<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
function getUcDealRepay($user_id,$limit,$condition=""){

	$result = array("rs_count"=>0,"list"=>array());
	$extWhere =" 1=1 ";
	$extWhere .=" and   has_repay=0 and user_id = ".$user_id ." and repay_time <=".next_replay_month(TIME_UTC,1)." ";

	$sql_count = "SELECT count(*) FROM ".DB_PREFIX."deal_repay where  $extWhere $condition  order by deal_id";
	$result['rs_count'] = $GLOBALS['db']->getOne($sql_count);
	if($result['rs_count'] > 0){
		$result['list']=$GLOBALS['db']->getAll("select *,l_key+1 as l_key_index from ".DB_PREFIX."deal_repay where  $extWhere $condition order by deal_id limit ".$limit);
		foreach($result['list'] as $k=>$v){
			$result['list'][$k]['name']= $GLOBALS['db']->getOne("select name from ".DB_PREFIX."deal where id = ".$result['list'][$k]['deal_id']);//贷款名称
			$result['list'][$k]['l_key_index'] = "第 ".$v['l_key_index']." 期";
			if($v['has_repay'] == 0){
				$result['list'][$k]['status_format'] = '待还';
			}elseif($v['status'] == 0){
				$result['list'][$k]['status_format'] = '提前还款';
			}elseif($v['status'] == 1){
				$result['list'][$k]['status_format'] = '准时还款';
			}elseif($v['status'] == 2){
				$result['list'][$k]['status_format'] = '逾期还款';
			}elseif($v['status'] == 3){
				$result['list'][$k]['status_format'] = '严重逾期';
			}
			$result['list'][$k]['repay_money_format'] = format_price($v['repay_money']);
			$result['list'][$k]['self_money_format'] = format_price($v['self_money']);
			$result['list'][$k]['interest_money_format'] = format_price($v['interest_money']);
		}
	}
	return $result;
}

function get_user_auth()
{
	$user_auth = array();
	//定义用户权限
	$user_auth_rs = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."user_auth where user_id = ".intval($GLOBALS['user_info']['id']));
	foreach($user_auth_rs as $k=>$row)
	{
		$user_auth[$row['m_name']][$row['a_name']][$row['rel_id']] = true;
	}
	return $user_auth;
}

class usercenterAction  extends publicAction
{
	public $user;
	public function __construct()
	{
		parent::__construct();
		if(!es_session::get('user_info')){
			alert('请先登入',0,url("index","login#index"));
		}
		$user = es_session::get('user_info');
		$this->user= get_user_info('*','id ='.$user['id']);
		
		
	}
	private $space_user;
	public function init_main()
	{
		//		$user_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id = ".intval($GLOBALS['user_info']['id']));
		//		require_once APP_ROOT_PATH."system/extend/ip.php";
		//		$iplocation = new iplocate();
		//		$address=$iplocation->getaddress($user_info['login_ip']);
		//		$user_info['from'] = $address['area1'].$address['area2'];
		$GLOBALS['tmpl']->assign('user_auth',get_user_auth());
	}
	private function get_loadlist($user_id,$where) {
		$condtion = "   AND dlr.has_repay = 0  ".$where." ";
		$sql = "select dlr.*,u.user_name,u.level_id,u.province_id,u.city_id from ".DB_PREFIX."deal_load_repay dlr LEFT JOIN ".DB_PREFIX."user u ON u.id=dlr.user_id  where ((dlr.user_id = ".$user_id." and dlr.t_user_id = 0) or dlr.t_user_id = ".$user_id.") $condtion order by dlr.repay_time desc ";
		$list = $GLOBALS['db']->getAll($sql);
	
		return $list;
	}
	public function index()
	{
		$page['title']="个人中心";
		//$GLOBALS['user'] =$this->user;
		

		
		$GLOBALS['tmpl']->assign('user',$this->user);
		$GLOBALS['tmpl']->assign("page",$page);
		$GLOBALS['tmpl']->display('my-account.html');
	}
	
	
	
	
	public function init_user(){
		
		$this->user_data = $this->user;
	
		$province_str = $GLOBALS['db']->getOne("select name from ".DB_PREFIX."region_conf where id = ".$this->user_data['province_id']);
		$city_str = $GLOBALS['db']->getOne("select name from ".DB_PREFIX."region_conf where id = ".$this->user_data['city_id']);
		if($province_str.$city_str=='')
			$user_location = $GLOBALS['lang']['LOCATION_NULL'];
		else
			$user_location = $province_str." ".$city_str;
	
		$this->user_data['fav_count'] = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."topic where user_id = ".$this->user_data['id']." and fav_id <> 0");
		$this->user_data['user_location'] = $user_location;
		$this->user_data['group_name'] = $GLOBALS['db']->getOne("select name from ".DB_PREFIX."user_group where id = ".$this->user_data['group_id']." ");
	
		$this->user_data['user_statics'] =sys_user_status($GLOBALS['user_info']['id'],false);
	
		$GLOBALS['tmpl']->assign('user_statics',$this->user_data['user_statics']);
	}
	public function usercenter(){
		$this->init_user();
		$user_info = $this->user_data;
		
		$ajax =intval($_REQUEST['ajax']);
		if($ajax==0)
		{
			$this->init_main();
		}
		$user_id = intval($GLOBALS['user_info']['id']);
		
		$data=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."licai where type=0");
		
		//我的红包
		$voucher_count = $GLOBALS['db']->getOne("SELECT COUNT(*) FROM ".DB_PREFIX."ecv WHERE user_id=".$user_id." AND if(end_time > 0, (end_time+24*3600-1) > ".TIME_UTC.",1=1) AND if(use_limit > 0,(use_limit - use_count) > 0,1=1)");
		$GLOBALS['tmpl']->assign("voucher_count",$voucher_count);
		$GLOBALS['tmpl']->assign("licai",$data);
		/***统计***/
		$user_statics = $user_info['user_statics'];
		
		
		
		
		//待收收益
		
		
		$user_info["lock_money"] = qian_format($user_info["lock_money"]);
		$user_statics["money"] = qian_format($user_info["money"]);
		
	
		$user_statics['h_profit'] = qian_format(get_profit($user_info['id'],0));//活期利息
		$user_statics['d_profit'] = qian_format(get_profit($user_info['id'],1));//定期收益
		$user_statics['sum_profit']=$user_statics['h_profit']+$user_statics['d_profit'];//总收益
		$user_statics['d_list'] = get_d_list($user_info['id']);//定期项目
		$user_statics['h_sum_money'] = qian_format(get_h_sum_money($user_info['id']));
		$user_statics['h_sum_money']=$user_statics['h_sum_money']?$user_statics['h_sum_money']:'0.00';
		$user_statics['h_sum_money'] =qian_format($user_statics['h_sum_money']);
		$user_statics['d_sum_money'] = qian_format(get_d_sum_money($user_info['id']));//定期投资金额
		$huo = get_huo_money($user_info['id']);
		//pp($huo);die;
	//	pp($user_statics);die;
		$user_statics['nmc_amount'] = $huo['is_effect']?$huo['nmc_amount']:'0.00';
// 		$yxb = $GLOBALS['db']->getOne("select id from ".DB_PREFIX."licai where type = 0");
// 		$GLOBALS['tmpl']->assign('yxb',$yxb);
		
		$user_statics['sum_money'] =qian_format(get_sum_money($user_info['id'],$user_statics));//总金额
		$user_statics['h_rape'] = get_h_rape();//获取最近活期利率
		$user_statics['h_id'] = get_h_id();
		//pp($user_statics);die;
		$user_statics['withdrawalsing_money']=$GLOBALS['db']->getOne("select sum(money) from ".DB_PREFIX."user_carry where user_id = ".$user_info['id']);
		$GLOBALS['tmpl']->assign('user_statics',$user_statics);
		$GLOBALS['tmpl']->display('user_index.html');
	}
	
	public function bind_bankcard(){
		$user_data = $this->user;
		$list=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$user_data['id']);
		//pp($list);die;
		$GLOBALS['tmpl']->assign('user_data',$user_data);
		$GLOBALS['tmpl']->assign('list',$list);
		 $GLOBALS['tmpl']->display('bind_bankcard.html'); 
	}
	
	public function security(){
		$user_data = $this->user;
		$list=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$user_data['id']);
		
		$user_data['bankcard'] = substr($user_data['bankcard'],-3);
		$GLOBALS['tmpl']->assign('list',$list);
		$GLOBALS['tmpl']->assign('user',$user_data);
		
		$GLOBALS['tmpl']->display('aq.html');
	}
	
	//验证手机号码
	public function validmobile()
	{
		$id=$_REQUEST['user_id'];
		$step = $_REQUEST['step'];
		//pp($step);die;
		$arr=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$id);
		//pp(MD5($_REQUEST['oldpwd']));die;//pp($arr['user_pwd']);die;
		if($step==1)
		{
			if(MD5($_REQUEST['oldpwd']) !== $arr['user_pwd']){
					
				$res['status'] =0;
				$res['step'] = 1;
				$res['info'] ="登录密码匹配错误";
				$res['jump'] ="";
				ajax_return($res);
				//alert("请重新核对原有密码",0,url("index","usercenter#security"));
					
			}else{
					
				$res['status'] =1;
				$res['step'] = 1;
				$res['info'] ="登录密码匹配成功";
				$res['jump'] =wap_url("index","usercenter#setmobileTpl",array("step"=>2));
				ajax_return($res);
				
			}
		}
		
		if($step==2){
		
			$mobile=$_REQUEST['mobile'];
	//pp("update ".DB_PREFIX."user set mobile = '".$mobile."' where id=".$id);
			$r=$GLOBALS['db']->query("update ".DB_PREFIX."user set mobile = '".$mobile."' where id=".$id);
			if($r){
				$res['status'] =1;
				$res['step'] = 2;
				$res['info'] ="手机号码修改成功";
				$res['jump'] =wap_url("index","usercenter");
				ajax_return($res);
				//alert("更新成功",0,url("index","usercenter#security"));
			}else{
				$res['status'] =0;
				$res['step'] = 2;
				$res['info'] ="手机号码修改失败或已存在";
				$res['jump'] ="";
				ajax_return($res);
				//alert("提交失败",0,url("index","usercenter#security"));
			}
		
		
			//alert("请重新核对原有密码",0,url("index","usercenter#security"));
		
		}
	}
	
	
	//修改支付密码页面
	public function setpwTpl()
	{
		$user_id = $_REQUEST['user_id'];
		
		$step=$_REQUEST['step']?$_REQUEST['step']:1;
		
		$user_data = $this->user;
		
		$list=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$user_data['id']);
		
		$GLOBALS['tmpl']->assign('user',$this->user);
		$GLOBALS['tmpl']->assign('step',$step);
		$GLOBALS['tmpl']->display('set_paypassword.html');
	}
	
	//修改登录密码页面
	public function setloginpwTpl()
	{
		$user_id = $_REQUEST['user_id'];
	
		$step=$_REQUEST['step']?$_REQUEST['step']:1;
	
		$user_data = $this->user;
	
		$list=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$user_data['id']);
	
		$GLOBALS['tmpl']->assign('user',$this->user);
		$GLOBALS['tmpl']->assign('step',$step);
		$GLOBALS['tmpl']->display('set_loginpassword.html');
	}
	
	//设置手机号码页面
	public function setmobileTpl()
	{
		$user_id = $_REQUEST['user_id'];
		
		$step=$_REQUEST['step']?$_REQUEST['step']:1;
		
		$user_data = $this->user;
		
		$list=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$user_data['id']);
		
		$GLOBALS['tmpl']->assign('user',$this->user);
		$GLOBALS['tmpl']->assign('step',$step);
		$GLOBALS['tmpl']->display('set_user_mobile.html');
	}
	
	public function changepwTpl()
	{
		$GLOBALS['tmpl']->display('change_password.html');
	}
	
	public function changepw(){
		
		$id=$_REQUEST['id'];
		
		$arr=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$id);
		//pp(MD5($_REQUEST['oldpw']));pp($arr['user_pwd']);die;
		if(MD5($_REQUEST['oldpw']) !== $arr['user_pwd']){
			alert("请重新核对原有密码",0,url("index","usercenter#security"));
		}else{
			if($_REQUEST['newpw'] !== $_REQUEST['tnewpw']){
				alert("两次输入的密码不相符",0,url("index","usercenter#security"));
			}else{
				$pwd=MD5($_REQUEST['newpw']);
				
				$r=$GLOBALS['db']->query("update ".DB_PREFIX."user set user_pwd = '".$pwd."' where id=".$id);
				
				if($r){
					alert("更新成功",0,url("index","usercenter#security"));
				}else{
					alert("提交失败",0,url("index","usercenter#security"));
				}
			}
		}
		
		
	}
	
	//设置登录密码
	public function validloginpwd(){
	
		$id=$_REQUEST['user_id'];
		$step = $_REQUEST['step'];
		//pp($step);die;
		$arr=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$id);
		//pp(MD5($_REQUEST['oldpwd']));die;//pp($arr['user_pwd']);die;
		if($step==1)
		{
			if(MD5($_REQUEST['oldpwd']) !== $arr['user_pwd']){
					
				$res['status'] =0;
				$res['step'] = 1;
				$res['info'] ="登录密码匹配错误";
				$res['jump'] ="";
				ajax_return($res);
				//alert("请重新核对原有密码",0,url("index","usercenter#security"));
					
			}else{
					
				$res['status'] =1;
				$res['step'] = 1;
				$res['info'] ="登录密码匹配成功";
				$res['jump'] =wap_url("index","usercenter#setloginpwTpl",array("step"=>2));
				ajax_return($res);
				/* if($_REQUEST['newpw'] !== $_REQUEST['tnewpw']){
				 	
				//alert("两次输入的密码不相符",0,url("index","usercenter#security"));
					
				}else{
				$pwd=MD5($_REQUEST['newpw']);
					
				$r=$GLOBALS['db']->query("update ".DB_PREFIX."user set user_pwd = '".$pwd."' where id=".$id);
					
				if($r){
				alert("更新成功",0,url("index","usercenter#security"));
				}else{
				alert("提交失败",0,url("index","usercenter#security"));
				}
				} */
			}
		}
	
	
		if($step==2){
				
			$pwd=MD5($_REQUEST['newpassword']);
				
			$r=$GLOBALS['db']->query("update ".DB_PREFIX."user set user_pwd = '".$pwd."' where id=".$id);
			if($r){
				$res['status'] =1;
				$res['step'] = 2;
				$res['info'] ="登录密码修改成功";
				$res['jump'] =wap_url("index","usercenter");
				ajax_return($res);
				//alert("更新成功",0,url("index","usercenter#security"));
			}else{
				$res['status'] =0;
				$res['step'] = 2;
				$res['info'] ="登录密码修改失败";
				$res['jump'] ="";
				ajax_return($res);
				//alert("提交失败",0,url("index","usercenter#security"));
			}
	
				
			//alert("请重新核对原有密码",0,url("index","usercenter#security"));
	
		}else{
	
			$res['status'] =1;
			$res['info'] ="登录密码匹配成功";
			$res['jump'] =wap_url("index","usercenter#setpwTpl",array("step"=>2));
			ajax_return($res);
			/* if($_REQUEST['newpw'] !== $_REQUEST['tnewpw']){
	
			//alert("两次输入的密码不相符",0,url("index","usercenter#security"));
	
			}else{
			$pwd=MD5($_REQUEST['newpw']);
	
			$r=$GLOBALS['db']->query("update ".DB_PREFIX."user set user_pwd = '".$pwd."' where id=".$id);
	
			if($r){
			alert("更新成功",0,url("index","usercenter#security"));
			}else{
			alert("提交失败",0,url("index","usercenter#security"));
			}
			} */
		}
	
	
	
	
	}
	
	//设置支付密码
	public function validpwd(){
	
		$id=$_REQUEST['user_id'];
		$step = $_REQUEST['step'];
		//pp($step);die;
		$arr=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$id);
		//pp($arr);die;
		//pp(MD5($_REQUEST['oldpwd']));die;//pp($arr['user_pwd']);die;
		if($step==1)
		{
			if(MD5($_REQUEST['oldpwd']) !== $arr['user_pwd']){
					
				$res['status'] =0;
				$res['step'] = 1;
				$res['info'] ="登录密码匹配错误";
				$res['jump'] ="";
				ajax_return($res);
				//alert("请重新核对原有密码",0,url("index","usercenter#security"));
			
			}else{
					
				$res['status'] =1;
				$res['step'] = 1;
				$res['info'] ="登录密码匹配成功";
				$res['jump'] =wap_url("index","usercenter#setpwTpl",array("step"=>2));
				ajax_return($res);
				/* if($_REQUEST['newpw'] !== $_REQUEST['tnewpw']){
			
				//alert("两次输入的密码不相符",0,url("index","usercenter#security"));
			
				}else{
				$pwd=MD5($_REQUEST['newpw']);
			
				$r=$GLOBALS['db']->query("update ".DB_PREFIX."user set user_pwd = '".$pwd."' where id=".$id);
			
				if($r){
				alert("更新成功",0,url("index","usercenter#security"));
				}else{
				alert("提交失败",0,url("index","usercenter#security"));
				}
				} */
			}
		}
		
		
		if($step==2){
			
			$pwd=MD5($_REQUEST['newpaypassword']);
			
			$r=$GLOBALS['db']->query("update ".DB_PREFIX."user set paypassword = '".$pwd."' where id=".$id);
			
			if($r){
				$res['status'] =1;
				$res['step'] = 2;
				$res['info'] ="支付密码修改成功";
				$res['jump'] =wap_url("index","usercenter");
				ajax_return($res);
				//alert("更新成功",0,url("index","usercenter#security"));
			}else{
				$res['status'] =0;
				$res['step'] = 2;
				$res['info'] ="支付密码修改成功";
				$res['jump'] ="";
				ajax_return($res);
				//alert("提交失败",0,url("index","usercenter#security"));
			}
				
			
			//alert("请重新核对原有密码",0,url("index","usercenter#security"));
		
		}else{
				
			$res['status'] =1;
			$res['info'] ="登录密码匹配成功";
			$res['jump'] =wap_url("index","usercenter#setpwTpl",array("step"=>2));
			ajax_return($res);
			/* if($_REQUEST['newpw'] !== $_REQUEST['tnewpw']){
		
			//alert("两次输入的密码不相符",0,url("index","usercenter#security"));
		
			}else{
			$pwd=MD5($_REQUEST['newpw']);
		
			$r=$GLOBALS['db']->query("update ".DB_PREFIX."user set user_pwd = '".$pwd."' where id=".$id);
		
			if($r){
			alert("更新成功",0,url("index","usercenter#security"));
			}else{
			alert("提交失败",0,url("index","usercenter#security"));
			}
			} */
		}
		
		
	
	
	}
	
	//更换手机号码
	
	public function changepaypw(){
		$id=$_REQUEST['id'];
		$arr=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id=".$id);
		$login_pwd=MD5($_REQUEST['login_pwd']);
		
		if($arr['user_pwd'] !== $login_pwd){
			echo "登录密码发生错误";
		}else{
			$paypwd=MD5($_REQUEST['paypwd']);
			$r=$GLOBALS['db']->query("update ".DB_PREFIX."user set paypassword = '".$paypwd."' where id=".$id);
			if($r){
				$user_data = $this->user;
				
				$user_data['paypassword']=$paypwd;
				es_session::set('user_info', $user_data);
				echo 1;
			}else{
				echo "更改失败";
			}
		}
	}
	
	public  function bankcheck(){
		$data['name']=$_REQUEST['name'];
		$data['bankcard']=$_REQUEST['bankcard'];
		$data['bankname']=$_REQUEST['bankname'];
		$id=$_REQUEST['uid'];
		if(!$data['name']){
			alert("姓名不能为空",0,url("index","usercenter#bind_bankcard"));
		}
		if(!$data['bankcard']){
			alert("卡号不能为空",0,url("index","usercenter#bind_bankcard"));
		}
		if(!$data['bankname']){
			alert("开户行不能为空",0,url("index","usercenter#bind_bankcard"));
		}
		if($data['bankname']&&$data['bankcard']&&$data['name']){
			$r=$GLOBALS['db']->query("update ".DB_PREFIX."user set real_name_encrypt='".$data['name']."' , bankcard='".$data['bankcard']."' , bankname='".$data['bankname']."' where id=".$id);
			
			if($r){
				$user_data = $this->user;
				$user_data['bankname']=$data['bankname'];
				$user_data['bankcard']=$data['bankcard'];
				$user_data['real_name_encrypt']=$data['name'];
				es_session::set('user_info', $user_data);
				$res['status'] = 1;
				$res['info'] = '认证成功';
				$res['url'] = url("index","usercenter#bind_bankcard");
				ajax_return($res);
// 				alert("认证成功",0,url("index","usercenter#bind_bankcard"));
			}else{
				$res['status'] = 0;
				$res['info'] = '认证失败';
				ajax_return($res);
// 				alert("认证失败",0,url("index","usercenter#bind_bankcard"));
			}
		}
	}
	
	public function myobject(){
		$GLOBALS['tmpl']->display('myobject.html');
	}
	public function myfriend(){
		$userdata=$this->user;
		$id=JIAM($userdata['id']);
		$data['url']=ROOT."/index.php?ctl=login&act=register_index&name=".$id;
		$data['code']=$id;
		$list = $GLOBALS['db'] ->getAll('select u.user_name,FROM_UNIXTIME(u.create_time+28800) as create_time ,sum(r.money) as money from '.DB_PREFIX."user as u left join ".DB_PREFIX."referrals as r on r.user_id = u.id where pid= ".$userdata['id']." group by u.id");

		$data['count']=count($list);
		foreach ($list as $v){
			$data['money'] +=$v['money'];
		}
		
		//转出
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		
		$w['user_id']=$userdata['id'];
		$w['order_id'] = 0;
		
		$mai = D('public')->table('licai_redempte')->where($w)->limit($limit)->select();
		$yxb = D('public')->table('licai')->where('type=0')->find();
		
		$GLOBALS['tmpl']->assign('yxb',$yxb);
		$GLOBALS['tmpl']->assign('mai',$mai);
		$GLOBALS['tmpl']->assign('data',$data);
		$GLOBALS['tmpl']->display('myfriend.html');
	}
	
	public function myfriend_v1(){
		$userdata=$this->user;
		$id=JIAM($userdata['id']);
		$data['url']=ROOT."/index.php?ctl=login&act=register_index&name=".$id;
		$data['code']=$id;
		$list = $GLOBALS['db'] ->getAll('select u.user_name,FROM_UNIXTIME(u.create_time+28800) as create_time ,sum(r.money) as money from '.DB_PREFIX."user as u left join ".DB_PREFIX."referrals as r on r.user_id = u.id where pid= ".$userdata['id']." group by u.id");
	
		$data['count']=count($list);
		foreach ($list as $v){
			$data['money'] +=$v['money'];
		}
	
		//转出
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
	
		$w['user_id']=$userdata['id'];
		$w['order_id'] = 0;
	
		$mai = D('public')->table('licai_redempte')->where($w)->limit($limit)->select();
		$yxb = D('public')->table('licai')->where('type=0')->find();
	
		$GLOBALS['tmpl']->assign('yxb',$yxb);
		$GLOBALS['tmpl']->assign('mai',$mai);
		$GLOBALS['tmpl']->assign('data',$data);
		$GLOBALS['tmpl']->display('myfriend_v1.html');
	}
	
	public function png(){
		$code=$_REQUEST['code'];
		require_once APP_ROOT_PATH.'sys/utils/phpqrcode/phpqrcode.php';
		
		
		$data['url']=ROOT."/index.php?ctl=login&name=".$code;
		
		$object = new \QRcode();
		$url=$data['url'];//网址或者是文本内容
		$level=3;
		$size=4;
		$errorCorrectionLevel =intval($level) ;//容错级别
		$matrixPointSize = intval($size);//生成图片大小
		 echo  $object->png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);
		
	}
	
	public function invitation(){
		
		$user = $this->user;
		$where['pid'] = $user['id'];
		
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		
		
		$user = es_session::get('user_info');
		$list = $GLOBALS['db'] ->getAll('select u.user_name,FROM_UNIXTIME(u.create_time+28800) as create_time ,sum(r.money) as money from '.DB_PREFIX."user as u left join ".DB_PREFIX."referrals as r on r.user_id = u.id where pid= ".$user['id']." GROUP by u.id  limit ".$limit);
		
		//pp('select u.user_name,FROM_UNIXTIME(u.create_time+28800) as create_time ,sum(r.money) as money from '.DB_PREFIX."user as u left join ".DB_PREFIX."referrals as r on r.user_id = u.id where pid= ".$user['id']." order by u.id  limit ".$limit);die;
		$count = $GLOBALS['db']->getOne('select u.user_name,FROM_UNIXTIME(u.create_time+28800) as create_time ,sum(r.money) as money from '.DB_PREFIX."user as u left join ".DB_PREFIX."referrals as r on r.user_id = u.id where pid= ".$user['id']);
		//pp('select u.user_name,FROM_UNIXTIME(u.create_time+28800) as create_time ,sum(r.money) as money from '.DB_PREFIX."user as u left join ".DB_PREFIX."referrals as r on r.user_id = u.id where pid= ".$user['id']." order by u.id  group by u.id limit ".$limit);die;
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		
		$GLOBALS['tmpl']->assign('page',$p);
		$GLOBALS['tmpl']->assign('list',$list);
		$GLOBALS['tmpl']->display('invitation.html');
	}
	
	public function account_balance(){
		$user = $this->user;
		
		$GLOBALS['tmpl']->assign('user',$user);
		$GLOBALS['tmpl']->display('account_balance.html');
	}
	public function withdrawals(){
		$user = $this->user;
		
		if(!$user['bankcard']){
			alert("请先认证银行卡",0,url("index","usercenter#bind_bankcard"));
		}
		
		
		$GLOBALS['tmpl']->assign('user',$user);
		$GLOBALS['tmpl']->display('withdrawals.html');
	}
	public function dlicai(){
		$GLOBALS['tmpl']->display('dlicai.html');
	}
	
public function  investment(){
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
			
		
		
		$user = $this->user;
		$list = $GLOBALS['db'] ->getAll('select o.*,l.name from '.DB_PREFIX."licai_order as o join ".DB_PREFIX."licai as l on l.id = o.licai_id  where o.user_id =".$user['id']." and o.type=1 and o.status>0  limit ".$limit);
		//pp('select o.*,l.name from '.DB_PREFIX."licai_order as o join ".DB_PREFIX."licai as l on l.id = o.licai_id  where o.user_id =".$user['id']." and o.type=1 and o.status>0  limit ".$limit);die;
		foreach ($list as $k=> $v){
			$list[$k]['profit']=get_deal_profit($user['id'],$v['id']);
		}
		$count = $GLOBALS['db'] ->getOne('select count(*) from '.DB_PREFIX."licai_order where  o.type=1 and user_id =".$user['id']);
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('page',$p);
		$GLOBALS['tmpl']->assign('list',$list);
		$GLOBALS['tmpl']->display('investment.html');
	}
	
	//活期转入
	public function current(){
		$user=$this->user;
		$where['user_id']=$user['id'];
		$where['type'] = 0;
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$buy = D('public')->table('licai_order')->where($where)->limit($limit)->select();
		
		$yxb = D('public')->table('licai')->where('type=0')->find();
		
		//$count=D('public')->table('licai_order')->where($where)->count();
		//$count=count($buy);
		$count=$GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."licai_order where user_id=".$where['user_id']." and type=".$where['type']);
		//pp("select count(*) from ".DB_PREFIX."licai_order where user_id=".$where['user_id']." and type=".$where['type']);die;
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		//pp($p);die;
		$GLOBALS['tmpl']->assign('yxb',$yxb);
		$GLOBALS['tmpl']->assign('buy',$buy);
		$GLOBALS['tmpl']->assign('page',$p);
		$GLOBALS['tmpl']->display('current.html');
	}
	//活期转出
	public function current_out(){
		$user=$this->user;
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$w['user_id']=$user['id'];
		$w['order_id'] = 0;
		
		$mai = D('public')->table('licai_redempte')->where($w)->limit($limit)->select();
		$yxb = D('public')->table('licai')->where('type=0')->find();
		$count=$GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."licai_redempte where user_id=".$w['user_id']." and order_id=".$w['order_id']);
		
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('yxb',$yxb);
		$GLOBALS['tmpl']->assign('mai',$mai);
		$GLOBALS['tmpl']->assign('page',$p);
		$GLOBALS['tmpl']->display('current_out.html');
	}
	
	public function current_list(){
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$user = es_session::get('user_info');
		$list=$GLOBALS['db']->getAll("select * from ".DB_PREFIX."licai_profit where order_id = 0 and user_id=".$user['id']." limit ".$limit);
		$count = $GLOBALS['db'] ->getOne("select count(*) from ".DB_PREFIX."licai_profit where order_id = 0 and user_id=".$user['id']);
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('list',$list);
		$GLOBALS['tmpl']->assign('page',$p);
		$GLOBALS['tmpl']->display('current_list.html');
	}
	//充值
	public function recharge(){
		$GLOBALS['tmpl']->display('recharge.html');
	}
	//提现记录
	public function  tixianlist(){
		$user=$this->user;
		
		
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$user = es_session::get('user_info');
		$list=$GLOBALS['db']->getAll("select * from ".DB_PREFIX."user_carry where user_id=".$user['id']);
		$count = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."user_carry where user_id=".$user['id']);
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
 		foreach ($list as $k=>$v){
 			$list[$k]['zonecard']=$v['bankzone']." / ".substr($v['bankcard'],-4);
 		}
		$GLOBALS['tmpl']->assign('page',$p);
		$GLOBALS['tmpl']->assign('list',$list);
		$GLOBALS['tmpl']->display('cash.html');
	}
}
?>