<?php
require_once APP_ROOT_PATH.'sys/model/baseModel.class.php';
class model{
	private   $model_obj;
	//网站项目构造
	public function __construct($ctl,$m='Application'){
		
		$model = strtolower($ctl?$ctl:"index");
		$modul = $m;
		$model = filter_ctl_act_req($model);
		
		
		if(!file_exists(APP_ROOT_PATH.$modul."/Model/".$model."Model.class.php"))
			$model = "index";

		require_once APP_ROOT_PATH.$modul."/Model/".$model."Model.class.php";
	
		if(!class_exists($model."Model"))
		{
			$model = "index";
			require_once APP_ROOT_PATH.$modul."/Model/".$model."Model.class.php";
		}
	

		define("MODULE_NAME",$model);

		$model_name = $model."Model";
	
		
		$this->model_obj = new $model_name;
		
	}
	
	public function obj(){
		return $this->model_obj;
	}
	public function __destruct()
	{
		unset($this);
	}
}
?>