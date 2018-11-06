<?php

class helpController{
	
	
	public function index()
	{
		$data = D('public','admin')->table('help_wenzhang')->select();
		$GLOBALS['tmpl']->assign('data',$data);
		$GLOBALS['tmpl']->display('help/help-list.html');
	}
	public function wenzhangadd(){
		
		$where['id'] = $_REQUEST['id'];
		$data = D('public','admin')->table('licai_help')->select();
		
		$wz = D('public','admin')->table('help_wenzhang')->where($where)->find();
		
		$GLOBALS['tmpl']->assign('data',$data);
		
		$GLOBALS['tmpl']->display('help/wenzhang-add.html');
	}
	public function wenzhang_ins(){
		
		//$data = D('public','admin')->table('help_wenzhang')->create();
		
		$where['id'] = $_REQUEST['wz_id'];
		
		$data['name'] = $_REQUEST['name'];
		$data['is_effect'] = $_REQUEST['is_effect'];
		$data['cate_id'] = $_REQUEST['cate_id'];
		/* $data['wenzhang'] = $_REQUEST['editorValue']; */
		$data['wenzhang'] = addslashes($_REQUEST['wenzhang']);
		//unset($data[0]);
		//pp($data);die;
		if($where['id'])
		{
			
			
			$r = D("public",'Admin')->table('help_wenzhang')->where($where)->data($data)->save();
		}else{
			$r = D('public','admin')->table('help_wenzhang')->add($data);
		}
		
		echo json_encode($r);die;
	}
	public function wenzhangdel(){
		
		$r =D('public','admin')->table('help_wenzhang')->delete($_REQUEST['id']);
		echo json_encode($r);die;
	}
	public function wenzhangedit(){
		$wenzhang = D('public','admin')->table('help_wenzhang')->where('id='.$_REQUEST['id'])->find();
		$data = D('public','admin')->table('licai_help')->select();
		
		$GLOBALS['tmpl']->assign('data',$data);
		$GLOBALS['tmpl']->assign('wenzhang',$wenzhang);
		$r = $GLOBALS['tmpl']->display('help/wenzhang-add.html');
		echo json_encode($r);die;
	}
	
	public function fenlei()
	{
		$data = D('public','admin')->table('licai_help')->select();
		$GLOBALS['tmpl']->assign('data',$data);
		$GLOBALS['tmpl']->display('help/fenlei.html');
	}
	public function fenlei_add(){
		$GLOBALS['tmpl']->display('help/fenlei-add.html');
	}
	//分类编辑
	public function fenlei_edit(){
		
		$where['id'] =$_REQUEST['id'];
		$data = D('public','admin')->table('licai_help')->where($where)->find();
// 		pp($data);die;
		$GLOBALS['tmpl']->assign('data',$data);
		$GLOBALS['tmpl']->display('help/fenlei-edit.html');
	}
	
	//分类更新
	public function fenlei_update(){
	
		$data = D("public","admin")->table("licai_help")->create();
// 		pp($data);die;
		$r =D('public','admin')->table('licai_help')->save($data);
		//pp($data);die;
		if($r)
			ajax_return($r);
	
	}
	
	public function fenlei_del(){
		
		$r = D('public','admin')->table('licai_help')->delete($_REQUEST['id']);
		echo json_encode($r);
	}
	public function fenlei_ins(){
		$data = D('public','admin')->table('licai_help')->create();
		$r = D('public','admin')->table('licai_help')->add($data);
		echo json_encode($r);die;
	}
	/* 批量删除 */
	function help_del(){
		$id=$_REQUEST['ids'];
		$ids='';
		foreach ($id as $v){
			$ids.=$v.",";
		}
		$ids=trim(substr($ids,0,-1),",");//去除最后一个 第一个逗号
		$sql="delete from ".DB_PREFIX."help_wenzhang where id in (".$ids.")";
		
		$r=$GLOBALS['db']->query($sql);
		echo $r;
	}
	/* 文章列表批量删除 */
	function fenlei_dels(){
		$id=$_REQUEST['ids'];
		$ids='';
		foreach ($id as $v){
			$ids.=$v.",";
		}
		$ids=trim(substr($ids,0,-1),",");//去除最后一个 第一个逗号
		$sql="delete from ".DB_PREFIX."licai_help where id in (".$ids.")";
	
		$r=$GLOBALS['db']->query($sql);
		echo $r;
	}
}
?>