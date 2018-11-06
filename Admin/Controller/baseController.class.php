<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set("Asia/Shanghai");
class baseController 
{
	public function __construct()
	{
		//!$this->is_login()
		if(!$this->is_login()){
// 			set_gopreview();
			alert("请重新登录",'',wap_url('admin','login#index'),1);
// 			$GLOBALS['tmpl']->display('login.html') ;
			
			die;
		}
		
	}
	public function is_login(){
		if(es_session::get(md5(app_conf("AUTH_KEY"))))
			return true;
		return false;
	}

	/**
	 * 验证验证码
	 */
	
	public function checkVerify(){
		$verify = new \Think\Verify();
		return $verify->check(I('verify'));
	}
	
	/**
	 * 单个上传图片
	 * @param  string $fileFile  上传文件的表单名称
	 */
	public function uploadPic($filedName,$config=array()){
		
		require_once 'sys/utils/Upload.php';
		
		$up = new fileupload();
		$path = $config['path']?$config['path']:'';
		$maxsize = $config['maxsize']?$config['maxsize']:1000000;
		$allowtype = $config['allowtype']?$config['allowtype']:array("gif","png","jpg","jpeg");
		$israndname = $config['israndname']?$config['israndname']:false;
		
		//设置属性（上传的位置、大小、类型、设置文件名是否要随机生成）
		$up->set("path",$path);
		$up->set("maxsize",$maxsize); //kb
		//array("gif","png","jpg","jpeg")
		$up->set("allowtype",$allowtype);//可以是"doc"、"docx"、"xls"、"xlsx"、"csv"和"txt"等文件，注意设置其文件大小
		$up->set("israndname",$israndname);//true:由系统命名；false：保留原文件名
		
		//使用对象中的upload方法，上传文件，方法需要传一个上传表单的名字name：pic
		//如果成功返回true，失败返回false
		$name = $filedName;
		if($up->upload($name))
		{
			$data['status'] = 1;
			//获取上传成功后文件名字
			$data['fileName'] = $up->getFileName();
			
			return $data;
		}else{
			$data['status'] = 0;
			//获取上传失败后的错误提示
			$data['errMsg'] = $up->getErrorMsg();
			return $data;
		}
					
		/* if($up->upload($name)){
			echo '<pre>';
			获取上传成功后文件名字
			var_dump($up->getFileName());
			echo '</pre>';
		
		}else{
			echo '<pre>';
			获取上传失败后的错误提示
			var_dump($up->getErrorMsg());
			echo '<pre/>';
		} */
		
	}
	

}



?>