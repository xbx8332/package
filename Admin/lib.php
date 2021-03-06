<?php 
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
/**
 * 刷新会员安全登录状态
 */
function refresh_user_info()
{
	global $user_info;
	global $user_logined;
	//实时刷新会员数据
	if($user_info)
	{
		$user_info = load_user($user_info['id']);
		$user_level = load_auto_cache("cache_user_level");
		$user_info['level'] = $user_level[$user_info['level_id']]['level'];
		$user_info['level_name'] = $user_level[$user_info['level_id']]['name'];
		es_session::set('user_info',$user_info);

		$user_logined_time = intval(es_session::get("user_logined_time"));
		$user_logined = es_session::get("user_logined");
		if(NOW_TIME-$user_logined_time>=MAX_LOGIN_TIME)
		{
			es_session::set("user_logined_time",0);
			es_session::set("user_logined", false);
			$user_logined = false;
		}
		else
		{
			if($user_logined)
				es_session::set("user_logined_time",NOW_TIME);
		}
	}
}

/**
 * 前端全运行函数，生成系统前台使用的全局变量
 * 1. 定位城市 GLOBALS['city'];
 * 2. 加载会员 GLOBALS['user_info'];
 * 3. 定位经纬度 GLOBALS['geo'];
 * 4. 加载推荐人与来路
 * 5. 更新购物车
 */
function global_run()
{
	global $global_is_run;
	$global_is_run = true;
	if(app_conf("SHOP_OPEN")==0&&get_client_ip()!='222.79.16.96')  //网站关闭时跳转到站点关闭页
	{
		app_redirect(wap_url("index","close"));
	}

	
	//处理城市
	global $city; 
	//require_once APP_ROOT_PATH."system/model/city.php";
	//$city = City::locate_city(intval($_REQUEST['city_id']));

	//处理经纬度
	//global $geo;
	//$geo = City::locate_geo($_REQUEST['m_longitude'],$_REQUEST['m_latitude']);
		
	global $ref_uid;
	
	//保存返利的cookie
	if($_REQUEST['r'])
	{
		$rid = intval(base64_decode($_REQUEST['r']));
		$ref_uid = intval($GLOBALS['db']->getOne("select id from ".DB_PREFIX."user where id = ".intval($rid)));
		es_cookie::set("REFERRAL_USER",intval($ref_uid));
	}
	else
	{
		//获取存在的推荐人ID
		if(intval(es_cookie::get("REFERRAL_USER"))>0)
			$ref_uid = intval($GLOBALS['db']->getOne("select id from ".DB_PREFIX."user where id = ".intval(es_cookie::get("REFERRAL_USER"))));
	}
	
	//会员自动登录及输出
	global $cookie_uname;
	global $cookie_upwd;
	global $user_info;
	global $user_logined;
	global $wx_info;
	global $is_weixin; //是否为微信访问
	global $supplier_info;  //商家信息
	//处理商户信息
	global $spid;
	$spid = intval($_REQUEST['spid']);
	if($spid>0)
	{
		$supplier_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."supplier where id = ".$spid);
	}
	
	$is_weixin=isWeixin();
	//用户15分钟不操作 要求用户重新登录
	

	if(es_session::get('time')>NOW_TIME)
	{
		es_session::set('time',NOW_TIME+900);
		
	}else{
		/* require_once './wap/Lib/main/core/common.php'; */
		$_SESSION['user_info']=null;
		es_cookie::delete("user_name");
		es_cookie::delete("user_pwd");
		/* return output("",1,'请重新登录'); */
	}
	
	
	
	$user_info = es_session::get('user_info');
	$wx_info = es_session::get("wx_info"); //微信在平台的信息记录，openid为平台公众号的openid，wx_openid为商家公众号的openid
	$spid = $account_id = intval($supplier_info['id']);
	
	$weixin_login = intval($_REQUEST['weixin_login']);
	if($weixin_login==1)
	{
		es_cookie::delete("deny_weixin_".intval($GLOBALS['supplier_info']['id']));
		$deny_weixin = 0;
	}
	else
	{
		$deny_weixin = intval(es_cookie::get("deny_weixin_".intval($GLOBALS['supplier_info']['id'])));
	}
	
	//$account_id = 23;
	if(empty($user_info))
	{
		//关于微信登录		
		//$m_config = getMConfig();//初始化手机端配置		
		if($is_weixin&&$deny_weixin==0)			
		{
			require_once APP_ROOT_PATH.'system/utils/weixin.php';
			$weixin_conf = load_auto_cache("weixin_conf");
			if($weixin_conf['platform_status']==1)
			{				
				$weixin_account_platform = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."weixin_account where user_id = 0");
				$weixin_account = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."weixin_account where user_id = '".$account_id."'");
				if(empty($weixin_account))$weixin_account=$weixin_account_platform;
				if($weixin_conf['platform_component_verify_ticket']!=""&&$weixin_account&&$weixin_account_platform)
				{		
					if(!$wx_info['openid'])//如未获取平台公众的openid先获取openid
					{
						$wx_code = strim($_REQUEST['code']);
						$wx_status = intval($_REQUEST['state']);
						if($wx_code&&$wx_status)
						{
							//微信端回跳回wap
							$url =  get_current_url();
							$weixin=new weixin($weixin_account_platform['authorizer_appid'],"",SITE_DOMAIN.$url,"snsapi_base");
							$wx_info['openid'] = $weixin->scope_get_openid($wx_code);
							es_session::set("wx_info", $wx_info);		
							app_redirect($url);
						}
						else
						{
							//跳转至微信的授权页
							$url =  get_current_url();
							$weixin = new weixin($weixin_account_platform['authorizer_appid'],"",SITE_DOMAIN.$url,"snsapi_base");
							$wx_url=$weixin->scope_get_code_platform();
							app_redirect($wx_url);
						}
					}
					else
					{
						//平台openid已授权，获取商家的openid
						$openid = $wx_info['openid'];
						$wx_code = strim($_REQUEST['code']);
						$wx_status = intval($_REQUEST['state']);
						if($wx_code&&$wx_status&&intval($_REQUEST['redirect'])==0)
						{
							//微信端回跳回wap							
							$url =  get_current_url();
							$weixin=new weixin($weixin_account['authorizer_appid'],"",SITE_DOMAIN.$url,"snsapi_base");								
							$wx_info['openid'] = $openid;	
							$wx_info['wx_openid'] = $weixin->scope_get_openid($wx_code);
							es_session::set("wx_info", $wx_info);
						}
							
						
						if($wx_info&&$wx_info['wx_openid']&&$wx_info['openid'])
						{
							$platform_user_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user  where wx_openid='".$wx_info['openid']."'"); //平台用户
							$supplier_user = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."weixin_user where account_id = '".$account_id."' and user_id = '".$platform_user_info['id']."'"); //获取当前商户的用户
							
							if($platform_user_info&&$supplier_user) //有平台用户，并且该用户已在商户生成过用户
							{
								auto_do_login_user($platform_user_info['user_name'],$platform_user_info['user_pwd'],false);
								$user_info = es_session::get('user_info');
							}
							elseif($platform_user_info&&!$supplier_user)//有平台用户但未成商家生成过用户
							{
								$GLOBALS['db']->query("delete from ".DB_PREFIX."weixin_user where openid = '".$wx_info['wx_openid']."'");
								$supplier_user = array();
								$supplier_user['user_id'] = $platform_user_info['id'];
								$supplier_user['account_id'] = $account_id;
								$supplier_user['openid'] = $wx_info['wx_openid']; //商户openid
								$supplier_user['nickname'] = $platform_user_info['user_name'];
								$GLOBALS['db']->autoExecute(DB_PREFIX."weixin_user",$supplier_user);
								$supplier_user['id'] = $GLOBALS['db']->insert_id();
								auto_do_login_user($platform_user_info['user_name'],$platform_user_info['user_pwd'],false);
								$user_info = es_session::get('user_info');
							}
							else
							{
								if(intval($_REQUEST['redirect'])==0) //未通知重定向
								{									
									//再次跳转
									$url =  get_current_url()."&redirect=1";	
									app_redirect($url);
								}
								else
								{
									
									//先再次授权下拉用户信息
									//第三次
									$wx_code = strim($_REQUEST['code']);
									$wx_status = intval($_REQUEST['state']);
									if($wx_code&&$wx_status)
									{
										//微信端回跳回wap
										$url =  get_current_url();
										$weixin=new weixin($weixin_account['authorizer_appid'],"",SITE_DOMAIN.$url);
										$weixin_user_info = $weixin->scope_get_userinfo_platform($wx_code); //通过授权获取到用户信息
										if($weixin_user_info['errcode'])
										{
											die($weixin_user_info['errmsg']);
										}
										//获取到用户详细信息
										if(!$platform_user_info)//平台用户未生成
										{
											$user_data = array();
											$user_data['user_name'] = $weixin_user_info['nickname'];
											$user_data['wx_openid'] = $wx_info['openid']; //平台openid
											$rs = auto_create($user_data);
											$platform_user_info = $rs['user_data'];
										}
										
										if(!$supplier_user)//商户会员未生成
										{
											$supplier_user = array();
											$supplier_user['user_id'] = $platform_user_info['id'];
											$supplier_user['account_id'] = $account_id;
											$supplier_user['openid'] = $wx_info['wx_openid']; //商户openid
											$supplier_user['nickname'] = $platform_user_info['user_name'];
											$GLOBALS['db']->autoExecute(DB_PREFIX."weixin_user",$supplier_user);
											$supplier_user['id'] = $GLOBALS['db']->insert_id();
										}
										
										if($supplier_user['openid']!=$wx_info['wx_openid'])
										{
											$supplier_user['user_id'] = $platform_user_info['id'];
											$supplier_user['account_id'] = $account_id;
											$supplier_user['openid'] = $wx_info['wx_openid']; //商户openid
											$supplier_user['nickname'] = $weixin_user_info['nickname'];
											$GLOBALS['db']->autoExecute(DB_PREFIX."weixin_user",$supplier_user,"UPDATE","id='".$supplier_user['id']."'");
										}
										auto_do_login_user($platform_user_info['user_name'],$platform_user_info['user_pwd'],false);
										$user_info = es_session::get('user_info');
									}
									else
									{
										//跳转至微信的授权页
										$url =  get_current_url();
										$weixin = new weixin($weixin_account['authorizer_appid'],"",SITE_DOMAIN.$url);
										$wx_url=$weixin->scope_get_code_platform();
										app_redirect($wx_url);
									}
								}//第三次授权成功
							}							
							
						}
						else
						{
							//跳转至微信的授权页
							$url =  get_current_url();
							$weixin = new weixin($weixin_account['authorizer_appid'],"",SITE_DOMAIN.$url,"snsapi_base");
							$wx_url=$weixin->scope_get_code_platform();
							app_redirect($wx_url);
						}
					}
					
				}
			}
			else
			{				
				if($m_config['wx_appid']&&$m_config['wx_secrit'])
				{
					$wx_code = strim($_REQUEST['code']);
					$wx_status = intval($_REQUEST['state']);
					if($wx_code&&$wx_status)
					{
						//微信端回跳回wap
						$url =  get_current_url();
						$weixin=new weixin($m_config['wx_appid'],$m_config['wx_secrit'],SITE_DOMAIN.$url);
						$wx_info=$weixin->scope_get_userinfo($wx_code);
					}
				
					if($wx_info&&$wx_info['openid'])
					{
						//用户未登陆
						$wx_user_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where wx_openid='".$wx_info['openid']."'");
						if($wx_user_info){
							//如果会员存在，直接登录
							auto_do_login_user($wx_user_info['user_name'],$wx_user_info['user_pwd'],false);
						}else{
							//会员不存在进入自动创建流程
							$user_data = array();
							$user_data['user_name'] = $wx_info['nickname'];
							$user_data['wx_openid'] = $wx_info['openid'];
							$rs = auto_create($user_data);
							$user_data = $rs['user_data'];
							auto_do_login_user($user_data['user_name'],$user_data['user_pwd'],false);
						}
						$user_info = es_session::get('user_info');
					}
					else
					{
						//跳转至微信的授权页
						$url =  get_current_url();
						$weixin = new weixin($m_config['wx_appid'],$m_config['wx_secrit'],SITE_DOMAIN.$url);
						$wx_url=$weixin->scope_get_code();
						app_redirect($wx_url);
					}
				}
				else
				{
					//showErr("微信功能未开通");
				}
			}//end platform
			
		}
		else
		{
			$cookie_uname = es_cookie::get("user_name")?es_cookie::get("user_name"):'';
			$cookie_upwd = es_cookie::get("user_pwd")?es_cookie::get("user_pwd"):'';
			if($cookie_uname!=''&&$cookie_upwd!=''&&!es_session::get("user_info"))
			{
				$cookie_uname = strim($cookie_uname);
				$cookie_upwd = strim($cookie_upwd);
				auto_do_login_user($cookie_uname,$cookie_upwd);
				$user_info = es_session::get('user_info');
			}
		}		
	}
	else
	{
		//已登录		
		if($is_weixin&&$deny_weixin==0)
		{
			$weixin_conf = load_auto_cache("weixin_conf");
			if($weixin_conf['platform_status']==1)
			{
				$supplier_user = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."weixin_user where account_id = '".$account_id."' and user_id = '".$user_info['id']."'"); //获取当前商户的用户
				if(empty($supplier_user))
				{
					$data = call_api_core("user","loginout");
					es_cookie::delete("user_name");
					es_cookie::delete("user_pwd");
					es_session::delete("wx_info");
					$url = get_gopreview();
					$url = preg_replace("/&redirect=[^&]*/i", "", $url);
					app_redirect($url);
				}	
			}			
		}
	}
	refresh_user_info();
	
	//此处是会员（商家登录状态的初始化）
	//require_once APP_ROOT_PATH."system/libs/biz_user.php";
	global $cookie_biz_uname;
	global $cookie_biz_upwd;
	global $account_info;
	$account_info = es_session::get('account_info');
	countNo($geo);
	if(empty($account_info))
	{
		$cookie_biz_uname = es_cookie::get("biz_uname")?es_cookie::get("biz_uname"):'';
		$cookie_biz_upwd = es_cookie::get("biz_upwd")?es_cookie::get("biz_upwd"):'';
		if($cookie_biz_uname!=''&&$cookie_biz_upwd!=''&&!es_session::get("account_info"))
		{
			$cookie_biz_uname = strim($cookie_biz_uname);
			$cookie_biz_upwd = strim($cookie_biz_upwd);
			do_login_biz($cookie_biz_uname, $cookie_biz_upwd);
			$account_info = es_session::get('account_info');
		}
	}
	//实时刷新会员数据
	if($account_info)
	{
		$account_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."supplier_account where is_delete = 0 and is_effect = 1 and id = ".intval($account_info['id']));
		if($account_info['is_main'] == 1){ //主账户取所有门店
			$account_locations = $GLOBALS['db']->getAll("select id as location_id from ".DB_PREFIX."supplier_location where supplier_id = ".$account_info['supplier_id']);
		}else
			$account_locations = $GLOBALS['db']->getAll("select location_id from ".DB_PREFIX."supplier_account_location_link where account_id = ".$account_info['id']);
	
		$account_location_ids = array();
		foreach($account_locations as $row)
		{
			$account_location_ids[] = $row['location_id'];
		}
		$account_info['location_ids'] =  $account_location_ids;
		$GLOBALS['account_info']['location_ids'] =  $account_location_ids;
	
		es_session::set('account_info',$account_info);
	}
	//end 商家端处理
	
	//刷新购物车


	

	global $referer;
	//保存来路
	// 	es_cookie::delete("referer_url");
	if(!es_cookie::get("referer_url"))
	{
		if(!preg_match("/".urlencode(SITE_DOMAIN.APP_ROOT)."/",urlencode($_SERVER["HTTP_REFERER"])))
		{
			$ref_url = $_SERVER["HTTP_REFERER"];
			if(substr($ref_url, 0,7)=="http://"||substr($ref_url, 0,8)=="https://")
			{
				preg_match("/http[s]*:\/\/[^\/]+/", $ref_url,$ref_url);
				$referer = $ref_url[0];
				if($referer)
					es_cookie::set("referer_url",$referer);
			}
		}
	}
	else
	{
		$referer = es_cookie::get("referer_url");
	}
	$referer = strim($referer);

	es_cookie::delete("is_pc");
}



/**
 * 获取前次停留的页面地址
 * @return string url
 */
function get_gopreview()
{
	$gopreview = es_session::get("wap_gopreview");
	if($gopreview==get_current_url())
	{
		$gopreview = wap_url("index");
	}
	if(empty($gopreview))
		$gopreview = wap_url("index");
	return $gopreview;
}


/**
 * 获取当前的url地址，包含分页
 * @return string
 */
function get_current_url()
{
	$url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?");
	$parse = parse_url($url);
	if(isset($parse['query'])) {
		parse_str($parse['query'],$params);
		$url   =  $parse['path'].'?'.http_build_query($params);
	}

	$url = preg_replace("/&code=[^&]*/i", "", $url);
	$url = preg_replace("/&state=[^&]*/i", "", $url);
	$url = preg_replace("/&appid=[^&]*/i", "", $url);
	return $url;
}

/**
 * 将当前页设为回跳的上一页地址
 */
function set_gopreview()
{
	$url =  get_current_url();
	es_session::set("wap_gopreview",$url);
}


function load_sms_lesstime()
{
	$data	=	es_session::get("send_sms_code_0_ip");
	$lesstime = SMS_TIMESPAN -(NOW_TIME - $data['time']);  //剩余时间
	if($lesstime<0)$lesstime=0;
	return $lesstime;
}
?>