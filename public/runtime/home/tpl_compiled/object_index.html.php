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
   <script type="text/javascript" src="/Application/Tpl/js/object.js"></script> 
  
  <body>
     <div class="container top">
    	<div class="row">
	    	<div class="col-lg-8">
	    		<div class="ibox float-e-margins" >
                    <div class="ibox-title">
                        <h3 style="margin:0px;font-size:24px;color:#363636;width:70%;display:inline-block"><?php echo $this->_var['licai']['name']; ?> </h3>
                        <div class="ibox-tools" style="width:25%;height:18px;display:inline-block">
                          
                        	<p style="color:#8c8c8c;font-size:16px;text-align:center;">截止<?php echo $this->_var['licai']['end_date']; ?></p>
                        </div>
                    </div>
                    <div class="ibox-content" style="height:150px">
                        <div class="container-fluid">
                        	<div class="row">
                        		<div class="col-lg-4 rs_top">
                        			<h6 style="text-align:center;color:gray;font-size:16px">预计收益率</h6>
                        			<p><h1 style="font-size:40px;text-align:center;font-weight:bold;font-size:30px"><?php if ($this->_var['history']): ?><?php echo $this->_var['history']; ?><?php else: ?><?php echo $this->_var['licai']['scope']; ?><?php endif; ?>%</h2></p>
                        		</div>
                        		<div class="col-lg-4 rs_top">
                        		<h6 style="text-align:center;color:gray;font-size:16px">最低起购金额</h6>
                        			<p><h1 style="font-size:40px;text-align:center;font-weight:bold;font-size:30px"><?php echo $this->_var['licai']['min_money']; ?></h2></p>
                        		</div>
                        		<div class="col-lg-4 rs_top">
                        		<h6 style="text-align:center;color:gray;font-size:16px">投资风险</h6>
                        			<p><h1 style="font-size:40px;text-align:center;font-weight:bold;font-size:30px"><?php if ($this->_var['licai']['risk_rank'] == 0): ?>低<?php elseif ($this->_var['licai']['risk_rank'] == 1): ?>中<?php else: ?>高<?php endif; ?></h2></p>
                        		</div>
                        	</div>
                        </div>
                    </div>
                    <div class="ibox-footer" style="font-size:12px;font-family:PingFangSC-Regular;line-height:12px;color:#363636">
                      <img alt="" src="/Application/Tpl/images/example/icon_note.png">
                        目标收益与实际收益有差别，请谨慎投资
                    </div>
                </div>
	    	</div>
	    	<div class="col-lg-4">
	    		<div style="width:100%;height:200px;">
	    			<div class="ibox float-e-margins" >
                    <div class="ibox-title">
                        <h6 style="color:gray;font-size:13px;">起购金额:&nbsp;&nbsp;<em style="color:black"><?php echo $this->_var['licai']['min_money']; ?></em> </h6>
                        <h6 style="color:gray;font-size:13px;">余额:&nbsp;&nbsp;<?php if (! $this->_var['user']['id']): ?><a onclick="dl()"  style="color:rgba(238,185,44,1)">请登录</a><?php else: ?><em style="color:black"><?php echo $this->_var['user']['money']; ?></em>元<?php endif; ?> 
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
                        		<form action="">
	                        		<div class="col-lg-12">
	                        			<div class="input-group" >
										  <span class="input-group-addon" style="border-radius:0px;height:40px;background:white" id="basic-addon1">&yen;</span>
										  <input type="text" name="money" style="height:40px;" class="form-control" placeholder="<?php echo $this->_var['licai']['min_money_format_num']; ?>1000起购" aria-describedby="basic-addon1">
										</div>
										<h6 style="color:red;height:10px;font-size:13px;margin-top:0px"><!-- *余额不足请充值 --></h6>
	                        		</div>
	                        		<div class="col-lg-12">
	                        		<input type="hidden" name="type" value="<?php echo $this->_var['licai']['type']; ?>"  />
	                        		<input type="hidden" name="licai_id" value="<?php echo $this->_var['licai']['id']; ?>"  />
	                        			<input type="hidden" name="start" value="10000"  />
	                        		<button type="button" id="purchase" style="background-color:#EEB92C;border-color:#EEB92C;height:48px;color:white" class="btn btn-warning btn-lg btn-block">立即购买</button>
	                        		</div>
                        		</form>
                        	</div>
                        </div>
                    </div>
                    <!-- <div class="ibox-footer">
                      <img alt="" src="/Application/Tpl/images/example/icon_note.png">
                        目标收益与实际收益有差别，请谨慎投资
                    </div> -->
                </div>
	    		</div>
	    	</div>
    	
    	</div>
    </div>
    
    <!--产品详情和产品规则  -->
    <div class="container" style="height:420px;">
    	<div class="row">
    		<div class="col-lg-12">
    			<div class="swiper-container">
					<div class="my-pagination"><ul class="my-pagination-ul"></ul></div>
					<div class="swiper-wrapper">
				    	
						<div class="swiper-slide" style="height: 420px;">
				        	<!--手机绑定GO-->
				        	<?php echo $this->_var['licai']['description']; ?>
				        	<!-- <div class="user_zc_body">
				                <ul style="padding:15px 0">
				                	<li>
				                        <p class="p_input">
				                        	<div style="width: 10%;display: inline-block;vertical-align:top;" >
				                        		<span class="" style="color: gray;">名称</span>
				                        	</div>
				                        	<div style="width: 80%;display: inline-block;">
				                        		<span>新手专享一个月活期理财，发舒服舒服护身符时候发货爽肤水尽快发货舒服舒服改还剩废话少说见覅U盾是</span>
				                        	</div>
				                        	
				                        </p>
				                    </li>
				                    <li>
				                       <p class="p_input">
				                        	<div style="width: 10%;display: inline-block;;vertical-align:top;" >
				                        		<span class="" style="color: gray">加入条件</span>
				                        	</div>
				                        	<div style="width: 80%;display: inline-block;">
				                        		<span>新手专享一个月活期理财，发舒服舒服护身符时候发货爽肤水尽快发货舒服舒服改还剩废话少说见覅U盾是第三季方式发神经发送发计算机分行数据方式</span>
				                        	</div>
				                        	
				                        </p>
				                    </li>
				                    <li>
				                       <p class="p_input">
				                        	<div style="width: 10%;display: inline-block;;vertical-align:top;" >
				                        		<span class="" style="color: gray">投标范围</span>
				                        	</div>
				                        	<div style="width: 80%;display: inline-block;">
				                        		<span>新手专享一个月活期理财，发舒服舒服护身符时候发货爽肤水尽快发货舒服舒服改还剩废话少说见覅U盾是</span>
				                        	</div>
				                        	
				                        </p>
				                    </li>
				                    <li>
				                       <p class="p_input">
				                        	<div style="width: 10%;display: inline-block;;vertical-align:top;" >
				                        		<span class="" style="color: gray">投标范围</span>
				                        	</div>
				                        	<div style="width: 80%;display: inline-block;">
				                        		<span>新手专享一个月活期理财，发舒服舒服护身符时候发货爽肤水尽快发货舒服舒服改还剩废话少说见覅U盾是</span>
				                        	</div>
				                        	
				                        </p>
				                    </li>
				                </ul>
				            </div> -->
				            
				            
				            <!--手机绑定END-->
				            
				        </div>
				        
				        
						<div class="swiper-slide" style="height: 320px">
				        
				        	<!--固话绑定GO-->
				        	<?php echo $this->_var['licai']['rule_info']; ?>
				        	<!-- <div class="user_zc_body">
				                <ul style="padding:15px 0">
				                	<li>
				                        <p class="p_input">
				                        	<div style="width: 10%;display: inline-block;vertical-align:top;" >
				                        		<span class="" style="color: gray;">名称</span>
				                        	</div>
				                        	<div style="width: 80%;display: inline-block;">
				                        		<span>新手专享一个月活期理财，发舒服舒服护身符时候发货爽肤水尽快发货舒服舒服改还剩废话少说见覅U盾是</span>
				                        	</div>
				                        	
				                        </p>
				                    </li>
				                    <li>
				                       <p class="p_input">
				                        	<div style="width: 10%;display: inline-block;;vertical-align:top;" >
				                        		<span class="" style="color: gray">加入条件</span>
				                        	</div>
				                        	<div style="width: 80%;display: inline-block;">
				                        		<span>新手专享一个月活期理财，发舒服舒服护身符时候发货爽肤水尽快发货舒服舒服改还剩废话少说见覅U盾是第三季方式发神经发送发计算机分行数据方式</span>
				                        	</div>
				                        	
				                        </p>
				                    </li>
				                    <li>
				                       <p class="p_input">
				                        	<div style="width: 10%;display: inline-block;;vertical-align:top;" >
				                        		<span class="" style="color: gray">投标范围</span>
				                        	</div>
				                        	<div style="width: 80%;display: inline-block;">
				                        		<span>新手专享一个月活期理财，发舒服舒服护身符时候发货爽肤水尽快发货舒服舒服改还剩废话少说见覅U盾是</span>
				                        	</div>
				                        	
				                        </p>
				                    </li>
				                    <li>
				                       <p class="p_input">
				                        	<div style="width: 10%;display: inline-block;;vertical-align:top;" >
				                        		<span class="" style="color: gray">投标范围</span>
				                        	</div>
				                        	<div style="width: 80%;display: inline-block;">
				                        		<span>新手专享一个月活期理财，发舒服舒服护身符时候发货爽肤水尽快发货舒服舒服改还剩废话少说见覅U盾是</span>
				                        	</div>
				                        	
				                        </p>
				                    </li>
				                </ul>
				            </div> -->
				            
				        
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
     <?php echo $this->fetch('footer_v1.html'); ?>
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
   

