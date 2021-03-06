﻿<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>用户登录</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src='/Application/Tpl/js/vendor/jquery-1.12.4.min.js'></script>
  <script src='/Application/Tpl/layer/layui/lay/dest/layui.all.js'></script>
  <style>
  body{
  margin:0px;
  padding:0px;
  }
  	input{
  		width:100%;
  		height:48px;
  		margin:0 auto;
  		margin:10px 0px;
  		padding-left:5px;
  		border:1px solid #F3F3F3;
  		font-size:20px;
  	}
  	.cart-button{
  		width:100%;
  		height:64px;
  		line-height:64px;
  		background:#EEB92C;
  		color:white;
  		font-size:20px;
  		border:1px solid #EEB92C;
  	}
  	a{
  		text-decoration : none;
  		color:black;
  	}

  </style>
<SCRIPT>

function zc(){
	 var index = parent.layer.getFrameIndex(window.name);
	 parent.layer.close(index);
	parent.layer.open({
		  type: 2,
		  title: '用户登录',
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

function user_login(){
	var user_name = $('input[name="user_name"]').val();
	var user_pwd = $('input[name="user_pwd"]').val();
	$.ajax({
		url:"<?php
echo parse_url_tag("u:index|login#dologin|"."".""); 
?>",
		type:"POST",
		data:{
			"user_name":user_name,
			"user_pwd":user_pwd
		},
		async: false ,
		success:function(obj){
			obj = JSON.parse(obj);
			if(obj.msg!='yes'){
				alert(obj.msg);
				
			
			}
			else{
			if(obj.msg=='yes'){
				var index = parent.layer.getFrameIndex(window.name);
				parent.layer.close(index);
				parent.layer.msg('登陆成功');
				parent.history.go(0);
				
			}}
		},
		error:function(a,b,c){
			console.log(a);
			console.log(b);
			console.log(c);
		}
	});
}


</SCRIPT>
</head>
	<body>
	<!-- <p id="errmsg" style="background:#FFC3C2;color:#CB3935;width:100%;height:48px;font-size:16px;text-align:center;line-height:48px;margin:0px;"></p> -->
	<form method="post" style="width:75%;margin:0 auto;">
		
		<p style="text-align:center;font-size:24px;">登录</p>
		<div><input type="text" placeholder="输入账号" name="user_name" readonly onfocus="this.removeAttribute('readonly');"></div> 
		<div><input type="password" placeholder="输入登录密码" name="user_pwd" readonly onfocus="this.removeAttribute('readonly');"></div>
		<p>
			<small><a href="#" style="font-size:16px;">忘记密码?</a></small>
		</p>
		<div><button onclick="user_login()"  class="cart-button">登录</button></div>
		
	</form>
	<div style="background:#F3F3F3;height:64px;width:100%;margin-top:35px;line-height:64px;">
		<div style="width:75%;margin:0 auto;">
			<span>还没有账号？</span><span style="float:right;cursor:pointer" onclick="zc()">立即注册</span>
		</div>
	</div>
</body>
</html>