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
		<script src='/Application/Tpl/js/vendor/jquery-1.12.4.min.js'></script>
		<!--layer弹出层  -->
		<!-- <link href="https://cdn.bootcss.com/layer/3.1.0/theme/default/layer.css" rel="stylesheet"> 
		<script type="text/javascript" src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script> -->
		<!--layer弹出层  -->
		<script src='/Application/Tpl/layer/layui/lay/dest/layui.all.js'></script>
		<script type="text/javascript" src="/Application/Tpl/js/user_index.js"></script>
	</head>
	<script>
		function zhuanchu(){
			parent.layer.open({
				  type: 2,
				  title: '转出',
				  shadeClose: true,
				  fix: true, //不固定
				  shade: 0.5,
				  offset: ['70px', '35%'],
				  area: ['480px', '480px'],
				  content: ['/index.php?ctl=redeem','no']
				}); 
		}
		
		function zhuanru(){
			parent.window.location="<?php
echo parse_url_tag("u:index|object#index|"."".""); 
?>";
		}
		function tixian(){
			window.location="<?php
echo parse_url_tag("u:index|usercenter#withdrawals|"."".""); 
?>";
		}
		function dqlc(){
			parent.window.location="<?php
echo parse_url_tag("u:index|object#regular|"."".""); 
?>";
		}
		function hqlc(){
			parent.window.location="<?php
echo parse_url_tag("u:index|object|"."".""); 
?>";
		}
	</script>
<style>
	body{
		background-color:transparent !important;
	}
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
	/* .row{
		margin-bottom:40px;
	} */
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
	.rs_top{
		border-right:1px solid #ededed;
	}
	.htop{
		margin-top:35px;
	}
	.hbord{
		border-right:1px solid #ededed;
	}
</style>
	<body class="no-skin">
		
		<div class="ibox float-e-margins bg" >
                     <div class="ibox-title">
                        <h3 style="width:89%;display:inline-block"> </h3>
                        <div class="ibox-tools" style="width:10%;display:inline-block">
                            <!-- <a class="collapse-link">
                                <i class="fa "><h5>截止日期 </h5></i>
                            </a> -->
                            <a href="/index.php?ctl=usercenter&act=investment">交易记录&nbsp;▶</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="container-fluid">
                        	<div class="row">
                        		<div class="col-xs-4 col-sm-4 col-lg-4 rs_top">
                        			<h6 style="text-align:center;color:gray;font-size:15px">总资产/元</h6>
                        			<p><h1 style="text-align:center;font-family:'微软雅黑';font-size:28px"><!-- 80000.00 --><?php echo $this->_var['user_statics']['sum_money']; ?></h2></p>
                        		</div>
                        		<div class="col-xs-4 col-sm-4 col-lg-4 rs_top">
                        		<h6 style="text-align:center;color:gray;font-size:15px">累计收益/元</h6>
                        			<p><h1 style="text-align:center;font-family:'微软雅黑';font-size:28px"><!-- 8000.00 --><?php echo $this->_var['user_statics']['sum_profit']; ?></h2></p>
                        		</div>
                        		<div class="col-xs-4 col-sm-4 col-lg-4 ">
                        			<div class="container-fluid" >
                        				<div class="row" style="padding-top:12%;">
                        					<div class="col-xs-6 col-sm-6 col-lg-6">
			                        			<a onclick="tixian()" style="color:rgb(238,185,44);border:1px solid rgb(238,185,44);background:rgb(255,255,255); !important" class="btn btn-default  btn-lg btn-block">提现</a>
			                        		</div>
			                        		<div class="col-xs-6 col-sm-6 col-lg-6">
			                        			<a href="#" id="contact" style="background:rgb(238,185,44) !important" class="btn btn-warning btn-lg btn-block"  >充值</a>
			                        		</div>
                        				</div>
                        			</div>
                        		</div>
                        	</div>
                        </div>
                    </div>
                </div>
                
                <div class="ibox float-e-margins bg" >
                    <div class="ibox-title">
                        <h3 style="width:89%;display:inline-block"><?php echo $this->_var['licai']['name']; ?></h3>
                        <div class="ibox-tools" style="width:10%;display:inline-block">
                            <!-- <a class="collapse-link">
                                <i class="fa "><h5>截止日期 </h5></i>
                            </a> -->
                            <a onclick="hqlc()">项目详情&nbsp;▶</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="container-fluid">
                        	<div class="row">
                        		<div class="col-xs-4 col-sm-4 col-lg-4 rs_top">
                        			<h6 style="text-align:center;color:gray;font-size:15px">总金额/元</h6>
                        			<p><h1 style="text-align:center;font-family:'微软雅黑';font-size:28px"><!-- 5.76% --><?php if ($this->_var['user_statics']['h_sum_money'] == 0): ?>0.00<?php else: ?><?php echo $this->_var['user_statics']['h_sum_money']; ?><?php endif; ?></h2></p>
                        			<p style="text-align:center;color:gray;font-size:10px">含体验金:<!-- 8000.00 --><?php echo $this->_var['user_statics']['nmc_amount']; ?>元</p>
                        			<div class="container-fluid" >
                        				<div class="row" style="padding-top:12%;">
                        					<div class="col-xs-6 col-sm-6 col-lg-6">
			                        			<a onclick="zhuanchu()" style="color:rgb(238,185,44);border:1px solid rgb(238,185,44);background:rgb(255,255,255); !important" class="btn btn-default  btn-lg btn-block">转出</a>
			                        		</div>
			                        		<div class="col-xs-6 col-sm-6 col-lg-6">
			                        			<a onclick="zhuanru()" style="background:rgb(238,185,44) !important" class="btn btn-warning btn-lg btn-block">转入</a>
			                        		</div>
                        				</div>
                        			</div>
                        		</div>
                        		<div class="col-xs-4 col-sm-4 col-lg-4 col-lg-4 htop hbord">
                        		<h6 style="text-align:center;color:gray;font-size:15px">历史年化收益率</h6>
                        			<p><h1 style="text-align:center;font-family:'微软雅黑';font-size:28px"><!-- 5.766 --><?php echo $this->_var['user_statics']['h_rape']; ?><!-- % --></h2></p>
                        		</div>
                        		<div class="col-xs-4 col-sm-4 col-lg-4 col-lg-4 htop">
                        		<h6 style="text-align:center;color:gray;font-size:15px">累计收益/元</h6>
                        			<p><h1 style="text-align:center;font-family:'微软雅黑';font-size:28px"><!-- 8000.00 --><?php echo $this->_var['user_statics']['h_profit']; ?></h2></p>
                        		</div>
                        	</div>
                        </div>
                    </div>
                    
                </div>
                
                
                <div class="ibox float-e-margins bg" >
                    <div class="ibox-title">
                        <h3 style="width:89%;display:inline-block">定期理财 </h3>
                        <div class="ibox-tools" style="width:10%;display:inline-block">
                            <!-- <a class="collapse-link">
                                <i class="fa "><h5>截止日期 </h5></i>
                            </a> -->
                            <a onclick="dqlc()">详情&nbsp;▶</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="container-fluid">
                        	<div class="row">
                        		<div class="col-xs-6 col-sm-6 col-lg-6">
                        			<h6 style="text-align:center;color:gray;font-size:15px">当前定投总资金/元</h6>
                        			<p><h1 style="text-align:center;font-family:'微软雅黑';font-size:28px"><!-- 10000.00 --><?php if ($this->_var['user_statics']['d_sum_money']): ?><?php echo $this->_var['user_statics']['d_sum_money']; ?><?php else: ?>0.00<?php endif; ?></h2></p>
                        		</div>
                        		<div class="col-xs-6 col-sm-6 col-lg-6">
                        		<h6 style="text-align:center;color:gray;font-size:15px">历史收益/元</h6>
                        			<p><h1 style="text-align:center;font-family:'微软雅黑';font-size:28px"><!-- 8000.00 --><?php echo $this->_var['user_statics']['d_profit']; ?></h2></p>
                        		</div>
                        	</div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="ibox float-e-margins bg" >
                    <div class="ibox-title">
                        <h3>余额 </h3>
                        <div class="ibox-tools">
                            <!-- <a class="collapse-link">
                                <i class="fa "><h5>截止日期 </h5></i>
                            </a> -->
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="container-fluid">
                        	<div class="row">
                        		<div class="col-xs-6 col-sm-6 col-lg-6">
                        			<h6 style="text-align:center;color:gray;font-size:15px">可用余额/元</h6>
                        			<p><h1 style="text-align:center;font-family:'微软雅黑';font-size:28px"><!-- 10000.00 --><?php echo $this->_var['user_statics']['money']; ?></h2></p>
                        		</div>
                        		<div class="col-xs-6 col-sm-6 col-lg-6">
                        		<h6 style="text-align:center;color:gray;font-size:15px">提现中余额/元</h6>
                        			<p><h1 style="text-align:center;font-family:'微软雅黑';font-size:28px"><?php if ($this->_var['user_statics']['withdrawalsing_money']): ?><?php echo $this->_var['user_statics']['withdrawalsing_money']; ?><?php else: ?>0.00<?php endif; ?></h2></p>
                        		</div>
                        	</div>
                        </div>
                    </div>
                </div>
	
	
	
		  <!-- <div class="container">
				我的账户
				<div class="row">
					<p class="p-class">
						<span class="like-btn"> 我的账户</span>
					</p>
					<div class="promery">
						<table class="table">
							<tr>
								<td >我的资产（元）</td>
								<td>累计收益（元）</td>
							</tr>
							<tr>
								<td class="td-txt" style="font-size:20px;"><?php echo $this->_var['user_statics']['sum_money']; ?></td>
								<td><?php echo $this->_var['user_statics']['sum_profit']; ?></td>
							</tr>
						</table>
						
					</div>
				</div>
				垚鑫宝
				<div class="row">
					<p class="p-class">
						<span class="like-btn">项目投资</span>
						<span style="float:right;margin-top:10px;"><a href="#">投资详情 > </a></span>
					</p>
					<div class="promery">
						<table style="width:100%;text-align:center;">
							<tr>
								<td style="width:35%;border-right:1px solid #e9e9e9;">
									<ul style="padding:0px;line-height:50px;">
										<li style="font-size:15px;color:gray;">总金额(元)  含体验金<span style="color: orange;"><?php echo $this->_var['user_statics']['nmc_amount']; ?></span>元</li>
										<li class="td-txt" style="font-size:20px;"><?php if ($this->_var['user_statics']['h_sum_money'] == 0): ?>0.00<?php else: ?><?php echo $this->_var['user_statics']['h_sum_money']; ?><?php endif; ?></li>
										<li>
											<a onclick=window.top.location="<?php
echo parse_url_tag("u:index|gobuy#index|"."id=".$this->_var['user_statics']['h_id']."".""); 
?>"><button class="btn btn-danger">转入</button></a>
											<a href="<?php
echo parse_url_tag("u:index|redeem#index|"."".""); 
?>"><button class="btn" style="color:gray;">转出</button></a>
										</li>
									</ul>
								</td>
								<td style="width:65%;">
									<table style="width:100%;text-align:center;height:auto;line-height:40px;font-size:18px;">
										<tr>
											<td class="txt-gray">历史年化收益</td>
											<td class="txt-gray">累计收益(元)</td>
										</tr>
										<tr>
											<td><?php echo $this->_var['user_statics']['h_rape']; ?>%</td>
											<td><?php echo $this->_var['user_statics']['h_profit']; ?></td>
										</tr>
										
									</table>
								</td>
							</tr>
						</table>
					</div>
					
				</div>	
				定期
				<div class="row">
					<p class="p-class">
						<span class="like-btn">定期</span>
						<span style="float:right;margin-top:10px;"><a href="#">详情 > </a></span>
					</p>
					<div class="promery">
						<table class="table">
							<tr>
								<td class="txt-gray txt-18">当前定期总投资(元)</td>
								<td class="txt-gray txt-18">历史累计收益(元)</td>
							</tr>
							<tr>
								<td class="txt-18"><?php if ($this->_var['user_statics']['d_sum_money']): ?><?php echo $this->_var['user_statics']['d_sum_money']; ?><?php else: ?>0.00<?php endif; ?></td>
								<td class="txt-18"><?php echo $this->_var['user_statics']['d_profit']; ?></td>
							</tr>
						</table>
						
					</div>
				</div>
				余额
				<div class="row">
					<p class="p-class">
						<span class="like-btn">余额</span>
					</p>
					<div class="promery">
						<table class="table">
							<tr>
								<td class="txt-gray txt-18">可用余额(元)</td>
								<td class="txt-gray txt-18">其中在途资金(元)</td>
							</tr>
							<tr>
								<td class="txt-18"><?php echo $this->_var['user_statics']['money']; ?></td>
								<td class="txt-18">0.00</td>
							</tr>
						</table>
						
					</div>
				</div>
		</div> -->  
		
	</body>
</html>
