<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 * 
 */
require_once APP_ROOT_PATH.'/Application/common.php';
require_once APP_ROOT_PATH.'/Application/lib.php';
$wap_config = require_once APP_ROOT_PATH."/Application/config.php";
$lang = require_once APP_ROOT_PATH."Application/lang/zh-cn/lang.php";
$IMG_APP_ROOT = APP_ROOT;
define("APP_INDEX","wap_index");
define("CACHE_SUBDIR",$GLOBALS['wap_config']['CACHE_SUBDIR']);

define("TMPL_NAME",$GLOBALS['wap_config']['TMPL_NAME']);

filter_injection($_REQUEST);
if(!file_exists(APP_ROOT_PATH.'public/runtime/'.CACHE_SUBDIR.'/'))
{
	mkdir(APP_ROOT_PATH.'public/runtime/'.CACHE_SUBDIR.'/',0777);
}

if(!file_exists(APP_ROOT_PATH.'public/runtime/'.CACHE_SUBDIR.'/tpl_caches/'))
	mkdir(APP_ROOT_PATH.'public/runtime/'.CACHE_SUBDIR.'/tpl_caches/',0777);
if(!file_exists(APP_ROOT_PATH.'public/runtime/'.CACHE_SUBDIR.'/tpl_compiled/'))
	mkdir(APP_ROOT_PATH.'public/runtime/'.CACHE_SUBDIR.'/tpl_compiled/',0777);
$GLOBALS['tmpl']->cache_dir      = APP_ROOT_PATH . 'public/runtime/'.CACHE_SUBDIR.'/tpl_caches';
$GLOBALS['tmpl']->compile_dir    = APP_ROOT_PATH . 'public/runtime/'.CACHE_SUBDIR.'/tpl_compiled';
$GLOBALS['tmpl']->template_dir   = APP_ROOT_PATH .'Application/Tpl/'. TMPL_NAME;

//定义模板路径
$tmpl_path = SITE_DOMAIN.APP_ROOT."/"."Application/Tpl/";

$GLOBALS['tmpl']->assign("TMPL",$tmpl_path.TMPL_NAME);
$GLOBALS['tmpl']->assign("TMPL_REAL",APP_ROOT_PATH."Application/Tpl/".TMPL_NAME); 
$GLOBALS['tmpl']->assign("APP_INDEX",APP_INDEX);

$GLOBALS['tmpl']->assign("APP_ROOT",APP_ROOT);

$page_type_arr = array("app");
global $page_type;
if(empty($page_type)){
    if(in_array(strim($_REQUEST['page_type']),$page_type_arr))
        $page_type = strim($_REQUEST['page_type']);
}

$GLOBALS['tmpl']->assign("PAGE_TYPE",$page_type);
//定义通讯对象
require_once APP_ROOT_PATH."sys/utils/transport.php";
$transport = new transport;
$transport->use_curl = true;

$_REQUEST = array_merge($_GET,$_POST);
filter_request($_REQUEST);
convert_req($_REQUEST);

//$m_config = getMConfig();//初始化手机端配置

//初始化session
global $sess_id;
global $define_sess_id;
$sess_id = strim($_REQUEST['sess_id']);
if($sess_id)
{
	$sess_verify = strim($_REQUEST['sess_verify']);
	//开始为session获取一个新分配的id
	$alloc_sess_id = es_session::id();
	
	//再用指定sess_id打开
	$define_sess_id = true;
	es_session::set_sessid($sess_id);
	es_session::restart();
	unset($_REQUEST['sess_id']);
	
	$define_sess_id = true;
}
else
{
	$define_sess_id = false;
	$sess_id= es_session::id();
}

//引用会员函数库
require_once APP_ROOT_PATH."sys/model/user.php";

$global_is_run = false;
$is_app = isApp();
?>