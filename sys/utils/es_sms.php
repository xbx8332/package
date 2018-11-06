<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
class sms_sender
{
	var $sms;
	var $class;	
	
	public function __construct()
    { 	
		$sms_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."sms where is_effect = 1");
		if($sms_info)
		{
			$sms_info['config'] = unserialize($sms_info['config']);
			
			require_once APP_ROOT_PATH."system/sms/".$sms_info['class_name']."_sms.php";
			
			$this->class=$sms_class = $sms_info['class_name']."_sms";
			
			$this->sms = new $sms_class($sms_info);
		}
    }
    
	
	public function sendSms($mobiles,$content,$is_adv = 0)
	{
		if(!is_array($mobiles))
			$mobiles = preg_split("/[ ,]/i",$mobiles);
		
		if(count($mobiles) > 0 )
		{
			if(!$this->sms)
			{
				$result['status'] = 0;
			}
			else
			{
				if($this->class=='ALI_sms'){
					$result = $this->sms->sendSms($mobiles,$content,$is_adv);
				}
				elseif($this->class=='FW_sms'){
					$content=addslashes($content);
					$result = $this->sms->sendSms($mobiles,$content,$is_adv);
				}
				
			}
		}
		else
		{
			$result['status'] = 0;
			$result['msg'] = "没有发送的手机号";
		}
		
		return $result;
	}
}
?>