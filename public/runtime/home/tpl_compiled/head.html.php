<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $this->_var['icon']['WEBSITE_TITLE']; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="/Application/Tpl/images/favicon.png"> -->

    <!-- All css files are included here -->
    <!-- Bootstrap fremwork main css -->
    <link rel = "Shortcut Icon" href="<?php echo $this->_var['icon']['LOGO']; ?>">
    <link rel="stylesheet" href="/Application/Tpl/css/bootstrap.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="/Application/Tpl/css/core.css">
    <link rel="stylesheet" href="/Application/Tpl/css/bannerList.css">
    <link rel="stylesheet" href="/Application/Tpl/css/base.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="/Application/Tpl/css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="/Application/Tpl/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="/Application/Tpl/css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="/Application/Tpl/css/custom.css">
	<!-- <link rel="stylesheet" href="/Application/Tpl/layer/layui/css/layui.css"> -->
<script src='/Application/Tpl/js/vendor/jquery-1.12.4.min.js'></script>
<!--  <script src='http://www.jjj.com/assets/js/index/kefu_online.js'></script>
<a href='http://www.jjj.com' user_id='' username='' avatar='' web_id='admin' id='workerman-kefu'></a>
 -->
<script src='/Application/Tpl/js/vendor/bannerList.js'></script>
<!-- <script src='/Application/Tpl/layer/layer/layer.js'></script> -->
<script src='/Application/Tpl/layer/layui/lay/dest/layui.all.js'></script>
	<style>
	body{
	background:#F7F7F7;
	}
	header{
		background:white;
	}
		.row-2{
			background:#fbfbfb;
			padding-top:15px;
		}
		.container{
			width:1200px;
		}
		.index-white{
			color:white;
		}
		.buy-btn-index{
			width:160px;
			height:64px;
			background:rgba(238,185,44,1);
			border:none;
			line-height:64px;
			font-size:24px;
			color:white;
			font-family:PingFangSC-Medium;
			float:right;
			}
		.buy-btn-index:hover{
			color:white;
		}	
		.index-p-1{
			font-size:24px;
			font-weight:bold;
		}
		.index-p-2{
			font-size:48px;
			color:#EEB92C;
		}
		.index-p-3{
			font-size:16px;
			color:#8C8C8C;
		}
		.owl-item{
			height:360px;
		}
		.font-12{
			font-size:12px;
		}
		.font-16{
			font-size:16px;
			color:black;
		}
		.btn-index-buy{
			width:160px;
			heigth:48px;
			font-size:16px;
			color:white;
			text-align:center;
			background:rgba(238,185,44,1);
			padding:10px 25px 10px 25px;
		}
		.zmd-div{
			position:absolute;
			left:0px;
		}
		.zmd-div-div{
			height:72px;

			margin-right:24px;
			background:white;
			padding:10px;
			float:left;
		}
		.jiantou{
			color:white;
			border-radius:100px;
			width:24px;
			height:24px;
			border:1px solid gray;
			background:gray;
			margin:0px 15px;
		}
	</style>
	<script>
	
		

		function dl(){
			layer.open({
				  type: 2,
				  title: '用户登录',
				  shadeClose: true,
				  fix: true, //不固定
				  shade: 0.5,
				  offset: ['70px', '35%'],
				  area: ['480px', '480px'],
				  content: ["<?php
echo parse_url_tag("u:index|login|"."".""); 
?>",'no']
				}); 
		}
		
		function zc(){
			layer.open({
				  type: 2,
				  title: '新用户注册',
				  shadeClose: true,
				  fix: true, //不固定
				  shade: 0.5,
				  offset: ['70px', '35%'],
				  area: ['480px', '480px'],
				  content: ["<?php
echo parse_url_tag("u:index|login#register_index|"."".""); 
?>",'no']
				}); 
		}
		
	</script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start of header area -->
        <header>

            <div class="header-bottom">
                <div class="container">
                    <div class="row header-middle-content">
                       <nav>
                       		<ul>
                       			<li style="width:160px;height:56px;"><a><img src="<?php echo $this->_var['icon']['WEBSITE_LOGO']; ?>" style="width:160px;height:56px;" /></a></li>
                       			<li class="index-li"><a href="<?php
echo parse_url_tag("u:index|index|"."".""); 
?>">首页</a></li>
                       			<li class="index-li"><a href="<?php
echo parse_url_tag("u:index|object#regular|"."".""); 
?>">定期参股</a></li>
                       			<li class="index-li"><a href="<?php
echo parse_url_tag("u:index|object#index|"."".""); 
?>">活期参股</a></li>
                       			<li class="index-li"><a href="<?php
echo parse_url_tag("u:index|loan#index|"."".""); 
?>">我要贷款</a></li>
                       			<li class="index-li"><a href="<?php
echo parse_url_tag("u:index|help#index|"."".""); 
?>">帮助中心</a></li>
                       			<li class="index-li"><a href="<?php
echo parse_url_tag("u:index|usercenter#myfriend_v1|"."".""); 
?>">邀请好友</a></li>
                       			<li class="index-li"><?php if (! $this->_var['user']): ?><a onclick="dl()">我的账户</a><?php else: ?><a href="<?php
echo parse_url_tag("u:index|usercenter#index|"."".""); 
?>">我的账户</a><?php endif; ?></li>
                       			<li class="index-li" style="float:right;<?php if ($this->_var['user']): ?>width:250px;<?php endif; ?>"><?php if (! $this->_var['user']): ?><a onclick="dl()">登录</a> | <a onclick="zc()">注册</a><?php else: ?><a href="<?php
echo parse_url_tag("u:index|usercenter#index|"."".""); 
?>" ><?php echo $this->_var['user']['user_name']; ?></a> | <a href="<?php
echo parse_url_tag("u:index|login#out|"."".""); 
?>">退出</a><?php endif; ?></li>
                       		</ul>
                       </nav>
                    </div>
                </div>
            </div>
                   
        </header>