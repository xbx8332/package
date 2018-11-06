<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
require_once 'sys/libs/licai.php';
class licaiController extends baseController
{
	public function __construct()
	{
		if(!is_role('lcgl'))
			alert('您没有权限',0,url('admin',"r=index"));
	}
	public function  aaa(){
		$GLOBALS['tmpl']->display('aaaaa/index.html');
		//pp($GLOBALS['tmpl']);;die;
	}
	public function current(){
		
		
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$data = D("licai",'Admin')->table('licai')->where('type=0')->order('id DESC')->limit($limit)->select();
		$count=D("licai",'Admin')->table('licai')->where('type=0')->count();
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		
		$GLOBALS['tmpl']->assign("page",$p);
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display('licai/current-list.html');
	}
	//批量删除
	public function currentdelall(){
		$id=$_REQUEST['ids'];
		$ids='';
		foreach ($id as $v){
			$ids.=$v.",";
		}
		$ids=trim(substr($ids,0,-1),",");//去除最后一个 第一个逗号
		$sql="delete from ".DB_PREFIX."licai where id in (".$ids.")";
		
		$r=$GLOBALS['db']->query($sql);
		echo $r;
	}
	public function current_add(){
		
		$GLOBALS['tmpl']->display('licai/current-add.html');
	}
	public function current_insert1(){
		echo json_decode(1);
	}
	public function current_insert(){
		
		 if($_REQUEST['type']==0){
			$count = D("licai",'Admin')->table('licai')->where('type=0')->select();
		
			if(count($count)>0)
			{
				alert('活期理财产品只能有一个',1,$log_info.L("INSERT_FAILED"));
				die;
			}
		}  
		
		$data = D("licai",'Admin')->table('licai')->create();
		
		$GLOBALS['tmpl']->assign("jumpUrl",wap_url('admin',MODULE_NAME));
		
		$data["user_name"] = strim($_REQUEST['user_name']);
		$data["verify"] = 1;
		$data["user_id"] = $GLOBALS['db']->getOne("select id from ".DB_PREFIX."user where user_name = '".$data["user_name"]."'");
		
		
		$log_info = $data["name"];
		
		//开始验证有效性
		if(!check_empty($data['name']))
		{
			alert("请输入名称",1);
		}
		if(!check_empty($data['time_limit']) && (!check_empty($data['end_date'])|| $data['end_date'] == '0000-00-00'))
		{
			alert("项目结束时间和理财期限至少填写一个",1);
		}
// 		if(!check_empty($data['user_name']))
// 		{
// 			alert("请填写发起人");
// 		}
		/*if(!check_empty($data['licai_sn']))
		 {
		 alert("请输入项目编号");
		 }*/
		
		
		if(strim($data["licai_sn"]) == "")
		{
			$data["licai_sn"] = "LC".to_date(TIME_UTC,"Y")."".rand(10000, 99999);
		}
		$data['begin_buy_date'] = trim($data['begin_buy_date']);
		$data['end_buy_date'] = trim($data['end_buy_date']);
		$data['end_date'] = trim($data['end_date']);
		
		$data['user_name'] = strim($_REQUEST["user_name"]);
		
		if(!$data['user_name'] )
			$data['user_id'] ="";
		else
		{
			$data['user_id'] = $GLOBALS['db']->getOne("select id from ".DB_PREFIX."user where user_name = '".$data["user_name"]."'");
		}
		$fflag = true;
		//$data["type"] = 0;
		
	//图片上传
		/* $config['path']=get_real_path()."uploads/licai";
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
			$data['img'] = 	"./uploads/licai/".$pic;
			//ajax_return($data);
			$fflag = true;
			
		} */
		//pp($data);die;
		if($fflag)
			
		$list=D("licai",'Admin')->table('licai')->adds($data);
		
		if (false !== $list) {
				
			save_log($log_info.L("INSERT_SUCCESS"),1);
			alert(L("INSERT_SUCCESS"),1);
		} else {
			//错误提示
			save_log($log_info.L("INSERT_FAILED"),0);
			alert(L("INSERT_FAILED"),1,$log_info.L("INSERT_FAILED"));
		}
	
		
	}
	public function current_del(){
		
		$data = D("licai",'Admin')->table('licai')->create();
		
		$r = D("licai",'Admin')->table('licai')->delete($data['id']);
		echo $r;
	}
	public function current_update(){
		$data = D("licai",'Admin')->table('licai')->create();
		$id['id']=$data['id'];
		/* $imgflg = $_REQUEST['imgflag'];
		
		if($imgflg&&!$_FILES['img'])
		{
			$fflag = true;
			unset($data['img']);
		}elseif (!$imgflg&&!$_FILES['img'])
		{
			
			//alert("请上传项目图片",1);
			$da['status'] = -1;
			$da['msg'] = "请上传项目图片";
 			ajax_return($da);
		}else{
			
			//图片上传
			$config['path']=get_real_path()."uploads/licai";
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
				$data['img'] = 	"./uploads/licai/".$pic;
				//ajax_return($data);
				$fflag = true;
					
			}
		} */
		
		$fflag = true;
		unset($data['id']);
		unset($data['0']);
		$data['description'] = addslashes($data['description']);
		$data['rule_info'] =addslashes($data['rule_info']);
		
		if($fflag)
		{
			$data = D("licai",'Admin')->table('licai')->where($id)->data($data)->save();
		if($data)
			{
				//alert("更新成功",1);
				$da['status'] = 1;
				$da['msg'] = "更新成功";
				ajax_return($da);
			}else{
				$da['status'] = 0;
				$da['msg'] = "更新失败";
				ajax_return($da);
				//alert("更新失败",1);
			}
		}
			
	}
	public function current_edit(){
		$where['id'] = $_REQUEST['id'];
		$data = D("licai",'Admin')->table('licai')->where($where)->find();
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display('licai/current-edit.html');
	}
	public function current_rate_edit(){
		$GLOBALS['tmpl']->display('current-add.html');
	}
	public function current_rate_update(){
		$GLOBALS['tmpl']->display('current-add.html');
	}
	
	
	public function regular(){
		
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$data = D("licai",'Admin')->table('licai')->where('type=1')->order('id DESC')->limit($limit)->select();
		$count=D("licai",'Admin')->table('licai')->where('type=1')->count();
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign("page",$p);
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display('licai/regular-list.html');
	}
	//添加定期产品页面
	public function regular_add(){
		$GLOBALS['tmpl']->display('licai/regular-add.html');
	}
	
	//编辑定期产品页面
	public function regular_edit(){
		$where['id'] = $_REQUEST['id'];
		
		$data = D("licai",'Admin')->table('licai')->where($where)->find();
		
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display('licai/regular-edit.html');
	}
	
	//更新定期产品
	public function regular_update()
	{
		//pp($_REQUEST);die;
		$data = D("licai",'Admin')->table('licai')->create();
		$id['id']=$data['id'];
		/* $imgflg = $_REQUEST['imgflag'];
		
		if($imgflg&&!$_FILES['img'])
		{
			$fflag = true;
			unset($data['img']);
		}elseif (!$imgflg&&!$_FILES['img'])
		{
			
			//alert("请上传项目图片",1);
			$da['status'] = -1;
			$da['msg'] = "请上传项目图片";
 			ajax_return($da);
		}
		else{
		//图片上传
			$config['path']=get_real_path()."uploads/licai";
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
				$data['img'] = 	"./uploads/licai/".$pic;
				//ajax_return($data);
				$fflag = true;
					
			}
		} */
		$fflag = true;
		unset($data['id']);
		unset($data['0']);
		$data['description'] = addslashes($data['description']);
		$data['rule_info'] =addslashes($data['rule_info']); 
		//pp($data);die;
		if($fflag)
		{
			$data = D("licai",'Admin')->table('licai')->where($id)->data($data)->save();
			
			if($data)
			{
				//alert("更新成功",1);
				$da['status'] = 1;
				$da['msg'] = "更新成功";
				ajax_return($da);
			}else{
				$da['status'] = 0;
				$da['msg'] = "更新失败";
				ajax_return($da);
				//alert("更新失败",1);
			}
			
		}
		
	}
	
	public function regular_del(){
	
		$data = D("licai",'Admin')->table('licai')->create();
		//pp($_REQUEST);die;
		$r = D("licai",'Admin')->table('licai')->delete($data['id']);
		echo $r;
	}
	
	
	//浮动查看
	public function float_check()
	{
		$where['licai_id']=$_REQUEST['id'];
		
		$data = D("licai",'Admin')->table('licai_history')->where($where)->select();
		
		$GLOBALS['tmpl']->assign('data',$data);
		$GLOBALS['tmpl']->display('licai/float-check.html');
	}
	
	//删除利率记录
	public function rate_del()
	{
		$data = D("licai",'Admin')->table('licai_history')->create();
		$r = D("licai",'Admin')->table('licai_history')->delete($data['id']);
		echo $r; 
	}
	
	//设置利率页面
	public function set_rate()
	{
		$param['id'] = $_REQUEST['id'];
		
		$GLOBALS['tmpl']->assign('data',$param);
		$GLOBALS['tmpl']->display('licai/rate-edit.html');
	}
	
	//活期利率设置页面提交
	public function rateinsert()
	{
		$param['licai_id'] = $_REQUEST['licai_id'];//理财产品编号id
		$param['set_rate_date'] = $_REQUEST['set_rate_date'];
		$param['rate_value'] = $_REQUEST['rate_value'];

		$data = D("licai",'Admin')->table('licai_history')->create();
		$GLOBALS['tmpl']->assign("jumpUrl",url('admin','licai#current'));
		
		$log_info = $data["licai_id"];
		
		//开始验证有效性
		
		if(!check_empty($data['history_date']))
		{
			alert("请输入日期",1);
		}
		
		if(!check_empty($data['rate']))
		{
			alert("请输入利率",1);
		}
		unset($data[0]);
		
		$list=D("licai",'Admin')->table('licai_history')->add ($data);
		
		$log_info .= "--".$list["id"];
		
		if (false !== $list) {
				
			require_once(APP_ROOT_PATH."sys/libs/licai.php");
				
			syn_licai_status($data['licai_id'],0);
				
			save_log($log_info.L("INSERT_SUCCESS"),1);
			alert(L("INSERT_SUCCESS"),1);
		} else {
			//错误提示
			save_log($log_info.L("INSERT_FAILED"),0);
			alert(L("INSERT_FAILED"),1,$log_info.L("INSERT_FAILED"));
		}
		
	}
	
	//定期浮动查看页面
	public function regular_float_check()
	{
		$where['licai_id']=$_REQUEST['id'];
		
		$data = D("licai",'Admin')->table('licai_history')->where($where)->select();
		
		$GLOBALS['tmpl']->assign('data',$data);
		$GLOBALS['tmpl']->display('licai/regular_float-check.html');
	}
	

	
	//定期设置利率页面
	public function set_regular_rate()
	{
		$param['id'] = $_REQUEST['id'];
		
		$GLOBALS['tmpl']->assign('data',$param);
		$GLOBALS['tmpl']->display('licai/regular_rate-edit.html');
	}
	
	//定期删除利率记录
	public function regular_rate_del()
	{
		$param['id'] = $_REQUEST['id'];
	
		echo json_encode($param);
	}
	
	//定期利率设置页面提交
	public function regular_rateinsert()
	{
		$param['licai_id'] = $_REQUEST['licai_id'];//理财产品编号id
		$param['set_rate_date'] = $_REQUEST['set_rate_date'];
		$param['rate_value'] = $_REQUEST['rate_value'];
	
		echo json_encode($param);
	}
	
	public function order(){
		
		$condition = " ";
		
		if(strim($_REQUEST["name"]) != "")
		{
			$condition = " and lc.name like '%".strim($_REQUEST["name"])."%'";
		}
		
		if(strim($_REQUEST["user_name"]) != "")
		{
			$condition = " and lco.user_name like '%".strim($_REQUEST["user_name"])."%'";
		}
		
		$start_time = strim($_REQUEST['start_time']);
		$end_time = strim($_REQUEST['end_time']);

		$d = explode('-',$start_time);
		if (isset($_REQUEST['start_time']) && $start_time !="" && checkdate($d[1], $d[2], $d[0]) == false){
			alert("开始时间不是有效的时间格式:{$start_time}(yyyy-mm-dd)");
			exit;
		}
		
		$d = explode('-',$end_time);
		if ( isset($_REQUEST['end_time']) && strim($end_time) !="" &&  checkdate($d[1], $d[2], $d[0]) == false){
			alert("结束时间不是有效的时间格式:{$end_time}(yyyy-mm-dd)");
			exit;
		}
		
		if ($start_time!="" && strim($end_time) !="" && to_timespan($start_time) > to_timespan($end_time)){
			alert('开始时间不能大于结束时间:'.$start_time.'至'.$end_time);
			exit;
		}
		if(strim($start_time)!="")
		{
			$condition .= " and lco.create_date >= '".strim($start_time)."'";
			$GLOBALS['tmpl']->assign("start_time",$start_time);
		}
		if(strim($end_time) !="")
		{
			$condition .= " and lco.create_date <= '".  strim($end_time)."'";
			$GLOBALS['tmpl']->assign("end_time",$end_time);
		}
		
		//排序字段 默认为主键名
		if (isset ( $_REQUEST ['_order'] )) {
			if(strim($_REQUEST['_order']) != "id")
			{
				$order = strim($_REQUEST ['_order']);
				if($order == "fee_format")
				{
					$order = "";
				}
			}
			else
			{
				$order = "lco.id";
			}
		} else {
			$order = "lco.id";
		}
		//排序方式默认按照倒序排列
		//接受 sost参数 0 表示倒序 非0都 表示正序
		if (isset($_REQUEST ['_sort'])){
			$sort = strim($_REQUEST ['_sort']) ? 'asc' : 'desc';
		} else {
			$sort = 'desc';
		}
		
		$sortImg = $sort; //排序图标
		$sortAlt = $sort == 'desc' ? l("ASC_SORT") : l("DESC_SORT"); //排序提示
		
		if($order == "")
		{
			$order_str = "";
		}
		else
		{
			$order_str = " order by ". str_replace("_format","",$order)." ".$sort;
		}
		
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		
		$page_size = 5;
		
		$limit = (($page-1)*$page_size).",".$page_size;
		
		$result = array();
		
		$result['count'] = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."licai_order lco left join ".DB_PREFIX."licai lc on lco.licai_id = lc.id where 1=1 ".$condition);
		
		if($result['count'] > 0){
				
			$result['list'] = $GLOBALS['db']->getAll("SELECT lco.*,lc.type,lc.name,lc.licai_sn FROM ".DB_PREFIX."licai_order lco left join ".DB_PREFIX."licai lc on lco.licai_id = lc.id where 1=1 ".$condition.$order_str." limit ".$limit);
				
		}
		
		$sort = $sort == 'desc' ? 1 : 0; //排序方式
		$GLOBALS['tmpl']->assign ( 'li', $limit );
		$GLOBALS['tmpl']->assign ( 'sort', $sort );
		$order = str_replace("lco.","",$order);
		$GLOBALS['tmpl']->assign ( 'order', $order );
		$GLOBALS['tmpl']->assign ( 'sortImg', $sortImg );
		$GLOBALS['tmpl']->assign ( 'sortType', $sortAlt );
	
		foreach($result['list']  as $k => $v)
		{
			if($v["status"] == 0)
			{
				$result['list'][$k]["status_format"] = "未支付";
			}
			elseif($v["status"] == 1)
			{
				$result['list'][$k]["status_format"] = "已支付";
			}
			elseif($v["status"] == 2)
			{
				$result['list'][$k]["status_format"] = "部分赎回";
			}
			elseif($v["status"] == 3)
			{
				$result["list"][$k]["status_format"] = "已完结";
			}
				
			$result['list'][$k]["site_buy_fee_rate_format"] = number_format($v['site_buy_fee_rate'],2)."%";
				
			if($v["begin_interest_type"] == 0)
			{
				$result['list'][$k]["begin_interest_type_format"] = "当日生效";
			}
			elseif($v["begin_interest_type"] == 1)
			{
				$result['list'][$k]["begin_interest_type_format"] = "次日生效";
			}
			elseif($v["begin_interest_type"] == 2)
			{
				$result['list'][$k]["begin_interest_type_format"] = "下个工作日生效";
			}
			elseif($v["begin_interest_type"] == 3)
			{
				$result['list'][$k]["begin_interest_type_format"] = "下二个工作日生效";
			}
				
			switch($v["type"])
			{
				case 0: $result["list"][$k]["type_format"] = "余额宝";
				break;
				case 1: $result["list"][$k]["type_format"] = "固定定存";
				break;
				//case 2: $result["list"][$k]["type_format"] = "浮动定存";
				//	break;
				//case 3: $result["list"][$k]["type_format"] = "票据";
				//	break;
				//case 4: $result["list"][$k]["type_format"] = "基金";
				//	break;
			}
			$result["list"][$k]["fee_format"] = format_price($v["site_buy_fee"]);
				
			$result["list"][$k]["money_format"] = format_price($v["money"]);
				
			if($v["type"] > 0)
			{
				$result["list"][$k]["before_rate_format"] = number_format($v["before_rate"],2)."%";
				$result["list"][$k]["interest_rate_format"] = number_format($v["interest_rate"],2)."%";
			}
			else
			{
				$result["list"][$k]["before_rate_format"] = "无";
				$licai_interest = get_licai_interest_yeb($v['licai_id'],$v['begin_interest_date'],$v['end_interest_date']);
				$result["list"][$k]["interest_rate_format"] = number_format($licai_interest["avg_interest_rate"],2)."%";
			}
				
		}
		
		$GLOBALS['tmpl']->assign("data",$result['list']);
		
		$page = new Page($result['count'],$page_size);   //初始化分页对象
		$p  =  $page->show();
		
		
		$GLOBALS['tmpl']->assign('page',$p);
		$GLOBALS['tmpl']->assign('main_title',"订单列表");
		$GLOBALS['tmpl']->display('licai/order-list.html');
		
	}
	//添加体验金页面
	public function issueMoney_add()
	{
		$GLOBALS['tmpl']->display('licai/issueMoney-add.html');
	}
	//保存体验金
	public function issueMoneyinsert()
	{
		//pp($_REQUEST['type']);die;
		
		$type = ($_REQUEST['type']);
		
		$count = D("licai",'Admin')->table('learn_type')->where('type='.$type)->select();
		//pp($count);die;
		if(count($count)>0)
		{
			$da['status'] =0;
			$da['msg'] ="注册金发放类型只能有一种";
			ajax_return($da);
			//alert('注册金发放类型只能有一种',1,$log_info.L("INSERT_FAILED"));
		die;
		}
		
		
		$data = D("public",'Admin')->table('learn_type')->create();
		$r =D('public','Admin')->table('learn_type')->add($data);
		if($r)
		{
			$da['status'] =1;
			$da['msg'] ="添加成功";
		}else{
			$da['status'] =0;
			$da['msg'] ="添加失败";
		}
		ajax_return($da);
	}
		
	//编辑体验金页面
	public function issueMoney_edit()
	{
		$where['id'] = $_REQUEST['id'];
		$data = D("public",'Admin')->table('learn_type')->where($where)->find();
		
		$GLOBALS['tmpl']->assign("data",$data);
		
		$GLOBALS['tmpl']->display('licai/issueMoney-edit.html');
	}
	
	//体验金更新
	public function issueMoney_update()
	{
		$data = D("public",'Admin')->table('learn_type')->create();
		$id['id']=$data['id'];
		
		unset($data['id']);
		
		$data = D("public",'Admin')->table('learn_type')->where($id)->data($data)->save();
		echo json_encode($data);
		
	}
	
	//体验金删除
	public function issueMoney_del()
	{
		$data = D("public",'Admin')->table('learn_type')->create();
		$r = D("public",'Admin')->table('learn_type')->delete($data['id']);
		echo $r;
	}
	
}
?>