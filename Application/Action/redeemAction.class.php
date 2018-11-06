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
class redeemAction  extends publicAction
{
	public function index()
	{
		$user = es_session::get('user_info');
		
		if(!$_REQUEST['id']){
		$page['title']="赎回申请";
		$h_sum_money = get_hno_sum_money($user['id']);
		$h_sum_money=$h_sum_money?$h_sum_money:0;
		$GLOBALS['tmpl']->assign('h_sum_money',$h_sum_money);
		$GLOBALS['tmpl']->assign('page',$page);
		//$GLOBALS['tmpl']->assign('id',$_REQUEST['id']);
		}else{
			$where['id']=$_REQUEST['id'];
			
			$data = D('public')->table('licai_order')->where($where)->find();
			
			$GLOBALS['tmpl']->assign('data',$data);
			$GLOBALS['tmpl']->assign('id',$_REQUEST['id']);
		}
		
		$GLOBALS['tmpl']->display('show_redeem.html');
	}
	
	//赎回
	function uc_redeem_add()
	{
		
		if(check_ipop_limit(CLIENT_IP,"redeem_add",2)){
			require_once APP_ROOT_PATH.'app/Lib/uc.php';
			$user = es_session::get('user_info');
			$user = get_user_info('*','id ='.$user['id']);
			$id = intval($_REQUEST["id"]);
			$redeem_money = floatval($_REQUEST["redeem_money"]);
			$paypassword = strim($_REQUEST["paypassword"]);
			
			$result["jump"] = "";
			
			
			if(md5($paypassword)!=$user['paypassword']){
				
				$result['msg'] = "支付密码错误";
				$result['success']=0;
				alert($result,1);
			}
			
			$result = create_redempte($user["id"],$id,$redeem_money);
			
			$result["jump"] = url('index',"usercenter#index");
			//$result["jump"]= "";
			
			$result['success']=1;
			alert($result,1);
		
		}
	else{
		alert($GLOBALS['lang']['SUBMIT_TOO_FAST'],0,url('index',"redeem#index"));
	}
	
	}
	
	
	public function userredeem(){
		$user = es_session::get('user_info');
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		
		$mai = $GLOBALS['db'] ->getAll("select *,l.name from ".DB_PREFIX."licai_redempte as r join ".DB_PREFIX."licai_order as o on o.id = r.order_id join ".DB_PREFIX."licai as l on l.id = o.licai_id where r.user_id = ".$user['id']." and r.order_id >0 limit ".$limit);
		$count = $GLOBALS['db'] ->getOne("select count(*) from ".DB_PREFIX."licai_redempte as r join ".DB_PREFIX."licai_order as o on o.id = r.order_id join ".DB_PREFIX."licai as l on l.id = o.licai_id where r.user_id = ".$user['id']." and r.order_id >0");
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('mai',$mai);
		$GLOBALS['tmpl']->assign('page',$p);
		$GLOBALS['tmpl']->display('redeem_list.html');
	}
	
	//收益记录
	public function profit(){
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$user = es_session::get('user_info');
		$list=$GLOBALS['db']->getAll("select * from ".DB_PREFIX."licai_profit  where order_id <> 0 and user_id=".$user['id']." limit ".$limit);
		$count = $GLOBALS['db'] ->getOne("select count(*) from ".DB_PREFIX."licai_profit where order_id <> 0 and user_id=".$user['id']);
		
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('list',$list);
		$GLOBALS['tmpl']->assign('page',$p);
		$GLOBALS['tmpl']->display('redeem_profit.html');
	}
	
}
?>