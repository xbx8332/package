<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>个人中心</title>

		<meta name="description" content="This is page-header (.page-header &gt; h1)" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		 <link rel="stylesheet" href="/Application/Tpl/css/bootstrap.min.css">
		 <!-- jquery latest version -->
    <script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="/Application/Tpl/js/bootstrap.min.js"></script>
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
table thead tr{
	color:grey;
}
</style>
	<body class="no-skin" style="background:#fff;">
		<div class="container">
				<!-- 我的账户 -->
				<div class="row">
					<!-- <p class="p-class">
						<span class="like-btn">赎回记录</span>
					</p>

							<table class="table">
								<tr>
									<td>产品名称</td>
									<td>时间</td>
									<td>支付金额</td>
									<td>收益比率</td>
									<td>实际收益（元）</td>
								</tr>
								<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'data');if (count($_from)):
    foreach ($_from AS $this->_var['data']):
?>
								<tr>
									<td><?php echo $this->_var['data']['name']; ?></td>
									<td><?php echo $this->_var['data']['date']; ?></td>
									<td><?php echo $this->_var['data']['pay_money']; ?></td>
									<td><?php echo $this->_var['data']['rate']; ?>%</td>
									<td><?php echo $this->_var['data']['profit']; ?></td>
									
								</tr>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							</table>
										<div style="width:100%;margin-top:20px;">
											<div style="float:right;">
											<?php echo $this->_var['page']; ?>
											</div>
										</div> -->
										
										<div class="ibox-content">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">项目名称</th>
                                <th class="text-center">投入金额/元</th>
                                <th class="text-center">时间</th>
                                <th class="text-center">收益比率/元</th>
                                <th class="text-center">实际收益（元）</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'data');if (count($_from)):
    foreach ($_from AS $this->_var['data']):
?>
							<tr>
								<td class="text-center"><?php echo $this->_var['data']['name']; ?></td>
								<td class="text-center"><?php echo $this->_var['data']['pay_money']; ?></td>
								<td class="text-center"><?php echo $this->_var['data']['date']; ?></td>
								<td class="text-center"><?php echo $this->_var['data']['rate']; ?>%</td>
								<td class="text-center"><?php echo $this->_var['data']['profit']; ?></td>
								
							</tr>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            <!-- <tr>
                                <td class="text-center">新手专享-3月</td>
                                <td class="text-center">1000.00</td>
                                <td class="text-center">2018-01-12 10:15:09</td>
                                <td class="text-center">5.76%</td>
                                <td class="text-center">100.00</td>
                            </tr>
                            <tr>
                                <td class="text-center">新手专享-3月</td>
                                <td class="text-center">1000.00</td>
                                <td class="text-center">2018-01-12 10:15:09</td>
                                <td class="text-center">5.76%</td>
                                <td class="text-center">100.00</td>
                            </tr>
                            <tr>
                                <td class="text-center">新手专享-3月</td>
                                <td class="text-center">1000.00</td>
                                <td class="text-center">2018-01-12 10:15:09</td>
                                <td class="text-center">5.76%</td>
                                <td class="text-center">100.00</td>
                            </tr> -->
                            </tbody>
                        </table>
                        <div style="width:100%;margin-top:20px;">
							<div style="float:right;">
							<?php echo $this->_var['page']; ?>
							</div>
						</div>
                    </div>
                </div>
										
						</div>
					</div>

	</body>
</html>
