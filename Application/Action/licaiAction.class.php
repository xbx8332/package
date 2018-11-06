<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */

class licaiAction extends publicAction
{
	public function bid(){
	
		
		//pp($_REQUEST);die;
		require_once APP_ROOT_PATH.'app/lib/uc.php';
		require_once APP_ROOT_PATH.'sys/libs/licai.php';
		$ajax = intval($_REQUEST['ajax']);
		$id = intval($_REQUEST['id']);
		$money =  floatval($_REQUEST['money']);
		$paypassword = trim($_REQUEST['paypassword']);
		
		$result = licai_bid($id,$money,$paypassword);
		
		ajax_return($result);
		/* if($result['status']==0){
			alert($result['info'],$ajax);
		}
		else{
			alert($result['info'],$ajax);
		} */
	
	}
}
?>