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
    </style>
    <link rel="stylesheet" href="/Application/Tpl/css/style.css">
   	<link rel="stylesheet" href="/Application/Tpl/swiper/swiper.min.css">

	<script src="/Application/Tpl/swiper/swiper.min.js"></script>
	<link href="/Application/Tpl/css/page_style.css" rel="stylesheet" type="text/css">
	<script>
		var buy_url = "<?php
echo parse_url_tag("u:index|object#buy_confirm|"."".""); 
?>";
		var user = "<?php echo $this->_var['user']['id']; ?>";
	</script>
</head>


    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    
  <?php echo $this->fetch('head.html'); ?>
  <!--layer弹出层  -->
	<!--  <link href="https://cdn.bootcss.com/layer/3.1.0/theme/default/layer.css" rel="stylesheet"> 
	<script type="text/javascript" src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script> -->
	<!--layer弹出层  -->
	<script type="text/javascript" src="/Application/Tpl/js/regular.js"></script>
  <body>
     <div class="container top">
    	<div class="row">
	    	<div class="col-lg-8">
	    		<div class="ibox float-e-margins" >
                    <div class="ibox-title">
                        <h3><?php echo $this->_var['licai']['name']; ?> </h3>
                        <div class="ibox-tools">
                            <!-- <a class="collapse-link">
                                <i class="fa "><h5>截止日期 </h5></i>
                            </a> -->
                            
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="container-fluid">
                        	<div class="row">
                        		<div class="col-lg-4 rs_top">
                        			<h6 style="text-align:center;color:gray;font-size:15px">预计收益率</h6>
                        			<p><h1 style="text-align:center;font-weight:bold;font-size:30px"><?php if ($this->_var['history']): ?><?php echo $this->_var['history']; ?><?php else: ?><?php echo $this->_var['licai']['scope']; ?><?php endif; ?>%</h2></p>
                        		</div>
                        		<div class="col-lg-4 rs_top">
                        		<h6 style="text-align:center;color:gray;font-size:15px">最低起购金额</h6>
                        			<p><h1 style="text-align:center;font-weight:bold;font-size:30px"><?php echo $this->_var['licai']['min_money_format_num']; ?></h2></p>
                        		</div>
                        		<div class="col-lg-4 rs_top">
                        		<h6 style="text-align:center;color:gray;font-size:15px">投资风险</h6>
                        			<p><h1 style="text-align:center;font-weight:bold;font-size:30px">低</h2></p>
                        		</div>
                        	</div>
                        </div>
                    </div>
                    <div class="ibox-footer">
                      <img alt="" src="/Application/Tpl/images/example/icon_note.png">
                        目标收益与实际收益有差别，请谨慎投资
                    </div>
                </div>
	    	</div>
	    	<div class="col-lg-4">
	    		<div style="width:100%;height:200px;">
	    			<div class="ibox float-e-margins" >
                    <div class="ibox-title">
                        <h6 style="color:gray;font-size:13px;">起购金额:&nbsp;&nbsp;<em style="color:black"><?php echo $this->_var['licai']['min_money_format_num']; ?></em> </h6>
                        <h6 style="color:gray;font-size:13px;">余额:&nbsp;&nbsp;<em style="color:black"><!-- 1000.00 --><?php if ($this->_var['user']['id']): ?><?php echo $this->_var['user']['money']; ?>元<?php else: ?><a onclick="dl()" style="color:rgba(238,185,44,1)">请登录</a><?php endif; ?></em> 
                       	<a id="recharge" style="float:right;color:rgba(238,185,44,1)">充值</a>
                        </h6>
                        <div class="ibox-tools">
                            <!-- <a class="collapse-link">
                                <i class="fa "><h5>截止日期 </h5></i>
                            </a> -->
                           
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="container-fluid">
                        	<div class="row">
                        		<form action="<?php
echo parse_url_tag("u:index|object#recharge|"."".""); 
?>" onsubmit="return false;" method="POST"  id="recharge-form" class="recharge-form">
	                        		<div class="col-lg-12">
	                        			<div class="input-group">
										  <span class="input-group-addon" id="basic-addon1">&yen;</span>
										  <input type="text" name="money" class="form-control" placeholder="<?php echo $this->_var['licai']['min_money_format_num']; ?>起购" aria-describedby="basic-addon1">
										</div>
										<h6 class="tips" style="color:red;font-size:13px;height:10px;margin-top:10px"><!-- *余额不足请充值 --></h6>
	                        		</div>
	                        		<div class="col-lg-12">
	                        			<input type="hidden" name="licai_id" value="<?php echo $this->_var['licai']['id']; ?>"  />
	                        			<input type="hidden" name="start" value="10000"  />
	                        			<button  id="purchase" style="background-color:#EEB92C;border-color:#EEB92C;color:white" class="btn  btn-lg btn-block">立即购买</button>
	                        		</div>
                        		</form>
                        	</div>
                        </div>
                    </div>
                    
                </div>
	    		</div>
	    	</div>
    	
    	</div>
    </div>
   
    <div class="container">
	   	<div class="row " >
	   		<div class="col-lg-12 "  >
	   			<div class="container-fluid four_bg">
	   				<div class="row " >
	   					<div class="col-lg-3 hj"  >
				   			<div align="center" >
				   				<img alt="" src="/Application/Tpl/images/example/icon_security.png">
				   			</div>
				   			<p style="text-align:center;font-weight:bold;margin-top:16px">投资安全</p>
				   			<p style="text-align:center;font-size:12px">安全优质资产,智能分配投资</p>
				           </div>
				           <div class="col-lg-3 hj">
				           	<div align="center" >
				   				<img alt="" src="/Application/Tpl/images/example/icon_high.png">
				   			</div>
				   			<p style="text-align:center;font-weight:bold;margin-top:16px">超高年化</p>
				   			<p style="text-align:center;font-size:12px">银行定制利率的五倍,超高收益</p>
				           </div>
				           <div class="col-lg-3 hj">
				           	<div align="center" >
				   				<img alt="" src="/Application/Tpl/images/example/icon_flex.png">
				   			</div>
				   			<p style="text-align:center;font-weight:bold;margin-top:16px">灵活易用</p>
				   			<p style="text-align:center;font-size:12px">长短期自由选,100元即可投资</p>
				           </div>
				           <div class="col-lg-3 hj" >
				           	<div align="center" >
				   				<img alt="" src="/Application/Tpl/images/example/icon_flex.png">
				   			</div>
				   			<p style="text-align:center;font-weight:bold;margin-top:16px">智能配置</p>
				   			<p style="text-align:center;font-size:12px">智能配置最有资产</p>
				           </div>
	   				</div>
	   			</div>	
	   		</div>
          <!--  <div class="col-lg-3 hj"  >
   			<div align="center" >
   				<img alt="" src="/Application/Tpl/images/example/icon_security.png">
   			</div>
   			<p style="text-align:center;font-weight:bold;margin-top:5px">投资安全</p>
   			<p style="text-align:center">安全优质资产,智能分配投资</p>
           </div>
           <div class="col-lg-3 hj">
           	<div align="center" >
   				<img alt="" src="/Application/Tpl/images/example/icon_high.png">
   			</div>
   			<p style="text-align:center;font-weight:bold;margin-top:5px">超高年化</p>
   			<p style="text-align:center">银行定制利率的五倍,超高收益</p>
           </div>
           <div class="col-lg-3 hj">
           	<div align="center" >
   				<img alt="" src="/Application/Tpl/images/example/icon_flex.png">
   			</div>
   			<p style="text-align:center;font-weight:bold;margin-top:5px">灵活易用</p>
   			<p style="text-align:center">长短期自由选,100元即可投资</p>
           </div>
           <div class="col-lg-3 hj" >
           	<div align="center" >
   				<img alt="" src="/Application/Tpl/images/example/icon_flex.png">
   			</div>
   			<p style="text-align:center;font-weight:bold;margin-top:5px">智能配置</p>
   			<p style="text-align:center">智能配置最有资产</p>
           </div> -->
          
	   	</div>
    </div>
	          
	
   
    <div class="container top">
    	<div class="row">
    		<div class="col-lg-12">
    			<div class="swiper-container">
					<div class="my-pagination"><ul class="my-pagination-ul"></ul></div>
					<div class="swiper-wrapper">
				    	
						<div class="swiper-slide">
				        	<!--手机绑定GO-->
				        	<div class="user_zc_body">
				               <?php echo $this->_var['licai']['description']; ?>
				            </div>
				            
				            
				            <!--手机绑定END-->
				            
				        </div>
				        
				        
						<div class="swiper-slide">
				        
				        	<!--固话绑定GO-->
				        	<div class="user_zc_body">
				                <?php echo $this->_var['licai']['rule_info']; ?>
				            </div>
				            
				        
				        </div>
				        
				        
				
					</div>
				</div>
                <!-- <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Basic IN+ Panel <small class="m-l-sm">This is custom panel</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="tabs_panels.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="tabs_panels.html#">Config option 1</a>
                                </li>
                                <li><a href="tabs_panels.html#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <h2 >
                            This is standard IN+ Panel<br/>
                        </h2>
                        <p>
                            <strong>Lorem ipsum dolor</strong>
                            Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. </p>
                        <p>
                            <small>
                                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.
                            </small>
                        </p>
                    </div>
                    <div class="ibox-footer">
                        <span class="pull-right">
                          The righ side of the footer
                    </span>
                        This is simple footer example
                    </div>
                </div> -->
            </div>
    	</div>
    </div> 
    <!--  <div style="width:100%;text-align:center;">
    	<img src="/Application/Tpl/images/regular.png" />
    </div>  -->
    
		
        <!-- Start page content -->
        <!-- <section id="page-content" class="page-wrapper pt-10" style="display:none;">
            <div class="container">
                <div class="row" style="padding:10px;">
                 	<div style="display:inline-block;width:60%;">
                 		<span>总金额（元）</span>
                 	</div>
                 	<div style="display:inline-block;float:right;">
                 		<span>近期资产年化6.6%</span>
                 	</div>
                </div> 
                <div class="row" style="padding:10px;">
                 	<div style="display:inline-block;width:70%;">
                 		<ul class="ul-hen">
                 			<li>1</li>
                 			<li>0</li>
                 			<li>3</li>
                 			<li style="border:none;padding-top:15px;">·</li>
                 			<li>4</li>
                 			<li>5</li>
                 			<li>6</li>
                 			<li>7</li>
                 			<li>8</li>
                 			<li>9</li>
                 		</ul>
                 	</div>
                 	<div style="display:inline-block;float:right;">
                 		<button class="btn btn-red">转入</button>
                 		<button class="btn bn-white-red">转出</button>
                 	</div>
                </div> 
                <div class="row" style="padding:20px 0px;">
                 	<div style="display:inline-block;width:20%;">
                 		<p>目标年化</p>
                 		<p>6.5%</p>
                 	</div>
                 	<div style="display:inline-block;width:20%;">
                 		<p>历史年化收益</p>
                 		<p>6.5%</p>
                 	</div>
                 	<div style="display:inline-block;width:20%;">
                 		<button class="btn btn-danger">使用加息券</button>
                 	</div>
                 	<div style="display:inline-block;width:20%;">
                 		<p>当前体验金（元）</p>
                 		<p>100.00</p>
                 	</div>
                 	<div style="display:inline-block;width:15%;">
                 		<p>累计收益（元）</p>
                 		<p>3.33</p>
                 	</div>
                </div> 
            </div>
        </section> -->
        <!-- End page content -->
        
         <!--弹出层  -->
     <div class="container top" id="showModal" style="display:none"  >
    	<div class="row">
	    	<div class="col-lg-4">
	    		<div style="width:100%;">
	    			<div class="ibox float-e-margins" >
                    <div class="ibox-title">
                        <h6 style="font-size:13px;font-family:'黑体';font-weight:bold">买入确认</h6>
                        <div class="ibox-tools">
                           
                        </div>
                    </div>
                    <div class="ibox-content">
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
    </div>
      <?php echo $this->fetch('footer_v1.html'); ?>    
   <script> 
		var mySwiper = new Swiper('.swiper-container',{
		pagination: '.my-pagination-ul',
		paginationClickable: true,
		paginationBulletRender: function (index, className) {
		switch (index) {
		  case 0: name='产品详情';break;
		  case 1: name='产品规则';break;
		
		  default: name='';
		}
		      return '<li class="' + className + '">' + name + '</li>';
		  }
		})
	</script>
   

