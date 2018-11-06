<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
class systemController extends baseController
{
	public function __construct()
	{
		if(!is_role('xtgl'))
			alert('您没有权限',0,url('admin',"r=index"));
	}
	public function index()
	{	
		$GLOBALS['tmpl']->assign('a','1111111');
		$GLOBALS['tmpl']->display('index.html');
		$a=D(array('ctl'=>'test','act'=>'aaa','modul'=>'Admin'));
		
	}
	
	//添加栏目
	public function category_insert(){
	
		global_run();
		
		$user_info=es_session::get('user_info');
		$uid=$user_info['id'];
		$data['page_title']='栏目管理';
		
		$data = $GLOBALS['db']->autoExcute(DB_PREFIX."system_category",$data,'INSERT','','SILENT');
		
		$GLOBALS['tmpl']->assign("data",$data);
		//$GLOBALS['tmpl']->display("system-category.html");
	
	}
	
	//提交设置好友佣金比例
	public function commissioninsert()
	{
		$param = $_REQUEST['commission'];
		//pp($param);die;
		//获取系统设置的的配置数据
		$d['name'] = strtoupper("website_commission");
		$d['value'] = $param ;
		//$r=D("public",'Admin')->table('conf')->where("name=".$d['name'])->find();
		$r = $GLOBALS['db']->getOne("select * from ".DB_PREIX."conf where name='".$d['name']."' ");
		//pp($r);die;
		if($r)
		{
			$rx=D("public",'Admin')->table('conf')->where("id=".$r)->save($d);
			
		}else{
			
			$rx=D("public",'Admin')->table('conf')->add ($d);
		}
		
		
		if($rx)
		{
			$sys_configs=D("public",'Admin')->table('conf')->select();
			
			$config_str = "<?php\n";
			$config_str .= "return array(\n";
			foreach($sys_configs as $k=>$v)
			{
				$config_str.="'".$v['name']."'=>'".$v['value']."',\n";
			}
			$config_str.=");\n ?>";
			
			$filename = get_real_path()."public/sys_wconfig.php";
			
			if (!$handle = fopen($filename, 'w')) {
				$this->error(l("OPEN_FILE_ERROR").$filename);
			}
				
				
			if (fwrite($handle, $config_str) === FALSE) {
				$this->error(l("WRITE_FILE_ERROR").$filename);
			}
				
			fclose($handle);
			
			$res['status'] = 1;
			$res['msg'] = "佣金设置成功";
			ajax_return($res);
			
		}else{
			
			$res['status'] = 0;
			$res['msg'] = "佣金设置失败";
			ajax_return($res);
		}
	
		echo json_encode($param);
	}
	
	//提交系统设置信息
	public function sysSetInfoInsert()
	{
		$param = $_REQUEST;
		//保存成功的标志
		
		$fflag = true;			
		//$data = D("system",'Admin')->table('conf')->create();
		//$GLOBALS['tmpl']->assign("jumpUrl",url('admin','system#current'));
		$arr['website_title'] = $param['website_title'];
		//$arr['website_logo'] = $param['website_logo'];
		$arr['website_mobile'] = $param['website_mobile'];
		$arr['website_tel'] = $param['website_tel'];
		$arr['website_addr'] = $param['website_addr'];
		$arr['website_email'] = $param['website_email'];
		$arr['website_description'] = $param['website_description'];
		$arr['website_copyright'] = $param['website_copyright'];
		$arr['website_icp'] = $param['website_icp'];
		$imgflag = $param['flag'];
		//开始验证有效性
		if(!check_empty($param['website_title']))
		{
			$fflag = false;
			alert("请输入网站名称",1);
		}
		if(!check_empty($param['website_mobile']))
		{
			$fflag = false;
			alert("请输入移动电话",1);
		}
		if(!check_empty($param['website_tel']))
		{
			$fflag = false;
			alert("请输入电话号码",1);
		}
		if(!check_empty($param['website_addr']))
		{
			$fflag = false;
			alert("请输入公司地址",1);
		}
		if(!check_empty($param['website_email']))
		{
			$fflag = false;
			alert("请输入 邮箱地址",1);
		}
		if(!check_empty($param['website_description']))
		{
			$fflag = false;
			alert("请输入描述",1);
		}
		if(!check_empty($param['website_copyright']))
		{
			$fflag = false;
			alert("请输入版权信息",1);
		}
		if(!check_empty($param['website_icp']))
		{
			$fflag = false;
			alert("请输入备案号",1);
		}
		
		if(!$imgflag&&!$_FILES['website_logo'])
		{
			$fflag = false;
			alert("请上传项目网站logo",1);
		}
		
		$path= get_real_path()."public/sys_wconfig.php";
		$file_flag = file_exists($path);
		
		$newArr = array();
		$num = count($arr);
		$flag = true;
		foreach($arr as $key=>$val)
		{
			/* $n = $num--;
			$newArr[$n]['name'] = strtoupper($key);
			$newArr[$n]['value'] =$val; */
			$d['name'] = strtoupper($key);
			$d['value'] = $val ;
			/* $name=D("public",'Admin')->table('conf')->where("name=".strtoupper($key))->find();
			 */
			if(!$file_flag) 
			{
				$list=D("public",'Admin')->table('conf')->add ($d);
				
			}else{
				//$list=D("public",'Admin')->table('conf')->where("name=".$d['name'])->save($d['value']);
				$list = $GLOBALS['db']->query("update ".DB_PREFIX."conf set value='".$d['value']."' where name='".$d['name']."'");	
			}
			
			if(!$list)
			{
				$flag = false;
			}
			
		}
		//die;
		if(!$flag)
		{
			alert("系统设置保存失败",1);
		}else{
			$fflag = true;
		}
		
		//$exist_img=D("public",'Admin')->table('conf')->where("name='WEBSITE_LOGO'")->find();
		
		if($imgflag&&!$_FILES['website_logo'])
		{
			$fflag = true;
		}
		else{
			$config['path']=get_real_path()."uploads/system";
			$config['maxsize'] = 1000000;
			$config['allowtype'] = array("gif","png","jpg","jpeg");
			$config['israndname'] = true;
			
			if(!is_dir($config['path']))
				$res=mkdir(iconv("UTF-8", "GBK", $config['path']),0777,true);
			//第一个参数:上传文件的表单名称   第二个参数：上传配置
			
			$result  = $this->uploadPic('website_logo',$config);
			$flag1 = false;
			//pp($result);die;
			if(!$result['status'])
			{
				$data['status'] = $result['status'];
				$data['msg'] = $result['errMsg'];
				$pic = $result['fileName'];
				$flag1 = true;
				$fflag = false;
				//ajax_return($data);
			}else{
				$data['status'] = $result['status'];
				$data['msg'] = "文件上传成功";
				$pic = $result['fileName'];
					
				$dpic['name'] = 'WEBSITE_LOGO';
				$dpic['value'] ="./uploads/system/".$pic;
				if($imgflag&&$_FILES['website_logo']||!$imgflag&&$_FILES['website_logo'])
				{
					$list = $GLOBALS['db']->query("update ".DB_PREFIX."conf set value='".$dpic['value']."' where name='WEBSITE_LOGO'");
				}else{
					$list=D("public",'Admin')->table('conf')->add ($dpic);
				}
				
				//ajax_return($data);
				if($list)
				{
					$fflag = true;
				}
			}
		}
		
		//pp($data);die;
		if($fflag)
		{
			$sys_configs=D("public",'Admin')->table('conf')->select();
			//pp($sys_configs);die;
			$config_str = "<?php\n";
			$config_str .= "return array(\n";
			foreach($sys_configs as $k=>$v)
			{
				$config_str.="'".$v['name']."'=>'".$v['value']."',\n";
			}
			$config_str.=");\n ?>";
			
			$filename = get_real_path()."public/sys_wconfig.php";
			
			if (!$handle = fopen($filename, 'w')) {
				$this->error(l("OPEN_FILE_ERROR").$filename);
			}
				
				
			if (fwrite($handle, $config_str) === FALSE) {
				$this->error(l("WRITE_FILE_ERROR").$filename);
			}
				
			fclose($handle);
			
			$dataa['status'] = "1";
			$dataa['msg'] = "系统设置保存成功";
			ajax_return($dataa);	
		}else{
			$dataa['status'] = "0";
			$dataa['msg'] = "系统设置保存失败";
			ajax_return($dataa);
		}

		
		//echo json_encode($msg);
		
	}
	
	//添加图片
	public function picture_add()
	{
		$GLOBALS['tmpl']->display("picture/picture-add.html");
	}
	
	public function picture_edit()
	{
		$where['id'] = $_REQUEST['id'];
		$data = D("public",'Admin')->table('conf')->where($where)->find();
		$GLOBALS['tmpl']->assign("data",$data);
		//pp($data);die;
		$GLOBALS['tmpl']->display("picture/picture-edit.html");
	}
	
	//添加网站首页图片数据
	public function picture_insert()
	{
		//pp($_FILES['img']);die;
		$img = $_FILES['img']['name'];
		
		if(count($img)!=3)
		{
			$dataa['status'] = 0;
			$dataa['msg'] = "请上传所有图片";
			ajax_return($dataa);
		}
		$name =
		"'WEBSITE_SLIDER_0',
		'WEBSITE_SLIDER_1',
		'WEBSITE_SLIDER_2'";
		
		$data = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."conf where name in(".$name.") ");
		
		if(count($data)!=0)
		{
			$dataa['status'] = 0;
			$dataa['msg'] = "请勿重复添加图片";
			ajax_return($dataa);
		}
		//图片上传
		$config['path']=get_real_path()."uploads/system";
		$config['maxsize'] = 1000000;
		$config['allowtype'] = array("gif","png","jpg","jpeg");
		$config['israndname'] = true;
			
		if(!is_dir($config['path']))
			$res=mkdir(iconv("UTF-8", "GBK", $config['path']),0777,true);
		//第一个参数:上传文件的表单名称   第二个参数：上传配置
		$result  = $this->uploadPic('img',$config);
		//pp($result);die;
		$fflag = false;
		if(!$result['status'])
		{
			$data1['status'] = $result['status'];
			$data1['msg'] = $result['errMsg'];
			$pic = $result['fileName'];
		
			$fflag = false;
			//ajax_return($data);
		}else{
			$data1['status'] = $result['status'];
			$data1['msg'] = "文件上传成功";
			$pic = $result['fileName'];
			if(is_array($pic))
			{
				foreach($pic as $key=>$val)
				{
					$data['name'] ="WEBSITE_SLIDER_".$key;
					$data['value'] ="./uploads/system/".$val;;
					//ajax_return($data);
					
					$list=D("public",'Admin')->table('conf')->add ($data);
					if(!$list)
					{
						$fflag = false;
					}else{
						$fflag = true;
					}
				}
			}
			
			
		}
		
		if($fflag)
		{
			$sys_configs=D("public",'Admin')->table('conf')->select();
			//pp($sys_configs);die;
			$config_str = "<?php\n";
			$config_str .= "return array(\n";
			foreach($sys_configs as $k=>$v)
			{
				$config_str.="'".$v['name']."'=>'".$v['value']."',\n";
			}
			$config_str.=");\n ?>";
				
			$filename = get_real_path()."public/sys_wconfig.php";
				
			if (!$handle = fopen($filename, 'w')) {
				$this->error(l("OPEN_FILE_ERROR").$filename);
			}
		
		
			if (fwrite($handle, $config_str) === FALSE) {
				$this->error(l("WRITE_FILE_ERROR").$filename);
			}
		
			fclose($handle);
				
			$dataa['status'] = "1";
			$dataa['msg'] = "图片保存成功";
			ajax_return($dataa);
		}else{
			$dataa['status'] = "0";
			$dataa['msg'] = "图片保存失败";
			ajax_return($dataa);
		}
		
	}
	
	//图片更新
	public function picture_update()
	{
		$data = D("public",'Admin')->table('conf')->create();
		$where['id']=$data['id'];
		//$param['name'] = $data['name'];
		$imgflg = $_REQUEST['imgflag'];
		
		if($imgflg&&!$_FILES['img'])
		{
			$fflag = false;
			$da['status'] = 0;
			$da['msg'] = "无更新操作";
			ajax_return($da);
		}elseif (!$imgflg&&!$_FILES['img'])
		{
			$fflag = false;
			//alert("请上传项目图片",1);
			$da['status'] = -1;
			$da['msg'] = "请上传图片";
			ajax_return($da);
		}else{
			
			//图片上传
			$config['path']=get_real_path()."uploads/system";
			$config['maxsize'] = 1000000;
			$config['allowtype'] = array("gif","png","jpg","jpeg");
			$config['israndname'] = true;
				
			if(!is_dir($config['path']))
				$res=mkdir(iconv("UTF-8", "GBK", $config['path']),0777,true);
			//第一个参数:上传文件的表单名称   第二个参数：上传配置
			$result  = $this->uploadPic('img',$config);
			$fflag = false;
			if(!$result['status'])
			{
				$data1['status'] = $result['status'];
				$data1['msg'] = $result['errMsg'];
				$pic = $result['fileName'];
				$fflag = false;
				//ajax_return($data);
			}else{
				$data1['status'] = $result['status'];
				$data1['msg'] = "文件上传成功";
				$pic = $result['fileName'];
				
				$param['value'] ="./uploads/system/".$pic;
				//ajax_return($data);
				$fflag = true;
					
			}
			
		}
		
		
		if($fflag)
		{
			$data = D("public",'Admin')->table('conf')->where($where)->data($param)->save();
			//pp($data);die;
			if($data)
			{
				$sys_configs=D("public",'Admin')->table('conf')->select();
			//pp($sys_configs);die;
			$config_str = "<?php\n";
			$config_str .= "return array(\n";
			foreach($sys_configs as $k=>$v)
			{
				$config_str.="'".$v['name']."'=>'".$v['value']."',\n";
			}
			$config_str.=");\n ?>";
			
			$filename = get_real_path()."public/sys_wconfig.php";
			
			if (!$handle = fopen($filename, 'w')) {
				$this->error(l("OPEN_FILE_ERROR").$filename);
			}
				
				
			if (fwrite($handle, $config_str) === FALSE) {
				$this->error(l("WRITE_FILE_ERROR").$filename);
			}
				
			fclose($handle);
			$da['status'] = 1;
			$da['msg'] = "更新成功";
			ajax_return($da);
				
			}else{
				$da['status'] = 0;
				$da['msg'] = "写入失败";
				ajax_return($da);
			}
			
			
			
			
		}else{
			$da['status'] = 0;
			$da['msg'] = "更新失败";
			ajax_return($da);
		}
		
		
	}
	
	//图片删除
	public function picture_del()
	{
		$id = $_REQUEST['id'];
		
		$r = D("public",'Admin')->table('conf')->delete($id);
		//echo $r;
		if($r)
		{
			$sys_configs=D("public",'Admin')->table('conf')->select();
			//pp($sys_configs);die;
			$config_str = "<?php\n";
			$config_str .= "return array(\n";
			foreach($sys_configs as $k=>$v)
			{
				$config_str.="'".$v['name']."'=>'".$v['value']."',\n";
			}
			$config_str.=");\n ?>";
				
			$filename = get_real_path()."public/sys_wconfig.php";
				
			if (!$handle = fopen($filename, 'w')) {
				$this->error(l("OPEN_FILE_ERROR").$filename);
			}
			
			
			if (fwrite($handle, $config_str) === FALSE) {
				$this->error(l("WRITE_FILE_ERROR").$filename);
			}
			
			fclose($handle);
			$da['status'] = 1;
			$da['msg'] = "删除成功";
			ajax_return($da);
			
		}else{
			
			$da['status'] = 0;
			$da['msg'] = "删除失败";
			ajax_return($da);
		}
		
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