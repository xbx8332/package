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

	</head>
<style>
body{
	background-color:transparent !important;
}
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
}
.col-lg-3{
	display:inline-block;
}
.txt-center{
	text-align:center;
	font-size:15px;
	line-height:30px;
}
.txt-reds{
	color:red;
} */
table thead tr{
	color:grey;
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
  
	function copy(){
		var Url2=document.getElementById("code");
		Url2.select(); // 选择对象
		document.execCommand("Copy"); // 执行浏览器复制命令
		/* alert("已复制好，可贴粘。"); */
		$("#sui").html("复制成功");
	}
	
 
</script>
	<body class="no-skin">
		<!-- <p class="p-class">
			<span class="like-btn">邀请好友</span>
			<a style="float:right;margin:10px;">已邀请的好友 > </a>
		</p>

		
				我的账户
				<div class="container" style="width:100%;display:inline-block;border:1px solid #e9e9e9;">
					
					
					<div class="col-lg-3 txt-center">
						<p>已邀请(人)</p>
						<p><?php echo $this->_var['data']['count']; ?></p>
					</div>
					
					<div class="col-lg-3 txt-center ">
						<p>累计邀请收益(元)</p>
						<p><?php if ($this->_var['data']['money']): ?><?php echo $this->_var['data']['money']; ?><?php else: ?>0<?php endif; ?></p>
					</div>
				</div>
				二维码
				<div style="margin-top:20px;">
					<div class="col-lg-8" style="float:right;">
						<textarea id="code" name="a" style="width:500px;height:120px;font-size:20px;color:gray;">送你10000元懒财网投资体验金，体验安全靠谱的活期投资，收益双倍余额宝，还不快来！<?php echo $this->_var['data']['url']; ?></textarea>
						<br><button onclick="copy()" class="btn btn-danger" style="width:350px;height:35px;">复制</button>
					</div>
					<div class="col-lg-4" style="float:right;">
						<img src="<?php
echo parse_url_tag("u:index|usercenter#png|"."code=".$this->_var['data']['code']."".""); 
?>" alt="二维码" style="width:200px; height:200px;border:1px solid gray;" />
					</div>
					
				</div> -->
				
                <div class="ibox float-e-margins " >
                    <div class="ibox-title">
                        <h3 style="width:89%;display:inline-block">邀请好友 </h3>
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
                        			<p class="side">二维码</p>
                        			<div>
                        				<img style="float:left;" src="<?php
echo parse_url_tag("u:index|usercenter#png|"."code=".$this->_var['data']['code']."".""); 
?>" alt="二维码" width='100' height='100'/>
                        				<div style="width:50%;float:left;font-weight:bold;margin-left:10px;">
	                        				<p>1.右键复制该二维码并分享</p>
	                        				<p>2.好友扫码并注册</p>
                        				</div>
                        			</div>
                        		</div>
                        		<div class="col-xs-6 col-sm-6 col-lg-6">
                        		<p class="side">邀请链接</p>
                        		<div class="col-lg-8" style="float:right;">
									<textarea id="code" name="a" cols='45' rows="4" >送你10000元垚鑫宝投资体验金，体验安全靠谱的活期投资，收益双倍余额宝，还不快来！<?php echo $this->_var['data']['url']; ?></textarea>
									<br><button onclick="copy()"  style="background:rgb(238,185,44) !important;width:50%;height:40px;color:white;display:inline-block;margin-right:10px;" class="btn btn-block" >复制</button>
									<span id="sui" style="color:rgb(238,185,44);font-family:'微软雅黑'"></span>
								</div>
			                        		
                        	</div>
                        </div>
                    </div>
                    
                </div>
                
                
                
                
               	<div class="ibox float-e-margins top" style="margin-bottom:0px !important;" >
                    
                    <div class="ibox-content">
                        <div class="container-fluid">
                        	<div class="row">
                        		<div class="col-xs-6 col-sm-6 col-lg-6">
                        			<h6 style="text-align:center;color:gray;font-size:15px">已邀请人数/人</h6>
                        			<p><h1 style="text-align:center;font-family:'微软雅黑';font-size:28px"><!-- 10 --><?php echo $this->_var['data']['count']; ?></h2></p>
                        		</div>
                        		<div class="col-xs-6 col-sm-6 col-lg-6">
                        		<h6 style="text-align:center;color:gray;font-size:15px">累计收益/元</h6>
                        			<p><h1 style="text-align:center;font-family:'微软雅黑';font-size:28px"><!-- 8000.00 --><?php if ($this->_var['data']['money']): ?><?php echo $this->_var['data']['money']; ?><?php else: ?>0<?php endif; ?></h2></p>
                        		</div>
                        		
                        	</div>
                        </div>
                    </div>
                    
                </div>
               
                
                
                <div class="ibox float-e-margins" >
                   
                    <div class="ibox-content">
                        <div class="container-fluid">
                        	<div class="row">
                        		   <div class="ibox float-e-margins">
                    
                    <!-- <div class="ibox-content">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">项目名称</th>
                                <th class="text-center">转出金额/元</th>
                                <th class="text-center">转出时间</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                             <?php $_from = $this->_var['mai']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
								<tr>
									<td class="text-center" ><?php echo $this->_var['yxb']['name']; ?></td>
									<td class="text-center"><?php echo $this->_var['list']['money']; ?></td>
									<td class="text-center"><?php echo $this->_var['list']['create_date']; ?></td>
								</tr>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            <tr>
                                <td class="text-center">新手专享-3月</td>
                                <td class="text-center">1000.00</td>
                                <td class="text-center">2018-01-12 10:15:09</td>
                               
                            </tr>
                            <tr>
                                <td class="text-center">新手专享-3月</td>
                                <td class="text-center">1000.00</td>
                                <td class="text-center">2018-01-12 10:15:09</td>
                               
                            </tr>
                            <tr>
                                <td class="text-center">新手专享-3月</td>
                                <td class="text-center">1000.00</td>
                                <td class="text-center">2018-01-12 10:15:09</td>
                               
                            </tr>
                            </tbody>
                        </table>
                    </div> -->
                </div>			
                        	</div>
                        </div>
                    </div>
                    
                </div>
                
                

	</body>
</html>
