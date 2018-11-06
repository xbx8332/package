<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
require APP_ROOT_PATH.'/Application/Action/publicAction.class.php';

require APP_ROOT_PATH.'/Application/init.php';
require APP_ROOT_PATH.'/Application/page.php';
define("CTL",'ctl');
define("ACT",'act');

class App{		
	private $module_obj;
	//网站项目构造
	public function __construct(){
		
		if($GLOBALS['pay_req'][CTL])
			$_REQUEST[CTL] = $GLOBALS['pay_req'][CTL];
		if($GLOBALS['pay_req'][ACT])
			$_REQUEST[ACT] = $GLOBALS['pay_req'][ACT];
		
		$module = strtolower($_REQUEST[CTL]?$_REQUEST[CTL]:"index");
		$action = strtolower($_REQUEST[ACT]?$_REQUEST[ACT]:"index");

		$module=$module;
		
		$module = filter_ctl_act_req($module);
		$action = filter_ctl_act_req($action);
		
		if(!file_exists(APP_ROOT_PATH."Application/Action/".$module."Action.class.php"))
		$module = "index";
		
		require_once APP_ROOT_PATH."Application/Action/".$module."Action.class.php";				
		if(!class_exists($module."Action"))
		{
			$module = "index";
			require_once APP_ROOT_PATH."Application/Action/".$module."Action.class.php";	
		}
		if(!method_exists($module."Action",$action))
		$action = "index";
		
		define("MODULE_NAME",$module);
		define("ACTION_NAME",$action);
		
		$module_name = $module."Action";
		
		
		$this->module_obj = new $module_name;
		$this->module_obj->$action();
	}
	
	public function __destruct()
	{
		unset($this);
	}
}
?>