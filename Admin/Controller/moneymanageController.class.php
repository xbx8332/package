<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 用户管理类
 */
class moneymanageController extends baseController
{
	public function __construct()
	{
		if(!is_role('zjgl'))
			alert('您没有权限',0,url('admin',"r=index"));
	}
	public function  index(){
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$data =$GLOBALS['db']->getAll('select c.id,u.user_name,c.status,c.money,c.bankzone,c.bankcard,c.create_time,c.fee from sn_user_carry as c join sn_user as u  on u.id = c.user_id order by c.id DESC limit '.$limit);
// 		pp('select c.id,u.user_name,c.money.c.bankzone,c.bankcard,c.create_time,c.fee from sn_user_carry as c join sn_user as u  on u.id = c.user_id order by c.id DESC limit '.$limit);die;
		$count=D('public','Admin')->table('user_carry')->count();
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		
		//pp($data);die;
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign("page",$p);
		$GLOBALS['tmpl']->assign("data",$data);
		
		$GLOBALS['tmpl']->display('moneymanage/withdrawals-list.html');
	}
	
	public function over(){
		
		
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$data = D('public','Admin')->table('licai_redempte')->where('order_id=0')->order('id DESC')->limit($limit)->select();
		$count=D('public','Admin')->table('licai_redempte')->where('order_id=0')->count();
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign("page",$p);
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display('moneymanage/over-list.html');
	}
	
	//资金充值页面
	public function recharge()
	{
		$GLOBALS['tmpl']->display('moneymanage/recharge.html');
	}
	//资金修改提交
	public function rechargeinsert()
	{
		
		$adm_session = es_session::get(md5(app_conf("AUTH_KEY")));
		$user_name = strim($_REQUEST['user_name']);
		$type = intval($_REQUEST['type']);	//预留
		$money = floatval($_REQUEST['money']);
		$memo =strim($_REQUEST['memo']);

		$user_id = $GLOBALS['db']->getOne("select id from ".DB_PREFIX."user where user_name = '".$user_name."'");
		
		if(strim($_REQUEST['money'])==""){
			$r['status'] = 0;
			$r['info'] = "金额不能为空";
			ajax_return($r);
// 			alert("金额不能为空",1);
		}
		
		/* if($money <= 0){
			$r['status'] = 0;
			$r['info'] = "金额应为正数";
// 			alert("金额应为正数",1);
		}
		 */
		if($user_id>0)
		{
			$msg = trim($memo)==''?l("ADMIN_MODIFY_ACCOUNT"):trim($memo);
			modify_account(array('money'=>$money),$user_id,$msg,13);
			recharge_log($money,$user_id,$user_name);
			save_log(l("ADMIN_MODIFY_ACCOUNT"),1);
			/* alert(L("UPDATE_SUCCESS"),1); */
			$r['status'] = 1;
			$r['info'] = "更新成功";
			ajax_return($r);
		}
		else
			$r['status'] = 0;
			$r['info'] = "用户不存在，或用户名输入错误";
			ajax_return($r);
// 			alert("用户不存在，或用户名输入错误",0);
	
	}
	
	//拒绝用户提现
	public function withdraw_refuse()
	{
		$id = $_REQUEST['id'];
		
		$withdraw = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user_carry where id=".$id);
		
		$userid = $withdraw['user_id'];
		$money = $withdraw['money'];
		$status =$withdraw['status'];
		if($status==1)
		{
			alert("已通过,无法修改",1);
		}
		//pp($userid);die;
		if($withdraw&&$status==0)
		{
			$msg = trim($memo)==''?l("ADMIN_MODIFY_ACCOUNT"):"";
			modify_account(array('lock_money'=>-$money,'money'=>$money),$userid,$msg,8);
			$GLOBALS['db']->query("update ".DB_PREFIX."user_carry set status=2 where id=".$id);
			$user_name = $GLOBALS['db']->getOne("select user_name from ".DB_PREFIX."user where id = ".$userid);
			withdraw_log($money,$userid,$user_name,2);
			save_log(l("ADMIN_MODIFY_ACCOUNT"),1);
			alert("操作成功",1);
			/* $data['status'] = 1;
			$data['msg'] = "操作成功"; */
		}else{
			alert("操作失败",1);
			/* $data['status'] = 0;
			$data['msg'] = "操作失败"; */
		}
	}
	
	//同意用户提现
	public function withdraw_agree()
	{
		$id = $_REQUEST['id'];
		
		$withdraw = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user_carry where id=".$id);
		
		$userid = $withdraw['user_id'];
		$money = $withdraw['money'];
		$status =$withdraw['status'];
		//pp($userid);die;
		if($status==2)
		{
			alert("已拒绝,无法修改",1);
		}
// 		pp($withdraw);pp($status);die;
		if($withdraw&&$status==0)
		{
			$msg = trim($memo)==''?l("ADMIN_MODIFY_ACCOUNT"):"";
			modify_account(array('lock_money'=>-$money),$userid,$msg,8);
// 			pp("update ".DB_PREFIX."user_carry set status=1 where id=".$id);die;
			$GLOBALS['db']->query("update ".DB_PREFIX."user_carry set status=1 where id=".$id);
			$user_name = $GLOBALS['db']->getOne("select user_name from ".DB_PREFIX."user where id = ".$userid);
			withdraw_log($money,$userid,$user_name,1);
			save_log(l("ADMIN_MODIFY_ACCOUNT"),1);
			 alert("操作成功",1);
			/* $data['status'] = 1;
			$data['msg'] = "操作成功"; */
		}else{
			alert("操作失败",1);
			/* $data['status'] = 0;
			$data['msg'] = "操作失败"; */
		}
		
		
	}
	//提现删除
	public function withdraw_del(){
		$where['id'] = $_REQUEST['id'];
	
		$data = D('public','Admin')->table('user_carry')->where($where)->delete();
		
		echo json_encode($data);
	}
	
	//提现日志
	public function withdraw_log(){
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$data = D('public','Admin')->table('withdraw_log')->where('is_delete=0')->order('id DESC')->limit($limit)->select();
		$count=D('public','Admin')->table('withdraw_log')->where('is_delete=0')->count();
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign("page",$p);
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display('moneymanage/withdraw_log.html');
	}
	
	//充值日志
	public function recharge_log(){
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$data = D('public','Admin')->table('recharge_log')->where('is_delete=0')->order('id DESC')->limit($limit)->select();
		$count=D('public','Admin')->table('recharge_log')->where('is_delete=0')->count();
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
	
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign("page",$p);
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display('moneymanage/recharge_log.html');
	}
	
}
?>