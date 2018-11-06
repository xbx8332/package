<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $this->_var['icon']['WEBSITE_TITLE']; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="/Application/Tpl/images/favicon.png"> -->

    <!-- All css files are included here -->
    <!-- Bootstrap fremwork main css -->
    <link rel = "Shortcut Icon" href="<?php echo $this->_var['icon']['LOGO']; ?>">
    <link rel="stylesheet" href="/Application/Tpl/css/bootstrap.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="/Application/Tpl/css/core.css">
    <link rel="stylesheet" href="/Application/Tpl/css/bannerList.css">
    <link rel="stylesheet" href="/Application/Tpl/css/base.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="/Application/Tpl/css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="/Application/Tpl/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="/Application/Tpl/css/responsive.css">
    <link href="/Admin/Tpl/public/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
    <!-- User style -->
    <link rel="stylesheet" href="/Application/Tpl/css/custom.css">
<script src='/Application/Tpl/js/vendor/jquery-1.12.4.min.js'></script>
		<script src='/Application/Tpl/layer/layui/lay/dest/layui.all.js'></script>
		<script type="text/javascript" src="/Application/Tpl/js/buy_in.js"></script>
<!--  <script src='http://www.jjj.com/assets/js/index/kefu_online.js'></script>
<a href='http://www.jjj.com' user_id='' username='' avatar='' web_id='admin' id='workerman-kefu'></a>
 -->
<script src='/Application/Tpl/js/vendor/bannerList.js'></script>
	<style>
	
		header{
			background:white;
		}
		.row-2{
			background:#fbfbfb;
			padding-top:15px;
		}
		.container{
			width:1200px;
		}
		.index-white{
			color:white;
		}
		.buy-btn-index{
			width:160px;
			height:64px;
			background:rgba(238,185,44,1);
			border:none;
			line-height:64px;
			font-size:24px;
			color:white;
			font-family:PingFangSC-Medium;
			float:right;
			}
		.buy-btn-index:hover{
			color:white;
		}	
		.index-p-1{
			font-size:24px;
			font-weight:bold;
		}
		.index-p-2{
			font-size:48px;
			color:#EEB92C;
		}
		.index-p-3{
			font-size:16px;
			color:#8C8C8C;
		}
		.owl-item{
			height:360px;
			margin-right:25px;
		}
		.font-12{
			font-size:12px;
		}
		.font-16{
			font-size:16px;
			color:black;
		}
		.btn-index-buy{
			width:160px;
			heigth:48px;
			font-size:16px;
			color:white;
			text-align:center;
			background:rgba(238,185,44,1);
			padding:10px 25px 10px 25px;
		}
		.zmd-div{
			position:relative;
			left:0px;
		}
		.zmd-div-div{
			height:72px;
			width:320px;
			margin-right:24px;
			background:white;
			padding:10px;
		}
	</style>
	<style>
	
        .table-tr-one{
            background-color:#edf7ff;
            font-size: 15px;
        }
        .table-tr-two{
             background-color: #d1e7f7;
             font-size: 15px;
        }
        .text-orange{
            color:#e49607;
        } 
       .btn-red{
       padding: 10px 50px;
    margin-right: 15px;
    font-size: 18px;
    font-weight: bold;
    border: 2px solid #f05244;
    background-color: #f05244;
    color: #fff;
    border-radius: 5px;
       }
        body{
            background:white;
        }
        .row-1{
            background:#fffbfb;
        }
        .ul-hen>li{
        float:left;
        border:1px solid #f05244;
        padding:15px 10px;
        margin-left:10px;
        border-radius:10px;
        color:#f05244;
        font-size:20px;
        font-weight:bold;
        }
        .top{
        margin-top:15px;
        
        }
        .four_bg{
        background:#ffffff
        }
        .hj{
       
        	padding:20px 0;
        }
        .rs_top{
        	padding: 11px 0;
        }
        .bord{
        	border-bottom:1px dashed #ededed;
        	margin:20px 0;
        }
        .title{
        	color:#8C8C8C;
        	display:inline-block;
        	font-family:'黑体'
        }
        .detxt {
        	display:inline-block;
        	color:#675f5f;
        	font-weight:bold;
        	font-family:'黑体';
        	margin-left:10px;
        }
        .unit{
        	height:50px;
        	line-height:50px;
        }
       /*  input{
  		width:100%;
  		height:48px;
  		margin:0 auto;
  		margin:10px 0px;
  		padding-left:5px;
  		border:1px solid #F3F3F3;
  		font-size:20px;
  	} */
  	.btn_area{
  		width:45%;
  		margin-left:10px;
  		display:inline-block;	
  	}
  	.selected{
  		color:#08c !important;
  	}
    </style>
    <script>
		var url = "<?php
echo parse_url_tag("u:index|object#&act=regular|"."".""); 
?>";
	</script>
	
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  
	 <!--弹出层  -->
     <!-- <div class="container top" id="showModal" style="width:200px;!important"  >
    	<div class="row">
	    	<div class="col-lg-4">
	    		<div style="">
	    			<div class="ibox float-e-margins" >
                    <div class="ibox-title">
                        <h6 style="font-size:13px;font-family:'黑体';font-weight:bold">买入确认</h6>
                        <div class="ibox-tools">
                           
                        </div>
                    </div>
                    <div class="ibox-content" >
                        <div class="container-fluid">
                        	<div class="row">
                        		<form action="">
	                        		<div class="col-lg-12 bord">
	                        			<div class="unit">
										  <span class="title" >投资项目</span>
										  <p class="detxt"  >活期理财</p>
										</div>
	                        		</div>
	                        		<div class="col-lg-12 bord">
	                        			<div class="unit">
										  <span class="title" >投资金额</span>
										  <p class="detxt"  ><em class="demoney">1000.00</em>元</p>
										</div>
	                        		</div>
	                        		<div class="col-lg-12 bord" >
	                        			<div class="unit">
										  <span class="title" >体验金&nbsp;&nbsp;</span>
										  <p class="detxt"  ><em class="demoney">1000.00</em>元</p>
										  <p style="display:inline-block;float:right"><button type="button" style="margin-top:10px;width:80px;border-radius:15px; !important" class="btn  btn-sm ">使用</button></p>
										</div>
	                        		</div>
	                        		<div class="col-lg-12 bord" >
	                        			<div class="unit">
										  <span class="title" >支付密码</span>
										  <p class="detxt"  >
										  	<input type="password" class="form-control" id="exampleInputPassword1" placeholder="输入支付密码">
										  </p>
										  
										</div>
	                        		</div>
	                        		<div class="col-lg-6">
	                        			<button type="button" style="color:rgb(238,185,44);border:1px solid rgb(238,185,44);background:rgb(255,255,255); !important" class="btn btn-default  btn-lg btn-block">取消买入</button>
	                        		</div>
	                        		<div class="col-lg-6">
	                        			<button type="button" style="background:rgb(238,185,44) !important" class="btn btn-warning btn-lg btn-block">确定买入</button>
	                        		</div>
                        		</form>
                        	</div>
                        </div>
                    </div>
                   
                </div>
	    		</div>
	    	</div>
    	
    	</div>
    </div> -->
    <!-- Body main wrapper start -->
    <form  style="width:75%;margin:0 auto;" action="/index.php?ctl=licai&act=bid" method="post" onsubmit="return false;" accept-charset="utf-8"  class="form-horizontal user-common-form" id ="buyin-form">
		<!-- <p style="text-align:center;font-size:24px;">登陆</p> -->
		<div class="unit bord">
			<label class="title" >投资项目</label>
			<p class="detxt"  ><?php if ($this->_var['data']['name']): ?><?php echo $this->_var['data']['name']; ?><?php endif; ?></p>
			<!-- <input type="hidden" placeholder="输入账号" name="name" readonly onfocus="this.removeAttribute('readonly');"> -->
		</div> 
		<div class="unit bord">
			<label class="title" >投资金额</label>
			<p class="detxt"  ><em class="demoney"><!-- 1000.00 --><?php if ($this->_var['money']): ?><?php echo $this->_var['money']; ?><?php endif; ?></em>元</p>
			<input type="hidden" placeholder="输入登录密码" name="money" value="<?php if ($this->_var['money']): ?><?php echo $this->_var['money']; ?><?php endif; ?>" readonly onfocus="this.removeAttribute('readonly');">
		</div>
		<?php if ($this->_var['data']['type'] == 0 && $this->_var['effect'] == 0 && $this->_var['nmc_amount'] != 0): ?>
		 <div class="unit bord">
			<label class="title" >体验金&nbsp;&nbsp;</label>
			<p class="detxt"  ><em class="demoney"><?php echo $this->_var['nmc_amount']; ?></em>元</p>
			<p id="nmc" style="display:inline-block;float:right"><a type="button"  style="margin-top:10px;width:80px;background:#fff;color:gray;border:1px solid #ededed;border-radius:15px; !important" class="btn  btn-sm "><i style="padding-right:7px;font-weight:10px;color:#ededed"  class="Hui-iconfont">&#xe6a8;</i>使用</a></p>
			<input type="hidden"  name="nmc_amount" value="<?php echo $this->_var['nmc_amount']; ?>" readonly onfocus="this.removeAttribute('readonly');">
			<input type="hidden"  name="is_effect" value="0" >
		</div> 
		<?php endif; ?>
		<div class="unit bord">
			<label class="title" >支付密码</label>
			<p class="detxt"  >
				<input type="password" name="paypassword"  id="paypassword" placeholder="输入支付密码">
			</p>
		</div>
		 <div class="unit " style="margin-top:17px">
			<p class="btn_area"  >
				<button  type="button" id="cancel"  style="width:100%;color:rgb(238,185,44);border:1px solid rgb(238,185,44);padding:15px 12px;background:rgb(255,255,255); !important" >取消买入</button>
			</p>
			<p class="btn_area"  >
				<input type="hidden"  name="user_id" value="<?php echo $this->_var['user']['id']; ?>" >
				<input type="hidden"  name="id" value="<?php echo $this->_var['licai_id']; ?>" >
				<button type="submit" id="sub" style="width:100%;padding:15px 12px;background:rgb(238,185,44) !important;color:white" >确定买入</button>
			</p>
			
		</div> 
	</form>
	
</body>
</html>  