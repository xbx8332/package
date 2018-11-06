<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>个人中心</title>
		
		<meta name="description" content="This is page-header (.page-header &gt; h1)" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		 <link rel="stylesheet" href="/Application/Tpl/css/bootstrap.min.css">
				 
			<link rel="stylesheet" href="/Application/Tpl/css/style.css">	 
				 <!-- jquery latest version -->
    <script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="/Application/Tpl/js/bootstrap.min.js"></script>
    
    <!--layer弹出层  -->
	<link href="https://cdn.bootcss.com/layer/3.1.0/theme/default/layer.css" rel="stylesheet"> 
	<script type="text/javascript" src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>
	<!--layer弹出层  -->
    
    <script type="text/javascript" src="/Application/Tpl/js/security.js"></script>
	</head>
<style>
/* .p-class{
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
    margin: 30px auto;
    width: 540px;}
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
} */
body{
	background-color:transparent !important;
}
.rs_top{
	border-right:1px solid #ededed;
}
.htop{
	margin-top:35px;
}
.hbord{
border-right:1px solid #ededed;
}
.side{
	border-left:5px solid rgb(238,185,44);
	padding-left:10px;
	font-family:'微软雅黑';
}
.top{
margin-top:15px;
}
</style>
<script>

	function checkpwd(){
		 
		 var id=$('input[name="pay_id"]').val();
		 var login_pwd=$('input[name="login_pwd"]').val();
		 var paypwd=$('input[name="paypwd"]').val();
		 var tpaypwd=$('input[name="tpaypwd"]').val();
		 if(paypwd != tpaypwd){
			 alert("两次输入的支付密码不相符");
		 }else{
			 $.ajax({
					url:"/index.php?ctl=usercenter&act=changepaypw",
					data:{
						"id":id,
						"login_pwd":login_pwd,
						"paypwd":paypwd,
						"tpaypwd":tpaypwd
					},
					type:"POST",
					success:function(obj){
						if(obj==1){
							alert("修改成功");
						}else{
							alert(obj);
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

</script>
	<body class="no-skin">
	
		<div class="ibox float-e-margins " >
                  <div class="ibox-title">
                        <h3 style="width:89%;display:inline-block">个人信息</h3>
                        <div class="ibox-tools" style="width:10%;display:inline-block">
                            <!-- <a class="collapse-link">
                                <i class="fa "><h5>截止日期 </h5></i>
                            </a> -->
                            <!-- <a href="#">详情&nbsp;▶</a> -->
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="container-fluid">
                        	<div class="row">
                        		<div class="col-xs-6 col-sm-6 col-lg-6">
                        			<p class="side">个人资料</p>
                        			<div>
                        				<p style="padding-left:20px;">
                        					<label style="color:gray;">用户名:</label>&nbsp;&nbsp;
                        					<span><!-- jojo --><?php echo $this->_var['user']['user_name']; ?></span>
                        				</p>
                        				<p style="padding-left:20px;">
                        					<label style="color:gray;">手机号码:</label>
                        					<span><!-- 18750558332 --><?php if ($this->_var['list']['mobile']): ?><?php echo $this->_var['list']['mobile']; ?><?php else: ?>无<?php endif; ?></span>
                        					<?php if ($this->_var['list']['mobile']): ?>
                        					<a href="<?php
echo parse_url_tag("u:index|usercenter#setmobileTpl|"."user_id=".$this->_var['user']['id']."".""); 
?>" style="display:inline-block;float:right;color:rgba(238,185,44,1);margin-right:10px;" class="">更换</a>
                        					<?php else: ?>
                        					<a href="<?php
echo parse_url_tag("u:index|usercenter#setmobileTpl|"."user_id=".$this->_var['user']['id']."".""); 
?>" style="display:inline-block;float:right;color:rgba(238,185,44,1);margin-right:10px;" class="">设置</a>
                        					<?php endif; ?>
                        				</p>
                        				<p style="padding-left:20px;">
                        					<label style="color:gray;">登录密码:</label>
                        					<span>••••••</span>
                        					<a href="<?php
echo parse_url_tag("u:index|usercenter#setloginpwTpl|"."user_id=".$this->_var['user']['id']."".""); 
?>" style="display:inline-block;float:right;color:rgba(238,185,44,1);margin-right:10px;" class="">修改</a>
                        					<!-- <a href="#" style="display:inline-block;float:right;color:rgba(238,185,44,1);margin-right:10px;" class="">设置</a> -->
                        				</p>
                        			</div>
                        		</div>
                        		<div class="col-xs-6 col-sm-6 col-lg-6">
                        		<p class="side">支付安全</p>
                        		<div>
                        				<p style="padding-left:20px;">
                        					<label style="color:gray;">账户:</label>&nbsp;&nbsp;
                        					<span><?php echo $this->_var['user']['user_name']; ?></span>
                        				</p>
                        				<p style="padding-left:20px;">
                        					<label style="color:gray;">支付密码:</label>
                        					<span><?php if ($this->_var['list']['paypassword']): ?>••••••<?php else: ?>未设置<?php endif; ?></span>
                        					<!-- <a href="<?php
echo parse_url_tag("u:index|usercenter#changepwTpl|"."id=".$this->_var['data']['id']."".""); 
?>" style="display:inline-block;float:right;color:rgba(238,185,44,1);margin-right:10px;" class="">更换</a> -->
                        					
                        						<a href="<?php
echo parse_url_tag("u:index|usercenter#setpwTpl|"."id=".$this->_var['user']['id']."".""); 
?>" style="display:inline-block;float:right;color:rgba(238,185,44,1);margin-right:10px;" class=""><?php if ($this->_var['user']['paypassword']): ?>修改<?php else: ?>设置<?php endif; ?></a>
                        					
                        					
                        				</p>
                        			</div>
			                        		
                        	</div>
                        </div>
                    </div>
                    
                </div>
                
                <!--银行卡  -->
                <div class="ibox float-e-margins top" >
                    <div class="ibox-title">
                        <h3 style="width:89%;display:inline-block">银行卡 &nbsp; &nbsp; &nbsp;<span style="color:gray;font-size:10px;">温馨提示:更换绑定的银行卡需要联系客服。</span></h3>
                        <div class="ibox-tools" style="width:10%;display:inline-block">
                            
                        </div>
                    </div>
                    <style>
                    	.bank_card{
                    		width:200px;
                    		height:135px;
                    		 background: -webkit-linear-gradient(left bottom,rgb(238,185,0),rgb(238,185,44)); 
							background: -o-linear-gradient(right top,rgb(238,185,0),rgb(238,185,44)); 
							background: -moz-linear-gradient(right top,rgb(238,185,0),rgb(238,185,44)); */
							background: linear-gradient(to right top,rgb(238,185,0),rgb(238,185,44)); 
                    		border-radius:10px;
                    	}
                    	.name{
                    		color:white;
                    		padding:10px 0 15px 5px;
                    	}
                    	.name img{
                    		margin:0 15px;
                    	}
                    	.card_no{}
                    	.card_no em span{
                    		color:white;font-size:15px;
                    		
                    	}
                    	.user{
                    		color:#CD8500;
                    		font-size:8px;
                    		padding:20px 0;
                    	}
                    	.bank_card_nor{
                    		width:200px;
                    		height:135px;
                    		background: #EBEBEB; 
							border:1px dashed gray;
							border-radius:10px;
							cursor:pointer;
                    	}
                    </style>
                    <div class="ibox-content">
                        <div class="container-fluid">
                        	<div class="row">
                        		<div class="col-xs-6 col-sm-6 col-lg-6">
                        			<?php if ($this->_var['user']['bankcard']): ?>
                        			<div class="bank_card">
                        				<p class="name">
                        					<img width='15' height="15" src="/Application/Tpl/images/bankicon/jh.jpg" />
                        					<span><?php echo $this->_var['user']['bankname']; ?><!-- 中国建设银行 --></span>
                        				</p>
                        				<p class="card_no">
                        					<em style="margin-left:15px;color:white;font-size:15px;display:inline-block" >****</em>&nbsp;<em style="color:white;font-size:15px;display:inline-block">****</em>&nbsp;<em style="color:white;font-size:15px;display:inline-block">****</em>&nbsp;<em style="color:white;font-size:15px;display:inline-block">****</em>&nbsp;<span style="color:white;font-size:15px;display:inline-block"><?php echo $this->_var['user']['bankcard']; ?></span>
                        				</p>
                        				<p class="user">
                        					<span style="margin-left:15px;color:#B8860B;;display:inline-block">开户人:<em><?php echo $this->_var['user']['real_name_encrypt']; ?></em></span>
                        				</p>
                        			</div>
                        			<?php else: ?>
                        			<div class="bank_card_nor">
                        				<p class="" style="text-align:center;margin:25px 0 10px 0;">
                        					<img width='40' height="40" src="/Application/Tpl/images/example/icon_add_pre.png" />
                        				</p>       				
                        				<p class="" style="text-align:center;">
                        					<span style="color:#C7C7C7;font-weight:bold;font-size:18px;display:inline-block">添加银行卡</span>
                        				</p>
                        			</div>
                        			<?php endif; ?>
                        		</div>
                        		<div class="col-xs-6 col-sm-6 col-lg-6">
                        		
			                        		
                        		</div>
                        </div>
                    </div>
                    
                </div>
                
		<!-- <div class="container">
				我的账户
				
				<div class="row">
					<p class="p-class">
						<span class="like-btn">安全设置</span>
					</p>
					<ul id="myTab" class="nav nav-tabs">
						<li class="active">
							<a href="#home" data-toggle="tab">
								 账号安全
							</a>
						</li>
						<li><a href="#ios" data-toggle="tab">支付安全</a></li>
						
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade in active" id="home">
						
								<form action="/index.php?ctl=usercenter&act=changepw" method="post" accept-charset="utf-8"  class="form-horizontal user-common-form">
									<div class="form-group">
						                <label class="col-xs-3 control-label">账号</label>
						                <div class="col-xs-7 errorWrapper">
						                	<input type="text" style="display:none;"  name="id" class="form-control valid" value="<?php echo $this->_var['user']['id']; ?>">
						                    <input type="text" name="user_name" class="form-control valid" value="<?php echo $this->_var['user']['user_name']; ?>" readonly>
						                </div>
						            </div>
						            <div class="form-group">
						                <label class="col-xs-3 control-label">旧密码</label>
						                <div class="col-xs-7 errorWrapper">
						                    <input type="password" name="oldpw" class="form-control valid" placeholder="请输入旧密码">
						                </div>
						            </div>
						            
						            <div class="form-group">
						                <label class="col-xs-3 control-label">新密码</label>
						                <div class="col-xs-7 errorWrapper">
						                    <input type="password" name="newpw" class="form-control valid" placeholder="请输入新密码">
						                </div>
						            </div>
						            <div class="form-group">
						                <label class="col-xs-3 control-label">确认新密码</label>
						                <div class="col-xs-7 errorWrapper">
						                    <input type="password" name="tnewpw" class="form-control valid" placeholder="请再次输入新密码">
						                </div>
						            </div>
			            			<div class="form-group">
						                <div id="guestIdentityButton" class="col-xs-offset-3 col-xs-7">
						                    <button type="submit" class="btn btn-red btn-identity btn-radius btn-fluid">确定</button>
						                </div>
						            </div>
								</form>
						</div>
						<div class="tab-pane fade" id="ios">
						<?php if ($this->_var['list']['paypassword']): ?>
							<div style="text-align:center;">
									<h3>如需修改支付密码，请联系客服！ Tel:<?php echo $this->_var['icon']['WEBSITE_TEL']; ?></h3>
									<img src="/Application/Tpl/images/timg.jpg"  style="margin:0 auto;"/>
							</div>
							
						<?php else: ?>
								<form action="/index.php?ctl=usercenter&act=changepaypw" method="post" accept-charset="utf-8" id="form2" class="form-horizontal user-common-form">
									<div class="form-group">
						                <label class="col-xs-3 control-label">账号</label>
						                <div class="col-xs-7 errorWrapper">
						                    <input type="text" style="display:none;"  name="pay_id" class="form-control valid" value="<?php echo $this->_var['user']['id']; ?>">
						                    <input type="text" name="pay_user_name" class="form-control valid" value="<?php echo $this->_var['user']['user_name']; ?>" readonly>
						                </div>
						            </div>
						            <div class="form-group">
						                <label class="col-xs-3 control-label">登录密码</label>
						                <div class="col-xs-7 errorWrapper">
						                    <input type="password" name="login_pwd" class="form-control valid" placeholder="请输入登录密码">
						                </div>
						            </div>
						            <div class="form-group">
						                <label class="col-xs-3 control-label">设置支付密码</label>
						                <div class="col-xs-7 errorWrapper">
						                    <input type="password" name="paypwd" class="form-control valid" placeholder="请输入新密码">
						                </div>
						            </div>
						            <div class="form-group">
						                <label class="col-xs-3 control-label">再次确认密码</label>
						                <div class="col-xs-7 errorWrapper">
						                    <input type="password" name="tpaypwd" class="form-control valid" placeholder="请再次输入新密码">
						                </div>
						            </div>
						            
						            
						            
			            			<div class="form-group">
						                <div id="guestIdentityButton" class="col-xs-offset-3 col-xs-7">
						                    <button type="button" class="btn btn-red btn-identity btn-radius btn-fluid" onclick="checkpwd()">确定</button>
						                </div>
						            </div>
								</form>
								<?php endif; ?>
						</div>
						
					</div>
					
				</div>
				
		</div> -->
	</body>
</html>
