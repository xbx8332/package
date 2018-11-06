<head>
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
        	margin-bottom:5px;
        }
        .title{
        	color:gray;
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
        .loan_li{
        	font-weight:bold;
        	font-family:'黑体';
        	padding-left:20px;
        }
        p{
        font-size:24px;
        }
        p > img{
        
        border:1px dashed gray;
        margin-right:13px;
        }
        #ppp{
        background: -ms-linear-gradient(top, #ffffff,  #eeb92c);        /* IE 10 */

background:-moz-linear-gradient(top,#ffffff,#eeb92c);/*火狐*/ 

background:-webkit-gradient(linear, 0% 0%, 0% 100%,from(#ffffff), to(#eeb92c));/*谷歌*/ 

background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#ffffff), to(#eeb92c));      /* Safari 4-5, Chrome 1-9*/

background: -webkit-linear-gradient(top, #ffffff, #eeb92c);   /*Safari5.1 Chrome 10+*/

background: -o-linear-gradient(top, #ffffff, #eeb92c);  /*Opera 11.10+*/}
    </style>
    <link rel="stylesheet" href="/Application/Tpl/css/style.css">
   <link rel="stylesheet" href="/Application/Tpl/swiper/swiper.min.css">

	<script src="/Application/Tpl/swiper/swiper.min.js"></script>
	<link href="/Application/Tpl/css/page_style.css" rel="stylesheet" type="text/css">
	
	
</head>


    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    
  <?php echo $this->fetch('head.html'); ?>
  <!--layer弹出层  -->
	 <!-- <link href="/Application/Tpl/layer/layer/mobile/need/layer.css" rel="stylesheet"> 
	<script type="text/javascript" src="/Application/Tpl/layer/layer/layer.js"></script> -->
	<!--layer弹出层  -->
	
	<script type="text/javascript" src="/Application/Tpl/js/loan.js"></script>
  <body>
    
    <div class="container top">
    	<div class="row">
    		<div class="col-lg-8">
    			<div class="swiper-container">
					<div class="my-pagination">
					<ul class="my-pagination-ul">
						<li class="loan_li">贷款规则</li>
					</ul>
					</div>
					<div class="">
				    	
						<div class="">
				        	<!--手机绑定GO-->
				        	<div class="user_zc_body">
				                <ul style="padding:15px 0">
				                	<?php $_from = $this->_var['list']['dkgz']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'v');if (count($_from)):
    foreach ($_from AS $this->_var['v']):
?>
				                	<li>
				                        <p class="p_input">
				                        	<div style="width: 10%;display: inline-block;vertical-align:top;" >
				                        		<span class="" style="color: gray;font-size:15px"><?php echo $this->_var['v']['rule_name']; ?></span>
				                        	</div>
				                        	<div style="width: 80%;display: inline-block;">
				                        		<span style="font-size:16px;font-family:'黑体'"><?php echo $this->_var['v']['rule_msg']; ?></span>
				                        	</div>
				                        	
				                        </p>
				                    </li>
				                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				                </ul>
				            </div>
				            
				        </div>
				       
					</div>
				</div>
				
				<!--贷款资格  -->
				<div class="swiper-container" style="margin-top:20px">
					<div class="my-pagination"><ul class="my-pagination-ul">
					<li class="loan_li">贷款资格</li>
					</ul></div>
					<div class="">
				    	
						<div class="">
				        	<!--手机绑定GO-->
				        	<div class="user_zc_body">
				                <ul style="padding:15px 0">
				                	<?php $_from = $this->_var['list']['dkzg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vv');if (count($_from)):
    foreach ($_from AS $this->_var['vv']):
?>
				                	<li>
				                        <p class="p_input">
				                        	
				                        	<div style="width: 100%;display: inline-block;">
				                        		<span style="font-size:16px;font-family:'黑体'"><?php echo $this->_var['vv']['rule_name']; ?></span>
				                        	</div>
				                        	<div style="padding-left:17px;margin-top:10px;width: 100%;display: inline-block;">
				                        		<p style="font-size:16px;font-family:'黑体';color:gray"><?php echo $this->_var['vv']['rule_msg']; ?></p>
				                        	</div>
				                        </p>
				                    </li>
				                    
				                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				                   
				                </ul>
				            </div>
				            
				        </div>
				       
					</div>
				</div>
                <!--end贷款资格  -->
                
                <!--快速问答 -->
                <div class="swiper-container" style="margin-top:20px">
					<div class="my-pagination"><ul class="my-pagination-ul">
					<li class="loan_li">快速问答</li>
					</ul></div>
					<div class="">
				    	
						<div class="">
				        	<!--手机绑定GO-->
				        	<div class="user_zc_body">
				                <ul style="padding:15px 0">
				                	<?php $_from = $this->_var['list']['kswd']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vvv');if (count($_from)):
    foreach ($_from AS $this->_var['vvv']):
?>
				                	<li>
				                        <p class="p_input">
				                        	
				                        	<div style="width: 100%;display: inline-block;">
				                        		<span style="font-size:16px;font-family:'黑体';margin-left:10px;">
				                        		<img alt="" src="/Application/Tpl/images/example/icon_qusetion.png">
				                        		<?php echo $this->_var['vvv']['rule_name']; ?></span>
				                        	</div>
				                        	<div style="padding-left:45px;margin-top:10px;width: 100%;display: inline-block;">
				                        		<p style="font-size:16px;font-family:'黑体';color:gray"><?php echo $this->_var['vvv']['rule_msg']; ?></p>
				                        	</div>
				                        </p>
				                       </li>
				                       
				                	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				                   
				                </ul>
				            </div>
				            
				        </div>
				       
					</div>
				</div>
                <!--快速问答  -->
                
            </div>
            <div class="col-lg-4">
		        <!-- <img style="width:100%" src="/Application/Tpl/images/liuchen1.jpg" alt=""> -->
	        	<div style="width:100%;background:#fff">
	        		<div >
	        			<p style="text-align:center;color:black;font-weight:bold;font-family:'黑体';padding:20px;font-size:24px;"><span id="ppp">申请贷款流程</span></p>
	        		</div>
	        		<div style="padding-left:30%;margin:30px 0">
	        			
	        			<p style="display:inline-block;width:80%;margin:0px;font-family:'黑体';"><img width='50' height="50" src="/Application/Tpl/images/example/icon_register.png" style="vertical-align:middle" alt="">1.注册账号</p>
	        		</div>
	        		<div style="padding-left:30%;margin:30px 0">
	        			<p style="display:inline-block;width:80%;margin:0px;font-family:'黑体'"><img width='50' height="50" src="/Application/Tpl/images/example/icon_upload.png" style="vertical-align:middle" alt="">2.上传资料</p>
	        		</div>
	        		<div style="padding-left:30%;margin:30px 0">
	        			<p style="display:inline-block;width:80%;margin:0px;font-family:'黑体'"><img width='50' height="50" src="/Application/Tpl/images/example/icon_stop.png" style="vertical-align:middle" alt="">3.等待审核</p>
	        		</div>
	        		<div style="padding-left:30%;margin:30px 0">
	        			<p style="display:inline-block;width:80%;margin:0px;font-family:'黑体'"><img width='50' height="50" src="/Application/Tpl/images/example/icon_wallet.png" style="vertical-align:middle" alt="">4.贷款到账</p>
	        		</div>
	        		<?php if ($this->_var['user']): ?>
	        		<button type="button" style="height:50px;background:rgb(238,185,44);font-size:20px;" class="btn btn-warning btn-lg btn-block" onclick = "dkmain()">立即申请</button>
	        		<?php else: ?>
	        		<button type="button" style="height:50px;background:rgb(238,185,44);font-size:20px;" class="btn btn-warning btn-lg btn-block" onclick = "dl()">登录后申请</button>
	        		<?php endif; ?>
	        	</div>
	        	
	        </div>
            
    	</div>
    </div> 
    <?php echo $this->fetch('footer_v1.html'); ?>
