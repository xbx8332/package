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
class f_licaiController extends baseController
{
	public function __construct()
	{
		if(!is_role('lcgl'))
			alert('您没有权限',0,url('admin',"r=index"));
	}
	
	public function over_suess(){
		$id=$_REQUEST['id'];
	
		if($id){
		$data  = $GLOBALS['db']->getRow('select * from '.DB_PREFIX."licai_redempte where id = ".$id);
// 		pp($data);;die;
		$user_id = $data['user_id'];
		$order_id = $data['order_id'];
		$GLOBALS['db']->query('update '.DB_PREFIX."licai_redempte set status = 1 where id =".$id);
		$GLOBALS['db']->query('update '.DB_PREFIX."licai_order set status = 3 where id =".$order_id);
		$money = $data['money']+$data['earn_money'];
		//$data  = $GLOBALS['db']->getRow('select * from '.DB_PREFIX."licai_redempte where id = ".$id);
		modify_account(array('money'=>$money),$user_id,'固定理财赎回',5);
	echo 	json_encode(array('msg'=>'处理完成','status'=>1));
		}else{
	echo 		json_encode(array('msg'=>'没有这个订单','status'=>0));
		}
		
	}
	public function over(){

		
		$condition = " and lc.type =1 ";
		$r_id = intval($_REQUEST["id"]);
		if($r_id)
		{
			$condition = " and lcr.id =".$r_id;
		}
		
		
		if(strim($_REQUEST["p_name"]) != "")
		{
			$condition .= " and lc.name like '%".strim($_REQUEST["p_name"])."%'";
		}
		
		if(strim($_REQUEST["user_name"]) != "")
		{
			$condition .= " and lco.user_name like '%".strim($_REQUEST["user_name"])."%'";
		}
		if(strim($_REQUEST["status"]) =="" || strim($_REQUEST["status"]) == "-1")
		{
			$condition .= " and lcr.status in (0,1,2) ";
		}
		else
		{
			$condition .= " and lcr.status = ".intval($_REQUEST["status"]);
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
			$condition .= " and lcr.create_date >= '".strim($start_time)."'";
			$GLOBALS['tmpl']->assign("start_time",$start_time);
		}
		if(strim($end_time) !="")
		{
			$condition .= " and lcr.create_date <= '".  strim($end_time)."'";
			$GLOBALS['tmpl']->assign("end_time",$end_time);
		}
		
		//排序字段 默认为主键名
		if (isset ( $_REQUEST ['_order'] )) {
			if(strim($_REQUEST['_order']) != "id" && strim($_REQUEST['_order']) != "user_name")
			{
				$order = strim($_REQUEST ['_order']);
				if($order == "show_rate_format" ||$order == "breach_money_format" ||  $order == "fee_money_format")
				{
					$order = "";
				}
			}
			else
			{
				$order = "lcr.".strim($_REQUEST ['_order']);
			}
		} else {
			$order = " lcr.id ";
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
		
		$page_size = 10;
		
		$limit = (($page-1)*$page_size).",".$page_size;
		$result = array();
		
		$result['count'] = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."licai_redempte lcr
		left join ".DB_PREFIX."licai_order lco on lcr.order_id = lco.id
		left join ".DB_PREFIX."licai lc on lco.licai_id = lc.id where 1=1 ".$condition);
		if($result['count'] > 0){
				
			$result['list'] = $GLOBALS['db']->getAll("SELECT lcr.*,lco.user_name,lco.licai_id,lco.money as order_money,
			lc.type as licai_type, lc.name,lco.begin_interest_date,
			lco.site_buy_fee,lco.redempte_money ,lco.money-lco.site_buy_fee-lco.redempte_money as have_money
			FROM ".DB_PREFIX."licai_redempte lcr
			left join ".DB_PREFIX."licai_order lco on lcr.order_id = lco.id
			left join ".DB_PREFIX."licai lc on lco.licai_id = lc.id where 1=1 ".$condition.$order_str." limit ".$limit);
		
		}
		
		$sort = $sort == 'desc' ? 1 : 0; //排序方式
		
		$GLOBALS['tmpl']->assign ( 'sort', $sort );
		$order = str_replace("lcr.","",$order);
		$GLOBALS['tmpl']->assign ( 'order', $order );
		$GLOBALS['tmpl']->assign ( 'sortImg', $sortImg );
		$GLOBALS['tmpl']->assign ( 'sortType', $sortAlt );
		
		foreach($result['list']  as $k => $v)
		{
			switch($v["licai_type"])
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
			//0表示未赎回 1表示已赎回 2表示拒绝
			if($v["status"] == 0)
			{
				$result["list"][$k]["status_format"] = "未赎回";
			}
			elseif($v["status"] == 1)
			{
				$result["list"][$k]["status_format"] = "已赎回";
			}
			elseif($v["status"] == 2)
			{
				$result["list"][$k]["status_format"] = "已拒绝";
			}
			//持有金额
			//$v["have_money"] = $v["order_money"] - $v["site_buy_fee"] - $v["redempte_money"];
				
			$result["list"][$k]["have_money_format"] = format_price($v["have_money"]);
				
			if($v["licai_type"] > 0 )
			{
				$licai_interest["breach_rate"] = $GLOBALS['db']->getOne('select interest_rate from '.DB_PREFIX."licai_order where id = ".$v['order_id']);
			}
			else
			{
				$interest = get_licai_interest_yeb($v["licai_id"],$v['begin_interest_date'],$v['create_date']);
				$licai_interest = number_format($interest["avg_interest_rate"],2);
			}
			
			if($v["licai_type"] > 0 ){
		
				if($v["type"] == 0)
				{
					$v["show_rate"] = $licai_interest["before_breach_rate"];
				}
				elseif($v["type"] == 1)
				{
					$v["show_rate"] = $licai_interest["breach_rate"];
				}
				elseif($v["type"] == 2)
				{
					$v["show_rate"] = $licai_interest["interest_rate"];
				}
		
			}
			else
			{
				$v["show_rate"] = $licai_interest;
			}
				
			$result["list"][$k]["show_rate_format"] = number_format($v["show_rate"],2)."%";
				
			$result["list"][$k]["earn_money_format"] = format_price($v["earn_money"]);
		
			$result["list"][$k]["fee_money_format"] = format_price($v["fee"]);
			//赎回金额
			$result["list"][$k]["money_format"] = format_price($v["money"]);
			
			$result["list"][$k]["redempte_money"] = $v['money']+$v["earn_money"];
		}
		
		
		//pp($result);die;
		$page = new Page($result['count'],$page_size);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('page',$p);
		$GLOBALS['tmpl']->assign("data",$result['list']);
		$GLOBALS['tmpl']->assign('main_title',"理财赎回管理");
		$GLOBALS['tmpl']->display ('f_licai/over-list.html');
		
	}
	
	public function grant(){
		
		
		$page = intval($_REQUEST['page']);
		if($page==0)
			$page = 1;
		$limit = (($page-1)*app_conf("DEAL_PAGE_SIZE")).",".app_conf("DEAL_PAGE_SIZE");
		$data =$GLOBALS['db']->getAll("select l.name,p.* from ".DB_PREFIX."licai_profit as p join ".DB_PREFIX."licai as l on l.id = p.licai_id order by p.id desc limit ".$limit." ");
		$count=$GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."licai_profit as p join ".DB_PREFIX."licai as l on l.id = p.licai_id");
		$page_pram = "";
		foreach($page_args as $k=>$v){
			$page_pram .="&".$k."=".$v;
		}
		
		$page = new Page($count,app_conf("DEAL_PAGE_SIZE"),$page_pram);   //初始化分页对象
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign("page",$p);
		$GLOBALS['tmpl']->assign('data',$data);
		$GLOBALS['tmpl']->assign('main_title',"理财赎回管理");
		$GLOBALS['tmpl']->display ('f_licai/ff-list.html');
		
	}
	
}
?>