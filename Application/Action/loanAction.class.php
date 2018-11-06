<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
class loanAction  extends publicAction
{
	public function index()
	{
		$page['title']="我要贷款";
		$data=$GLOBALS['db']->getAll("select * from ".DB_PREFIX."licai_rulemsg");
		$list=array();
		foreach ($data as $v){
			if($v['type']==1){
				$list['dkgz'][]=$v;
			}elseif($v['type']==2){
				$list['dkzg'][]=$v;
			}else{
				$list['kswd'][]=$v;
			}
		}
		$user_data = es_session::get('user_info');
		//pp(es_session::get('user_info'));die;
		//pp($list);die;
		$GLOBALS['tmpl']->assign('user',es_session::get('user_info'));
		$GLOBALS['tmpl']->assign("list",$list);
		$GLOBALS['tmpl']->assign("page",$page);
		
		  if($user_data['id'])
		{
			$GLOBALS['tmpl']->display('i_loan_index.html');
		}else{
			$GLOBALS['tmpl']->display('i_loan_rule.html');
		} 	 
//  		$GLOBALS['tmpl']->display('i_loan_rule.html');
		
	}
	
	function loansuccess(){
		$user_data = es_session::get('user_info');
		//pp(es_session::get('user_info'));die;
		//pp($list);die;
		$GLOBALS['tmpl']->assign('user',es_session::get('user_info'));
		$GLOBALS['tmpl']->display('i_loan_index.html');
	}
	
	
	public function doloan()
	{
		if(!es_session::get("user_info"))
			alert('请您先登录或者先注册',0,url("index","login#index"));
		set_gopreview();
		$GLOBALS['tmpl']->display('apply.html');
	}
	
	public function loaning(){
		
		$loan = D('public')->table('loan');
		$data = $loan->create();
		//pp($data);die;
		if(!check_empty($data['name']))
		{
			alert("请输入借款人姓名",0,get_gopreview());
		}
		if(!check_empty($data['mortgage']))
		{
			alert("请选择有无抵押",0,get_gopreview());
		}
		if(!check_empty($data['mobile']))
		{
			alert("请输入联系方式",0,get_gopreview());
		}
		if(!check_mobile($data['mobile']))
		{
			alert("请输入正确的手机格式",0,get_gopreview());
		}
		if(!check_empty($data['loanmoney']))
		{
			alert("请输入借款金额",0,get_gopreview());
		}
		$r = $loan->add($data);
		if($r)
		{
			$res = array(
					'status'=>1,
					'info'=>'申请成功',
					'jump'=>wap_url("index", 'loan')
			);
			ajax_return($res);
			
		}else{
			$res = array(
					'status'=>0,
					'info'=>'申请失败',
					'jump'=>wap_url("index", 'loan')
			);
			ajax_return($res);
			
		}	
			/* alert('申请成功！',0,url('index','loan'));
		alert('申请失败'); */
	}
	
}
?>