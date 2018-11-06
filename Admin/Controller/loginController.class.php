<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
class loginController
{
	public function  index(){
		$GLOBALS['tmpl']->display('login.html');
		//pp($GLOBALS['tmpl']);;die;
	}
	public function test(){
		$where['name']='user';
		$where['city_id'] ='6666';
		$where['sort'] ='111';
		$where['pid'] ='1';
		$res = D('login','Admin')->table('area')->where('id=73')->add($where);
		
	}
	
	
	public function getVerify(){
	
		// 导入Image类库
		$Verify = new Verify();
		$Verify->length   = 4;
		ob_clean();
		$Verify->entry();
	}
	public function checkVerify(){
		$verify = new Verify();
		return $verify->check($_REQUEST['verify']);
	}
	
	public function dologin(){

		$adm_name = strim($_POST['adm_name']);
		$adm_password = (trim($_POST['adm_password']));
		$adm_dog_key = strim($_POST['adm_dog_key']);
		$ajax = intval($_REQUEST['ajax']);  //是否ajax提交
		if($adm_name == '')
		{
			$data['status'] = 0;
			$data['jump'] = '';
			$data['msg'] = L('ADM_NAME_EMPTY');
			ajax_return($data);
			//alert(L('ADM_NAME_EMPTY'),$ajax,get_gopreview());
		}
		if($adm_password == '')
		{
			$data['status'] = 0;
			$data['jump'] = '';
			$data['msg'] = L('ADM_PASSWORD_EMPTY');
			ajax_return($data);
			//alert( L('ADM_PASSWORD_EMPTY'),$ajax,get_gopreview());
		}
		
		
		if(!$this->checkVerify()) {
			$data['status'] = 2;
			$data['jump'] = $_REQUEST['verify'];
			$data['msg'] = L('ADM_VERIFY_ERROR');
			ajax_return($data);
// 			alert( L('ADM_VERIFY_ERROR'),$ajax,get_gopreview());
		}
		
		$condition['adm_name'] = $adm_name;
		$condition['is_effect'] = 1;
		$condition['is_delete'] = 0;
		$adm_data = D('login','Admin')->table('admin')->where($condition)->find();
		
		if($adm_data) //有用户名的用户
		{
			if($adm_data['adm_password']!=md5($adm_password))
			{
				save_log($adm_name.L("ADM_PASSWORD_ERROR"),0); //记录密码登录错误的LOG
				
				$data['status'] = 0;
				$data['jump'] = '';
				$data['msg'] = L('ADM_PASSWORD_ERROR');
					
				ajax_return($data);
				//alert( L("ADM_PASSWORD_ERROR"),$ajax,get_gopreview());
			}
			else
			{
				//登录成功
				$adm_session['adm_name'] = $adm_data['adm_name'];
				$adm_session['adm_id'] = $adm_data['id'];
				$adm_session['adm_dog_key'] = $adm_dog_key;
				$adm_session['pid'] = $adm_data['pid'];
				$adm_session['is_department'] = $adm_data['is_department'];
				$adm_session['role_id'] = $adm_data['role_id'];
				
				$a =$GLOBALS['db']->getRow('select * from '.DB_PREFIX.'role where id='.$adm_data['role_id']);

				$adm_session['role'] =$a['role'];
				$adm_session['role_name'] =$a['name'];
				es_session::set(md5(app_conf("AUTH_KEY")),$adm_session);
		
				//重新保存记录
				$adm_data['login_ip'] = CLIENT_IP;
				$adm_data['login_time'] = TIME_UTC;
				D('login','Admin')->table('admin')->save($adm_data);
				
				save_log($adm_data['adm_name'].L("LOGIN_SUCCESS"),1);
				
				$data['status'] = 1;
				$data['jump'] ='/admin.php';
				$data['msg'] = L('LOGIN_SUCCESS');
				
				ajax_return($data);
				//alert(L("LOGIN_SUCCESS"),$ajax,wap_url('admin','index#index'));
			}
		}
		else
		{
			save_log($adm_name.L("ADM_NAME_ERROR"),0); //记录用户名登录错误的LOG
			$data['status'] = 0;
			$data['jump'] = '';
			$data['msg'] = L('ADM_PASSWORD_ERROR');
			ajax_return($data);
			//alert( L("ADM_NAME_ERROR"),$ajax,get_gopreview());
		}
		
	}
	//登出函数
	public function do_loginout()
	{
		//验证是否已登录
		//管理员的SESSION
		$adm_session = es_session::get(md5(app_conf("AUTH_KEY")));
		$adm_id = intval($adm_session['adm_id']);
		es_session::delete(md5(app_conf("AUTH_KEY")));
		es_session::set(md5(app_conf("AUTH_KEY")),'');
		alert(L("LOGINOUT_SUCCESS"),'',wap_url('admin','login#index'));
		
	}
}
?>