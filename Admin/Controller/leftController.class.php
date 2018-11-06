<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
class leftController extends baseController
{
	public function index()
	{	
		
		$GLOBALS['tmpl']->display('index.html');
		
		
	}
	
	//活期产品管理
	public function active_mana(){
		
		
		$GLOBALS['tmpl']->display('article-list.html');
	
	}
	
	//定期产品管理
	public function regular_mana()
	{
		$GLOBALS['tmpl']->display('article-list.html');
	}
	
	//活期产品购买管理
	public function active_purchase_mana(){
	
	
		$GLOBALS['tmpl']->display('article-list.html');
	
	}
	
	//定期产品购买管理
	public function regular_purchase_mana(){
	
	
		$GLOBALS['tmpl']->display('article-list.html');
	
	}
	
	
	//系统设置
	public function system_set()
	{
		$data = D("public","Admin")->table("conf")->select();
		//pp($data);die;
		$arr = array();
		foreach($data as $key=>$val)
		{
			$name= strtolower($val['name']);
			$arr[$name] = $val['value'];
		}
		//pp($arr);die;
		$GLOBALS['tmpl']->assign("data",$arr);
		$GLOBALS['tmpl']->display("system/system-base.html");
	}
	
	//好友佣金比例设置
	public function commission_set()
	{
		$data = D("public","Admin")->table("conf")->where("name='WEBSITE_COMMISSION'")->find();
		//pp($data);die;
		$GLOBALS['tmpl']->assign('data',$data);
		$GLOBALS['tmpl']->display("system/system-commission.html");
	}
	
	//体验金管理页面
	public function issueMoney_set()
	{
		$data = D("public","Admin")->table("learn_type")->select();
		//pp($data);die;
		$GLOBALS['tmpl']->assign('data',$data);
		$GLOBALS['tmpl']->display("system/system-issueMoney.html");
	}
	
	//栏目管理
	public function category_mana(){
	
		global_run();
		
		$user_info=es_session::get('user_info');
		$uid=$user_info['id'];
		$data['page_title']='栏目管理';
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display("system-category.html");
	
	}
	
	//图片管理列表页
	public function picture_mana()
	{
		$name =
				"'WEBSITE_SLIDER_0',
				'WEBSITE_SLIDER_1',
				'WEBSITE_SLIDER_2'";
		
		$data = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."conf where name in(".$name.") ");
		//pp($data);die;
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display("picture/picture-list.html");
	}
	
	
	
	//速汇金
	public function moneygram(){
		global_run();
		init_app_page();
		$user_info=es_session::get('user_info');
		$uid=$user_info['id'];
		$data['page_title']='速汇金';
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display("moneygram.html");
	
	}

}
?>