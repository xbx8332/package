<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 用户管理类
 */
class loanmanageController extends baseController
{
	public function  index(){

		
		//接受 sost参数 0 表示倒序 非0都 表示正序
		if (isset($_REQUEST ['_sort'])){
			$sort = strim($_REQUEST ['_sort']) ? 'asc' : 'desc';
		} else {
			$sort = 'desc';
		}
		
		$sortImg = $sort; //排序图标
		$sortAlt = $sort == 'desc' ? l("ASC_SORT") : l("DESC_SORT"); //排序提示
		
		if($order == "")
		{
			$order_str = "";
		}
		else
		{
			$order_str = " order by ". str_replace("_format","",$order)." ".$sort;
		}
		
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		
		$page_size = 5;
		
		$limit = (($page-1)*$page_size).",".$page_size;
		$result = array();
		
		$data = D('public','Admin')->table('loan')->select();
		$data1 = D('public','Admin')->table('loan')->order('id DESC')->limit($limit)->select();
		$GLOBALS['tmpl']->assign("data",$data1);
		$result['count'] = count($data);
		$page = new Page($result['count'],$page_size);   //初始化分页对象
		$p  =  $page->show();
		//pp($p);die;
		$GLOBALS['tmpl']->assign('page',$p);
		
		$GLOBALS['tmpl']->display('loan/loan-list.html');
	}
	
	public function loandel(){
		$where['id'] = $_REQUEST['id'];
		
		$data = D('public','Admin')->table('loan')->where($where)->delete();
		echo json_encode($data);
	}
	
	public function loanstart(){
		$where['id'] = $_REQUEST['id'];
		$data = D('public','Admin')->table('loan')->where($where)->save(array('start'=>1));
		echo json_encode($data);
	}
	public function loanstop(){
		$where['id'] = $_REQUEST['id'];
		$data = D('public','Admin')->table('loan')->where($where)->save(array('start'=>2));
		echo json_encode($data);
	}
	

	public function rulemsg(){
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		
		
		$data = D("public",'Admin')->table('licai_rulemsg')->order('id DESC')->limit($limit)->select();
		$count = D('public','Admin')->table('licai_rulemsg')->count();
		
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign("admin",$data);
		$GLOBALS['tmpl']->assign("page",$p);
		$GLOBALS['tmpl']->display('loan/rule-list.html');
	}
	
	public function ruleadd(){
		$GLOBALS['tmpl']->display('loan/rule-add.html');
	}
	public function rulesave(){
		$data['rule_name']=$_REQUEST['rule_name'];
		$data['rule_msg']=$_REQUEST['rulemsg'];
		$data['type']=$_REQUEST['type'];
		$r = D('public','Admin')->table('licai_rulemsg')->add($data);
		echo $r;
	}
	//删除
	public function delloan(){
		echo json_encode(D('public','admin')->table('licai_rulemsg')->delete($_REQUEST['id']));
	}
	//编辑
	public function loanedit(){
		$where['id'] = $_REQUEST['id'];
		$data = D('public','Admin')->table('licai_rulemsg')->where($where)->find();
		 //pp($data);die;
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display('loan/rule-edit.html');
	}
	//更新
	public function loanupdate(){
		$data =D('public','admin')->table('licai_rulemsg')->create();
		$where['id']=$data['id'];
		$r = D('public','Admin')->table('licai_rulemsg')->where($where)->save($data);
		echo json_encode($r);die;
	}
	//批量删除
	public  function  delloanall(){

		$id=$_REQUEST['ids'];
		$ids='';
		foreach ($id as $v){
			$ids.=$v.",";
		}
		$ids=trim(substr($ids,0,-1),",");//去除最后一个 第一个逗号
		$sql="delete from ".DB_PREFIX."licai_rulemsg where id in (".$ids.")";
		
		$r=$GLOBALS['db']->query($sql);
		echo $r;
		
	}
}
?>