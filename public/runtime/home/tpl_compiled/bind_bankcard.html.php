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
		<!--layer弹出层  -->
		<script src='/Application/Tpl/layer/layui/lay/dest/layui.all.js'></script>
		<script type="text/javascript" src="/Application/Tpl/js/bind_card.js"></script>
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
</style>
	<body class="no-skin" style="background:transparent !important;">
		<!-- <div class="container">
				
				<div class="row"> -->
					<!-- <p class="p-class">
						<span class="like-btn">银行卡认证</span>
					</p> -->
					<div>
					<p>我的账户&nbsp;&nbsp;▶&nbsp;&nbsp;添加银行卡</p>
				</div>
					<?php if ($this->_var['list']['bankcard']): ?>
					<form  method="post" accept-charset="utf-8" id="bind-card"  class="form-horizontal user-common-form">
						<div class="form-group">
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			                <div class="col-xs-4 errorWrapper">
			                	
			                	<input type="text" class="form-control valid" value="<?php echo $this->_var['list']['real_name_encrypt']; ?>" readonly>
			                </div>
			                 <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			            </div>
			            <div class="form-group">
			                <label class="col-xs-4 control-label"><!-- 银行卡号 --></label>
			                <div class="col-xs-4 ">
			                	<input type="text" class="form-control valid" value="<?php echo $this->_var['list']['bankcard']; ?>" readonly>
			                </div>
			                <label class="col-xs-4 control-label"><!-- 银行卡号 --></label>
			            </div>
			            <div class="form-group">
			                <label class="col-xs-4 control-label"><!-- 开户行 --></label>
			                <div class="col-xs-4 ">
			                	<input type="text" class="form-control valid" value="<?php echo $this->_var['list']['bankname']; ?>" readonly>
			                </div>
			                <label class="col-xs-4 control-label"><!-- 开户行 --></label>
			            </div>
			           <div style="">
							<h3 style="text-align:center">如需修改银行卡信息，请联系客服！ Tel:1552646545</h3>
							<!-- <img src="/Application/Tpl/images/timg.jpg"  style="margin:0 auto;"/> -->
						</div>
					</form>		
					<?php else: ?>
					<form action="/index.php?ctl=usercenter&act=bankcheck" id="bind-card"  method="post" onsubmit="return false;" accept-charset="utf-8"  class="form-horizontal user-common-form">
						<div class="form-group">
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			                <div class="col-xs-4 errorWrapper">
			                	<input type="text" hidden name="uid" value="<?php echo $this->_var['user_data']['id']; ?>" />
			                    <input type="text" name="name" class="form-control valid" placeholder="请输入您的真实姓名">
			                </div>
			                <label class="col-xs-4 control-label"><!-- 姓名 --></label>
			            </div>
			            <div class="form-group">
			                <label class="col-xs-4 control-label"><!-- 银行卡号 --></label>
			                <div class="col-xs-4 errorWrapper">
			                    <input type="text" name="bankcard" class="form-control valid" placeholder="请输入银行卡号">
			                </div>
			                <label class="col-xs-4 control-label"><!-- 银行卡号 --></label>
			            </div>
			            <div class="form-group">
			                <label class="col-xs-4 control-label"><!-- 开户行 --></label>
			                <div class="col-xs-4 errorWrapper">
			                    <input type="text" name="bankname" class="form-control valid" placeholder="请输入该卡开户行">
			                </div>
			                <label class="col-xs-4 control-label"><!-- 开户行 --></label>
			            </div>
			            
            			<div class="form-group">
			                <div id="guestIdentityButton" class="col-xs-offset-4 col-xs-4">
			                    <button type="submit" class="btn  btn-identity btn-radius btn-fluid" style="background:rgb(238,185,44);color:white;">确认添加</button>
			                </div>
			            </div>
					</form>
					<?php endif; ?>
				</div>
				
		</div>
	</body>
</html>
