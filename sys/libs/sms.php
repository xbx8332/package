<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
interface sms{
	
	/**
	 * 发送短信
	 * @param array $mobile_number		手机号
	 * @param string $content		短信内容
	 * return array(status='',msg='')
	*/
	function sendSMS($mobile_number,$content,$is_adv);
	
	/*获取该短信接口的相关数据*/
	function getSmsInfo();
	
	function check_fee();
}
?>