<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
class indexController extends baseController
{public function  index(){
			
		$a =es_session::get(md5(app_conf("AUTH_KEY")));
		//pp($a);die;
		$GLOBALS['tmpl']->assign('role',$a);
		$GLOBALS['tmpl']->display('index.html');
	}
}
?>