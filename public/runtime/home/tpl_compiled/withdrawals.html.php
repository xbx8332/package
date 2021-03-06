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
	border-bottom:1px solid #eeb92c;
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
}
</style>
	<body class="no-skin">
		<div class="container">
				<!-- 我的账户 -->
				<div class="row">
					<p class="p-class">
						<span class="like-btn" style="background:#eeb92c">提现</span>
					</p>
					<form action="<?php
echo parse_url_tag("u:index|usercarry#usercarry|"."".""); 
?>" method="post" class="form-horizontal user-common-form">
						<div class="form-group">
			                <label class="col-xs-3 control-label">可提现资金：</label>
			                <div class="col-xs-7 ">
			                    <span style="color:orange;font-weight:bold;"><?php echo $this->_var['user']['money']; ?>元</span>
			                </div>
			            </div>
			            
			            <div class="form-group">
			                <label class="col-xs-3 control-label">提现金额</label>
			                <div class="col-xs-7 errorWrapper">
			                    <input type="number" name="carrymoney" class="form-control valid" placeholder="请输入提现金额" readonly onfocus="this.removeAttribute('readonly');">
			                </div>
			            </div>
						<div class="form-group">
			                <label class="col-xs-3 control-label">提现费用：</label>
			                <div class="col-xs-7 errorWrapper">
			                    <span style="color:orange;font-weight:bold;">0元</span>
			                </div>
			            </div>
			            <div class="form-group">
			                <label class="col-xs-3 control-label">实付金额：</label>
			                <div class="col-xs-7 errorWrapper">
			                    <span style="color:orange;font-weight:bold;">0元</span>
			                </div>
			            </div>
			            
			            <div class="form-group">
			                <label class="col-xs-3 control-label">开户行：</label>
			                <div class="col-xs-7 errorWrapper">
			                    <span style="color:orange;font-weight:bold;"><?php echo $this->_var['user']['bankname']; ?></span>
			                </div>
			            </div>
			            <div class="form-group">
			                <label class="col-xs-3 control-label">开户名：</label>
			                <div class="col-xs-7 errorWrapper">
			                    <span style="color:orange;font-weight:bold;"><?php echo $this->_var['user']['real_name_encrypt']; ?></span>
			                </div>
			            </div>
			            <div class="form-group">
			                <label class="col-xs-3 control-label">卡号：</label>
			                <div class="col-xs-7 errorWrapper">
			                    <span style="color:orange;font-weight:bold;"><?php echo $this->_var['user']['bankcard']; ?></span>
			                </div>
			               
			            </div>
			             <p style="text-align:center;">提现时间约为3个工作日</p>
			            <div class="form-group">
			                <label class="col-xs-3 control-label">支付密码</label>
			                <div class="col-xs-7 errorWrapper">
			                    <input type="password" name="paypassword" class="form-control valid" placeholder="请输入支付密码" readonly onfocus="this.removeAttribute('readonly');">
			                </div>
			            </div>
			            <div class="form-group">
			                <div style="text-align:center;">
			                    <label><input name="Fruit" type="checkbox" value="1" />《垚鑫宝产品管理服务协议》 </label> 
			                </div>
            			</div>
            			<div class="form-group">
			                <div id="guestIdentityButton" class="col-xs-offset-3 col-xs-7">
			                    <button type="submit" class="btn btn-red btn-identity btn-radius btn-fluid" style="background:#eeb92c">确定</button>
			                </div>
			            </div>
					</form>
				</div>
				<hr />
				<h4>提示：</h4>
				<p>1）每周首次转出免手续费2元。</p>
				<p>2）每周首次转出免手续费2元。</p>
				<p>3）每周首次转出免手续费2元。</p>
				<p>4）每周首次转出免手续费2元。</p>
				<p>5）每周首次转出免手续费2元。</p>
				
		</div>
	</body>
</html>
