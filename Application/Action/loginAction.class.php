<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
require_once APP_ROOT_PATH."sys/model/user.php";
class loginAction extends publicAction
{
	public function index()
	{
		set_gopreview();
		
		$namecode=$_REQUEST['name'];
		
		$GLOBALS['tmpl']->assign('code',$namecode);
		$GLOBALS['tmpl']->display('uc_login.html');
	}
	
	public function register_index(){
		
		$GLOBALS['tmpl']->assign('name',$_REQUEST['name']);
		$GLOBALS['tmpl']->display('uc_register.html');
	}
	
	public function out(){
		es_session::set('user_info','');
		app_redirect(url("index","index#index"));
	}
	
	public function register()
	{
		//注册验证码
// 		if(intval(app_conf("VERIFY_IMAGE")) == 1 && intval(app_conf("USER_VERIFY")) >= 3){
// 			$verify = md5(trim($_REQUEST['verify']));
// 			$session_verify = es_session::get('verify');
// 			if($verify!=$session_verify)
// 			{				
// 				showErr($GLOBALS['lang']['VERIFY_CODE_ERROR'],0,url("shop","user#register"));
// 			}
// 		}
		
		require_once APP_ROOT_PATH."sys/model/user.php";
		$user_data = $_POST;
		if(!$user_data){
			 app_redirect("404.html");
			 exit();
		}
		foreach($user_data as $k=>$v)
		{
			$user_data[$k] = htmlspecialchars(addslashes($v));
		}
		
		if(trim($user_data['user_pwd'])!=trim($user_data['user_pwd_confirm']))
		{
			showErr($GLOBALS['lang']['USER_PWD_CONFIRM_ERROR']);
		}
		if(trim($user_data['user_pwd'])=='')
		{
			showErr($GLOBALS['lang']['USER_PWD_ERROR']);
		}
		$patten3 = "/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,21}$/";
		if(!preg_match($patten3,trim($user_data['user_pwd'])))
		{
			showErr("设置密码请输入6-21字母和数字组成");
		}
		
		if(isset($user_data['referer']) && $user_data['referer']!=""){
			$p_user_data = get_user_info("id,user_type","mobile_encrypt =AES_ENCRYPT('".$user_data['referer']."','".AES_DECRYPT_KEY."') OR user_name='".$user_data['referer']."'");

			if($p_user_data["user_type"] == 3)
			{
				$user_data['referer_memo'] = $p_user_data['id'];
				//$user_data['pid'] = $p_user_data['id'];
				$user_data['pid'] = 0;
			}
			elseif($p_user_data["user_type"] < 2)
			{
				$user_data['pid'] = $p_user_data["id"];
				if($user_data['pid'] > 0){
					$refer_count = get_user_info("count(*)","pid='".$user_data['pid']."' ","ONE");
					if($refer_count == 0){
						$user_data['referral_rate'] = (float)trim(app_conf("INVITE_REFERRALS_MIN"));
					}
					elseif((float)trim(app_conf("INVITE_REFERRALS_MIN")) + $refer_count*(float)trim(app_conf("INVITE_REFERRALS_RATE")) > (float)trim(app_conf("INVITE_REFERRALS_MAX"))){
						$user_data['referral_rate'] =(float)trim(app_conf("INVITE_REFERRALS_MAX"));
					}
					else{
						$user_data['referral_rate'] =(float)trim(app_conf("INVITE_REFERRALS_MIN")) + $refer_count*(float)trim(app_conf("INVITE_REFERRALS_RATE"));
					}
						
					
					if(intval(app_conf("REFERRAL_IP_LIMIT")) > 0 && get_user_info("count(*)","register_ip ='".CLIENT_IP."' AND pid='".$user_data['pid']."'","ONE") > 0){
						$user_data['referral_rate'] = 0;
					}
				}
				else{
					$user_data['pid'] = 0;
					$user_data['referer_memo'] = $user_data['referer'];
				}
			}
		}
		if($_REQUEST['pid']){
			$user_data['pid']=JIEM($_REQUEST['pid']);
		}elseif($_REQUEST['p_name']){
			$user_data['pid']=$GLOBALS['db']->getOne("select id from ".DB_PREFIX."user where user_name='".$_REQUEST['p_name']."'");
			if(!$user_data['pid']){
				alert("该推荐人 不存在",0,url("index","login#index"));
			}
		}
		
		//判断是否为手机注册
		if((app_conf("REGISTER_TYPE") == 0 || app_conf("REGISTER_TYPE") == 1) && (app_conf("USER_VERIFY") == 0 || app_conf("USER_VERIFY") == 2)){
			if(strim($user_data['sms_code'])==""){
				showErr("请输入手机验证码");
			}
			//判断验证码是否正确
			if($GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."mobile_verify_code WHERE mobile='".strim($user_data['mobile'])."' AND verify_code='".strim($user_data['sms_code'])."' AND create_time + ".SMS_EXPIRESPAN." > ".TIME_UTC." ")==0){
				showErr("手机验证码出错,或已过期");
			}
			$user_data['is_effect'] = 1;
			$user_data['mobilepassed'] = 1;
		}
		
		//判断是否为邮箱注册
// 		if((app_conf("REGISTER_TYPE") == 0 || app_conf("REGISTER_TYPE") == 2) && (app_conf("USER_VERIFY") == 1 || app_conf("USER_VERIFY") == 2)){
			
// 			if(strim($user_data['emsms_code'])==""){
// 				showErr("请输入邮箱验证码");
// 			}
// 			//判断验证码是否正确
// 			if($GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."email_verify_code WHERE email='".strim($user_data['email'])."' AND verify_code='".strim($user_data['emsms_code'])."' AND create_time + ".SMS_EXPIRESPAN." > ".TIME_UTC." ")==0){
// 				showErr("邮箱验证码出错,或已过期");
// 			}
// 			$user_data['is_effect'] = 1;
// 			$user_data['emailpassed'] = 1;
				
// 		}
		
		
		$res = save_user($user_data);
		if($_REQUEST['subscribe']==1)
		{
			//订阅
			if($GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."mail_list where mail_address = '".$user_data['email']."'")==0)
			{
				$mail_item['city_id'] = intval($_REQUEST['city_id']);
				$mail_item['mail_address'] = $user_data['email'];
				$mail_item['is_effect'] = app_conf("USER_VERIFY");
				$GLOBALS['db']->autoExecute(DB_PREFIX."mail_list",$mail_item,'INSERT','','SILENT');
			}
			if($user_data['mobile']!=''&&$GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."mobile_list where mobile = '".$user_data['mobile']."'")==0)
			{
				$mobile['city_id'] = intval($_REQUEST['city_id']);
				$mobile['mobile'] = $user_data['mobile'];
				$mobile['is_effect'] = app_conf("USER_VERIFY");
				$GLOBALS['db']->autoExecute(DB_PREFIX."mobile_list",$mobile,'INSERT','','SILENT');
			}
			
		}
		
		if($res['status'] == 1)
		{
			$user_id = intval($res['data']);
			//更新来路
			$GLOBALS['db']->query("update ".DB_PREFIX."user set referer = '".$GLOBALS['referer']."' where id = ".$user_id);
			$user_info = get_user_info("*","id = ".$user_id);
			if($user_info['is_effect']==1)
			{
				//在此自动登录
				$result = do_login_user($user_data['user_name'],$user_data['user_pwd']);
				$GLOBALS['tmpl']->assign('integrate_result',$result['msg']);
				if($_REQUEST['pid'])
				{
					showSuccess('注册成功',$ajax,wap_url('index','usercenter'));
				}else
				echo '<script>alert("注册成功");index = parent.layer.getFrameIndex(window.name);
								parent.layer.close(index);
								parent.layer.msg("注册成功");
								parent.history.go(0); </script>';die;
			}
			else{
				showSuccess($GLOBALS['lang']['WAIT_VERIFY_USER'],0,APP_ROOT."/");
			}
		}
		else
		{
			$error = $res['data'];		
			if(!$error['field_show_name'])
			{
					$error['field_show_name'] = $GLOBALS['lang']['USER_TITLE_'.strtoupper($error['field_name'])];
			}
			if($error['error']==EMPTY_ERROR)
			{
				$error_msg = sprintf($GLOBALS['lang']['EMPTY_ERROR_TIP'],$error['field_show_name']);
			}
			if($error['error']==FORMAT_ERROR)
			{
				$error_msg = sprintf($GLOBALS['lang']['FORMAT_ERROR_TIP'],$error['field_show_name']);
			}
			if($error['error']==EXIST_ERROR)
			{
				$error_msg = sprintf($GLOBALS['lang']['EXIST_ERROR_TIP'],$error['field_show_name']);
			}
			showErr($error_msg);
		}
	}
	
public function dologin(){
	
	if(!$_POST)
	{
		app_redirect("404.html");
		exit();
	}
	foreach($_POST as $k=>$v)
	{
		$_POST[$k] = htmlspecialchars(addslashes($v));
	}
	
	
// 	$ajax = intval($_REQUEST['ajax']);
// 	if(!check_hash_key()){
// 		echo 1;die;
// 		showErr("非法请求!",$ajax);
// 	}
	//验证码
// 	if(app_conf("VERIFY_IMAGE")==1)
// 	{
// 		$verify = md5(trim($_REQUEST['verify']));
// 		$session_verify = es_session::get('verify');
// 		if($verify!=$session_verify)
// 		{
// 			showErr($GLOBALS['lang']['VERIFY_CODE_ERROR'],$ajax,url("shop","user#login"));
// 		}
// 	}
	
	require_once APP_ROOT_PATH."sys/model/user.php";
	
	$_POST['user_pwd'] = trim(MD5($_POST['user_pwd']));
	
	if(check_ipop_limit(CLIENT_IP,"user_dologin",0)){
		$result = do_login_user($_POST['user_name'],$_POST['user_pwd']);
		
	}
	else
		showErr($GLOBALS['lang']['SUBMIT_TOO_FAST'],1,url("index","user#login"));
	if($result['status'])
	{
		$s_user_info = es_session::get("user_info");
		if(intval($_POST['auto_login'])==1)
		{
			
			//自动登录，保存cookie
			$user_data = $s_user_info;
			es_cookie::set("user_name",$user_data['user_name'],3600*24*30);
			es_cookie::set("user_pwd",md5($user_data['user_pwd']."_EASE_COOKIE"),3600*24*30);
		}
		if($ajax==0&&trim(app_conf("INTEGRATE_CODE"))=='')
		{
  			
			alert('yes',1);
		}
		else
		{
			$jump_url = get_gopreview();
			$s_user_info = es_session::get("user_info");
			if($s_user_info['ips_acct_no']=="" && app_conf("OPEN_IPS")){
				
				if($ajax==1)
				{
					$return['status'] = 2;
					$return['info'] = "本站需绑定第三方托管账户，是否马上去绑定";
					$return['data'] = $result['msg'];
					$return['jump'] = $jump_url;
					$return['jump1'] = APP_ROOT."/index.php?ctl=collocation&act=CreateNewAcct&user_type=0&user_id=".$s_user_info['id'];
					ajax_return($return);
				}
				else
				{
					$GLOBALS['tmpl']->assign('integrate_result',$result['msg']);
					showSuccess($GLOBALS['lang']['LOGIN_SUCCESS'],$ajax,$jump_url);
				}
			}
			else{
				
				if($ajax==1)
				{
					$return['status'] = 1;
					$return['info'] = $GLOBALS['lang']['LOGIN_SUCCESS'];
					$return['data'] = $result['msg'];
					$return['jump'] = $jump_url;
					ajax_return($return);
				}
				else
				{
					$GLOBALS['tmpl']->assign('integrate_result',$result['msg']);
					showSuccess($GLOBALS['lang']['LOGIN_SUCCESS'],$ajax,$jump_url);
				}
			}
		}
			
	}
	else
	{
		if($result['data'] == ACCOUNT_NO_EXIST_ERROR)
		{
			$err = $GLOBALS['lang']['USER_NOT_EXIST'];
		}
		if($result['data'] == ACCOUNT_PASSWORD_ERROR)
		{
			$err = $GLOBALS['lang']['PASSWORD_ERROR'];
		}
		if($result['data'] == ACCOUNT_NO_VERIFY_ERROR)
		{
			$err = $GLOBALS['lang']['USER_NOT_VERIFY'];
			if(app_conf("MAIL_ON")==1&&$ajax==0)
			{
				$GLOBALS['tmpl']->assign("page_title",$err);
				$GLOBALS['tmpl']->assign("user_info",$result['user']);
				$GLOBALS['tmpl']->display("verify_user.html");
				exit;
			}
	
		}
		alert($err,1);
	}
	
}
}
?>