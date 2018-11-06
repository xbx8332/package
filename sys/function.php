<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
function qc($str){
	return substr($str,0,strlen($str)-1);
}
function is_role($role){
	$a =es_session::get(md5(app_conf("AUTH_KEY"))); 
	if(strpos($a['role'],$role)!==false){
		return true;
	}
	return false;	
}
 function get_h_rape(){
 	$licai  = $GLOBALS['db']->getRow("select id,scope from ".DB_PREFIX."licai where type=0 ");
 	$rate = $GLOBALS['db']->getOne("select rate from ".DB_PREFIX."licai_history licai_id = ".$licai['id']." and type=0 and h.history_date ='".date(time(),'Y-m-d')."'");
 	return $rate?$rate:$licai['scope'];
 		 
 }

 function qian_format($money){
 	return round($money,2);
 }
 
 function get_deal_profit($id,$oid){
 	return $GLOBALS['db']->getOne('select sum(profit) from '.DB_PREFIX."licai_profit where user_id =".$id." and order_id=".$oid);
 	
 }
 function get_h_id(){
 	return $GLOBALS['db']->getOne('select id from '.DB_PREFIX."licai where type=0"); 
 }

 function get_d_sum_money($id){
 	return  get_pay_money($id,1);
 }
function get_h_sum_money($id){
	return  get_pay_money($id,0);
}

function get_hno_sum_money($id){
	$sql='select huo_money+huo_no_money as money from '.DB_PREFIX."licai_yeb where user_id =".$id;
	
	$s= $GLOBALS['db']->getOne($sql);
	return $s;
}
function get_sum_money($id,$user_statics){
	$money = $GLOBALS['db']->getOne("select AES_DECRYPT(money_encrypt,'".AES_DECRYPT_KEY."') as money from ".DB_PREFIX."user where is_delete = 0 and id =".$id);	
	//
// 	pp($money);
// 	$money +=$user_statics['h_profit'];
	
	
// 	$money +=$user_statics['d_profit'];
	
	
	$money +=get_pay_money($id,1);
	//
// 	pp('v'.$money);
	$huo=get_hno_sum_money($id);
// 	pp($huo);
	$money+=$huo;
	//
	
// 	pp('a'.$money);die;
	return $money;
}
function get_profit($id ,$type){
	if($type==0)
		$sql='select sum(profit) from '.DB_PREFIX."licai_profit where user_id =".$id." and order_id=".$type;
	else 
		$sql='select sum(earn_money) from '.DB_PREFIX."licai_redempte where user_id =".$id." and order_id>=".$type;

	
	return $GLOBALS['db']->getOne($sql);
}
function update_h_money($user_id,$money){  
	$GLOBALS['db']->query ( 'update ' . DB_PREFIX . "licai_yeb set huo_no_money =huo_no_money+" . $money . " where user_id=" . $user_id );
// 	echo  'update ' . DB_PREFIX . "user set huo_money =huo_money+" . $money . " where id=" . $user_id ;die;
}
function update_money($money,$key='money'){
	$user = es_session::get ('user_info');
	$user[$key] = $user[$key] + $money;
	es_session::set ('user_info', $user);
}

function get_d_list($id){
	$sql='select * from '.DB_PREFIX."licai_order where user_id =".$id." and type=1";
	return $GLOBALS['db']->getAll($sql);
}

function get_huo_money($id){
	$sql='select huo_money+huo_no_money+nmc_amount as money,huo_money,huo_no_money,nmc_amount,is_effect from '.DB_PREFIX."licai_yeb where user_id =".$id;
	//pp($sql);
	return $GLOBALS['db']->getRow($sql);
}
function get_pay_money($id,$tpye='-1'){
	
	if($tpye)
		$sql='select sum(money) from '.DB_PREFIX."licai_order where user_id =".$id." and status=1 and type=".$tpye;
	
	else
		$sql='select case when is_effect = 1 then huo_money+huo_no_money+nmc_amount else huo_money+huo_no_money end as money from '.DB_PREFIX."licai_yeb where user_id =".$id;
		
	return $GLOBALS['db']->getOne($sql);
	
}

//更新用户统计
function sys_user_status($user_id,$is_cache = false,$make_cache=false){
	if($user_id == 0)
		return ;
	$data = false;
	if($make_cache == false){
		if($is_cache == true){
			$key = md5("USER_STATICS_".$user_id);
			$data = load_dynamic_cache($key);
		}
	}
	if($data==false){
		//留言数
		$data['dp_count'] = $GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."message use index(idx_0)  WHERE user_id=$user_id AND is_effect = 1");
		//总借款额
		$data['borrow_amount'] = $GLOBALS['db']->getOne("SELECT sum(borrow_amount) FROM ".DB_PREFIX."deal  use index(idx_0) WHERE deal_status in(4,5) AND user_id=$user_id AND publish_wait = 0 and is_delete = 0 and is_effect=1 ");

		$has_repay_rs = $GLOBALS['db']->getRow("SELECT sum(true_repay_money) as total_repay_money,sum(true_manage_money) as total_manage_money FROM ".DB_PREFIX."deal_repay WHERE user_id=$user_id");
		//已还本息
		$data['repay_amount'] = $has_repay_rs['total_repay_money'];

		//已还管理费
		$data['repay_manage_amount'] = $has_repay_rs['total_manage_money'];

		//投资返利
		$data['rebate_money'] = $GLOBALS['db']->getOne("SELECT sum(rebate_money) FROM ".DB_PREFIX."deal_load WHERE is_has_loans=1 AND user_id=$user_id");

		//发布借款笔数
		$data['deal_count'] = $GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."deal use index(idx_1) WHERE user_id=$user_id AND publish_wait = 0 and is_delete = 0 and is_effect=1 ");
		//成功借款笔数
		$data['success_deal_count'] = $GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."deal use index(idx_0) WHERE deal_status in (4,5) AND user_id=$user_id AND publish_wait = 0 and is_delete = 0 and is_effect=1 ");
		//还清笔数
		$data['repay_deal_count'] = $GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."deal use index(idx_0) WHERE deal_status = 5 AND user_id=$user_id AND publish_wait = 0 and is_delete = 0 and is_effect=1 ");
		//未还清笔数
		$data['wh_repay_deal_count'] = $data['success_deal_count'] - $data['repay_deal_count'];
		//提前还清笔数
		$data['tq_repay_deal_count'] = $GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."deal_inrepay_repay WHERE user_id=$user_id");
		//正常还清笔数
		$data['zc_repay_deal_count'] = $GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."deal WHERE deal_status = 5 AND user_id=$user_id AND publish_wait = 0 and is_delete = 0 and is_effect=1  AND id not in (SELECT deal_id FROM ".DB_PREFIX."deal_inrepay_repay WHERE user_id=$user_id)");
		//加权平均借款利率
		//$data['avg_rate'] = $GLOBALS['db']->getOne("SELECT sum(rate)/count(*) FROM ".DB_PREFIX."deal use index(idx_0) WHERE deal_status in (4,5) AND user_id=$user_id AND publish_wait = 0 and is_delete = 0 and is_effect=1  ");
		$avg_rate = $GLOBALS['db']->getRow("SELECT sum(rate) as sum_rate ,count(*) as sum_count FROM ".DB_PREFIX."deal use index(idx_0) WHERE deal_status in(4,5) AND user_id=$user_id AND publish_wait = 0 and is_delete = 0 and is_effect=1  ");

		//加权平均借款利率【加债权】
		$repay_avg_rate = $GLOBALS['db']->getRow("SELECT sum(d.rate) as sum_rate ,count(*) as sum_count FROM ".DB_PREFIX."deal_load_repay dlr LEFT JOIN ".DB_PREFIX."deal d ON d.id=dlr.deal_id WHERE (dlr.user_id = ".$user_id." and dlr.t_user_id = 0) or dlr.t_user_id = ".$user_id);

		$data["avg_rate"] =(floatval($avg_rate["sum_rate"])+floatval($repay_avg_rate["sum_rate"]))/(floatval($avg_rate["sum_count"])+floatval($repay_avg_rate["sum_count"]));

		//平均每笔借款金额
		$data['avg_borrow_amount'] = $data['borrow_amount'] / $data['success_deal_count'];

		//逾期本息
		$data['yuqi_amount'] = $GLOBALS['db']->getOne("SELECT (sum(repay_money) + sum(impose_money)) as new_amount FROM ".DB_PREFIX."deal_repay WHERE user_id=$user_id AND ((has_repay=1 and status in(2,3)) or (has_repay=0 AND (".TIME_UTC."- repay_time -24*3600 + 1 ) > 0) )");
		//逾期费用
		$data['yuqi_impose'] = $GLOBALS['db']->getOne("SELECT sum(repay_money) FROM ".DB_PREFIX."deal_repay WHERE has_repay=1 AND user_id=$user_id AND ((has_repay=1 and status in(2,3)) or (has_repay=0 AND (".TIME_UTC."- repay_time -24*3600 + 1 ) > 0))");

		//逾期次数
		$data['yuqi_count'] = $GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."deal_repay WHERE user_id=".$user_id."  AND ((has_repay=1 AND status = 2) or (has_repay=0  AND (".TIME_UTC."- repay_time -24*3600 + 1 )/24/3600 between 1 and ".(intval(app_conf('YZ_IMPSE_DAY')) - 1)." ))");
		//严重逾期次数
		$data['yz_yuqi_count'] = $GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."deal_repay WHERE user_id=$user_id AND ((has_repay=1 AND status = 3) or (has_repay=0  AND (".TIME_UTC."- repay_time -24*3600 + 1 )/24/3600 >= ".intval(app_conf('YZ_IMPSE_DAY')) ." ))");

		$load_info = $GLOBALS['db']->getRow("SELECT sum(true_interest_money - true_manage_money - true_manage_interest_money) as load_earnings,sum(true_repay_money - true_manage_money - true_manage_interest_money) AS load_repay_money,sum(true_reward_money) as load_reward_money FROM ".DB_PREFIX."deal_load_repay  WHERE  ((user_id = ".$user_id." and t_user_id = 0) or t_user_id = ".$user_id.") AND has_repay=1 ");
		//已赚利息
		$data['load_earnings'] = $load_info['load_earnings'];
		//已回收本息
		$data['load_repay_money'] = $load_info['load_repay_money'];
		//奖励收益
		$data['reward_money'] = $load_info['load_reward_money'];

		//坏账
		$data['bad_count'] = $GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."deal_repay  WHERE user_id=".$user_id."  AND is_site_bad = 1 ");


		$need_load_info = $GLOBALS['db']->getRow("SELECT sum(repay_money) AS load_repay_money,sum(manage_money - true_manage_money) as total_manage_money FROM ".DB_PREFIX."deal_repay  WHERE has_repay=0 AND user_id=$user_id ");
		//待还本息【债权】
		//$t_need_load_info = $GLOBALS['db']->getRow("SELECT sum(repay_money) AS load_repay_money,sum(repay_manage_money) as total_manage_money FROM ".DB_PREFIX."deal_load_repay WHERE has_repay=0 AND t_user_id=$user_id");
		//print_r($t_need_load_info);die;
		//待还本息
		//$data['need_repay_amount'] = $need_load_info['load_repay_money'] + $t_need_load_info['load_repay_money'];
		$data['need_repay_amount'] = $need_load_info['load_repay_money'];
		//待还管理费
		//$data['need_manage_amount'] = $need_load_info['total_manage_money'] + $t_need_load_info['total_manage_money'];
		$data['need_manage_amount'] = $need_load_info['total_manage_money'];



		//邀请返利
		$data['referrals_money'] = $GLOBALS['db']->getOne("SELECT sum(money) FROM ".DB_PREFIX."referrals WHERE rel_user_id=".$user_id."  AND pay_time >0  ");

		//提现手续费
		$data['carry_fee_money'] = $GLOBALS['db']->getOne("SELECT sum(fee) FROM ".DB_PREFIX."user_carry WHERE user_id=".$user_id."  AND status =1  ");

		//充值手续费
		$data['incharge_fee_money'] = $GLOBALS['db']->getOne("SELECT sum(fee_amount) FROM ".DB_PREFIX."payment_notice WHERE user_id=".$user_id."  AND is_paid =1  ");

		//充值总额
		$data['incharge_money'] = $GLOBALS['db']->getOne("SELECT sum(money) FROM ".DB_PREFIX."payment_notice WHERE user_id=".$user_id." AND `is_paid`=1");
		//提现总额
		$data['carry_money'] = $GLOBALS['db']->getOne("SELECT sum(money) FROM ".DB_PREFIX."user_carry WHERE user_id=".$user_id." AND `status`=1");

		//投资统计管理费
		$data['load_manage_money'] = $GLOBALS['db']->getOne("SELECT sum(true_manage_money) FROM ".DB_PREFIX."deal_load_repay WHERE user_id=".$user_id." AND `has_repay`=1");

		//已赚提前还款违约金
		$data['load_tq_impose'] = $GLOBALS['db']->getOne("SELECT sum(impose_money) FROM ".DB_PREFIX."deal_load_repay WHERE has_repay=1 AND status = 0 AND ((user_id = ".$user_id." and t_user_id = 0) or t_user_id = ".$user_id.")");
		//已赚逾期罚息
		$data['load_yq_impose'] = $GLOBALS['db']->getOne("SELECT sum(impose_money) FROM ".DB_PREFIX."deal_load_repay WHERE has_repay=1 AND status in (2,3) AND ((user_id = ".$user_id." and t_user_id = 0) or t_user_id = ".$user_id.")");

		//借出加权平均收益率
		//$data['load_avg_rate'] = $GLOBALS['db']->getOne("SELECT sum(rate)/count(*) FROM ".DB_PREFIX."deal_load dl LEFT JOIN ".DB_PREFIX."deal d ON d.id=dl.deal_id WHERE d.deal_status in(4,5) AND dl.user_id=$user_id");


		$load_avg_rate = $GLOBALS['db']->getRow("SELECT sum(rate) as sum_rate ,count(*) as sum_count FROM ".DB_PREFIX."deal_load dl LEFT JOIN ".DB_PREFIX."deal d ON d.id=dl.deal_id WHERE d.deal_status in(4,5) AND dl.user_id=$user_id ");
		//借出加权平均收益率【加入债权】
		$load_repay_avg_rate = $GLOBALS['db']->getRow("SELECT sum(d.rate) as sum_rate ,count(*) as sum_count FROM ".DB_PREFIX."deal_load_repay dlr LEFT JOIN ".DB_PREFIX."deal d ON d.id=dlr.deal_id WHERE (dlr.user_id = ".$user_id." and dlr.t_user_id = 0) or dlr.t_user_id = ".$user_id);
		//print_r($load_repay_avg_rate);die;
		if((floatval($load_avg_rate["sum_count"])+floatval($load_repay_avg_rate["sum_count"])) != 0)
			$data["load_avg_rate"] =(floatval($load_avg_rate["sum_rate"])+floatval($load_repay_avg_rate["sum_rate"]))/(floatval($load_avg_rate["sum_count"])+floatval($load_repay_avg_rate["sum_count"]));
		else
			$data["load_avg_rate"] = 0;
		/**/
		//托管待收总额
		$ips_money = $GLOBALS['db']->getRow("SELECT sum(dlr.repay_money) as ips_need_money FROM ".DB_PREFIX."deal_load_repay dlr left join ".DB_PREFIX."deal d on dlr.deal_id = d.id WHERE dlr.user_id=".$user_id." and dlr.has_repay= 0 and d.ips_bill_no <> '' ");

		$data["ips_need_money"] = round($ips_money["ips_need_money"],2);

		//托管待还总额
		$data["ips_repay_money"] = $GLOBALS['db']->getOne("SELECT sum(dl.repay_money) FROM ".DB_PREFIX."deal_repay dl left join ".DB_PREFIX."deal d on dl.deal_id = d.id WHERE dl.user_id=".$user_id." and dl.has_repay= 0 and d.ips_bill_no <> '' ");;

		//托管回款资金
		$data["ips_load_money"] = $GLOBALS['db']->getOne("SELECT sum(dlr.repay_money) as ips_need_money FROM ".DB_PREFIX."deal_load_repay dlr left join ".DB_PREFIX."deal d on dlr.deal_id = d.id WHERE dlr.user_id=".$user_id." and dlr.has_repay= 1 and d.ips_bill_no <> '' ");
		//托管充值资金
		$data['ips_incharge_money'] = round(get_ips_incharge($user_id),2);

		//托管的返利
		$data['ips_referrals_money'] = $GLOBALS['db']->getOne("SELECT sum(r.money) FROM ".DB_PREFIX."referrals r left join ".DB_PREFIX."deal d on r.deal_id = d.id  WHERE r.rel_user_id=".$user_id."  AND r.pay_time >0  and  d.ips_bill_no <> '' ");
		//$data["ips_incharge_money"] = $GLOBALS['db']->getOne("SELECT sum(money) FROM ".DB_PREFIX."payment_notice WHERE user_id=".$user_id." AND `is_paid`=1 and ");

		//总借出笔数
		$u_load = $GLOBALS['db']->getRow("SELECT count(*) as load_count,sum(money) as load_money FROM ".DB_PREFIX."deal_load WHERE user_id=$user_id and is_repay= 0 ");

		$data['load_count'] = $u_load['load_count'];
		//总借出金额
		$data['load_money'] = $u_load['load_money'];

		//总债权笔数【含债权转入】
		$t_u_load = $GLOBALS['db']->getRow("SELECT count(*) as load_count,sum(dlr.repay_money) as load_money  FROM ".DB_PREFIX."deal_load_repay dlr LEFT JOIN ".DB_PREFIX."deal d ON d.id=dlr.deal_id LEFT JOIN ".DB_PREFIX."deal_load dl ON dl.id=dlr.load_id WHERE d.is_delete=0 AND d.is_effect=1 and dl.is_repay= 0 and  dlr.t_user_id = ".$user_id);

		$data['load_count'] = $data['load_count'] + $t_u_load['load_count'];

		//总借出金额【含债权转入】
		$data['load_money'] = floatval($data['load_money']) + floatval($t_u_load['load_money']);
		//已回收笔数
		$data['reback_load_count'] = $GLOBALS['db']->getOne("SELECT count(*)  FROM ".DB_PREFIX."deal_load dl LEFT JOIN ".DB_PREFIX."deal d ON d.id=dl.deal_id WHERE d.deal_status =5 AND dl.user_id=$user_id and d.is_delete = 0 and d.is_effect=1");

		//已回收笔数【含债权转入】
		$data['t_reback_load_count'] = $GLOBALS['db']->getOne("SELECT count(*)  FROM ".DB_PREFIX."deal_load_repay dlr LEFT JOIN ".DB_PREFIX."deal d ON d.id=dlr.deal_id WHERE d.deal_status =5 AND d.is_delete = 0 and d.is_effect=1 and  dlr.t_user_id = ".$user_id." ");

		//总已回收笔数
		$data['reback_load_count'] = $data['reback_load_count'] + $data['t_reback_load_count'];

		//待回收笔数【含债权转入】
		$data['wait_reback_load_count'] = $GLOBALS['db']->getOne("SELECT count(*)  FROM ".DB_PREFIX."deal_load dl LEFT JOIN ".DB_PREFIX."deal d ON d.id=dl.deal_id WHERE d.deal_status =4 AND dl.user_id=$user_id and d.is_delete = 0 and d.is_effect=1");

		$load_wait = $GLOBALS['db']->getRow("SELECT sum(self_money) as total_self_money,sum(repay_money - manage_money - manage_interest_money) as total_repay_money,sum(interest_money) as load_wait_earnings FROM ".DB_PREFIX."deal_load_repay where ((user_id = ".$user_id." and t_user_id = 0) or t_user_id = ".$user_id.") and has_repay = 0  ");

		//待回收本金
		$data['load_wait_self_money'] = $load_wait['total_self_money'];
		//待回收本息
		$data['load_wait_repay_money'] = $load_wait['total_repay_money'];
		//待回收利息
		$data['load_wait_earnings'] = $load_wait['load_wait_earnings'];





		if($GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."user_sta WHERE user_id=".$user_id) > 0)
			$GLOBALS['db']->autoExecute(DB_PREFIX."user_sta",$data,"UPDATE","user_id=".$user_id);
		else{
			$data['user_id'] = $user_id;
			$GLOBALS['db']->autoExecute(DB_PREFIX."user_sta",$data,"INSERT");
		}

		if($data['deal_count'] > 0 || $data['load_count']){
			if($data['deal_count'] > 0)
				$u_data['is_borrow_in'] = 1;
			if($data['load_count'] > 0)
				$u_data['is_borrow_out'] = 1;
			$GLOBALS['db']->autoExecute(DB_PREFIX."user",$u_data,"UPDATE","id=".$user_id);
		}
		if(isset($key) && ($is_cache == true || $make_cache == true) ){
			set_dynamic_cache($key,$data);
		}
	}
	return $data;
}
//日期加减
function dec_date($date,$dec){
	//$sysc_start_time = to_timespan(to_date(to_timespan($date),'Y-m-d')) - $dec * 86400;

	return to_date(to_timespan($date)  - $dec * 86400,'Y-m-d');
}

function get_user_info($extField,$extWhere="",$Type="ROW")
{
	if($extField=="*"){
		$extField = "*,AES_DECRYPT(real_name_encrypt,'".AES_DECRYPT_KEY."') as real_name,AES_DECRYPT(email_encrypt,'".AES_DECRYPT_KEY."') as email,AES_DECRYPT(idno_encrypt,'".AES_DECRYPT_KEY."') as idno,AES_DECRYPT(money_encrypt,'".AES_DECRYPT_KEY."') as money,AES_DECRYPT(mobile_encrypt,'".AES_DECRYPT_KEY."') as mobile";
	}

	if(strpos(strtolower($extWhere),"where")===false){
		$extWhere = " WHERE ".$extWhere;
	}
	$result = array();
	switch(strtoupper($Type)){
		case "ROW":
			$result = $GLOBALS['db']->getRow("select $extField from ".DB_PREFIX."user $extWhere ");
			break;
		case "ALL":
			$result = $GLOBALS['db']->getAll("select $extField from ".DB_PREFIX."user $extWhere ");
			break;
		case "ONE":
			$result = $GLOBALS['db']->getOne("select $extField from ".DB_PREFIX."user $extWhere ");
			break;
	}


	return $result;
}
function check_empty($data)
{
	if(trim($data)=='')
	{
		return false;
	}
	return true;
}


function decodeUnicode($str)
{
	return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
			create_function(
					'$matches',
					'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
			),
			$str);
}

function alert($msg ='',$ajax='',$jump='',$login=false){
		echo header("Access-Control-Allow-Origin:*");
		$data['msg']=$msg;
		if($ajax){
			echo json_encode($data);
		}else{
			if($jump){
				echo "<script> alert('{$msg}');location.href='".$jump."' </script>";
				if($login){
					echo "<script>  alert('{$msg}');parent.location.href='".$jump."' </script>";
				}else{
				echo "<script> alert('{$msg}');location.href='".$jump."' </script>";
				}
				
			
			}else 
			echo "<script>  alert('{$msg}');</script>";		
		}die;
	
}

function L($name){
	return $GLOBALS['lang'][$name];
}

function input_csv($handle)
{
	$out = array ();
	$n = 0;
	while ($data = fgetcsv($handle, 10000))
	{
		$num = count($data);
		for ($i = 0; $i < $num; $i++)
		{
			$out[$n][$i] = $data[$i];
		}
		$n++;
	}
	return $out;
}

define('DIR',get_real_path()."public/Data/");
/**
 * 存储信息到文件
 */
function FF($name,$str ='',$dir=DIR){
	if(!file_exists($dir)){
		if(mkdir($dir)){
		}else{
			die('没有权限');
		}
	}
	$name =  $name.".php";
	if($str){
		$str=serialize($str);
		file_put_contents($dir.$name,$str."\r\n",FILE_APPEND);
	}ELSE{
		return unserialize(file_get_contents($dir.$name));
	}
}






/**硬件检测
 * 
 */
function GetCoreInformation() {
	$data = file('/proc/stat');
	
	$cores = array();
	foreach( $data as $line ){
		if( preg_match('/^cpu[0-9]/', $line) ){
			$info = explode(' ', $line);
			$cores[]=array('user'=>$info[1],'nice'=>$info[2],'sys' => $info[3],'idle'=>$info[4],'iowait'=>$info[5],'irq' => $info[6],'softirq' => $info[7]);
		}
	}
	return $cores;
}
function GetCpuPercentages($stat1, $stat2) {
	if(count($stat1)!==count($stat2)){
		return;
	}
	$cpus=array();
	for( $i = 0, $l = count($stat1); $i < $l; $i++) {
		$dif = array();	$dif['user'] = $stat2[$i]['user'] - $stat1[$i]['user'];
		$dif['nice'] = $stat2[$i]['nice'] - $stat1[$i]['nice'];	
		$dif['sys'] = $stat2[$i]['sys'] - $stat1[$i]['sys'];
		$dif['idle'] = $stat2[$i]['idle'] - $stat1[$i]['idle'];
		$dif['iowait'] = $stat2[$i]['iowait'] - $stat1[$i]['iowait'];
		$dif['irq'] = $stat2[$i]['irq'] - $stat1[$i]['irq'];
		$dif['softirq'] = $stat2[$i]['softirq'] - $stat1[$i]['softirq'];
		$total = array_sum($dif);
		$cpu = array();
		foreach($dif as $x=>$y) $cpu[$x] = round($y / $total * 100, 2);
		$cpus['cpu' . $i] = $cpu;
	}
	return $cpus;
}

function makeImageUrl($title, $data) {$api='http://api.yahei.net/tz/cpu_show.php?id=';$url.=$data['user'].',';$url.=$data['nice'].',';$url.=$data['sys'].',';$url.=$data['idle'].',';$url.=$data['iowait'];$url.='&chdl=User|Nice|Sys|Idle|Iowait&chdlp=b&chl=';$url.=$data['user'].'%25|';$url.=$data['nice'].'%25|';$url.=$data['sys'].'%25|';$url.=$data['idle'].'%25|';$url.=$data['iowait'].'%25';$url.='&chtt=Core+'.$title;return $api.base64_encode($url);}

function GetIpLookup($ip = ''){
	if(empty($ip)){
		$ip = GetIp();
	}
	$res = @curl_get_data('http://api.map.baidu.com/location/ip?ak=7SWr0IBsRhDxUQQNltFRSdi7iVwrRZ6R&coor=bd09ll&ip='. $ip,'get');
	if(empty($res)){ return false; }
	$json = json_decode($res, true);
	
	return $json['content'];
}



/**
 * cpu 内存 
 */
function get_cpu(){
	$fp = popen('top -b -n 2 | grep -E "^(Cpu|Mem|Tasks)"',"r");//获取某一时刻系统cpu和内存使用情况
	$rs = "";
	while(!feof($fp)){
		$rs .= fread($fp,1024);
	}
	pclose($fp);
	$sys_info = explode("\n",$rs);
	$tast_info = explode(",",$sys_info[3]);//进程 数组
	$cpu_info = explode(",",$sys_info[4]);  //CPU占有量  数组
	$mem_info = explode(",",$sys_info[5]); //内存占有量 数组
	//正在运行的进程数
	$tast_running = trim(trim($tast_info[1],'running'));
	
	
	//CPU占有量
	$cpu_usage = trim(trim($cpu_info[0],'Cpu(s): '),'%us');  //百分比
	
	//内存占有量
	$mem_total = trim(trim($mem_info[0],'Mem: '),'k total');
	$mem_used = trim($mem_info[1],'k used');
	$mem_usage = round(100*intval($mem_used)/intval($mem_total),2);  //百分比

}
/**
 * 统计人数
 */

function countNo($geo=''){
	session_start();
	$geo['time'] = time();
	$por = ($geo);
	$u = es_session::get('user_info');
	$por[session_id()] = $u['user_name'];
	$por = serialize($por);
	redis_db::$redis->setex(session_id(),3600,$por);
	redis_db::$redis->sAdd('No',session_id());
	$NO = redis_db::$redis->sMembers('No');
	$flag = false;
	 
	foreach ($NO as $v){
		$user = unserialize(redis_db::$redis->get($v));
		
		if($user['time']+300<time()){
			redis_db::$redis->sRem('No', $v);
			$flag = true;
			continue;
		}
		if($user['xpoint']==$user['ypoint']){
			continue;
		}
		$x['x']=$user['xpoint'];
		$x['y']=$user['ypoint'];
		$un = $user[$v];
		if($un)
			$xy[$un] = $x;
		else
			$xy[$v] = $x;
		//FF('countNO',$x);
		
	}

	$d['xy'] = $xy; 
	$d['count'] = redis_db::$redis->sCard('No');
	
	if($flag){
	$data['data']= encryption($d);
	
	curl_get_data(ZS_URL.'online','post_arr',$data);
	}
}
/**
 * 接口请求
 * 
 */

function mallinterface ($url,$get='get',$arr ,$tpye='',$time=3){
	$url=$url.'?';
	if($get =='get'){
		if($tpye=='zjht'){
			$str='';
			foreach ($arr as $k=> $v){
				$str=$str.$k.'='.$v.'&';
			}
			$url = $url.$str;
			
		}else{
			
			$parameter= encryption($arr,'YX');
			$url = $url."parameter=".$parameter;
		}
		
		return json_decode(curl_get_data($url,$get,$arr,$time),true);
	}else if ($get =='post'){
		$a= curl_get_data($url,$get,$arr,$time);
		return json_decode($a,true);
	}
}


/**
 * 对象数组转为普通数组
 *
 * AJAX提交到后台的JSON字串经decode解码后为一个对象数组，
 * 为此必须转为普通数组后才能进行后续处理，
 * 此函数支持多维数组处理。
 *
 * @param array
 * @return array
 */
function objarray_to_array($obj) {
	$ret = array();
	foreach ($obj as $key => $value) {
		if (gettype($value) == "array" || gettype($value) == "object"){
			$ret[$key] =  objarray_to_array($value);
		}else{
			$ret[$key] = $value;
		}
	}
	return $ret;
}

/**
 * 加密
 */
function encryption($str,$arr =''){
	if($arr)
	{
		return $arr.base64_encode(json_encode($str));
	}
	return base64_encode(gzcompress(json_encode($str)));
}
/**
 * 解密
 */
function Decrypt($str,$arr=''){
	if($arr)
	{
		return json_decode(base64_decode(substr($str,strlen($arr))),true);
	}
	return json_decode(gzuncompress(base64_decode($str)),true);
}

/**
 * 简单对称加密算法之加密
 * @param String $string 需要加密的字串
 * @param String $skey 加密EKY
 * @author Anyon Zou <zoujingli@qq.com>
 * @date 2013-08-13 19:30
 * @update 2014-10-10 10:10
 * @return String
 */
function JIAM($string = '', $skey = 'cxphp') {
	$strArr = str_split(base64_encode($string));
	$strCount = count($strArr);
	foreach (str_split($skey) as $key => $value)
		$key < $strCount && $strArr[$key].=$value;
	return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
}

/**
 * 简单对称加密算法之解密
 * @param String $string 需要解密的字串
 * @param String $skey 解密KEY
 * @author Anyon Zou <zoujingli@qq.com>
 * @date 2013-08-13 19:30
 * @update 2014-10-10 10:10
 * @return String
 */
function JIEM($string = '', $skey = 'cxphp') {
	$strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
	$strCount = count($strArr);
	foreach (str_split($skey) as $key => $value)
		$key <= $strCount  && isset($strArr[$key]) && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
	return base64_decode(join('', $strArr));
}


/**
 * 打印语句
 * @param unknown $array
 */
function pp($array){
echo '<pre>';
print_r($array);
echo '</pre>';
}






//获取真实路径
function get_real_path()
{
	return APP_ROOT_PATH;
}

//获取GMTime
function get_gmtime()
{
	$now = (time() - date('Z'));
	return $now;
}

function to_date($utc_time, $format = 'Y-m-d H:i:s') {
	if (empty ( $utc_time )) {
		return '';
	}
	$timezone = intval(app_conf('TIME_ZONE'));
	$time = $utc_time + $timezone * 3600; 
	return date ($format, $time );
}
function to_time($utc_time, $format = 'H:i:s') {
	if (empty ( $utc_time )) {
		return '';
	}
	$timezone = intval(app_conf('TIME_ZONE'));
	$time = $utc_time + $timezone * 3600;
	return date ($format, $time );
}

function to_timespan($str, $format = 'Y-m-d H:i:s')
{
	$timezone = intval(app_conf('TIME_ZONE'));
	//$timezone = 8; 
	$time = intval(strtotime($str));
	if($time!=0)
	$time = $time - $timezone * 3600;
    return $time;
}



//获取客户端IP
function get_client_ip() {
	//使用wap时，是通过中转方式，所以要在wap/index.php获取客户ip,转入到:sjmapi上 chenfq by add 2014-11-01
	if (isset($GLOBALS['request']['client_ip']) && !empty($GLOBALS['request']['client_ip']))
		$ip = $GLOBALS['request']['client_ip'];
	else if (isset($_REQUEST['client_ip']) && !empty($_REQUEST['client_ip']))
		$ip = $_REQUEST['client_ip'];	
	else if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
		$ip = getenv ( "HTTP_CLIENT_IP" );
	else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
		$ip = getenv ( "HTTP_X_FORWARDED_FOR" );
	else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
		$ip = getenv ( "REMOTE_ADDR" );
	else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
		$ip = $_SERVER ['REMOTE_ADDR'];
	else
		$ip = "0.0.0.0";
	if(!preg_match("/(\d+)\.(\d+)\.(\d+)\.(\d+)/", $ip))
		$ip = "0.0.0.0";
	return strim($ip);
}

//过滤注入
function filter_injection(&$request)
{
	$pattern = "/(select[\s])|(insert[\s])|(update[\s])|(delete[\s])|(from[\s])|(where[\s])/i";
	foreach($request as $k=>$v)
	{
				if(preg_match($pattern,$k,$match))
				{
						die("SQL Injection denied!");
				}
		
				if(is_array($v))
				{					
					filter_injection($v);
				}
				else
				{					
					
					if(preg_match($pattern,$v,$match))
					{
						die("SQL Injection denied!");
					}					
				}
	}
	
}

//过滤请求
function filter_request(&$request)
{
		if(MAGIC_QUOTES_GPC)
		{
			foreach($request as $k=>$v)
			{
				if(is_array($v))
				{
					filter_request($request[$k]);
				}
				else
				{
					$request[$k] = stripslashes(trim($v));
				}
			}
		}
		
}

function adddeepslashes(&$request)
{

			foreach($request as $k=>$v)
			{
				if(is_array($v))
				{
					adddeepslashes($v);
				}
				else
				{
					$request[$k] = addslashes(trim($v));
				}
			}		
}

//request转码
function convert_req(&$req)
{
	foreach($req as $k=>$v)
	{
		if(is_array($v))
		{
			convert_req($req[$k]);
		}
		else
		{
			if(!is_u8($v))
			{
				$req[$k] = iconv("gbk","utf-8",$v);
			}
		}
	}
}

function is_u8($string)
{
	if(strlen($string)>255)
	$tag = true;
	else
	$tag = preg_match('%^(?:
		 [\x09\x0A\x0D\x20-\x7E]            # ASCII
	   | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
	   |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
	   | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
	   |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
	   |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
	   | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
	   |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
   )*$%xs', $string);

   return $tag;
// 	$encode = mb_detect_encoding($string,array("GB2312","GBK","UTF-8"));
// 	if($encode=="UTF-8")
// 		return true;
// 	else
// 		return false;
}

//清除缓存
function clear_cache()
{
		//系统后台缓存
		syn_dealing();
		clear_dir_file(get_real_path()."public/runtime/admin/Cache/");	
		clear_dir_file(get_real_path()."public/runtime/admin/Data/_fields/");		
		clear_dir_file(get_real_path()."public/runtime/admin/Temp/");	
		clear_dir_file(get_real_path()."public/runtime/admin/Logs/");	
		@unlink(get_real_path()."public/runtime/admin/~app.php");
		@unlink(get_real_path()."public/runtime/admin/~runtime.php");
		@unlink(get_real_path()."public/runtime/admin/lang.js");
		@unlink(get_real_path()."public/runtime/app/config_cache.php");	
		
		
		//数据缓存
		clear_dir_file(get_real_path()."public/runtime/app/data_caches/");				
		clear_dir_file(get_real_path()."public/runtime/app/db_caches/");
		$GLOBALS['cache']->clear();
		clear_dir_file(get_real_path()."public/runtime/data/");

		//模板页面缓存
		clear_dir_file(get_real_path()."public/runtime/app/tpl_caches/");		
		clear_dir_file(get_real_path()."public/runtime/app/tpl_compiled/");
		@unlink(get_real_path()."public/runtime/app/lang.js");	
		
		//脚本缓存
		clear_dir_file(get_real_path()."public/runtime/statics/");		
			
				
		
}
function clear_dir_file($path,$include_path=true)
{
   if ( $dir = opendir( $path ) )
   {
            while ( $file = readdir( $dir ) )
            {
                $check = is_dir( $path. $file );
                if ( !$check )
                {
                    @unlink( $path . $file );                       
                }
                else 
                {
                 	if($file!='.'&&$file!='..')
                 	{
                 		clear_dir_file($path.$file."/");              			       		
                 	} 
                 }           
            }
            closedir( $dir );
            if($include_path)
            rmdir($path);
            return true;
   }
}

function check_install()
{
	if(!file_exists(get_real_path()."public/install.lock"))
	{
	    clear_cache();
		header('Location:'.APP_ROOT.'/install');
		exit;
	}
}

function syn_brand_match($brand_id)
{
	$brand = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."brand where id = ".$brand_id);
	if($brand)
	{
		$brand['tag_match'] = "";
		$brand['tag_match_row'] = "";
		$GLOBALS['db']->autoExecute(DB_PREFIX."brand", $brand, $mode = 'UPDATE', "id=".$brand_id, $querymode = 'SILENT');

		//标签
		$tags = preg_split("/[ ,]/i",$brand['tag']);
		foreach($tags as $row)
		{
			$tag = trim($row);
			if(trim($tag)!="")
				insert_match_item($tag,"brand",$brand_id,"tag_match");

		}
		
		//关于分类
		$cate_id = $brand['shop_cate_id'];
		require_once APP_ROOT_PATH."sys/utils/child.php";
		$ids_util = new child("shop_cate");
		$ids = $ids_util->getChildIds($cate_id);
		$ids[] = $cate_id;
			
		$deal_cate = $GLOBALS['db']->getAll("select name from ".DB_PREFIX."shop_cate where id in (".implode(",", $ids).") and is_effect = 1 and is_delete = 0");
		
		foreach($deal_cate as $k=>$item)
		{
			$name_words = div_str($item['name']);
			foreach($name_words as $kk=>$vv)
			{
				if(trim($vv)!="")
				insert_match_item(trim($vv),"brand",$brand_id,"tag_match");
			}
		}

	}
}




function get_deal_cate_name($cate_id)
{
	return $GLOBALS['db']->getOne("select name from ".DB_PREFIX."deal_cate where id =".$cate_id);
}
	
function get_deal_city_name($city_id)
{
	return $GLOBALS['db']->getOne("select name from ".DB_PREFIX."deal_city where id =".$city_id);
}

function format_price($price)
{
	if (defined("APP_INDEX")&&APP_INDEX == "app"){
		if($price >= 0){
			return "¥".(round($price,2));
		}else{
			return "-¥".(round(abs($price),2));
		}
	}else{
		if($price >= 0){
			return app_conf("CURRENCY_UNIT")."".(round($price,2));
		}else{
			return "-".app_conf("CURRENCY_UNIT")."".(round(abs($price),2));
		}
	}
}
function format_score($score)
{
	return intval($score)."".app_conf("SCORE_UNIT");	
}

//utf8 字符串截取
function msubstr($str, $start=0, $length=15, $charset="utf-8", $suffix=true)
{
	if(function_exists("mb_substr"))
    {
        $slice =  mb_substr($str, $start, $length, $charset);
        if($suffix&$slice!=$str) return $slice."…";
    	return $slice;
    }
    elseif(function_exists('iconv_substr')) {
        return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix&&$slice!=$str) return $slice."…";
    return $slice;
}


//字符编码转换
if(!function_exists("iconv"))
{	
	function iconv($in_charset,$out_charset,$str)
	{
		require 'libs/iconv.php';
		$chinese = new Chinese();
		return $chinese->Convert($in_charset,$out_charset,$str);
	}
}

//JSON兼容
if(!function_exists("json_encode"))
{	
	function json_encode($data)
	{
		require_once 'libs/json.php';
		$JSON = new JSON();
		return $JSON->encode($data);
	}
}
if(!function_exists("json_decode"))
{	
	function json_decode($data)
	{
		require_once 'libs/json.php';
		$JSON = new JSON();
		return $JSON->decode($data,1);
	}
}

//邮件格式验证的函数
function check_email($email)
{
	if(!empty($email) && !preg_match("/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/",$email))
	{
		return false;
	}
	else
	return true;
}

//验证手机号码
function check_mobile($mobile)
{
	if(!empty($mobile) && !preg_match("/^(1[34578]\d{9})$/",$mobile))
	{
		return false;
	}
	else
	return true;
}

/**
 * 页面跳转
 */
function app_redirect($url,$time=0,$msg='')
{
    //多行URL地址支持
    $url = str_replace(array("\n", "\r"), '', $url);    
    if (!headers_sent()) {
        // redirect
        if(0===$time&&$msg=="") {
        	if(substr($url,0,1)=="/")
        	{        		
        		if(defined("SITE_DOMAIN"))
        			header("Location:".SITE_DOMAIN.$url);
        		else
        			header("Location:".$url);
        	}
        	else
        	{
        		header("Location:".$url);
        	}
            
        }else {
            header("refresh:{$time};url={$url}");
            echo($msg);
        }
        exit();
    }else {
        $str    = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
        if($time!=0)
            $str   .=   $msg;
        exit($str);
    }
}



/**
 * 验证访问IP的有效性
 * @param ip地址 $ip_str
 * @param 访问页面 $module
 * @param 时间间隔 $time_span
 * @param 数据ID $id
 */
function check_ipop_limit($ip_str,$module,$time_span=0,$id=0)
{
		$op = es_session::get($module."_".$id."_ip");
	
    	if(empty($op))
    	{
    		$check['ip']	=	 CLIENT_IP;
    		$check['time']	=	time();
    		es_session::set($module."_".$id."_ip",$check);    		
    		return true;  //不存在session时验证通过
    	}
    	else 
    	{   
    		$check['ip']	=	 CLIENT_IP;
    		$check['time']	=	time();   
    		$origin	=	es_session::get($module."_".$id."_ip");
//     	PP($check);DIE;
    		if($check['ip']==$origin['ip'])
    		{
    			if($check['time'] - $origin['time'] < $time_span)
    			{
    				return false;
    			}
    			else 
    			{
    				es_session::set($module."_".$id."_ip",$check);
    				return true;  //不存在session时验证通过    				
    			}
    		}
    		else 
    		{
    			es_session::set($module."_".$id."_ip",$check);
    			return true;  //不存在session时验证通过
    		}
    	}
    }

function trim_bom($contents)
{
	$charset[1] = substr($contents, 0, 1);
	$charset[2] = substr($contents, 1, 1);
	$charset[3] = substr($contents, 2, 1);
	if (ord($charset[1]) == 239 && ord($charset[2]) == 187 && ord($charset[3]) == 191)
	{
		$contents = substr($contents, 3);
		return $contents;
	}
	else
	{
		return $contents;
	}
}

function gzip_out($content)
{
	if($GLOBALS['refresh_page']&&!IS_DEBUG)
	{
		echo "<script>location.reload();</script>";
		exit;
	}
	
	if($distribution_cfg["CACHE_TYPE"]!="File")
	{
		if(preg_match_all("/href=\"([^\"]+)\"/i", $content, $matches))
		{
			foreach($matches[1] as $k=>$v)
			{
				$content = str_replace($v, trim_bom($v), $content);
			}
		}
	}
	
	header("Content-type: text/html; charset=utf-8");
    header("Cache-control: private");  //支持页面回跳
	$gzip = app_conf("GZIP_ON");
	if( intval($gzip)==1 )
	{
		if(!headers_sent($file,$line)&&extension_loaded("zlib")&&preg_match("/gzip/i",$_SERVER["HTTP_ACCEPT_ENCODING"]))
		{
	
			
			$content = gzencode($content,9);	
			header("Content-Encoding: gzip");
			header("Content-Length: ".strlen($content));
			echo $content;
			
		}
		else
		echo $content;
	}else{
		echo $content;
	}
	
}


/**
	 * 保存图片
	 * @param array $upd_file  即上传的$_FILES数组
	 * @param array $key $_FILES 中的键名 为空则保存 $_FILES 中的所有图片
	 * @param string $dir 保存到的目录
	 * @param array $whs
	 	可生成多个缩略图
		数组 参数1 为宽度，
			 参数2为高度，
			 参数3为处理方式:0(缩放,默认)，1(剪裁)，
			 参数4为是否水印 默认为 0(不生成水印)
	 	array(
			'thumb1'=>array(300,300,0,0),
			'thumb2'=>array(100,100,0,0),
			'origin'=>array(0,0,0,0),  宽与高为0为直接上传
			...
		)，
	 * @param array $is_water 原图是否水印
	 * @return array
	 	array(
			'key'=>array(
				'name'=>图片名称，
				'url'=>原图web路径，
				'path'=>原图物理路径，
				有略图时
				'thumb'=>array(
					'thumb1'=>array('url'=>web路径,'path'=>物理路径),
					'thumb2'=>array('url'=>web路径,'path'=>物理路径),
					...
				)
			)
			....
		)
	 */
//$img = save_image_upload($_FILES,'avatar','temp',array('avatar'=>array(300,300,1,1)),1);
function save_image_upload($upd_file, $key='',$dir='temp', $whs=array(),$is_water=false,$need_return = false)
{
		require_once APP_ROOT_PATH."sys/utils/es_imagecls.php";
		$image = new es_imagecls();
		$image->max_size = intval(app_conf("MAX_IMAGE_SIZE"));
		
		$list = array();

		if(empty($key))
		{
			foreach($upd_file as $fkey=>$file)
			{
				$list[$fkey] = false;
				$image->init($file,$dir);
				if($image->save())
				{
					$list[$fkey] = array();
					$list[$fkey]['url'] = $image->file['target'];
					$list[$fkey]['path'] = $image->file['local_target'];
					$list[$fkey]['name'] = $image->file['prefix'];
				}
				else
				{
					if($image->error_code==-105)
					{
						if($need_return)
						{
							return array('error'=>1,'message'=>'上传的图片太大');
						}
						else
						echo "上传的图片太大";
					}
					elseif($image->error_code==-104||$image->error_code==-103||$image->error_code==-102||$image->error_code==-101)
					{
						if($need_return)
						{
							return array('error'=>1,'message'=>'非法图像');
						}
						else
						echo "非法图像";
					}
					exit;
				}
			}
		}
		else
		{
			$list[$key] = false;
			$image->init($upd_file[$key],$dir);
			if($image->save())
			{
				$list[$key] = array();
				$list[$key]['url'] = $image->file['target'];
				$list[$key]['path'] = $image->file['local_target'];
				$list[$key]['name'] = $image->file['prefix'];
			}
			else
				{
					if($image->error_code==-105)
					{
						if($need_return)
						{
							return array('error'=>1,'message'=>'上传的图片太大');
						}
						else
						echo "上传的图片太大";
					}
					elseif($image->error_code==-104||$image->error_code==-103||$image->error_code==-102||$image->error_code==-101)
					{
						if($need_return)
						{
							return array('error'=>1,'message'=>'非法图像');
						}
						else
						echo "非法图像";
					}
					exit;
				}
		}

		$water_image = APP_ROOT_PATH.app_conf("WATER_MARK");
		$alpha = app_conf("WATER_ALPHA");
		$place = app_conf("WATER_POSITION");
		
		foreach($list as $lkey=>$item)
		{
				//循环生成规格图
				foreach($whs as $tkey=>$wh)
				{
					$list[$lkey]['thumb'][$tkey]['url'] = false;
					$list[$lkey]['thumb'][$tkey]['path'] = false;
					if($wh[0] > 0 || $wh[1] > 0)  //有宽高度
					{
						$thumb_type = isset($wh[2]) ? intval($wh[2]) : 0;  //剪裁还是缩放， 0缩放 1剪裁
						if($thumb = $image->thumb($item['path'],$wh[0],$wh[1],$thumb_type))
						{
							$list[$lkey]['thumb'][$tkey]['url'] = $thumb['url'];
							$list[$lkey]['thumb'][$tkey]['path'] = $thumb['path'];
							if(isset($wh[3]) && intval($wh[3]) > 0)//需要水印
							{
								$paths = pathinfo($list[$lkey]['thumb'][$tkey]['path']);
								$path = $paths['dirname'];
				        		$path = $path."/origin/";
				        		if (!is_dir($path)) { 
						             @mkdir($path);
						             @chmod($path, 0777);
					   			}   	    
				        		$filename = $paths['basename'];
								@file_put_contents($path.$filename,@file_get_contents($list[$lkey]['thumb'][$tkey]['path']));      
								$image->water($list[$lkey]['thumb'][$tkey]['path'],$water_image,$alpha, $place);
							}
						}
					}
				}
			if($is_water)
			{
				$paths = pathinfo($item['path']);
				$path = $paths['dirname'];
        		$path = $path."/origin/";
        		if (!is_dir($path)) { 
		             @mkdir($path);
		             @chmod($path, 0777);
	   			}   	    
        		$filename = $paths['basename'];
				@file_put_contents($path.$filename,@file_get_contents($item['path']));        		
				$image->water($item['path'],$water_image,$alpha, $place);
			}
		}			
		return $list;
}

function empty_tag($string)
{	
	$string = preg_replace(array("/\[img\]\d+\[\/img\]/","/\[[^\]]+\]/"),array("",""),$string);
	if(strim($string)=='')
	return $GLOBALS['lang']['ONLY_IMG'];
	else 
	return $string;
	//$string = str_replace(array("[img]","[/img]"),array("",""),$string);
}

//验证是否有非法字汇，未完成
function valid_str($string)
{
	$string = msubstr($string,0,5000);
	if(app_conf("FILTER_WORD")!='')
	$string = preg_replace("/".app_conf("FILTER_WORD")."/","*",$string);
	return $string;
}


/**
 * utf8字符转Unicode字符
 * @param string $char 要转换的单字符
 * @return void
 */
function utf8_to_unicode($char)
{
	switch(strlen($char))
	{
		case 1:
			return ord($char);
		case 2:
			$n = (ord($char[0]) & 0x3f) << 6;
			$n += ord($char[1]) & 0x3f;
			return $n;
		case 3:
			$n = (ord($char[0]) & 0x1f) << 12;
			$n += (ord($char[1]) & 0x3f) << 6;
			$n += ord($char[2]) & 0x3f;
			return $n;
		case 4:
			$n = (ord($char[0]) & 0x0f) << 18;
			$n += (ord($char[1]) & 0x3f) << 12;
			$n += (ord($char[2]) & 0x3f) << 6;
			$n += ord($char[3]) & 0x3f;
			return $n;
	}
}

/**
 * utf8字符串分隔为unicode字符串
 * @param string $str 要转换的字符串
 * @param string $depart 分隔,默认为空格为单字
 * @return string
 */
function str_to_unicode_word($str,$depart=' ')
{
	$arr = array();
	$str_len = mb_strlen($str,'utf-8');
	for($i = 0;$i < $str_len;$i++)
	{
		$s = mb_substr($str,$i,1,'utf-8');
		if($s != ' ' && $s != '　')
		{
			$arr[] = 'ux'.utf8_to_unicode($s);
		}
	}
	return implode($depart,$arr);
}


/**
 * utf8字符串分隔为unicode字符串
 * @param string $str 要转换的字符串
 * @return string
 */
function str_to_unicode_string($str)
{
	$string = str_to_unicode_word($str,'');
	return $string;
}

//分词
function div_str($str)
{
	require_once APP_ROOT_PATH."sys/libs/words.php";
	$words = words::segment($str);
	$words[] = $str;	
	return $words;
}

/**
 * 
 * @param $tag  //要插入的关键词
 * @param $table  //表名
 * @param $id  //数据ID
 * @param $field		// tag_match/name_match/cate_match/locate_match
 */
function insert_match_item($tag,$table,$id,$field)
{
	if($tag=='')
	return;
	
	$unicode_tag = str_to_unicode_string($tag);
	$sql = "select count(*) from ".DB_PREFIX.$table." where match(".$field.") against ('".$unicode_tag."' IN BOOLEAN MODE) and id = ".$id;
	$rs = $GLOBALS['db']->getOne($sql);
	if(intval($rs) == 0)
	{
		$match_row = $GLOBALS['db']->getRow("select * from ".DB_PREFIX.$table." where id = ".$id);
		if($match_row[$field]=="")
		{
				$match_row[$field] = $unicode_tag;
				$match_row[$field."_row"] = $tag;
		}
		else
		{
				$match_row[$field] = $match_row[$field].",".$unicode_tag;
				$match_row[$field."_row"] = $match_row[$field."_row"].",".$tag;
		}
		$GLOBALS['db']->autoExecute(DB_PREFIX.$table, $match_row, $mode = 'UPDATE', "id=".$id, $querymode = 'SILENT');	
		
	}	
}

function get_all_parent_id($id,$table,&$arr = array())
{
	if(intval($id)>0)
	{
		$arr[] = $id;
		$pid = $GLOBALS['db']->getOne("select pid from ".$table." where id = ".$id);
		if($pid>0)
		{
			get_all_parent_id($pid,$table,$arr);
		}
	}
}


/**
 * 同步库存索引的key
 */
function syn_attr_stock_key($id)
{
    $attr_stock_list =$GLOBALS['db']->getAll("select * from ".DB_PREFIX."attr_stock where deal_id = ".$id);
    foreach($attr_stock_list as $row)
    {
        $attr_ids = array();
        $attr_cfg = unserialize($row['attr_cfg']);
        foreach($attr_cfg as $goods_type_attr_id=>$deal_attr_name)
        {
            $attr_ids[] = $GLOBALS['db']->getOne("select id from ".DB_PREFIX."deal_attr where deal_id = ".$id." and goods_type_attr_id = ".$goods_type_attr_id." and name='".$deal_attr_name."'");
        }
        sort($attr_ids);
        $attr_ids = implode($attr_ids, "_");
        $GLOBALS['db']->query("update ".DB_PREFIX."attr_stock set attr_key = '".$attr_ids."' where id =".$row['id']);
    }
}



//封装url

function url($app_index,$route="index",$param=array())
{
	$key = md5("URL_KEY_".$app_index.$route.serialize($param));
	if(isset($GLOBALS[$key]))
	{
		$url = $GLOBALS[$key];
		return $url;
	}
	
	$url = load_dynamic_cache($key);
	if($url!==false)
	{
		$GLOBALS[$key] = $url;
		return $url;
	}
	
	$show_city = intval($GLOBALS['city_count'])>1?true:false;  //有多个城市时显示城市名称到url
	$route_array = explode("#",$route);
	
	if(isset($param)&&$param!=''&&!is_array($param))
	{
		$param['id'] = $param;
	}

	$module = strtolower(trim($route_array[0]));
	$action = strtolower(trim($route_array[1]));

	if(!$module||$module=='index')$module="";
	if(!$action||$action=='index')$action="";

	if(app_conf("URL_MODEL")==0 || $GLOBALS['request']['from']=="wap")//fwb改过
	{
		//过滤主要的应用url
		if($app_index==app_conf("MAIN_APP"))
		$app_index = "index";
		
		//原始模式
		$url = APP_ROOT."/".$app_index.".php";
		if($module!=''||$action!=''||count($param)>0||$show_city) //有后缀参数
		{
			$url.="?";
		}

// 		if(isset($param['city']))
// 		{
// 			$url .= "city=".$param['city']."&";
// 			unset($param['city']);
// 		}		
		if($module&&$module!='')
		$url .= "ctl=".$module."&";
		if($action&&$action!='')
		$url .= "act=".$action."&";
		if(count($param)>0)
		{
			foreach($param as $k=>$v)
			{
				if($k&&$v)
				$url =$url.$k."=".urlencode($v)."&";
			}
		}
		if(substr($url,-1,1)=='&'||substr($url,-1,1)=='?') $url = substr($url,0,-1);
		$GLOBALS[$key] = $url;
		set_dynamic_cache($key,$url);
		return $url;
	}
	else
	{
		//重写的默认
		$url = APP_ROOT;
	
		if($app_index!='index')
		$url .= "/".$app_index;

		if($module&&$module!='')
		$url .= "/".$module;
		if($action&&$action!='')
		$url .= "/".$action;
		
		if(count($param)>0)
		{
			$url.="/";
			foreach($param as $k=>$v)
			{
				if($k!='city')
				$url =$url.$k."-".urlencode($v)."-";
			}
		}
		
		//过滤主要的应用url
		if($app_index==app_conf("MAIN_APP"))
		$url = str_replace("/".app_conf("MAIN_APP"),"",$url);
		
		$route = $module."#".$action;
		switch ($route)
		{
				case "xxx":
					break;
				default:
					break;
		}
				
		if(substr($url,-1,1)=='/'||substr($url,-1,1)=='-') $url = substr($url,0,-1);
		
		
		
		if(isset($param['city']))
		{
			$city_uname = $param['city'];

			if($GLOBALS['distribution_cfg']['DOMAIN_ROOT']!="")
			{
				$domain = "http://".$city_uname.".".$GLOBALS['distribution_cfg']['DOMAIN_ROOT'];	
				return $domain.$url;
			}
			else
			{
				return $url."/city/".$city_uname;
			}	

		}
		if($url=='')$url="/";
		$GLOBALS[$key] = $url;
		set_dynamic_cache($key,$url);
		return $url;
	}
	
	
}

function wap_url($app_index,$route="index",$param=array())
{
	global $page_type;
	if($page_type)
	{
		$param['page_type'] = $page_type;
	}
	global $spid;
	if($spid)
	{
		if(!isset($param['spid']))
		$param['spid'] = $spid;
	}
	
	$key = md5("WAP_URL_KEY_".$app_index.$route.serialize($param));
	if(isset($GLOBALS[$key]))
	{
		$url = $GLOBALS[$key];
		return $url;
	}

	$url = load_dynamic_cache($key);
	if($url!==false)
	{
		$GLOBALS[$key] = $url;
		return $url;
	}

	$show_city = intval($GLOBALS['city_count'])>1?true:false;  //有多个城市时显示城市名称到url
	$route_array = explode("#",$route);

	if(isset($param)&&$param!=''&&!is_array($param))
	{
		$param['id'] = $param;
	}

	$module = strtolower(trim($route_array[0]));
	$action = strtolower(trim($route_array[1]));

	if(!$module||$module=='index')$module="";
	if(!$action||$action=='index')$action="";

	//原始模式
	$url = APP_ROOT."/".$app_index.".php";
	if($module!=''||$action!=''||count($param)>0||$show_city) //有后缀参数
	{
		$url.="?";
		/** 关闭url传输自定义session到url中，很重要，如有遇到浏览器不支持cookie的再议
		if($GLOBALS['define_sess_id'])
		{
			$url.="sess_id=".$GLOBALS['sess_id']."&";
		}*/
	}
	else
	{
		/** 关闭url传输自定义session到url中，很重要，如有遇到浏览器不支持cookie的再议
		if($GLOBALS['define_sess_id'])
		{
			$url.="?sess_id=".$GLOBALS['sess_id']."&";
		}
		*/
	}


// 	if(isset($param['city']))
// 	{
// 		$url .= "city=".$param['city']."&";
// 		unset($param['city']);
// 	}
	if($module&&$module!='')
		$url .= "ctl=".$module."&";
	if($action&&$action!='')
		$url .= "act=".$action."&";
	if(count($param)>0)
	{
		foreach($param as $k=>$v)
		{
			if($k&&$v)
				$url =$url.$k."=".urlencode($v)."&";
		}
	}
	if(substr($url,-1,1)=='&'||substr($url,-1,1)=='?') $url = substr($url,0,-1);
	$GLOBALS[$key] = $url;
	set_dynamic_cache($key,$url);
	return $url;
}

function unicode_encode($name) {//to Unicode
    $name = iconv('UTF-8', 'UCS-2', $name);
    $len = strlen($name);
    $str = '';
    for($i = 0; $i < $len - 1; $i = $i + 2) {
        $c = $name[$i];
        $c2 = $name[$i + 1];
        if (ord($c) > 0) {// 两个字节的字
            $cn_word = '\\'.base_convert(ord($c), 10, 16).base_convert(ord($c2), 10, 16);
            $str .= strtoupper($cn_word);
        } else {
            $str .= $c2;
        }
    }
    return $str;
}

function unicode_decode($name) {//Unicode to
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
    preg_match_all($pattern, $name, $matches);
    if (!empty($matches)) {
        $name = '';
        for ($j = 0; $j < count($matches[0]); $j++) {
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0) {
                $code = base_convert(substr($str, 2, 2), 16, 10);
                $code2 = base_convert(substr($str, 4), 16, 10);
                $c = chr($code).chr($code2);
                $c = iconv('UCS-2', 'UTF-8', $c);
                $name .= $c;
            } else {
                $name .= $str;
            }
        }
    }
    return $name;
}



//载入动态缓存数据
function load_dynamic_cache($name)
{
	if(isset($GLOBALS['dynamic_cache'][$name]))
	{
		return $GLOBALS['dynamic_cache'][$name];
	}
	else
	{
		return false;
	}
}

function set_dynamic_cache($name,$value)
{
	if(!isset($GLOBALS['dynamic_cache'][$name]))
	{
		if(count($GLOBALS['dynamic_cache'])>MAX_DYNAMIC_CACHE_SIZE)
		{
			array_shift($GLOBALS['dynamic_cache']);
		}
		$GLOBALS['dynamic_cache'][$name] = $value;		
	}
}


//同步一张图片到分享图片表(图片可以为本地获远程。 远程需要开启file_get_contents()的远程权限)
function syn_image_to_topic($image)
{
    $image = str_replace("./public", APP_ROOT_PATH."public", $image);
	$image_str = @file_get_contents($image);
	$file_name = md5(microtime(true)).rand(10,99).".jpg";
	
	//创建comment目录
		if (!is_dir(APP_ROOT_PATH."public/comment")) { 
	             @mkdir(APP_ROOT_PATH."public/comment");
	             @chmod(APP_ROOT_PATH."public/comment", 0777);
	        }
		
	    $dir = to_date(NOW_TIME,"Ym");
	    if (!is_dir(APP_ROOT_PATH."public/comment/".$dir)) { 
	             @mkdir(APP_ROOT_PATH."public/comment/".$dir);
	             @chmod(APP_ROOT_PATH."public/comment/".$dir, 0777);
	        }
	        
	    $dir = $dir."/".to_date(NOW_TIME,"d");
	    if (!is_dir(APP_ROOT_PATH."public/comment/".$dir)) { 
	             @mkdir(APP_ROOT_PATH."public/comment/".$dir);
	             @chmod(APP_ROOT_PATH."public/comment/".$dir, 0777);
	        }
	     
	    $dir = $dir."/".to_date(NOW_TIME,"H");
	    if (!is_dir(APP_ROOT_PATH."public/comment/".$dir)) { 
	             @mkdir(APP_ROOT_PATH."public/comment/".$dir);
	             @chmod(APP_ROOT_PATH."public/comment/".$dir, 0777);
	        }
	   
	   $file_url = "./public/comment/".$dir."/".$file_name;	  
	   $file_path = APP_ROOT_PATH."public/comment/".$dir."/".$file_name;
	   @file_put_contents($file_path,$image_str);
	   $filesize = intval(@filesize($file_path));

	   if($filesize>0)
	   {
		   	if($GLOBALS['distribution_cfg']['OSS_TYPE']&&$GLOBALS['distribution_cfg']['OSS_TYPE']!="NONE")
		   	{
		   		syn_to_remote_image_server($file_url);
		   	}
		   	
		    $icon_url = get_spec_image($file_url,100,100,1);		   
		    require_once APP_ROOT_PATH."sys/utils/es_imagecls.php";
			$image = new es_imagecls();

			$info = $image->getImageInfo($file_path);
			$image_data['width'] = intval($info[0]);
			$image_data['height'] = intval($info[1]);
			$image_data['name'] =$file_name;
			$image_data['filesize'] = $filesize;
			$image_data['create_time'] = NOW_TIME;
			$image_data['user_id'] = intval($GLOBALS['user_info']['id']);
			$image_data['user_name'] = addslashes($GLOBALS['user_info']['user_name']);
			$image_data['path'] = $icon_url;
			$image_data['o_path'] = $file_url;
			$GLOBALS['db']->autoExecute(DB_PREFIX."topic_image",$image_data);				
			$data['id'] = intval($GLOBALS['db']->insert_id());
			$data['url'] = $icon_url;
	   }
	   return $data;
	
}

function load_auto_cache($key,$param=array())
{
	require_once APP_ROOT_PATH."sys/libs/auto_cache.php";
	$file =  APP_ROOT_PATH."sys/auto_cache/".APP_TYPE."/".$key.".auto_cache.php";
	if(!file_exists($file))
	$file =  APP_ROOT_PATH."sys/auto_cache/".$key.".auto_cache.php";
	
	if(file_exists($file))
	{
		require_once $file;
		$class = $key."_auto_cache";
		$obj = new $class;
		$result = $obj->load($param);
	}
	else
	$result = false;
	return $result;
}

function rm_auto_cache($key,$param=array())
{
	require_once APP_ROOT_PATH."sys/libs/auto_cache.php";
	$file =  APP_ROOT_PATH."sys/auto_cache/".$key.".auto_cache.php";
	if(file_exists($file))
	{
		require_once $file;
		$class = $key."_auto_cache";
		$obj = new $class;
		$obj->rm($param);
	}
}


function clear_auto_cache($key)
{
	require_once APP_ROOT_PATH."sys/libs/auto_cache.php";
	$file =  APP_ROOT_PATH."sys/auto_cache/".$key.".auto_cache.php";
	if(file_exists($file))
	{
		require_once $file;
		$class = $key."_auto_cache";
		$obj = new $class;
		$obj->clear_all();
	}
}

/*ajax返回*/
function ajax_return($data,$jsonp=false)
{
	if($jsonp)
	{
			$json = json_encode($data);
			header("Content-Type:text/html; charset=utf-8");
			echo $_GET['callback']."(".$json.")";exit;
			

	}
	else
	{
		header("Content-Type:text/html; charset=utf-8");
        echo(json_encode($data));
        exit;	
	}
}


function is_animated_gif($filename){
 $fp=fopen($filename, 'rb');
 $filecontent=fread($fp, filesize($filename));
 fclose($fp);
 return strpos($filecontent,chr(0x21).chr(0xff).chr(0x0b).'NETSCAPE2.0')===FALSE?0:1;
}


function make_deal_cate_js()
{
	$js_file = APP_ROOT_PATH."public/runtime/app/deal_cate_conf.js";
	if(!file_exists($js_file))
	{
		$js_str = "var deal_cate_conf = [";
		$deal_cates = $GLOBALS['db']->getAll("select id,name from ".DB_PREFIX."deal_cate where is_delete = 0 and is_effect = 1 order by sort desc");
		foreach($deal_cates as $k=>$v)
		{
			$js_str.='{"n":"'.$v['name'].'","i":"'.$v['id'].'","s":[';
			$deal_cate_types = $GLOBALS['db']->getAll("select t.id,t.name from ".DB_PREFIX."deal_cate_type as t left join ".DB_PREFIX."deal_cate_type_link as l on l.deal_cate_type_id = t.id where l.cate_id = ".$v['id']." order by t.sort desc");
			foreach($deal_cate_types as $kk=>$vv)
			{
				$js_str .= '{"n":"'.$vv['name'].'","i":"'.$vv['id'].'"},';
			}
			if($deal_cate_types)
			$js_str = substr($js_str,0,-1);
			$js_str .= ']},';
		}
		if($deal_cates)
		$js_str = substr($js_str,0,-1);
		$js_str.="];";
		@file_put_contents($js_file,$js_str);
	}
}

function make_deal_region_js()
{
	$dir = APP_ROOT_PATH."public/runtime/app/deal_region_conf/";
	if (!is_dir($dir))
    {
             @mkdir($dir);
             @chmod($dir, 0777);
    }  
	$js_file = $dir.intval($GLOBALS['deal_city']['id']).".js";
	if(!file_exists($js_file))
	{
		$js_str = "var deal_region_conf = [";
		$areas = $GLOBALS['db']->getAll("select id,name from ".DB_PREFIX."area where city_id = ".intval($GLOBALS['deal_city']['id'])." and pid = 0 order by sort desc");
		foreach($areas as $k=>$v)
		{
			$js_str.='{"n":"'.$v['name'].'","i":"'.$v['id'].'","s":[';
			$regions = $GLOBALS['db']->getAll("select id,name from ".DB_PREFIX."area where city_id = ".intval($GLOBALS['deal_city']['id'])." and pid = ".$v['id']." order by sort desc");
			foreach($regions as $kk=>$vv)
			{
				$js_str .= '{"n":"'.$vv['name'].'","i":"'.$vv['id'].'"},';
			}
			if($regions)
			$js_str = substr($js_str,0,-1);
			$js_str .= ']},';
		}
		if($areas)
		$js_str = substr($js_str,0,-1);
		$js_str.="];";
		@file_put_contents($js_file,$js_str);
	}
}


function make_delivery_region_js()
{
	$path = APP_ROOT_PATH."public/runtime/region.js"; 
	if(!file_exists($path))
	{
		$jsStr = "var regionConf = ".get_delivery_region_js();		
		@file_put_contents($path,$jsStr);
	}
}
function get_delivery_region_js($pid = 0)
{

		$jsStr = "";
		$childRegionList = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."delivery_region where pid = ".$pid." order by id asc");
		foreach($childRegionList as $childRegion)
		{
			if(empty($jsStr))
				$jsStr .= "{";
			else
				$jsStr .= ",";
				
			$childStr = get_delivery_region_js($childRegion['id']);
			$jsStr .= "\"r$childRegion[id]\":{\"i\":$childRegion[id],\"n\":\"$childRegion[name]\",\"c\":$childStr}";
		}
		
		if(!empty($jsStr))
			$jsStr .= "}";
		else
			$jsStr .= "\"\"";
				
		return $jsStr;

}
function init_reids(){
	$filename = APP_ROOT_PATH."sys/redis/redis.php";
	if(file_exists($filename)){
		require APP_ROOT_PATH.'sys/redis/redis.php';
		new redis_db($GLOBALS['config']['REDIS_HOST'],$GLOBALS['config']['REDIS_POST'],$GLOBALS['config']['REDIS_PWD']); 
		
	}
}

function update_sys_config()
{
	$filename = APP_ROOT_PATH."sys/db/db_config.php";
	if(!file_exists($filename))
	{
		//定义DB
		require APP_ROOT_PATH.'sys/db/db.php';
		$dbcfg = require_once  APP_ROOT_PATH."sys/db/db_config.php";
		
		define('DB_PREFIX', $dbcfg['DB_PREFIX']); 
		if(!file_exists(APP_ROOT_PATH.'public/runtime/app/db_caches/'))
			mkdir(APP_ROOT_PATH.'public/runtime/app/db_caches/',0777);
		$pconnect = false;
		$db = new mysql_db($dbcfg['DB_HOST'].":".$dbcfg['DB_PORT'], $dbcfg['DB_USER'],$dbcfg['DB_PWD'],$dbcfg['DB_NAME'],'utf8',$pconnect);
		
		//end 定义DB

		$sys_configs = $db->getAll("select * from ".DB_PREFIX."conf");
		$config_str = "<?php\n";
		$config_str .= "return array(\n";
		foreach($sys_configs as $k=>$v)
		{
			$config_str.="'".$v['name']."'=>'".addslashes($v['value'])."',\n";
		}
		$config_str.=");\n ?>";	
		file_put_contents($filename,$config_str);
		$url = APP_ROOT."/";
		app_redirect($url);
	}
}



function valid_tag($str)
{
	
	return preg_replace("/<(?!div|ol|ul|li|sup|sub|span|br|img|p|h1|h2|h3|h4|h5|h6|\/div|\/ol|\/ul|\/li|\/sup|\/sub|\/span|\/br|\/img|\/p|\/h1|\/h2|\/h3|\/h4|\/h5|\/h6|blockquote|\/blockquote|strike|\/strike|b|\/b|i|\/i|u|\/u)[^>]*>/i","",$str);
}

//显示语言
// lang($key,p1,p2......) 用于格式化 sprintf %s
function lang($key)
{
	$args = func_get_args();//取得所有传入参数的数组
	$key = strtoupper($key);
	if(isset($GLOBALS['lang'][$key]))
	{
		if(count($args)==1)
			return $GLOBALS['lang'][$key];
		else
		{
			$result = $key;
			$cmd = '$result'." = sprintf('".$GLOBALS['lang'][$key]."'";
			for ($i=1;$i<count($args);$i++)
			{
				$cmd .= ",'".$args[$i]."'";
			}
			$cmd.=");";
			eval($cmd);
			return $result;
		}
	}
	else
		return $key;
}

function filter_ctl_act_req($str){
	$search = array("../","\n","\r","\t","\r\n","'","<",">","\"","%");
		
	return str_replace($search,"",$str);
}
function isMobile() {
     $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';  
	 	$mobile_browser = '0';  
	 if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))  
	 	$mobile_browser++;  
	 if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))  
	 	 $mobile_browser++;  
	 if(isset($_SERVER['HTTP_X_WAP_PROFILE']))  
	  	$mobile_browser++;  
	 if(isset($_SERVER['HTTP_PROFILE']))  
	  	$mobile_browser++;  
	 $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));  
	 $mobile_agents = array(  
	    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',  
	    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',  
	    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',  
	    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',  
	    'newt','noki','oper','palm','pana','pant','phil','play','port','prox',  
	    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',  
	    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',  
	    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',  
	    'wapr','webc','winw','winw','xda','xda-'
	 );  
	 if(in_array($mobile_ua, $mobile_agents))  
	  	$mobile_browser++;  
	 if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)  
	 	 $mobile_browser++;  
	 // Pre-final check to reset everything if the user is on Windows  
	 if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)  
	  	$mobile_browser=0;  
	 // But WP7 is also Windows, with a slightly different characteristic  
	 if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)  
	  	$mobile_browser++;  
	 if($mobile_browser>0)  
	  	return true;  
	 else
	  	return false;
}


/**
 * 转义html编码去空格
 */
function strim($str)
{
	return quotes(htmlspecialchars(trim($str)));
}

/**
 * 转义去空格
 */
function btrim($str)
{
	return quotes(trim($str));
}

function quotes($content)
{
	//if $content is an array
	if (is_array($content))
	{
		foreach ($content as $key=>$value)
		{
			//$content[$key] = mysql_real_escape_string($value);
			$content[$key] = addslashes($value);
		}
	} else
	{
		//if $content is not an array
		$content = addslashes($content);
		//mysql_real_escape_string($content);
	}
	return $content;
}


function get_gmmtime()
{
	$hs = microtime();
	$hs = explode(" ",$hs);
	$hs = $hs[0];
	$hs = explode(".",$hs);
	$hs = substr($hs[1],3,3);
	$now = NOW_TIME.".".$hs;
	return $now;
}
/**
 * 发送消息函数
 * @param unknown_type $user_id
 * @param unknown_type $content
 * @param unknown_type $type
 * @param unknown_type $id
 */




function isios() {
	//判断手机发送的客户端标志,兼容性有待提高
	if (isset ($_SERVER['HTTP_USER_AGENT'])) {
		$clientkeywords = array (
				'iphone',
				'ipod',
				'mac',
		);
		// 从HTTP_USER_AGENT中查找手机浏览器的关键字
		if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
			return true;
		}
	}
}


function ofc_max($max_value)
{
	$max_value = floor($max_value);
	$begin_val = substr($max_value,0,1);
	$max_length = strlen($max_value)-1;
	$begin_val = intval($begin_val)+1;

	$multi = "1";
	for($i=0;$i<$max_length;$i++)
	{
	$multi.="0";
	}
	$multi = intval($multi);
	$max_value = $begin_val*$multi;

	if($max_value<=10)$max_value = 10;
	if($max_value>10&&$max_value<=200)$max_value = 200;

	return $max_value;
}

/**
 * 散列算法
 * @param unknown_type $value  计算散列的基础值
 * @param unknown_type $count  散列的总基数
 * @return number
 */

function hash_table($value,$count)
{
	$pid = intval(round(hexdec(md5($value))/pow(10,32))%$count);
	return $pid;
}



//获取相应规格的图片地址
//gen=0:保持比例缩放，不剪裁,如高为0，则保证宽度按比例缩放  gen=1：保证长宽，剪裁
function get_spec_image($img_path,$width=0,$height=0,$gen=0,$is_preview=true)
{
	if(defined("IMAGE_ZOOM"))
	{
		$width*=IMAGE_ZOOM;
		$height*=IMAGE_ZOOM;
	}
	//关于ALIOSS的生成
	if($GLOBALS['distribution_cfg']['OSS_TYPE']&&$GLOBALS['distribution_cfg']['OSS_TYPE']=="ALI_OSS")
	{
		$pathinfo = pathinfo($img_path);
		$file = $pathinfo['basename'];
		$dir = $pathinfo['dirname'];
		$dir = str_replace("./public/", "/public/", $dir);

		if($width==0)
		{
			$file_name = $GLOBALS['distribution_cfg']['OSS_DOMAIN'].$dir."/".$file;
		}
		else if($height==0)
		{
			$file_name = $GLOBALS['distribution_cfg']['OSS_DOMAIN'].$dir."/".$file."@".$width."w_1l_1x.jpg";
		}
		else if($gen==0)
			$file_name = $GLOBALS['distribution_cfg']['OSS_DOMAIN'].$dir."/".$file."@".$width."w_".$height."h_0c_1e_1x.jpg"; //以短边缩放 1e 不剪裁
		else
			$file_name = $GLOBALS['distribution_cfg']['OSS_DOMAIN'].$dir."/".$file."@".$width."w_".$height."h_1c_1e_1x.jpg"; //以短边缩放 1e 剪裁
		return $file_name;
	}

	if($width==0||substr($img_path, 0,2)!="./")
		$new_path = $img_path;
	else
	{
		//$img_name = substr($img_path,0,-4);
		//$img_ext = substr($img_path,-3);
		$fileinfo = pathinfo($img_path);
		$img_ext = $fileinfo['extension'];
		$len = strlen($img_ext) + 1;
		$img_name =substr($img_path,0,-$len);

		if($is_preview)
			$new_path = $img_name."_".$width."x".$height.".jpg";
		else
			$new_path = $img_name."o_".$width."x".$height.".jpg";
		if(!file_exists(APP_ROOT_PATH.$new_path))
		{
			require_once APP_ROOT_PATH."sys/utils/es_imagecls.php";
			$imagec = new es_imagecls();
			$thumb = $imagec->thumb(APP_ROOT_PATH.$img_path,$width,$height,$gen,true,"",$is_preview);

			if($GLOBALS['distribution_cfg']['OSS_TYPE']&&$GLOBALS['distribution_cfg']['OSS_TYPE']=="ES_FILE")
			{
				$paths = pathinfo($new_path);
				$path = str_replace("./","",$paths['dirname']);
				$filename = $paths['basename'];
				$pathwithoupublic = str_replace("public/","",$path);

				$file_array['path'] = $pathwithoupublic;
				$file_array['file'] = get_domain().APP_ROOT."/".$path."/".$filename;
				$file_array['name'] = $filename;
				$GLOBALS['curl_param']['images'][] = $file_array;
			}

		}
	}
	//return APP_ROOT."/test.php?path=".$new_path."&rand=".rand(1000000,9999999);
	return $new_path;
}


function get_spec_gif_anmation($url,$width,$height)
{
	require_once APP_ROOT_PATH."sys/utils/gif_encoder.php";
	require_once APP_ROOT_PATH."sys/utils/gif_reader.php";
	require_once APP_ROOT_PATH."sys/utils/es_imagecls.php";
	$gif = new GIFReader();
	$gif->load($url);
	$imagec = new es_imagecls();
	foreach($gif->IMGS['frames'] as $k=>$img)
	{
		$im = imagecreatefromstring($gif->getgif($k));
		$im = $imagec->make_thumb($im,$img['FrameWidth'],$img['FrameHeight'],"gif",$width,$height,$gen=1);
		ob_start();
		imagegif($im);
		$content = ob_get_contents();
		ob_end_clean();
		$frames [ ] = $content;
		$framed [ ] = $img['frameDelay'];
	}

	$gif_maker = new GIFEncoder (
			$frames,
			$framed,
			0,
			2,
			0, 0, 0,
			"bin"   //bin为二进制   url为地址
	);
	return $gif_maker->GetAnimation ( );
}
function isWeixin(){
	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$is_weixin = strpos($agent, 'micromessenger') ? true : false ;
	if($is_weixin){
		return true;
	}else{
		return false;
	}
}
function isQQ(){
	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$is_qq = strpos($agent, 'qq/') ? true : false ;
	if($is_qq){
		return true;
	}else{
		return false;
	}
}






/**
 * 按宽度格式化html内容中的图片
 * @param unknown_type $content
 * @param unknown_type $width
 * @param unknown_type $height
 */
function format_html_content_image($content,$width,$height=0)
{
	global $is_app;
    $res = preg_match_all("/<img.*?src=[\"|\']([^\"|\']*)[\"|\'][^>]*>/i", $content, $matches);
    if($res)
    {
        foreach($matches[0] as $k=>$match)
        {
            $old_path = $matches[1][$k];
            if(preg_match("/\.\/public\//i", $old_path))
            {
            	$origin_path = $matches[1][$k];
                $new_path = get_spec_image($matches[1][$k],$width,$height,0);
                if($is_app)
                	$content = str_replace($match, "<a href='javascript:open_url(\"".$origin_path."\")'><img src='".$origin_path."' lazy='true' /></a>", $content);
                else
               		$content = str_replace($match, "<a href='".$origin_path."'><img src='".$origin_path."' lazy='true' /></a>", $content);
            }
        }
    }

    return $content;
}
/**
 * 带域名连接替换成public
 * @param unknown $str
 * @return mixed
 */
function replace_domain_to_public($str){
    //对图片路径的修复
    if($GLOBALS['distribution_cfg']['OSS_TYPE']&&$GLOBALS['distribution_cfg']['OSS_TYPE']!="NONE")
    {
        $domain = $GLOBALS['distribution_cfg']['OSS_DOMAIN'];
    }
    else
    {
        $domain = SITE_DOMAIN.APP_ROOT;
    }

    return str_replace($domain."/public/","./public/",$str);
}

function check_remote_file_exists($url)
{
	$curl = curl_init($url);
	// 不取回数据
	curl_setopt($curl, CURLOPT_NOBODY, true);
	// 发送请求
	$result = curl_exec($curl);
	$found = false;
	// 如果请求没有发送失败
	if ($result !== false) {
		// 再检查http响应码是否为200
		$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		if ($statusCode == 200) {
			$found = true;
		}
	}
	curl_close($curl);

	return $found;
}

/**
 * 模拟get post 请求
 */
function curl_get_data($url,$get = 'get',$array='',$time=3){
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
// 	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
// 		'https://ebspay.boc.cn'

// 	));
	
	
	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
 	curl_setopt($curl, CURLOPT_REFERER,"https://ebspay.boc.cn");
 	curl_setopt($curl, CURLOPT_ENCODING, "gzip, deflate, sdch");
	
 	//curl_setopt($curl, CURLOPT_CAINFO, 'D:\phpStudy1\cacert.pem');
//	pp($array);
	if($get=='post'){
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS,http_build_query($array));
	}
	if($get=='post_arr'){
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS,($array));
		
	}
//  	curl_setopt($curl, CURLOPT_NOBODY, false);
//  	curl_setopt($curl, CURLOPT_HEADER, 1);
// 	curl_setopt($curl,CURLOPT_BINARYTRANSFER,1);
 // 	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
 // 	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
	//curl_setopt($curl, CURLOPT_SAFE_UPLOAD, true);
	curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
	
	curl_setopt($curl, CURLOPT_TIMEOUT,$time);
	
	$data = curl_exec($curl);
	//pp()$data = $data->asXML();
	//var_dump($data);
	header("Content-type:text/html;charset=utf-8");
	
	//pay_logs($data,'fail',$array);
	if($data===false){
		FF('fail_curl'.to_date(NOW_TIME,'Y-m-d'),curl_error($curl));
	}
	curl_close($curl);
	
	return $data;
}
/**
 * 通过curl下载文件到指定位置
 * @param unknown_type $file 远程文件
 * @param unknown_type $dest 存储位置
 */
function curl_download($file,$dest)
{
	$ch = curl_init($file);
	$fp = fopen($dest, "wb");
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$res=curl_exec($ch);
	curl_close($ch);
	fclose($fp);
	return $res;
}

function gen_scan_qrcode($url,$size=3)
{
	if(substr($url, 0,1)=="/")
	{
		$url = SITE_DOMAIN.$url;
	}
	return gen_qrcode($url,$size);
}



/**
 * 合并adm_cfg中的配置文件
 * @param unknown_type $config  //原配置
 * @param unknown_type $config_file  //新配置文件
 */
function array_merge_admnav($config,$config_file)
{
	if(!file_exists($config_file))
	{
		return $config;
	}
	$new_config = require $config_file;
	foreach($new_config as $k=>$v)
	{
		if($config[$k])
		{
			foreach($v['groups'] as $kk=>$vv)
			{
				if($config[$k]['groups'][$kk])
				{
					foreach($vv['nodes'] as $kkk=>$vvv)
					{
						$config[$k]['groups'][$kk]['nodes'][] = $vvv;
					}
				}
				else
				{
					$config[$k]['groups'][$kk] = $vv;
				}
			}
		}
		else
		{
			$config[$k] = $v;
		}
	}
	return $config;
}


/**
 * 合并adm_node中的配置文件
 * @param unknown_type $config  //原配置
 * @param unknown_type $config_file  //新配置文件
 */
function array_merge_admnode($config,$config_file)
{
	if(!file_exists($config_file))
	{
		return $config;
	}
	$new_config = require $config_file;
	foreach($new_config as $k=>$v)
	{
		if($config[$k])
		{
			foreach($v['node'] as $kk=>$vv)
			{
				$config[$k]['node'][$kk] = $vv;
			}
		}
		else
		{
			$config[$k] = $v;
		}
	}
	return $config;
}

/**
 * 合并mobile_cfg中的配置文件
 * @param unknown_type $config  //原配置
 * @param unknown_type $config_file  //新配置文件
 */
function array_merge_mobile_cfg($config,$config_file)
{
	if(!file_exists($config_file))
	{
		return $config;
	}
	$new_config = require $config_file;
	foreach($new_config as $k=>$v)
	{
		if($config[$k])
		{
			foreach($v['nav'] as $kk=>$vv)
			{
				$config[$k]['nav'][$kk] = $vv;
			}
		}
		else
		{
			$config[$k] = $v;
		}
	}
	return $config;
}

/**
 * 合并web_cfg_web_nav中的配置文件
 * @param unknown_type $config  //原配置
 * @param unknown_type $config_file  //新配置文件
 */
function array_merge_web_nav($config,$config_file)
{
	if(!file_exists($config_file))
	{
		return $config;
	}
	$new_config = require $config_file;
	foreach($new_config as $k=>$v)
	{
		if($config[$k])
		{
			foreach($v['acts'] as $kk=>$vv)
			{
				$config[$k]['acts'][$kk] = $vv;
			}
		}
		else
		{
			$config[$k] = $v;
		}
	}
	return $config;
}


/**
 * 合并uc_node中的配置文件
 * @param unknown_type $config  //原配置
 * @param unknown_type $config_file  //新配置文件
 */
function array_merge_ucnode($config,$config_file)
{
	if(!file_exists($config_file))
	{
		return $config;
	}
	$new_config = require $config_file;
	foreach($new_config as $k=>$v)
	{
		if($config[$k])
		{
			foreach($v['node'] as $kk=>$vv)
			{
				$config[$k]['node'][$kk] = $vv;
			}
		}
		else
		{
			$config[$k] = $v;
		}
	}
	return $config;
}



//以下是微信公众平台的消息发送函数

/**
 * 获取微信消息模板的内容
 * @param unknown_type $template_id 模板ID，详见wx_template_cfg.php
 * @param unknown_type $tmpl  对应的DB中的模板数据集
 * @param unknown_type $param 对应ID传入的参数
 * 
 * 返回
 * array(
 * 	status=>必返回   info=>status为false时返回  url=>可为空，表示消息的跳转页  data=>必返回，为指定模板的实际内容
 * )
 * 
 */
function get_wx_msg_content($template_id,$tmpl,$user_id,$wx_account,$param=array())
{	
	$data=unserialize($tmpl['msg']);
	
	switch ($template_id)
	{
		case "OPENTM201490080": //订单支付成功模板
			if(empty($param))
			{
// 				{{first.DATA}}
// 				订单编号：{{keyword1.DATA}}
// 				商品详情：{{keyword2.DATA}}
// 				订单金额：{{keyword3.DATA}}
// 				{{remark.DATA}}
				$data['keyword1']=array('value'=>'00000000','color'=>'#000000');
				$data['keyword2']=array('value'=>'这是一款测试的商品','color'=>'#000000');
				$data['keyword3']=array('value'=>'100元','color'=>'#000000');
				$url = SITE_DOMAIN.wap_url("index");
				return array("status"=>true,"url"=>$url,"data"=>$data);
			}
			else
			{
				$order_id = intval($param['order_id']);
				$order_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_order where id = ".$order_id);
				if(empty($order_info))
				{
					return array("status"=>false,"info"=>"订单不存在");
				}
				$deal_order_items = $GLOBALS['db']->getAll("select name,sub_name from ".DB_PREFIX."deal_order_item where order_id = ".$order_id." and supplier_id = ".$wx_account['user_id']);
				if(empty($deal_order_items))
				{
					return array("status"=>false,"info"=>"订单不存在");
				}
				$order_price = round($order_info['total_price'],2)."元";
				if(count($deal_order_items)>1)
				{
					$item_name = $deal_order_items[0]['sub_name']."等";
				}
				else
				{
					$item_name = $deal_order_items[0]['sub_name'];
				}
				
				$data['keyword1']=array('value'=>$order_info['order_sn'],'color'=>'#000000');
				$data['keyword2']=array('value'=>$item_name,'color'=>'#000000');
				$data['keyword3']=array('value'=>$order_price,'color'=>'#000000');
				$url = SITE_DOMAIN.wap_url("index","uc_order",array("pay_status"=>2,"id"=>$order_id));
				return array("status"=>true,"url"=>$url,"data"=>$data);
			}
			break;
		case "TM00430": //退款成功通知
			if(empty($param))
			{
// 				{{first.DATA}}
				
// 				退款金额：{{orderProductPrice.DATA}}
// 				商品详情：{{orderProductName.DATA}}
// 				订单编号：{{orderName.DATA}}
// 				{{remark.DATA}}
				$data['orderProductPrice']=array('value'=>'100元','color'=>'#000000');
				$data['orderProductName']=array('value'=>'这是一款测试的商品','color'=>'#000000');
				$data['orderName']=array('value'=>'00000000','color'=>'#000000');
				$url = SITE_DOMAIN.wap_url("index");
				return array("status"=>true,"url"=>$url,"data"=>$data);
			}
			else
			{
				$order_id = intval($param['order_id']);
				$refund_price = round($param['refund_price'],2)."元";
				$deal_name = strim($param['deal_name']);
				$order_sn = strim($param['order_sn']);
				
				$data['orderProductPrice']=array('value'=>$refund_price,'color'=>'#000000');
				$data['orderProductName']=array('value'=>$deal_name,'color'=>'#000000');
				$data['orderName']=array('value'=>$order_sn,'color'=>'#000000');
				$url = SITE_DOMAIN.wap_url("index","uc_order",array("pay_status"=>2,"id"=>$order_id));
				return array("status"=>true,"url"=>$url,"data"=>$data);
			}
			break;
		case "OPENTM200565259": //订单发货提醒
			if(empty($param))
			{
// 				{{first.DATA}}
// 				订单编号：{{keyword1.DATA}}
// 				物流公司：{{keyword2.DATA}}
// 				物流单号：{{keyword3.DATA}}
// 				{{remark.DATA}}
				$data['keyword1']=array('value'=>'00000000','color'=>'#000000');
				$data['keyword2']=array('value'=>'顺风快递','color'=>'#000000');
				$data['keyword3']=array('value'=>'00000000','color'=>'#000000');
				$url = SITE_DOMAIN.wap_url("index");
				return array("status"=>true,"url"=>$url,"data"=>$data);
			}
			else
			{
				$order_id = intval($param['order_id']);
				$order_sn = strim($param['order_sn']);
				$company_name = strim($param['company_name']);
				$delivery_sn = strim($param['delivery_sn']);
				$order_item_id = intval($param['order_item_id']);
				
				$data['keyword1']=array('value'=>$order_sn,'color'=>'#000000');
				$data['keyword2']=array('value'=>$company_name,'color'=>'#000000');
				$data['keyword3']=array('value'=>$delivery_sn,'color'=>'#000000');
				$url = SITE_DOMAIN.wap_url("index","uc_order#check_delivery",array("item_id"=>$order_item_id));
				return array("status"=>true,"url"=>$url,"data"=>$data);
			}
			break;
		case "OPENTM202314085": //订单确认收货通知
			if(empty($param))
			{
// 				{{first.DATA}}
// 				订单号：{{keyword1.DATA}}
// 				商品名称：{{keyword2.DATA}}
// 				下单时间：{{keyword3.DATA}}
// 				发货时间：{{keyword4.DATA}}
// 				确认收货时间：{{keyword5.DATA}}
// 				{{remark.DATA}}
				$data['keyword1']=array('value'=>'00000000','color'=>'#000000');
				$data['keyword2']=array('value'=>'这是一款测试商品','color'=>'#000000');
				$data['keyword3']=array('value'=>'2015-07-01 12:00:00','color'=>'#000000');
				$data['keyword4']=array('value'=>'2015-07-01 14:00:00','color'=>'#000000');
				$data['keyword5']=array('value'=>'2015-07-05 14:00:00','color'=>'#000000');
				$url = SITE_DOMAIN.wap_url("index");
				return array("status"=>true,"url"=>$url,"data"=>$data);
			}
			else
			{
				$order_item_id = intval($param['order_item_id']);
				$order_item = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_order_item where id = ".$order_item_id);
				$order_id = $order_item['order_id'];
				if(empty($order_item))
				{
					return array("status"=>false,"info"=>"订单不存在");
				}
				$order_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_order where id = ".$order_id);
				if(empty($order_info))
				{
					return array("status"=>false,"info"=>"订单不存在");
				}
				$delivery_notice = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."delivery_notice where order_item_id = ".$order_item_id);
				if(empty($delivery_notice))
				{
					return array("status"=>false,"info"=>"订单不存在");
				}
				
				
				$total_count = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."delivery_notice where notice_sn = '".$delivery_notice['notice_sn']."' and order_id=".$order_id." and is_arrival = 1");
				if($total_count>1)
				{
					$deal_name = $order_item['sub_name']."等";
				}
				else
				{
					$deal_name = $order_item['sub_name'];
				}
				$data['keyword1']=array('value'=>$order_info['order_sn'],'color'=>'#000000');
				$data['keyword2']=array('value'=>$deal_name,'color'=>'#000000');
				$data['keyword3']=array('value'=>to_date($order_info['create_time']),'color'=>'#000000');
				$data['keyword4']=array('value'=>to_date($delivery_notice['delivery_time']),'color'=>'#000000');
				$data['keyword5']=array('value'=>to_date(NOW_TIME),'color'=>'#000000');
				$url = SITE_DOMAIN.wap_url("index","uc_order",array("pay_status"=>2,"id"=>$order_id));
				return array("status"=>true,"url"=>$url,"data"=>$data);
				
			}
			break;
		case "OPENTM200738546": //电子凭证验证成功通知
			if(empty($param))
			{
// 				{{first.DATA}}
// 				凭证类型：{{keyword1.DATA}}
// 				凭证属性：{{keyword2.DATA}}
// 				验证时间：{{keyword3.DATA}}
// 				{{remark.DATA}}
				$data['keyword1']=array('value'=>'xxxxx电子凭证','color'=>'#000000');
				$data['keyword2']=array('value'=>'电子券','color'=>'#000000');
				$data['keyword3']=array('value'=>'2015-07-01 12:00:00','color'=>'#000000');
				$url = "";
				return array("status"=>true,"url"=>$url,"data"=>$data);
			}
			else
			{
				$coupon_sn = strim($param['coupon_sn']);
				$coupon = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_coupon where password ='".$coupon_sn."'");
				if(empty($coupon))
				{
					return array("status"=>false,"info"=>"电子券不存在");
				}
				if($coupon['confirm_time']==0)
				{
					return array("status"=>false,"info"=>"电子券未使用");
				}
				$deal_item = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_order_item where id = ".$coupon['order_deal_id']);
				
				if(empty($deal_item))
				{
					return array("status"=>false,"info"=>"订单不存在");
				}
				
				$data['keyword1']=array('value'=>$deal_item['sub_name'].'电子凭证['.$coupon_sn.']','color'=>'#000000');
				$data['keyword2']=array('value'=>'电子券','color'=>'#000000');
				$data['keyword3']=array('value'=>to_date($coupon['confirm_time']),'color'=>'#000000');
				$url = "";
				return array("status"=>true,"url"=>$url,"data"=>$data);
					
			}
			break;
		default:
			return array("status"=>false,"info"=>"模板编号不存在");
			break;
	}
	
}


/**
 * 发送微信消费
 * @param unknown_type $template_id_short 模板类型 的ID，即模板编号
 * @param unknown_type $user_id  会员ID
 * @param unknown_type $wx_account 公众平台授权帐号
 * @param unknown_type $param 不同模板类型传入的参数，在get_wx_msg_content函数中细分，不传为演示
 * @return array(status,info);
 */
function send_wx_msg($template_id_short,$user_id,$wx_account,$param=array())
{
	
	$weixin_conf = load_auto_cache("weixin_conf");
	if(!$weixin_conf['platform_status'])
	{
		return array(
			"status" => false,
			"info" => "平台功能未开通"
		);
	}

	$openid =  $GLOBALS['db']->getOne("select openid from ".DB_PREFIX."weixin_user where user_id = '".$user_id."' and account_id = ".$wx_account['user_id']);		
	if(!$openid)
	{
		return array(
				"status" => false,
				"info" => "微信用户未授权"
		);
	}
	if(!$wx_account)
	{
		return array(
				"status" => false,
				"info" => "公众号未授权"
		);
	}
	
	$tmpl = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."weixin_tmpl where account_id = '".$wx_account['user_id']."' and template_id_short = '".$template_id_short."'");
	if(!$tmpl)
	{
		return array(
				"status" => false,
				"info" => "未安装该消息模板"
		);
	}
	
	$result = get_wx_msg_content($template_id_short,$tmpl,$user_id,$wx_account,$param);
	if(!$result['status'])
	{
		return $result;
	}
	
	if($param)
	{
		require_once APP_ROOT_PATH."sys/model/user.php";
		$user_info = load_user($user_id);
		$tmpl['is_allow_wx'] = 1;
		$msg_data = array();
		$msg_result = array();
		$msg_data['dest'] = $openid;
		$msg_data['send_type'] = 2;		
		$msg_result['url'] = $result['url'];
		$msg_result['data'] = $result['data'];
		$msg_result['template_id'] = $tmpl['template_id'];
		$msg_result['account_id'] = $wx_account['id'];
		$msg_data['content'] = serialize($msg_result);
		send_msg_item_add($tmpl, $user_info, $msg_data);
	}
	else
	{
		require_once APP_ROOT_PATH."sys/wechat/platform_wechat.class.php";
		
		$option = array();
		$option['authorizer_access_token']=$wx_account['authorizer_access_token'];
		$option['authorizer_access_token_expire']=$wx_account['expires_in'];
		$option['authorizer_appid']=$wx_account['authorizer_appid'];
		$option['authorizer_refresh_token']=$wx_account['authorizer_refresh_token'];
		$platform= new PlatformWechat($option);
		$platform->check_platform_authorizer_token();
			
		
		
			
		$info=array(
				'touser'=>$openid,
				'template_id'=>$tmpl['template_id'],
				'url'=>$result['url'],
				'topcolor'=>'#000000',
				'data'=>$result['data']
		);
		$result=$platform->sendTemplateMessage($info);
		if($result){
			if(isset($result['errcode'])&&$result['errcode']>0){
				return array(
						"status" => false,
						"info" => $result['errMsg']
				);
			}else{
				return array(
						"status" => true,
						"info" => "发送成功"
				);
			}
		}else{
			return array(
					"status" => false,
					"info" => "通讯失败"
			);
		}
	}
}



//end微信公众平台消息发送
/**
 * 验证关键词的是否重复
 * @param unknown_type $keywords
 * @param unknown_type $reply_id
 * @param unknown_type $match_type
 */
function word_check($keywords,$reply_id = 0,$match_type = 0,$supplier_id = 0)
{
	if($match_type == 0){
		$keywords = preg_split("/[ ,]/i",$keywords);
		$exists_keywords = array();
		foreach($keywords as $tag){
			$tag = trim($tag);
			if($tag != ''){
				$unicode_tag =  str_to_unicode_string(trim($tag));
					
				$condition =" account_id=".$supplier_id."  and id <> ".$reply_id." ";
				if($unicode_tag){
					$condition .= " and (match(keywords_match) AGAINST ('".$unicode_tag."' IN BOOLEAN MODE) or keywords = '".$tag."')";
					//$where['keywords_match'] = array('match',$unicode_tag);
				}
				$count = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."weixin_reply where ".$condition);
				if($count > 0){
					$exists_keywords[] = trim($tag);
					break;
				}
			}
		}
	}else{
		$keywords = trim($keywords);
		if($keywords != ''){
	
			
			$unicode_tag =  str_to_unicode_string(trim($keywords));
				
			$condition =" account_id=".$supplier_id."  and id <> ".$reply_id." ";
			if($unicode_tag){
				$condition .= " and (match(keywords_match) AGAINST ('".$unicode_tag."' IN BOOLEAN MODE) or keywords = '".$keywords."')";
			}
			$count = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."weixin_reply where ".$condition);
			
				
			if($count > 0){
				$exists_keywords[] = $keywords;
			}
		}
	}
	return $exists_keywords;
}


/**
 * 同步公众号回复的索引
 * @param unknown_type $reply_id
 */
function syncMatch($reply_id){

	$reply_data['keywords_match'] = "";
	$reply_data['keywords_match_row'] = "";
	$GLOBALS['db']->autoExecute(DB_PREFIX."weixin_reply", $reply_data, $mode = 'UPDATE', "id=".$reply_id, $querymode = 'SILENT');

	$reply_data = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."weixin_reply where id = ".$reply_id);

	$keywords = $reply_data['keywords'];
	$keywords = preg_split("/[ ,]/i",$keywords);
	foreach($keywords as $tag)
	{
		insert_match_item(trim($tag),"weixin_reply",$reply_id,"keywords_match");
	}

}

function csrf_gate()
{
	$http_referer = $_SERVER['HTTP_REFERER'];
	if($http_referer)
	{
		if(strpos($http_referer, SITE_DOMAIN)!==0)
		{
			header("Content-Type:text/html; charset=utf-8");
			die("非法的操作访问");
		}
	}
	else
	{
		header("Content-Type:text/html; charset=utf-8");
		die("非法的操作访问");
	}
}




/**
 * 请求api接口
 * @param unknown_type $act 接口名
 * @param unknown_type $param 参数
 *
 * 返回：array();
 */

function D($request_param,$m='Application'){
	
	require_once APP_ROOT_PATH.'Application/model.class.php';
	
	$model = new model($request_param,$m);
	return $model->obj();
}
/**
 * 字符串命名风格转换
 * type 0 将Java风格转换为C的风格 1 将C风格转换为Java的风格
 * @param string $name 字符串
 * @param integer $type 转换类型
 * @return string
 */
function parse_name($name, $type=0) {
	if ($type) {
		return ucfirst(preg_replace_callback('/_([a-zA-Z])/', function($match){return strtoupper($match[1]);}, $name));
	} else {
		return strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $name), "_"));
	}
}
//去空格，不允许非法的路径引入
function sltrim($str)
{
	$str =  addslashes(htmlspecialchars(trim($str)));
	$str = preg_replace("/[\.|\/]/", "", $str);
	return $str;
}

function send_register_reward($user_id,$date_time="",$pid=0){
	if($user_id == 0)
		return false;
	if($date_time==""){
		$date_time = to_date(TIME_UTC);
	}
	$register_money = doubleval(app_conf("USER_REGISTER_MONEY"));
	$register_score = intval(app_conf("USER_REGISTER_SCORE"));
	$register_point = intval(app_conf("USER_REGISTER_POINT"));
	$register_lock_money = intval(app_conf("USER_LOCK_MONEY"));
	$register_redbag = intval(app_conf("USER_REGISTER_REDBAG"));
	if($register_money>0||$register_score>0 || $register_point > 0 || $register_lock_money>0 )
	{
		$user_get['score'] = $register_score;
		$user_get['money'] = $register_money;
		$user_get['point'] = $register_point;
		$user_get['lock_money'] = $register_lock_money;
		modify_account($user_get,intval($user_id),"在".$date_time."注册成功",18);
	}
	if($register_redbag > 0){
		modify_account(array('money'=>$register_redbag,'nmc_amount'=>$register_redbag),intval($user_id),"在".$date_time."注册成功,送红包",18);
	}

	//红包
	//获取未过期的注册红包
	$ecv_list = $GLOBALS['db']->getAll("SELECT * FROM ".DB_PREFIX."ecv_type WHERE end_time +24*3600-1 > ".TIME_UTC." AND send_type=3 ");
	if($ecv_list){
		foreach($ecv_list as $k=>$v){
			require_once APP_ROOT_PATH."system/libs/voucher.php";
			send_voucher($v['id'],$user_id,0);
		}
	}

	/*
	 * 邀请送体验金
	 */
	if($pid >0){
		$learn_invite = $GLOBALS['db']->getOne("select sum(lsl.money) from ".DB_PREFIX."learn_send_list lsl left join ".DB_PREFIX."learn_type lt on lsl.type_id = lt.id where lt.type = 1 and lsl.is_effect = 1 and lsl.user_id ='".$pid."' ");
		$learn_type_invite = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."learn_type where type = 1 and begin_time < '".$date_time."' and '".$date_time."' < end_time and is_effect = 1 and '$learn_invite'< max_money order by id desc limit 1 ");
		if($learn_type_invite){
			$learn_invite_data['user_id'] = $pid;
			$learn_invite_data['type_id'] = $learn_type_invite['id'];
			$learn_invite_data['money'] = $learn_type_invite['money'];
			$learn_invite_data['type'] = 0;
			$learn_invite_data['begin_time'] = $now_time;
			$end_time = to_timespan($now_time)+$learn_type_invite['time_limit'] * 24 * 3600 ;
			$learn_invite_data['end_time'] = to_date($end_time,'Y-m-d H:i:s');
			$learn_invite_data['is_use'] = 0;
			$learn_invite_data['is_effect'] = 1;
			$GLOBALS['db']->autoExecute(DB_PREFIX."learn_send_list",$learn_invite_data);

		}
	}

	/*
	 * 注册送体验金
	 */
	$learn_type = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."learn_type where type = 0 and begin_time < '".$date_time."' and '".$date_time."' < end_time and is_effect = 1 order by id desc limit 1 ");
	if($learn_type){
		$learn_send_data['user_id'] = $user_id;
		$learn_send_data['type_id'] = $learn_type['id'];
		$learn_send_data['money'] = $learn_type['money'];
		$learn_send_data['type'] = 0;
		$learn_send_data['begin_time'] = $now_time;
		$end_time = to_timespan($now_time)+$learn_type['time_limit'] * 24 * 3600 ;
		$learn_send_data['end_time'] = to_date($end_time,'Y-m-d H:i:s');
		$learn_send_data['is_use'] = 0;
		$learn_send_data['is_effect'] = 1;
		$GLOBALS['db']->autoExecute(DB_PREFIX."learn_send_list",$learn_send_data);

	}
}




?>