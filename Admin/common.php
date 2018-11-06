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
 * 请求api接口
 * @param unknown_type $act 接口名
 * @param unknown_type $param 参数
 * 
 * 返回：array();
*/
function request_api($ctl,$act="index",$request_param=array())
{
	$api_url = $GLOBALS['wap_config']['API_URL'];
	if(empty($api_url))
	{
		$api_url = SITE_DOMAIN.APP_ROOT."/mapi/index.php";
	}
		

	//定义基础数据
	$request_param['ctl']=$ctl;
	$request_param['act']=$act;
	$request_param['r_type']=0;
	$request_param['i_type']=1;
	$request_param['from']='wap';
	$request_param['sess_id'] = $GLOBALS['sess_id'];
	$request_param['email'] = $GLOBALS['cookie_uname'];
	$request_param['pwd'] = $GLOBALS['cookie_upwd'];
	$request_param['biz_uname'] = $GLOBALS['cookie_biz_uname'];
	$request_param['biz_upwd'] = $GLOBALS['cookie_biz_upwd'];
	$request_param['client_ip'] = CLIENT_IP;
	$request_param['image_zoom'] = 2;
	$request_param['ref_uid'] = $GLOBALS['ref_uid'];
	$request_param['spid'] = $GLOBALS['supplier_info']['id']; //上传商户ID
	//以下是定位的传参，api端为可选参数，由wap端进行传参生成数据
	$request_param['city_id'] = $GLOBALS['city']['id'];
	$request_param['m_longitude'] = $GLOBALS['geo']['xpoint'];
	$request_param['m_latitude'] = $GLOBALS['geo']['ypoint'];
	

	filter_request($request_param);
	
	es_session::write();

	$request_data = $GLOBALS['transport']->request($api_url,$request_param);
	
	$data=$request_data['body'];
// 	echo $data;exit;
	$data=json_decode(base64_decode($data),1);
	return $data;
	
}
/* 加密传输
function request_api($ctl,$act="index",$request_param=array())
{
	$api_url = $GLOBALS['wap_config']['API_URL'];
	if(empty($api_url))
	{
		$api_url = SITE_DOMAIN.APP_ROOT."/mapi/index.php";
	}


	//定义基础数据
	$request_param['ctl']=$ctl;
	$request_param['act']=$act;
	//$request_param['r_type']=0;
	//$request_param['i_type']=1;
	$request_param['from']='wap';
	$request_param['sess_id'] = $GLOBALS['sess_id'];
	$request_param['email'] = $GLOBALS['cookie_uname'];
	$request_param['pwd'] = $GLOBALS['cookie_upwd'];
	$request_param['biz_uname'] = $GLOBALS['cookie_biz_uname'];
	$request_param['biz_upwd'] = $GLOBALS['cookie_biz_upwd'];
	$request_param['client_ip'] = CLIENT_IP;
	$request_param['image_zoom'] = 2;
	$request_param['ref_uid'] = $GLOBALS['ref_uid'];
	$request_param['spid'] = $GLOBALS['supplier_info']['id']; //上传商户ID

	//以下是定位的传参，api端为可选参数，由wap端进行传参生成数据
	$request_param['city_id'] = $GLOBALS['city']['id'];
	$request_param['m_longitude'] = $GLOBALS['geo']['xpoint'];
	$request_param['m_latitude'] = $GLOBALS['geo']['ypoint'];

	filter_request($request_param);

	require_once APP_ROOT_PATH.'/system/libs/crypt_aes.php';
	$aes = new CryptAES();
	$aes->set_key(FANWE_AES_KEY);
	$aes->require_pkcs5();
	$json = json_encode($request_param);
	$encText = $aes->encrypt($json);

	$param=array();
	$param['r_type']=4;
	$param['i_type']=4;
	$param['requestData']=$encText;
	$param['client_ip'] = CLIENT_IP;

	es_session::write();
	
	$request_data = $GLOBALS['transport']->request($api_url,$param);
	
	$data=$request_data['body'];
	
	if ($param['r_type'] == 4){
		$data = $aes->decrypt($data);
		$data=json_decode($data,1);
	}else{
		$data=json_decode(base64_decode($data),1);
	}

	return $data;

}
*/
//解析URL标签
// $str = u:wap#index|id=10&name=abc
function parse_url_tag($str)
{
	$key = md5("URL_TAG_".$str);
	if(isset($GLOBALS[$key]))
	{
		return $GLOBALS[$key];
	}

	$url = load_dynamic_cache($key);
	$url=false;
	if($url!==false)
	{
		$GLOBALS[$key] = $url;
		return $url;
	}
	$str = substr($str,2);
	$str_array = explode("|",$str);
	$app_index = $str_array[0];
	$route = $str_array[1];
	$param_tmp = explode("&",$str_array[2]);
	$param = array();

	foreach($param_tmp as $item)
	{
		if($item!='')
			$item_arr = explode("=",$item);
		if($item_arr[0]&&$item_arr[1])
			$param[$item_arr[0]] = $item_arr[1];
	}
	if(isApp())
		$param['show_prog'] = 1;
	$GLOBALS[$key]= wap_url($app_index,$route,$param);
	set_dynamic_cache($key,$GLOBALS[$key]);
	return $GLOBALS[$key];
}
//封装url



/**
 * 获得查询次数以及查询时间
 *
 * @access  public
 * @return  string
 */
function run_info()
{

	if(!SHOW_DEBUG)return "";

	$query_time = number_format($GLOBALS['db']->queryTime,6);

	if($GLOBALS['begin_run_time']==''||$GLOBALS['begin_run_time']==0)
	{
		$run_time = 0;
	}
	else
	{
		if (PHP_VERSION >= '5.0.0')
		{
			$run_time = number_format(microtime(true) - $GLOBALS['begin_run_time'], 6);
		}
		else
		{
			list($now_usec, $now_sec)     = explode(' ', microtime());
			list($start_usec, $start_sec) = explode(' ', $GLOBALS['begin_run_time']);
			$run_time = number_format(($now_sec - $start_sec) + ($now_usec - $start_usec), 6);
		}
	}

	/* 内存占用情况 */
	if (function_exists('memory_get_usage'))
	{
		$unit=array('B','KB','MB','GB');
		$size = memory_get_usage();
		$used = @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
		$memory_usage = lang("MEMORY_USED",$used);
	}
	else
	{
		$memory_usage = '';
	}

	/* 是否启用了 gzip */
	$enabled_gzip = (app_conf("GZIP_ON") && function_exists('ob_gzhandler'));
	$gzip_enabled = $enabled_gzip ? lang("GZIP_ON") : lang("GZIP_OFF");

	$str = lang("QUERY_INFO_STR",$GLOBALS['db']->queryCount, $query_time,$gzip_enabled,$memory_usage,$run_time);

	foreach($GLOBALS['db']->queryLog as $K=>$sql)
	{
		if($K==0)$str.="<br />SQL语句列表：";
		$str.="<br />行".($K+1).":".$sql;
	}

	return "<div style='width:640px; padding:10px; line-height:22px; border:1px solid #ccc; text-align:left; margin:30px auto; font-size:14px; color:#999; height:150px; overflow-y:auto;'>".$str."</div>";
}


//显示错误
function showErr($msg,$ajax=0,$jump='',$stay=0)
{
	if($jump=="")
		$jump = get_gopreview();
	echo "<script>alert('".$msg."');location.href='".$jump."';</script>";exit;
}

//显示成功
function showSuccess($msg,$ajax=0,$jump='',$stay=0)
{
	if($jump=="")
		$jump = get_gopreview();
	echo "<script>alert('".$msg."');parent.location.href='".$jump."';</script>";exit;
}


function agentArr(){
	$agent = $_SERVER['HTTP_USER_AGENT'];
	$agent_array = array();
	if($agent){
		$agent_arr = explode(" ",$agent);
		foreach($agent_arr as $k=>$v){
			$kkv = explode("/",$v);
			$agent_array[$kkv[0]] = strim($kkv[1]);
		}
	}
	return $agent_array;
}


function get_sdk_guid(){
	$agent = agentArr();
	return $agent['sdk_guid'];
}

function isApp(){
	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$is_app = strpos($agent, 'fanwe_app_sdk') ? true : false ;
	if($is_app){
		return true;
	}else{
		return false;
	}
}
function save_log($msg,$status)
{
	if(app_conf("ADMIN_LOG")==1)
	{
		$adm_session = es_session::get(md5(app_conf("AUTH_KEY")));
		$log_data['log_info'] = $msg;
		$log_data['log_time'] = TIME_UTC;
		$log_data['log_admin'] = intval($adm_session['adm_id']);
		$log_data['log_ip']	= CLIENT_IP;
		$log_data['log_status'] = $status;	
		$log_data['module']	=	MODULE_NAME;
		$log_data['action'] = 	ACTION_NAME;
		D('login','Admin')->table("Log")->add($log_data);
	}
}

/*
 * 充值日志记录
`recharge_price`'变动金额',
  `user_id`'充值的会员',
  `user_name`'会员名称',
 **/
function recharge_log($recharge_price,$user_id,$user_name){
	$adm_session = es_session::get(md5(app_conf("AUTH_KEY")));
	$log_data['create_time'] = to_date(TIME_UTC);
	$log_data['operation_admin'] = $adm_session['adm_name'];
	$log_data['recharge_price'] = $recharge_price;
	$log_data['user_id'] = $user_id;
	$log_data['user_name'] = $user_name;
	D('public','Admin')->table("recharge_log")->add($log_data);
}

/*
 * 提现日志记录
 * $withdraw_price 提现金额
 * $user_id 用户id
 * $user_name 用户名
 * $status 提现审核状态
 *   */

function withdraw_log($withdraw_price,$user_id,$user_name,$status){
	$adm_session = es_session::get(md5(app_conf("AUTH_KEY")));
	$log_data['create_time'] = to_date(TIME_UTC);
	$log_data['operation_admin'] = $adm_session['adm_name'];
	$log_data['withdraw_price'] = $withdraw_price;
	$log_data['user_id'] = $user_id;
	$log_data['user_name'] = $user_name;
	$log_data['status'] = $status;
	D('public','Admin')->table("withdraw_log")->add($log_data);
}

?>