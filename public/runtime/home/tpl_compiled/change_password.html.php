<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>个人中心</title>

		<meta name="description" content="This is page-header (.page-header &gt; h1)" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		 <link rel="stylesheet" href="/Application/Tpl/css/bootstrap.min.css">
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
						<p>账户安全&nbsp;&nbsp;▶&nbsp;&nbsp;修改支付密码</p>
					</div>
					
					<form action="/index.php?ctl=usercenter&act=bankcheck" method="post" accept-charset="utf-8"  class="form-horizontal user-common-form">
						<div class="form-group">
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			                <div class="col-xs-4 errorWrapper">
			                	<p><span class="fs active" >验证密码</span>&nbsp;&nbsp;&nbsp;&nbsp;▶&nbsp;&nbsp;&nbsp;&nbsp;<span class="fs <?php if (1 == 0): ?>active<?php endif; ?>">修改密码</span></p>	
			                </div>
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			            </div>
			            
						<div class="form-group">
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			                <div class="col-xs-4 errorWrapper">
			                	<div class="progress" style="height:4px !important;">
								  <div   class="progress-bar progress-bar-warning " role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" <?php if (1 == 1): ?>style="width: 50%"<?php else: ?>style="width: 100%"<?php endif; ?> >
								    <span class="sr-only"><!-- 60% Complete (warning) --></span>
								  </div>
								</div>
			                </div>
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			            </div>
			            <?php if (1 == 0): ?>
						<div class="form-group">
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			                <div class="col-xs-4 errorWrapper">
			                	<input type="text" hidden name="uid" value="<?php echo $this->_var['user_data']['id']; ?>" />
			                    <input type="text" name="name" class="form-control valid" placeholder="请输入登陆密码">
			                </div>
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			            </div>
			            
            			<div class="form-group">
			                <div id="guestIdentityButton" class="col-xs-offset-4 col-xs-4">
			                    <button type="submit" class="btn  btn-identity btn-radius btn-fluid" style="background:rgba(238,185,44,1);;color:white;font-size:15px;">验证密码</button>
			                </div>
			            </div>
			            <?php elseif (1 == 1): ?>
			            <div class="form-group">
			                <label class="col-xs-4 control-label"></label>
			                <div class="col-xs-4 errorWrapper">
			                	<input type="hidden"  name="uid" value="<?php echo $this->_var['user_data']['id']; ?>" />
			                    <input type="text" name="paypassword" class="form-control valid" placeholder="输入支付密码">
			                </div>
			                <label class="col-xs-4 control-label"></label>
			            </div>
			            <div class="form-group">
			                <label class="col-xs-4 control-label"></label>
			                <div class="col-xs-4 errorWrapper">
			                    <input type="text" name="newpaypassword" class="form-control valid" placeholder="确认支付密码">
			                </div>
			                <label class="col-xs-4 control-label"></label>
			            </div>
			            
            			<div class="form-group">
			                <div id="guestIdentityButton" class="col-xs-offset-4 col-xs-4">
			                    <button type="submit" class="btn  btn-identity btn-radius btn-fluid" style="background:rgba(238,185,44,1);;color:white;font-size:15px;">确认修改</button>
			                </div>
			            </div>
			            <?php endif; ?>
					</form>
					
				</div>
				
		</div>
	</body>
</html>
