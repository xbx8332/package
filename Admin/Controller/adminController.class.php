<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
class adminController extends baseController
{
	public function __construct()
	{
		if(!is_role('qxgl'))
			alert('您没有权限',0,url('admin',"r=index"));
	}
	public function  user(){
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$a =$GLOBALS['db']->getAll('select * from '.DB_PREFIX.'role as r join '.DB_PREFIX.'admin as a on a.role_id =r.id order by r.id limit '.$limit);
		$count=$GLOBALS['db']->getOne('select * from '.DB_PREFIX.'role as r join '.DB_PREFIX.'admin as a on a.role_id =r.id');
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign("page",$p);
		
		
		$GLOBALS['tmpl']->assign('admin',$a);
		$GLOBALS['tmpl']->display('admin/admin-list.html');
		//pp($GLOBALS['tmpl']);die;
	}
	
	//管理员账户编辑页面
	public function  adminedit(){
		$where['id'] = $_REQUEST['id'];
		$data = D('public','Admin')->table('admin')->where($where)->find();
		//pp($data);die;
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display('admin/admin-edit.html');
	}
	
	//管理员账户更新
	public  function adminupdate()
	{
		$data = D("public","admin")->table("admin")->create();
		$data['adm_password'] =md5($data['adm_password']);
		$r =D('public','admin')->table('admin')->save($data);
		//pp($data);die;
		if($r)
		ajax_return($r);
		//pp($r);die;
	}
	
	public function del(){
		echo json_encode(D('public','admin')->table('admin')->delete($_REQUEST['id']));
		
	}
	public function  adminadd(){
		
		$r= D('public','admin')->table('role')->select();
		
		$GLOBALS['tmpl']->assign('role',$r);
		$GLOBALS['tmpl']->display('admin/admin-add.html');
		//pp($GLOBALS['tmpl']);;die;
	}
	public function  adminins(){
		$data =D('public','admin')->table('admin')->create();
		$data['adm_password'] =md5($data['adm_password']);
		$r =D('public','admin')->table('admin')->add($data);
		
		echo json_encode($r);die;
		//pp($GLOBALS['tmpl']);;die;
	}
	public function role(){
		
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$r= D('public','admin')->table('role')->order('id DESC')->limit($limit)->select();
		$count=D('public','admin')->table('role')->count();
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign("page",$p);
		$GLOBALS['tmpl']->assign('role',$r);
		$GLOBALS['tmpl']->display('admin/admin-role.html');
	}
	public function roledel(){
		echo json_encode(D('public','admin')->table('role')->delete($_REQUEST['id']));
	}
	public function roleadd(){
		$GLOBALS['tmpl']->display('admin/admin-role-add.html');
	}
	public function roleins(){
		
		$data['name'] = $_POST['roleName'];
		$data['bz'] = $_POST['bz'];
		$map =$_POST;
		unset($map['roleName']);
		unset($map['bz']);
		unset($map['admin-role-save']);
		foreach ($map as $v){
			$data['role'] .= $v.',';
		}
		$data['role']=qc($data['role']);
		
		$r= D('public','admin')->table('role')->add($data);
		
		echo json_encode($r);die;
	}
	//批量删除
	public  function delrole(){

		$id=$_REQUEST['ids'];
		$ids='';
		foreach ($id as $v){
			$ids.=$v.",";
		}
		$ids=trim(substr($ids,0,-1),",");//去除最后一个 第一个逗号
		$sql="delete from ".DB_PREFIX."role where id in (".$ids.")";
		
		$r=$GLOBALS['db']->query($sql);
		echo $r;
		
		
	}
	//批量删除
	public  function deladmlist(){
	
		$id=$_REQUEST['ids'];
		$ids='';
		foreach ($id as $v){
			$ids.=$v.",";
		}
		$ids=trim(substr($ids,0,-1),",");//去除最后一个 第一个逗号
		$sql="delete from ".DB_PREFIX."admin where id in (".$ids.")";
	
		$r=$GLOBALS['db']->query($sql);
		echo $r;
	
	
	}
	
}
?>