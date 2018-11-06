<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 好友管理类
 */
class friendmanageController extends baseController
{
	public function __construct()
	{
		if(!is_role('hygl'))
			alert('您没有权限',0,url('admin',"r=index"));
	}
	public function  index(){
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$data = D('member','Admin')->all_select($limit);
		$count=D('member','Admin')->get_count();
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign("page",$p);
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display('friend/friend-list.html');
	}
	
	//查询用户受邀人列表
	public function friend_invitor()
	{
		$pid = $_REQUEST['id'];
		//$data = D('member','Admin')->table('user')->where($where)->findAll();
		$list = $GLOBALS['db']->getAll("select * from sn_user where pid=".$pid."  ");
		
		foreach ($list as $key=>$val)
		{
			$pid = $val['pid'];
			if($pid)
			$user_name = $GLOBALS['db']->getOne("select user_name from sn_user where id=".$pid."  ");
			$list[$key]['ref'] = $user_name;
		}
		//pp($list);die;
		 if($list)
		{
			$data['status'] = 1;
			$data['data'] = $list;
			ajax_return($data);
		}else{
			$data['status'] = 0;
			$data['data'] = array();
			ajax_return($data);
		}
		
	}
}
?>