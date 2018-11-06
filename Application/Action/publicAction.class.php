<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
class publicAction 
{
	public $user;
	public function __construct(){
		$icon=$GLOBALS['w_conf'];
		$user=es_session::get('user_info');
		$this->user=get_user_info("*","id=".$user['id']);
		$GLOBALS['tmpl']->assign("user",$this->user);
		$GLOBALS['tmpl']->assign("icon",$icon);
	}
	public function is_login(){
		if(es_session::get('user_info'))
			return true;
		return false;
	}
}
?>