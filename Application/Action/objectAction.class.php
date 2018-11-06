<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
require_once APP_ROOT_PATH.'sys/libs/licai.php';
class objectAction  extends publicAction
{
	public function index()
	{
		
		$the_one=TIME_UTC;
		$bar=array();//垚鑫宝近七日收益数据
		$cumulative=array();//垚鑫宝近七日累计收益
		for($i=1;$i<8;$i++){
			$bar[to_date($the_one-86400*$i,'m-d')]=0;
			$cumulative[to_date($the_one-86400*$i,'m-d')]=0;
		}
		$data=$GLOBALS['db']->getRow("select * from ".DB_PREFIX."licai where type=0");
		//pp($data);die;
		$list=$GLOBALS['db']->getAll("select id,date_format(history_date,'%m-%d') as history_date,rate from ".DB_PREFIX."licai_history where licai_id=".$data['id']." order by id desc limit 8");
		
		$user = es_session::get('user_info');
		foreach ($bar as $k=>$v){
			foreach ($list as $kk=>$vv){
				if($k==$vv['history_date']){
					$bar[$k]=$vv['rate'];
				}
			}
		}
	
		foreach ($bar as $k=>$v){
			if(!$v)
				$bar[$k]=$data['scope'];
		}
		$ddt=$GLOBALS['db']->getAll("select *,date_format(date,'%m-%d') as date from ".DB_PREFIX."licai_profit where licai_id=".$data['id']." and user_id = ".$user['id'] );
		
		foreach ($cumulative as $k=>$v){
			foreach ($ddt as $kk=>$vv){
				if($k==$vv['date']){
					$cumulative[$k]=$vv['profit'];
				}
			}
		}
		
		
		//echo D('member','Admin')->table('user')->count();die;
		//echo $GLOBALS['db']->lastsql();die;
		$w['licai_id']=$data['id'];
		$w['history_date']=to_date ( TIME_UTC, 'Y-m-d' );
		$history =  D('public')->table('licai_history')->where($w)->order('id desc')->find();
		$GLOBALS['tmpl']->assign("history",$history['rate']?$history['rate']:$data['scope']);
		$GLOBALS['tmpl']->assign('lis',$list[0]['rate']);
		$GLOBALS['tmpl']->assign('h_profit' , qian_format(get_profit($user_info['id'],0)));
		$user = es_session::get('user_info');
		$user = get_user_info('*',"id=".$user['id']);
//  		$user['money'] = 121212121;
		$GLOBALS['tmpl']->assign('the_two',$cumulative);
		$GLOBALS['tmpl']->assign('the_one',$bar);
		$page['title']="垚鑫宝";
		$huo = get_huo_money($user['id']);
//    		pp($data);die;
//			pp($user_statics);die;
	
		$nmc_amount = $huo['is_effect']?$huo['nmc_amount']:'0.00';
		$GLOBALS['tmpl']->assign('nmc_amount',$nmc_amount);
		$GLOBALS['tmpl']->assign('licai',$data);
		$GLOBALS['tmpl']->assign('huo_money',qian_format(get_h_sum_money($user['id'])));

 		$user['money'] = is_int($user['money'])?$user['money']:sprintf("%.3f",$user['money']);

      	$GLOBALS['tmpl']->assign('user',$user);
		$GLOBALS['tmpl']->assign("page",$page);
//  		$GLOBALS['tmpl']->assign('user',es_session::get('user_info'));

		if(!$user['id']){
			
			$GLOBALS['tmpl']->display('object_index.html');
		}else{
// 			pp($user);die;
			$GLOBALS['tmpl']->display('object_success.html');
		}
		
	}
	
	public function regular()
	{
		
		$page['title']="理财详情";
	
		
		$id = intval($_REQUEST['id']);
		$licai = get_licai($id);
		
		$licai["fund_brand_name"] = $GLOBALS["db"]->getOne("select name from ".DB_PREFIX."licai_fund_brand where id =".$licai["fund_brand_id"]);
		
		/* if(!$licai || $licai['status'] == 0)
			showErr("理财产品不存在"); */
//  		pp($licai);die;
		$GLOBALS['tmpl']->assign("licai",$licai);
		$min_interest_rate=0;
		$min_interest_rate=0;
		if($licai['type'] > 0){
			$licai_interest_json = json_encode($licai['licai_interest']);
			$min_interest_rate = $licai['licai_interest'][0]['interest_rate'];
			$max_interest_rate = $licai['licai_interest'][count($licai['licai_interest'])-1]['interest_rate'];
		}
		else{
			$licai_interest_json =json_encode($licai['licai_interest']);// $licai['average_income_rate'];
		}
		
		//为客户创造收益
		//$user_income = doubleval($GLOBALS['db']->getOne("select sum(money) from ".DB_PREFIX."user_log WHERE `type`=9 "));
// 		$user_income = doubleval($GLOBALS['db']->getOne("select sum(earn_money) from ".DB_PREFIX."licai_redempte"));
// 		$GLOBALS['tmpl']->assign("user_income",$user_income);
	
		$condition = " where lc.id = ".$id;
		//图表
		//七天
		//$condition .= " and lh.history_date >= '".to_date(TIME_UTC-7*3600*24,"Y-m-d")."' and lh.history_date <= '".to_date(TIME_UTC,"Y-m-d")."'";
// 		if($licai["type"] == 0)
// 		{
// 			$data_table_count = $GLOBALS["db"]->getOne("select count(*) from ".DB_PREFIX."licai_history lh left join ".DB_PREFIX."licai lc on lc.id=lh.licai_id ".$condition);
			
// 			if($data_table_count >= 7)
// 			{
// 				$limit = " limit ".($data_table_count-7).",7 ";
// 			}
// 			else
// 			{
// 				$limit = "";
// 			}
			
// 			$data_table = $GLOBALS['db']->getAll("select lh.history_date,lh.rate from ".DB_PREFIX."licai_history lh left join ".DB_PREFIX."licai lc on lc.id = lh.licai_id ".$condition." order by lh.history_date asc ".$limit);
			
// 			if($data_table_count == 1)
// 			{
// 				array_unshift($data_table,array("history_date"=>$data_table[0]["history_date"],"rate"=>$data_table[0]["rate"]));
// 			}

// 			$GLOBALS['tmpl']->assign("data_table",$data_table);
// 		}
$user =es_session::get('user_info');
		//七天收益
		$the_one=TIME_UTC-(86400*8);
		$bar=array();//垚鑫宝近七日收益数据
		$dateArr = array();
		for($i=1;$i<8;$i++){
			$bar[to_date($the_one+86400*$i,'m-d')]=0;
			$cumulative[to_date($the_one+86400*$i,'m-d')]=0;
		}
		
		$list=$GLOBALS['db']->getAll("select id,date_format(history_date,'%m-%d') as history_date,rate from ".DB_PREFIX."licai_history where licai_id=".$id." order by id desc limit 8");
		
		foreach ($bar as $k=>$v){
			foreach ($list as $kk=>$vv){
				if($k==$vv['history_date']){
					$bar[$k]=$vv['rate'];
				}
			}
		}
		foreach ($bar as $k=>$v){
			if(!$v)
				$bar[$k]=$licai['scope'];
		}
		
		$licai = D('public')->table('licai')->select();
		foreach ($licai as $v){
			if($v['type'] ==0){
				$where['licai_id'] = $v['id'];
				$v['history'] =  D('public')->table('licai_history')->where($where)->order('id desc')->find();
				$licai_huo = $v;
			}elseif($v['type'] ==1){
				$where['licai_id'] = $v['id'];
				$where['history_date']=to_date ( TIME_UTC, 'Y-m-d' );
				$v['history'] =  D('public')->table('licai_history')->where($where)->order('id desc')->find();
				$licai_ding[] = $v;
			}
		}
		
		$ddt=$GLOBALS['db']->getAll("select *,date_format(date,'%m-%d') as date from ".DB_PREFIX."licai_profit where licai_id=".$id." and user_id = ".$user['id'] );
		//pp($ddt);
		foreach ($cumulative as $k=>$v){
			foreach ($ddt as $kk=>$vv){
				if($k==$vv['date']){
					$cumulative[$k]=$vv['profit'];
				}
			}
		}
		//pp($cumulative);pp($bar);die;
		$GLOBALS['tmpl']->assign("cumulative",$cumulative);
		$GLOBALS['tmpl']->assign("bar",$bar);//收益图表数据
		$w['licai_id']=$_REQUEST['id'];
		$w['history_date']=to_date ( TIME_UTC, 'Y-m-d' );
		$history =  D('public')->table('licai_history')->where($w)->order('id desc')->find();
		
		$GLOBALS['tmpl']->assign("history",$history['rate']);
		$GLOBALS['tmpl']->assign("huo_money",get_huo_money($user['id']));
		
		$user = get_user_info('*',"id=".$user['id']);
		
		$user['money'] = is_int($user['money'])?$user['money']:sprintf("%.3f",$user['money']);
		$GLOBALS['tmpl']->assign("user",$user);
		$GLOBALS['tmpl']->assign("licai_ding",$licai_ding);
		$GLOBALS['tmpl']->assign("licai_interest_json",$licai_interest_json);
		$GLOBALS['tmpl']->assign("min_interest_rate",$min_interest_rate);
		$GLOBALS['tmpl']->assign("max_interest_rate",$max_interest_rate);
//     		pp($user);die;
		//pp(get_huo_money($user['id']));die;
		if($id)
		{
			$GLOBALS['tmpl']->display('regular_success.html');
		
		}else{
			$GLOBALS['tmpl']->display('regular_index.html');
		}
		
	
	}
	
	public function buy_confirm()
	{
		//理财ID
		$licai_id = $_REQUEST['id'];
		//项目名称
		$name = $_REQUEST['name'];
		//投资金额
		$money = $_REQUEST['money'];
		//理财类型
		$type = $_REQUEST['type'];
		
		$licaiy['id'] = $_REQUEST['id'];
		$licaiy['name'] = $_REQUEST['name'];
		$licaiy['money'] = $_REQUEST['money'];
		$licaiy['type'] = $_REQUEST['type'];
		
		$user = es_session::get('user_info');
		
// 		$w['id']=$licai_id;
// 		$licai =  D('public')->table('user_carry')->where($w)->find();
// 		pp($licai);die;
		$m = get_huo_money($user['id']);
		
		$nmc_amount = $m['nmc_amount'];
		$effect = $m['is_effect'];
		//pp($type);die;
		$GLOBALS['tmpl']->assign('user',es_session::get('user_info'));
		//pp($user);die;
		$GLOBALS['tmpl']->assign("nmc_amount",$nmc_amount);
		$GLOBALS['tmpl']->assign("effect",$effect);
		$GLOBALS['tmpl']->assign("money",$money);
		$GLOBALS['tmpl']->assign("licai_id",$licai_id);
		$GLOBALS['tmpl']->assign("type",$type);
		$GLOBALS['tmpl']->assign("data",$licaiy);
		$GLOBALS['tmpl']->display('confirm.html');
		
	}
	
	public function recharge()
	{
		$data = array(
				'status'=>1,
				'info'=>'成功',
				'jump'=>''
		);
		ajax_return($data);
	}
	
	
	
}
?>