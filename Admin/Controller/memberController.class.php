<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 会员管理提现类
 */

class memberController extends baseController
{
	public function __construct()
	{
		if(!is_role('hygl'))
			alert('您没有权限',0,url('admin',"index"));
	}
	public function  index(){
		$requst = D('member','Admin')->table('user')->create();
		if($requst){
			foreach ($requst as $k=>$v){
				if($v){
					$where.="and ".$k."='".$v."'";
				}
				
			}
		}else{
			$where = '';
		}
		
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		
// 		pp($where);die;
		$data = D('member','Admin')->all_select($limit,$where);

// 		echo D('member','Admin')->getLastSql();die;
		$count = D('member','Admin')->get_count($where);
		
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->assign("page",$p);
		$GLOBALS['tmpl']->display('member/member-list.html');
	}
	//添加会员页面
	public function member_add()
	{
		$GLOBALS['tmpl']->display('member/member-add.html');
	}
	
	//添加会员数据
	public function member_insert()
	{
		$data =D('public','admin')->table('user')->create();
		$name_have = D('member','Admin')->table('user')->where("user_name = '".$data['user_name']."'")->find();
		if($name_have){
			$r['returnCode']=0;
			$r['returnMsg']='用户名已存在';
			echo json_encode($r);die;
		}
		$mobile_have = D('member','Admin')->table('user')->where("mobile = '".$data['mobile']."'")->find();
		if($mobile_have){
			$r['returnCode']=0;
			$r['returnMsg']='手机号已存在';
			echo json_encode($r);die;
		}
		$data['is_effect'] = 1;
		$data['user_pwd'] =md5($data['user_pwd']);
		$data['paypassword'] =md5($data['paypassword']);
		
		$r =D('public','admin')->table('user')->add($data);
		if($r){
			$rs['returnCode']=1;
			$rs['returnMsg']='添加成功';
			echo json_encode($rs);die;
		}else{
			$r['returnCode']=0;
			$r['returnMsg']='添加失败';
			echo json_encode($r);die;
		}
		
		
	}
	
	public function Recharge(){
		//充值
	}
	
	public function  memberset(){
		
		$where['id'] = $_REQUEST['id'];
		$data['is_effect'] =$_REQUEST['is_effect'];
		$data = D('member','Admin')->table('user')->where($where)->save($data);
		echo json_encode($data);die;
	}
	public function  memberdel(){
		
		$where['id'] = $_REQUEST['id'];
		$data['is_delete'] =$_REQUEST['is_delete'];
		$data = D('member','Admin')->table('user')->where($where)->save($data);
		echo json_encode($data);die;
	}
	//批量删除
	public function memberdelall(){
		$id=$_REQUEST['ids'];
		$ids='';
		foreach ($id as $v){
			$ids.=$v.",";
		}
		$ids=trim(substr($ids,0,-1),",");//去除最后一个 第一个逗号
		$sql="delete from ".DB_PREFIX."user where id in (".$ids.")";
		
		$r=$GLOBALS['db']->query($sql);
		echo $r;
		
	}
	public function  memberedit(){
		$where['id'] = $_REQUEST['id'];
		$data = D('member','Admin')->table('user')->where($where)->find();
		
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display('member/member-edit.html');
	}
	
	//会员充值
	public function user_charge()
	{
		$where['id'] = $_REQUEST['id'];
		$data = D('member','Admin')->table('user')->where($where)->find();
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display('moneymanage/recharge.html');
	}
	//修改会员密码页面
	public function change_password()
	{
		$where['id'] = $_REQUEST['id'];
		$data = D('member','Admin')->table('user')->where($where)->find();
		
		$GLOBALS['tmpl']->assign("data",$data);
		$GLOBALS['tmpl']->display('member/member-change-password.html');
	}
	
	//修改会员密码数据
	public function change_pwd()
	{
		$param = $_REQUEST;
		$where['id'] = $param['id'];
		$data['user_pwd'] =md5($param['newpassword']) ;
		//pp($data);die;
		$r = D('member','Admin')->table('user')->where($where)->save($data);
		echo json_encode($r);die;
	}
	
	public function memberupdate(){
		$data = D('member','Admin')->table('user')->create($_REQUEST);
		
		$where['id']=$data['id'];
		unset($data['id']);
		unset($data[0]);
		$list = D('member','Admin')->table('user')->where($where)->find();
		if($data['paypassword']===$listp['paypassword']){
			$data['paypassword']=$data['paypassword'];
		}else{
			$data['paypassword']=MD5($data['paypassword']);
		}
		$r = D('member','Admin')->table('user')->where($where)->save($data);
		
		echo json_encode($r);die;
	}
	
	

	public function excelimport(){
		$tmp_file = $_FILES['file_stu']['tmp_name'];
		$file_types = explode ( ".", $_FILES ['file_stu'] ['name'] );
		$file_type = $file_types [count ( $file_types ) - 1];
		
		/*判别是不是.xlsx文件，判别是不是excel文件*/
			if (strtolower ( $file_type ) != "xls")
			{
				 alert('请上传Excel2003版本的XLS文件',0,url('admin',"member#index"));
			}
		require APP_ROOT_PATH.'sys/utils/PHPExcel/Classes/PHPExcel.php';
		require APP_ROOT_PATH.'sys/utils/PHPExcel/Classes/PHPExcel/IOFactory.php';
		require APP_ROOT_PATH.'sys/utils/PHPExcel/Classes/PHPExcel/Reader/Excel5.php';
		$reader= \PHPExcel_IOFactory::createReader('Excel5');//03版本
		$PHPExcel = $reader->load($tmp_file); // 文档名称
		$objWorksheet = $PHPExcel->getActiveSheet();
		$highestRow = $objWorksheet->getHighestRow(); // 取得总行数
		$highestColumn = $objWorksheet->getHighestColumn(); // 取得总列数
	$msg='';
		for($j=2;$j<=$highestRow;$j++)                        //从第二行开始读取数据
		{
			$str="";
			for($k='A';$k<=$highestColumn;$k++)            //从A列读取数据
			{
				$str .=$PHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'|*|';//读取单元格
			}
				
			$str=mb_convert_encoding($str,'UTF-8','auto');//根据自己编码修改
			$strs = explode("|*|",$str);
			$is_user = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where user_name='".$strs[0]."'");
			$is_moblie = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where mobile='".$strs[1]."'");
			
			if(!$strs[0]||!$strs[1]){
				continue;
			}
			if($is_user){//判断用户名、是否存在
// 				$msg.="用户名".$is_user['user_name']."已存在<br />";
				$arr['id']=$is_user['id'];
				$arr['user_pwd']=$strs[2];
				$arr['email']=$strs[3];
				$arr['mobile']=$strs[1];
				$arr['real_name_encrypt']=$strs[4];
				$arr['idno_encrypt']=$strs[5];
				$arr['mobile_encrypt']=$strs[3];
				$arr['bankcard']=$strs[6];
				$arr['bankname']=$strs[7];
				$r = D('member','Admin')->table('user')->save($arr);
			}elseif($is_moblie){
// 				$msg.="手机号：".$is_moblie['mobile']."已存在<br />";
				$arr['id']=$is_user['id'];
				$arr['user_pwd']=$strs[2];
				$arr['email']=$strs[3];
				$arr['mobile']=$strs[1];
				$arr['real_name_encrypt']=$strs[4];
				$arr['idno_encrypt']=$strs[5];
				$arr['mobile_encrypt']=$strs[3];
				$arr['bankcard']=$strs[6];
				$arr['bankname']=$strs[7];
				$r = D('member','Admin')->table('user')->save($arr);
			}else{
				$val.="('".$strs[0]."','".$strs[2]."','".$strs[3]."','".$strs[1]."','".TIME_UTC."','".to_date(TIME_UTC,'Y-m-d')."',1,'".$strs[4]."','".$strs[5]."','".$strs[1]."','".$strs[6]."','".$strs[7]."'),";
			}
			
				
				
	
		}
		$val=substr($val,0,-1);
		if($val){
			$sql="insert into ".DB_PREFIX."user (user_name,user_pwd,email,mobile,create_time,create_date,is_effect,real_name_encrypt,idno_encrypt,mobile_encrypt,bankcard,bankname) values ".$val;
			$r=$GLOBALS['db']->query($sql);
		}
		
		
			if($r){
				echo "<script>alert('导入成功！');window.location='/admin.php?ctl=member'</script>";
			}else{
				echo "<script>alert('导入失败！');window.location='/admin.php?ctl=member'</script>";
			}
			
		
		
	}
	
	
}
?>