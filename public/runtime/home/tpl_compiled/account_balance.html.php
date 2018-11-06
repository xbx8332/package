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
.table{
	text-align:center;
	background-color:#fffbfb;
	font-size:15px;
	padding:5px;
}
.td-txt{
	color:#ff6633;
}
.promery{
	border:1px solid #e9e9e9;
}
.row{
	margin-bottom:40px;
}
ul li{
	list-style:none;
}
.btn{
padding: 4px 28px;
}
.txt-gray{
	color:gray;
}
.txt-18{
font-size:18px;
}
</style>
	<body class="no-skin">
		<div class="container">
				<!-- 我的账户 -->
				<div class="row">
					<p class="p-class">
						<span class="like-btn"> 账户余额</span>
					</p>
					<div class="promery">
						<table class="table">
							<tr>
								<td >我的余额（元）</td>
								<td>提现中金额（元）</td>
								<td>操作</td>
							</tr>
							<tr>
								<td class="td-txt" style="font-size:20px;"><?php if ($this->_var['user']['money']): ?><?php echo $this->_var['user']['money']; ?><?php else: ?>0.00<?php endif; ?></td>
								<td><?php echo $this->_var['user']['lock_money']; ?></td>
								<td>
									<a href="<?php
echo parse_url_tag("u:index|usercenter#withdrawals|"."".""); 
?>">
										<button class="btn" style="color:gray;">提现</button>
									</a>
								</td>
							</tr>
						</table>
						
					</div>
				</div>
				<!-- 垚鑫宝 -->
				<div class="row">
					<p class="p-class">
						<span class="like-btn">账户充值</span>
						<span style="float:right;font-size:20px;color:red;">客服热线：<?php echo $this->_var['icon']['WEBSITE_TEL']; ?></span>
					</p>
					<div class="promery" style="text-align:center;border:none;">
						<h3 style="font-family: 黑体;color:#df4b2f;">充值请联系客服人员，我们竭诚为您提供服务！</h3>
						<img src="/Application/Tpl/images/timg.jpg"  style="margin:0 auto;"/>
					</div>
					
				</div>	
				
		</div>
	</body>
</html>
