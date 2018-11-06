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
class gobuyAction  extends publicAction
{
	public function index()
	{
		$page['title']="理财详情";
	
		
		$id = intval($_REQUEST['id']);
		$licai = get_licai($id);
		
		$licai["fund_brand_name"] = $GLOBALS["db"]->getOne("select name from ".DB_PREFIX."licai_fund_brand where id =".$licai["fund_brand_id"]);
		
		if(!$licai || $licai['status'] == 0)
			showErr("理财产品不存在");
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
		
		//七天收益
		$the_one=TIME_UTC;
		$bar=array();//垚鑫宝近七日收益数据
		$dateArr = array();
		for($i=1;$i<8;$i++){
			$bar[to_date($the_one-86400*$i,'m-d')]=0;
			$cumulative[to_date($the_one-86400*$i,'m-d')]=0;
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
		$GLOBALS['tmpl']->assign("bar",$bar);//收益图表数据
		$w['licai_id']=$_REQUEST['id'];
		$w['history_date']=to_date ( TIME_UTC, 'Y-m-d' );
		$history =  D('public')->table('licai_history')->where($w)->order('id desc')->find();
		
		$GLOBALS['tmpl']->assign("history",$history['rate']);
		$GLOBALS['tmpl']->assign("huo_money",get_huo_money($user['id']));
		$user =es_session::get('user_info');
		$user = get_user_info('*',"id=".$user['id']);
		$GLOBALS['tmpl']->assign("user",$user);
		$GLOBALS['tmpl']->assign("licai_interest_json",$licai_interest_json);
		$GLOBALS['tmpl']->assign("min_interest_rate",$min_interest_rate);
		$GLOBALS['tmpl']->assign("max_interest_rate",$max_interest_rate);
		
		$GLOBALS['tmpl']->display('gobuy.html');
	}
	
	
	
	
}
?>