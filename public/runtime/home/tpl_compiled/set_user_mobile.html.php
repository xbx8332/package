<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>个人中心</title>

		<meta name="description" content="This is page-header (.page-header &gt; h1)" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="/Application/Tpl/css/bootstrap.min.css">
		<script src='/Application/Tpl/js/vendor/jquery-1.12.4.min.js'></script>
		<script src='/Application/Tpl/layer/layui/lay/dest/layui.all.js'></script>
		<script type="text/javascript" src="/Application/Tpl/js/set_pwd.js"></script>
	</head>
<style>
.p-class{
	border-bottom:1px solid #f05244;
}
.like-btn{
	display: inline-block;
    padding: 0 30px;
    color: #fff;
    font-size: 18px;
    line-height: 40px;
    background-color: #f05244;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}
.btn-charge, .btn-identity, .btn-login, .btn-normal, .btn-register {
    font-size: 20px;
    padding: 6px 60px;
}
.btn-red {
    background-color: #f05244;
    color: #fff;
}
.table{
	text-align:center;
	background-color:#fffbfb;
	font-size:15px;
	padding:5px;
}
.td-txt{
	color:#337ab7;
}
.promery{
	border:1px solid #e9e9e9;
}

.txt-gray{
	color:gray;
}
.txt-18{
font-size:18px;
}
.user-common-form {
   /*  margin: 30px auto; */
   background:#fff;
   	padding:50px 0;
    width: 100%;}
.form-horizontal .form-group {
    margin-left: -15px;
    margin-right: -15px;
}
.form-group {
    margin-bottom: 15px;
}
.form-horizontal .control-label {
    text-align: right;
    margin-bottom: 0;
    padding-top: 7px;
}
.user-common-form .form-control {
    font-size: 14px;
    height: 38px;
}
.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.btn-radius {
    border-radius: 5px;
}
.btn-orange, .btn-sms {
    background-color: #ff8b1b;
    color: #fff;
}
.btn-fluid {
    width: 100%;
}
.fs{
font-size:20px;
font-family:'黑体';
}
.active{
	color:rgba(238,185,44,1);
}
</style>
	<body class="no-skin" style="background:transparent !important;">
		<!-- <div class="container">
				
				<div class="row"> -->
					<!-- <p class="p-class">
						<span class="like-btn">银行卡认证</span>
					</p> -->
					<div>
						<p>账户安全&nbsp;&nbsp;▶&nbsp;&nbsp;修改手机号码</p>
					</div>
					
					<form action="/index.php?ctl=usercenter&act=validmobile" method="post" onsubmit="return false;" accept-charset="utf-8"  class="form-horizontal user-common-form" id ="mobile-valid-form">
						<div class="form-group">
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			                <div class="col-xs-4 errorWrapper">
			                	<p><span class="fs active" >验证密码</span>&nbsp;&nbsp;&nbsp;&nbsp;▶&nbsp;&nbsp;&nbsp;&nbsp;<span class="fs <?php if ($this->_var['step'] == 2): ?>active<?php endif; ?>">设置手机号码</span></p>	
			                </div>
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			            </div>
			            
						<div class="form-group">
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			                <div class="col-xs-4 errorWrapper">
			                	<div class="progress" style="height:4px !important;">
								  <div   class="progress-bar progress-bar-warning " role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" <?php if ($this->_var['step'] == 1): ?>style="width: 50%"<?php elseif ($this->_var['step'] == 2): ?>style="width: 100%"<?php endif; ?> >
								    <span class="sr-only"><!-- 60% Complete (warning) --></span>
								  </div>
								</div>
			                </div>
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			            </div>
			            <?php if ($this->_var['step'] == 1): ?>
						<div class="form-group">
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			                <div class="col-xs-4 errorWrapper">
			                	<!-- <input type="text" hidden name="user_id" value="<?php echo $this->_var['user']['id']; ?>" /> -->
			                    <input type="hidden" name="step" class="form-control valid" value="<?php echo $this->_var['step']; ?>" >
			                    <input type="password" name="oldpwd" class="form-control valid" placeholder="请输入登陆密码">
			                </div>
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			            </div>
			            
            			<div class="form-group">
			                <div id="guestIdentityButton" class="col-xs-offset-4 col-xs-4">
			                <input type="hidden" name="user_id" class="form-control valid" value="<?php echo $this->_var['user']['id']; ?>">
			                    <button type="submit" class="btn  btn-identity btn-radius btn-fluid" style="background:rgba(238,185,44,1);color:white;font-size:15px;">验证密码</button>
			                </div>
			            </div>
			            <?php elseif ($this->_var['step'] == 2): ?>
			            <div class="form-group">
			                <label class="col-xs-4 control-label"></label>
			                <div class="col-xs-4 errorWrapper">
			                	
			                    <input type="text" name="mobile" class="form-control valid" placeholder="输入新手机号码">
			                </div>
			                <label class="col-xs-4 control-label"></label>
			            </div>
			            <!-- <div class="form-group">
			                <label class="col-xs-4 control-label"></label>
			                <div class="col-xs-4 errorWrapper">
			                    <input type="password" name="newpassword" class="form-control valid" placeholder="确认新密码">
			                </div>
			                <label class="col-xs-4 control-label"></label>
			            </div> -->
			            
            			<div class="form-group">
			                <div id="guestIdentityButton" class="col-xs-offset-4 col-xs-4">
			                	<input type="hidden" name="step" class="form-control valid" value="<?php echo $this->_var['step']; ?>" >
			                 	<input type="hidden" name="user_id" class="form-control valid" value="<?php echo $this->_var['user']['id']; ?>">
			                    <button type="submit" class="btn  btn-identity btn-radius btn-fluid" style="background:rgba(238,185,44,1);;color:white;font-size:15px;">确认</button>
			                </div>
			            </div>
			            <?php endif; ?>
					</form>
					
				</div>
				
		</div>
	</body>
	<script>
	$("#mobile-valid-form").bind("submit",function(){
		var query = $(this).serialize();
		var action = $(this).attr("action");
		var step  = $("input[name='step']").val();
		var pwd  = $("input[name='oldpwd']").val();
		var mobile  = $("input[name='mobile']").val();
		
		console.log(action);
		
		if(step=='1')
		{
			if(!pwd){
				
				layer.msg('请输入登录密码',{icon:2,time:1000,offset:'t'});
			    return false;
			}
		}
		console.log(mobile);
		if(step=='2')
		{
			if(!mobile)
			{
				layer.msg('请输入手机号码!',{icon:2,time:1000,offset:'t'});
				return false;
			}
			
			var mobileReg = /^1(3|4|5|7|8)\d{9}$/;
			if(!mobileReg.test(mobile))
			{
				layer.msg('请输入正确的手机号码格式！',{icon:2,time:1000,offset:'t'});
				/* layer.alert('请输入正确的手机号码格式！', {
					title:false,
					offset:'auto',
					closeBtn: 0,
					shade:0.7
				}, function(index){
					layer.close(index);
				 
				}); */
			    return false;
			}
			
				
		}
		
		$.ajax({
			url:action,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(obj){
				console.log(obj);
				if(obj.status)
				{
					if(obj.step==2)
					{
						parent.layer.msg(obj.info,{icon:1,time:1000,offset:'t'},function(){
							
							parent.location.href = obj.jump;
						});
						
					}else if(obj.step==1){
						
						location.href = obj.jump;
					}
					/*parent.layer.msg('购买成功',{icon:1,time:1000});*/
					
					
					
				}
				else
				{
					layer.msg(obj.info,{icon:2,time:1000,offset:'t'});
				}
				
			}			
		});    
		
		
		
	});
	
	</script>
</html>
