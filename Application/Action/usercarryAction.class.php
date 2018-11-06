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
class usercarryAction  extends publicAction
{
	public function usercarry()
	{
		$user = $this->user;
		$carrymoney=$_REQUEST['carrymoney'];
		$paypassword=$_REQUEST['paypassword'];
		$Fruit=$_REQUEST['Fruit'];
		$user = get_user_info('*',"id=".$user['id']);
		if(!$user['paypassword']){
			alert("请设置支付密码",0,url("index","usercenter#usercenter"));
		}
		if($carrymoney>$user['money']){
			alert("余额不足",0,url("index","usercenter#withdrawals"));
		}
		if(!$carrymoney){
			alert("请填写提现金额",0,url("index","usercenter#withdrawals"));
		}
		if($carrymoney <= 0){
			alert("提现金额不能小于等于0",0,url("index","usercenter#withdrawals"));
		}
		if(!$paypassword){
			alert("请输入支付密码",0,url("index","usercenter#withdrawals"));
		}
		if(!$Fruit){
			alert("请认真阅读垚鑫宝服务协议",0,url("index","usercenter#withdrawals"));
		}
		$paypassword=MD5($paypassword);
		if($paypassword !== $user['paypassword']){
			alert("支付密码错误",0,url("index","usercenter#withdrawals"));
		}
		$data['user_id']=$user['id'];
		$data['user_name']=$user['user_name'];
		$data['money']=$carrymoney;
		$data['fee']=0;
		$data['bankcard']=$user['bankcard'];
		$data['create_time']=to_date(TIME_UTC);
		$data['status']=0;
		$data['update_time']=0;
		$data['msg']='';
		$data['real_name']='';
		$data['bankzone']=$user['bankname'];
		$data['create_time']=to_date(TIME_UTC);
		$r=$GLOBALS['db']->autoExecute(DB_PREFIX."user_carry",$data,'INSERT','','SILENT');
		if($r){
			modify_account(array('money'=>'-'.$carrymoney,'lock_money'=>$carrymoney),$user['id'],'提现',8);
			update_money(-$carrymoney);
			update_money($carrymoney,'lock_money');
			alert("提交成功",0,url("index","usercenter#withdrawals"));
		}else{
			alert("提交失败",0,url("index","usercenter#withdrawals"));
		}
	}
	
	
	
	
}
?>