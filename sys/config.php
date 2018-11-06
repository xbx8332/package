<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

// 前后台加载的系统配置文件

// 加载数据库中的配置与数据库配置
if(file_exists(APP_ROOT_PATH.'sys/db/db_config.php'))
{
	$db_config	=	require APP_ROOT_PATH.'sys/db/db_config.php';
}


if($GLOBALS['distribution_cfg']['CACHE_TYPE']!="File")
{
	$cfg_link = @mysql_connect($db_config['DB_HOST'].":".$db_config['DB_PORT'], $db_config['DB_USER'], $db_config['DB_PWD'], true);
	
	$db_version = @mysql_get_server_info($cfg_link);
	/* 如果mysql 版本是 4.1+ 以上，需要对字符集进行初始化 */
	if ($db_version > '4.1')
	{
		mysql_query("SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary", $cfg_link);
		if ($db_version > '5.0.1')
		{
			mysql_query("SET sql_mode=''",$cfg_link);
		}
	}	
	mysql_select_db($db_config['DB_NAME'], $cfg_link);
	$query = mysql_query("select * from ".$db_config['DB_PREFIX']."conf", $cfg_link);
	while ($row = mysql_fetch_assoc($query))
	{
		$db_conf[$row['name']] = addslashes($row['value']);
	}
	@mysql_close($cfg_link);
}
else
{ 
	//加载系统配置信息
	if(file_exists(APP_ROOT_PATH.'public/sys_config.php'))
	{
		$db_conf	=	require APP_ROOT_PATH.'public/sys_config.php';
	}
}
$w_conf=array();
if(file_exists(APP_ROOT_PATH.'public/sys_wconfig.php'))
{
	$w_conf	=	require APP_ROOT_PATH.'public/sys_wconfig.php';
}



$dist_cgf = require APP_ROOT_PATH.'sys/redis/redis_cfg.php';

if(is_array($db_config))
$config = array_merge($db_conf,$db_config,$dist_cgf,$w_conf);
elseif(is_array($db_conf))
$config = array_merge($db_conf);


$config['AUTH_KEY'] = "shenniu";
$config['ALLOW_IMAGE_EXT'] = "jpg,gif,png,jpeg";


return $config;
?>