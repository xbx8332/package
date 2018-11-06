<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */

class helpAction  extends publicAction
{
	public function index()
	{
		$help_fenlei = D('public')->table('licai_help')->select();
		$help_wz = D('public')->table('help_wenzhang')->select();
		$data = array();
		foreach ($help_fenlei as $k =>$v){
			$data[$k]=$v;
			foreach ($help_wz as $kk =>$vv){
				if($v['id'] == $vv['cate_id']){
					$data[$k]['wz'][] = $vv;
				}
			}
		}
		$GLOBALS['tmpl']->assign('user',es_session::get('user_info'));
		$GLOBALS['tmpl']->assign('data',$data);
		$GLOBALS['tmpl']->display('help.html');
	}
	
	function help_index(){
		$id = $_REQUEST['id'];
		$data = $help_wz = D('public')->table('help_wenzhang')->where("id=".$id)->find();
		//pp($data);die;
		$GLOBALS['tmpl']->assign('data',$data);
		$GLOBALS['tmpl']->display('help_index.html');
	}
	
	
	
}
?>