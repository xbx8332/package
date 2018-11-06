<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>新用户注册</title>
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
  		height:35px;
  		margin:0 auto;
  		margin:5px 0px;
  		padding-left:5px;
  		border:1px solid #F3F3F3;
  		font-size:12px;
  	}
  	.cart-button{
  		width:100%;
  		height:64px;
  		line-height:64px;
  		background:#EEB92C;
  		color:white;
  		margin-top:15px;
  		border:1px solid #EEB92C;
  	}
  	a{
  		text-decoration : none;
  		color:black;
  	}
	td{padding: 5px 15px;}
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
echo parse_url_tag("u:index|login|"."".""); 
?>",'no']
			}); 
	}
	
	function user_register(){
		var user_name = $('input[name="user_name"]').val();
		var user_pwd = $('input[name="user_pwd"]').val();
		var user_pwd_confirm = $('input[name="user_pwd_confirm"]').val();
		var phone = $('input[name="phone"]').val();
		var p_name = $('input[name="p_name"]').val();
		var reg = new RegExp("^[\u4e00-\u9fa5A-Za-z0-9-_]*$");  //只能中英文，数字，下划线，减号
		var pwdreg = new RegExp("/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,21}$/");
		if(!pwdreg.test(user_pwd)){
			alert("密码请输入6-21字母和数字");return false;
		}
		if(!reg.test(user_name)){
			alert("用户名只能中英文，数字，下划线，减号");return false;
		}else{
			if(user_pwd!=user_pwd_confirm)
			{
				alert("两次输入的密码不符");return false;
			}else{
				$.ajax({
					url:"<?php
echo parse_url_tag("u:index|login#register|"."".""); 
?>",
					type:"POST",
					data:{
						"user_name":user_name,
						"user_pwd":user_pwd,
						"user_pwd_confirm":user_pwd_confirm,
						"phone":phone,
						"p_name":p_name
					},
					success:function(obj){
						obj = JSON.parse(obj);
						
						if(obj.msg!='yes'){
							parent.layer.msg(obj.msg);
							//alert(obj.msg);
						}
						else{
								
								var index = parent.layer.getFrameIndex(window.name);
								parent.layer.close(index);
								parent.layer.msg('注册成功');
								parent.history.go(0);
								
							
						}
					},
					error:function(a,b,c){
						console.log(a);
						console.log(b);
						console.log(c);
					}
				});
			}
		}
		
	}
	
</SCRIPT>
</head>
	<body>
	<form method="post" action="<?php
echo parse_url_tag("u:index|login#register|"."".""); 
?>" style="width:90%;margin:0 auto;" autocomplete="off">
     <p style="text-align:center;font-size:24px;">注册</p>
     <table style="width:100%;">
     	<tr>
     		<td>
     			<input type="text" name="user_name" placeholder="用户名" readonly onfocus="this.removeAttribute('readonly');" autocomplete="off" >
     		</td>
     		<td>
     			<input type="text" name="mobile" style="display:none">
     			<input type="text" name = "mobile" placeholder="手机号" autocomplete="off">
     		</td>
     	</tr>
     	<tr>
     		<td>
     			<input type="password" name="user_pwd" placeholder="密码" readonly onfocus="this.removeAttribute('readonly');" autocomplete="off">
     		</td>
     		<td>
     			<input type="text" name="user_pwd_confirm" style="display:none">
     			<input type="password" name="user_pwd_confirm" placeholder="确认密码" autocomplete="off">
     		</td>
     	</tr>
     	<tr>
     		<td>
     			<input type="text" name = "<?php if ($this->_var['name']): ?>pid<?php else: ?>p_name<?php endif; ?>" value="<?php echo $this->_var['name']; ?>" placeholder="推荐人" autocomplete="off">
     		</td>
     		<td>
     			
     		</td>
     	</tr>
     </table>
     <div><button  style="font-size:24px;" type="submit"  class="cart-button">注册</button></div>
   </form>
	<div style="background:#F3F3F3;height:64px;width:100%;margin-top:35px;line-height:64px;">
		<div style="width:75%;margin:0 auto;">
			<span>已有账号？</span><span style="float:right;cursor:pointer" onclick="zc()">立即登录</span>
		</div>
	</div>
</body>
</html>