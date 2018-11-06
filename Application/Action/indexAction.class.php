<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
require_once APP_ROOT_PATH.'sys/libs/licai.php';
class indexAction extends publicAction
{
	public function index()
	{
		//pp($_SESSION);die;
		$licai = D('public')->table('licai')->select();
		foreach ($licai as $v){
			if($v['type'] ==0){
				$where['licai_id'] = $v['id'];
				$v['history'] =  D('public')->table('licai_history')->where($where)->order('id desc')->find();
				$licai_huo = $v;
			}elseif($v['type'] ==1){
				$where['licai_id'] = $v['id'];
				$where['history_date']=to_date ( TIME_UTC, 'Y-m-d' );
				$v['history'] =  D('public')->table('licai_history')->where($where)->order('id desc')->find();
				$licai_ding[] = $v;
			}
		}
		$licai_dealshow =  get_licai_dealshow(10,1);

		$GLOBALS['tmpl']->assign("licai_dealshow",$licai_dealshow);
		$GLOBALS['tmpl']->assign('licai_huo',$licai_huo);
		$GLOBALS['tmpl']->assign('licai_ding',$licai_ding);
		$GLOBALS['tmpl']->assign('user',es_session::get('user_info'));
		$GLOBALS['tmpl']->display('index.html');
	}
	
}
?>