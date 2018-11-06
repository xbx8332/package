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
        .fs{
        	text-align:center;
        	font-size:12px
        }
        span.counter {display:block;  font-size:50px; font-family:'Pacifico';color:#f05244;}
    </style>
     <!--echarts -->      
	<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts-all-3.js"></script>
	<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/dataTool.min.js"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=PSFy3jtjuMs55uACdrtdW1nkLTO0GPFd"></script>
	<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.min.js"></script>
	<!--end echarts-->
    
    <link rel="stylesheet" href="/Application/Tpl/css/style.css">
    <link rel="stylesheet" href="/Application/Tpl/swiper/swiper.min.css">

	<script src="/Application/Tpl/swiper/swiper.min.js"></script>
	<link href="/Application/Tpl/css/page_style.css" rel="stylesheet" type="text/css">
	<script>
		var buy_url = "<?php
echo parse_url_tag("u:index|object#buy_confirm|"."".""); 
?>";
		var user = "<?php echo $this->_var['user']['id']; ?>";
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
	</script>
	
</head>


    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    
  <?php echo $this->fetch('head.html'); ?>
  <script type="text/javascript" src="/Application/Tpl/js/regular.js"></script>
  <script type="text/javascript" src="/Application/Tpl/js/digitalScroll.js"></script>
  
  <body>
     <div class="container top">
    	<div class="row">
	    	<div class="col-lg-8">
	    	<?php if (1 == 0): ?>
	    	<div class="ibox float-e-margins" >
                    <div class="ibox-title">
                         <h3 style="margin:0px;color:#363636;width:70%;display:inline-block"><?php echo $this->_var['licai']['name']; ?> </h3>
                        <div class="ibox-tools" style="width:25%;height:18px;display:inline-block">
                          
                        	<p style="color:#8c8c8c;font-size:16px;text-align:center;"><?php echo $this->_var['licai']['end_date']; ?></p>
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
                        			<p><h1 style="text-align:center;font-weight:bold;font-size:30px"><?php if ($this->_var['licai']['risk_rank'] == 0): ?>低<?php elseif ($this->_var['licai']['risk_rank'] == 1): ?>中<?php else: ?>高<?php endif; ?></h2></p>
                        		</div>
                        	</div>
                        </div>
                    </div>
                    <div class="ibox-footer">
                      <img alt="" src="/Application/Tpl/images/example/icon_note.png">
                        目标收益与实际收益有差别，请谨慎投资
                    </div>
                </div>
	    	<?php elseif (1 == 1): ?>
	    		<div class="ibox float-e-margins" >
                    <div class="ibox-title">
                         <h3 style="margin:0px;font-size:24px;color:#363636;width:70%;display:inline-block"><?php echo $this->_var['licai']['name']; ?> </h3>
                        <div class="ibox-tools" style="width:25%;height:18px;display:inline-block">
                          
                        	<p style="color:#8c8c8c;font-size:16px;text-align:center;">截止<?php echo $this->_var['licai']['end_date']; ?></p>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="container-fluid">
                        	<div class="row">
                        		<div class="col-lg-7 ">
                        			<h6 style="text-align:left;font-size:12px">总金额/元</h6>
                        			<p><h1 class="t_num t_num1" style="text-align:left;font-weight:bold;font-size:30px"><?php echo $this->_var['huo_money']; ?></h2></p>
                        		</div>
                        		<div class="col-lg-2 ">
                        		
                        		</div>
                        		<div class="col-lg-3 " >
                        			<a onclick="zhuanchu()" style="margin:20px 0;color:rgb(238,185,44);border:1px solid rgb(238,185,44);background:rgb(255,255,255); !important" class="btn btn-default  btn-lg btn-block">转出</a>
                        		</div>
                        	</div>
                        </div>
                    </div>
                    <div class="ibox-footer">
                      <!-- <img alt="" src="/Application/Tpl/images/example/icon_note.png">
                        目标收益与实际收益有差别，请谨慎投资 -->
                        <div class="container-fluid">
                        	<div class="row">
                        		<div class="col-lg-3 ">
                        			<h6 class="fs" >体验金/元</h6>
                        			<p><h1 style="text-align:center;font-size:20px"><?php echo $this->_var['nmc_amount']; ?></h2></p>
                        		</div>
                        		<div class="col-lg-3 " style="border-right:1px solid #ededed;" >
                        		<h6 class="fs" >累计收益/元</h6>
                        			<p><h1 style="text-align:center;font-size:20px"><?php echo $this->_var['h_profit']; ?></h2></p>
                        		</div>
                        		<div class="col-lg-3 ">
                        		<h6 class="fs" >目标年化</h6>
                        			<p><h1 style="text-align:center;font-size:20px"><?php echo $this->_var['history']; ?>%</h2></p>
                        		</div>
                        		<div  class="col-lg-3 ">
                        		<h6 class="fs" >历史年化</h6>
                        			<p><h1 style="text-align:center;font-size:20px"><?php echo $this->_var['history']; ?>%</h2></p>
                        		</div>
                        	</div>
                        </div>
                    </div>
                </div>
	    	<?php endif; ?>
	    		
	    	</div>
	    	<div class="col-lg-4">
	    		<div style="width:100%;height:200px;">
	    			<div class="ibox float-e-margins" >
                    <div class="ibox-title">
                        <h6 style="color:gray;font-size:13px;">起购金额:&nbsp;&nbsp;<em style="color:black"><?php echo $this->_var['licai']['min_money']; ?></em> </h6>
                        <h6 style="color:gray;font-size:13px;">余额:&nbsp;&nbsp;<em style="color:black"><!-- 1000.00 --><?php if ($this->_var['user']['id']): ?><?php if ($this->_var['user']['money']): ?><?php echo $this->_var['user']['money']; ?><?php else: ?>0.00<?php endif; ?>元<?php else: ?><a onclick="dl()" style="color:rgba(238,185,44,1)">请登录</a><?php endif; ?></em> 
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
	                        			<div class="input-group">
										  <span class="input-group-addon" style="border-radius:0px;height:40px;background:white" id="basic-addon1">&yen;</span>
										  <input type="text" name="money" style="height:40px;" class="form-control" placeholder="<?php echo $this->_var['licai']['min_money']; ?>起购" aria-describedby="basic-addon1">
										</div>
										<h6 style="color:red;height:12px;font-size:13px;margin-top:10px"><!-- *余额不足请充值 --></h6>
	                        		</div>
	                        		<div class="col-lg-12">
	                        		<input type="hidden" name="type" value="<?php echo $this->_var['licai']['type']; ?>"  />
	                        		<input type="hidden" name="licai_id" value="<?php echo $this->_var['licai']['id']; ?>"  />
	                        		<input type="hidden" name="name" value="<?php echo $this->_var['licai']['name']; ?>"  />
	                        			<input type="hidden" name="start" value="<?php echo $this->_var['licai']['min_money']; ?>"  />
	                        			<button type="button" id="purchase" style="background-color:#EEB92C;border-color:#EEB92C;height:48px;color:white" class="btn  btn-lg btn-block">立即购买</button>
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
    
 
    <div class="container">
	   	<div class="row " >
	   		<div class="col-lg-12 "  >
	   			<div class="container-fluid four_bg">
	   				<div class="row " >
	   				   <div class="col-lg-6 hj"  >
				   			<div id="main1" style="width:100%;height:250px;"></div>
			           </div>
			           <div class="col-lg-6 hj">
			           	<div id="main2" style="width:100%;height:250px;"></div>
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
	          
	
   
    <div class="container top" style="height:420px;">
    	<div class="row">
    		<div class="col-lg-12">
    			<div class="swiper-container" style="height: auto;">
					<div class="my-pagination"><ul class="my-pagination-ul"></ul></div>
					<div class="swiper-wrapper" style="height: auto;">
				    	
						<div class="swiper-slide">
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
				                        		<span>新手专享一个月活期理财</span>
				                        	</div>
				                        	
				                        </p>
				                    </li>
				                    <li>
				                       <p class="p_input">
				                        	<div style="width: 10%;display: inline-block;;vertical-align:top;" >
				                        		<span class="" style="color: gray">加入条件</span>
				                        	</div>
				                        	<div style="width: 80%;display: inline-block;">
				                        		<span>最低加入金额10000元，单期最高加入限额50,0000元。</span>
				                        	</div>
				                        	
				                        </p>
				                    </li>
				                    <li>
				                       <p class="p_input">
				                        	<div style="width: 10%;display: inline-block;;vertical-align:top;" >
				                        		<span class="" style="color: gray">投标范围</span>
				                        	</div>
				                        	<div style="width: 80%;display: inline-block;">
				                        		<span>根据用户加入时选定的产品要素为依据，对符合要求的融资项目进行自动投标。为避免打扰用户，回款信息不以短信方式通知但在用户轻松投账户内可查询。</span>
				                        	</div>
				                        	
				                        </p>
				                    </li>
				                    <li>
				                       <p class="p_input">
				                        	<div style="width: 10%;display: inline-block;;vertical-align:top;" >
				                        		<span class="" style="color: gray">说明</span>
				                        	</div>
				                        	<div style="width: 80%;display: inline-block;">
				                        		<span>系统于约定退出日期发起债权转让以实现退出目的。用户持有的债权转让完成的具体时间视交易情况而定，未能成功出让的债权将由用户继续持有，系统自动再次甚至多次发起债权转让，直至用户成功退出，退出完成前，资产利息归用户享有。</span>
				                        	</div>
				                        	
				                        </p>
				                    </li>
				                </ul>
				            </div> -->
				            
				            
				            <!--手机绑定END-->
				            
				        </div>
				        
				        
						<div class="swiper-slide" style="height: 320px;">
				        <?php echo $this->_var['licai']['rule_info']; ?>
				        	<!--固话绑定GO-->
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
<!--echart图表  -->
 <script>
	      	//基于准备好的dom，初始化echarts实例		--实时监测区域
			var dom = document.getElementById("main1");
			var myChart = echarts.init(dom);
			/*  var mData1 = ['1-10','1-11','1-12','1-13','1-14','1-15','1-16'];
			var sData1 = [10,20,25,40,35,60,70];  */
			 var mData1 = [];
			var sData1 = []; 
			<?php $_from = $this->_var['the_one']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
				mData1.unshift('<?php echo $this->_var['key']; ?>');
				sData1.unshift('<?php echo $this->_var['item']; ?>');
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			//var sData1 = ["<?php echo $this->_var['point']['4']; ?>","<?php echo $this->_var['point']['3']; ?>","<?php echo $this->_var['point']['2']; ?>","<?php echo $this->_var['point']['1']; ?>","<?php echo $this->_var['point']['0']; ?>"];;
			optionPoint=setOptionPoint(mData1,sData1);
			initChartPoint(optionPoint);
			
			function setOptionPoint(mData,sData)
			{
				optionTrade = {
					backgroundColor: 'rgba(255,255,255,0)',
					title: {
						text: '',
						textStyle: {
							fontWeight: 'normal',
							fontSize: 16,
							color: '#F1F1F3'
						},
						left: '6%'
					},
					tooltip: {
						trigger: 'axis',
						axisPointer: {
							lineStyle: {
								color: '#57617B'
							}
						}
					},
					legend: {
						icon: 'rect',
						itemWidth: 14,
						itemHeight: 5,
						itemGap: 13,
						data: ['历史年化收益'],
						right: '4%',
						textStyle: {
							fontWeight:'bold',
							fontSize: 15,
							color: '#000'
						}
					},
					grid: {
						show:false,
						left: '0%',
						right: '5%',
						bottom: '0%',
						containLabel: true
					},
					xAxis: [{
						splitLine:{show: false},
						type: 'category',
						boundaryGap: false,
						axisLine: {
							lineStyle: {
								color: '#fff'
							}
						},
						axisLabel: {
						  
							textStyle: {
								fontSize: 14,
								 color: '#808080'
							}
						},
						data:mData
					}],
					yAxis: [{
						
						type: 'value',
						axisTick: {
							show: false
						},
						axisLine: {
							lineStyle: {
								color: '#fff'
							}
						},
						axisLabel: {
							margin: 10,
							textStyle: {
								fontSize: 14,
								 color: '#808080'
							}
						},
						splitLine: {
							show:true,
							lineStyle: {
								color: '#EDEDED'
							}
						}
					}],
					series: [{
						name: '历史年化收益',
						type: 'line',
						smooth: false,
						lineStyle: {
							normal: {
								width: 1
							}
						},
						areaStyle: {
							normal: {
								color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
									offset: 0,
									color: 'rgba(238,185,44, 0.3)'
								}, {
									offset: 0.8,
									color: 'rgba(238,185,44, 0)'
								}], false),
								shadowColor: 'rgba(0, 0, 0, 0.1)',
								shadowBlur: 10
							}
						},
						itemStyle: {
							normal: {
								color: 'rgb(238,185,44)'
							}
						},
						data: sData
					} ]
				
				}
				
				return optionTrade;
			
			}
				
				
			//初始化图表
			function initChartPoint(chartOption)
			{
				if (chartOption && typeof chartOption === "object") {
					myChart.setOption(chartOption, true);
				}
			
			}
			
			/*右  */
			//基于准备好的dom，初始化echarts实例		--实时监测区域
			var dom1 = document.getElementById("main2");
			var myChart1 = echarts.init(dom1);
			 /* var mData2 = ['1-10','1-11','1-12','1-13','1-14','1-15','1-16'];
			var sData2 = [10,20,25,40,35,60,70];  */
			var mData2 = [];
			var sData2 = [];
			<?php $_from = $this->_var['the_two']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
				mData2.unshift('<?php echo $this->_var['key']; ?>');
				sData2.unshift('<?php echo $this->_var['item']; ?>');
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			//var sData1 = ["<?php echo $this->_var['point']['4']; ?>","<?php echo $this->_var['point']['3']; ?>","<?php echo $this->_var['point']['2']; ?>","<?php echo $this->_var['point']['1']; ?>","<?php echo $this->_var['point']['0']; ?>"];;
			optionPoint1=setOptionPoint1(mData2,sData2);
			initChartPoint1(optionPoint1);
			
			function setOptionPoint1(mData1,sData1)
			{
				optionTrade = {
					backgroundColor: 'rgba(255,255,255,0)',
					title: {
						text: '',
						textStyle: {
							fontWeight: 'normal',
							fontSize: 16,
							color: '#F1F1F3'
						},
						left: '6%'
					},
					tooltip: {
						trigger: 'axis',
						axisPointer: {
							lineStyle: {
								color: '#ff7405'
							}
						}
					},
					legend: {
						icon: 'rect',
						itemWidth: 14,
						itemHeight: 5,
						itemGap: 13,
						data: ['万分收益/元'],
						right: '4%',
						textStyle: {
							fontWeight:'bold',
							fontSize: 15,
							color: '#000'
						}
					},
					grid: {
						show:false,
						left: '0%',
						right: '5%',
						bottom: '0%',
						containLabel: true
					},
					xAxis: [{
						splitLine:{show: false},
						type: 'category',
						boundaryGap: false,
						axisLine: {
							lineStyle: {
								
								color: '#fff'
							}
						},
						axisLabel: {
						  
							textStyle: {
								fontSize: 14,
								 color: '#808080'
							}
						},
						data:mData1
					}],
					yAxis: [{
						
						type: 'value',
						axisTick: {
							show: false
						},
						axisLine: {
							lineStyle: {
								color: '#fff'
							}
						},
						axisLabel: {
							margin: 10,
							textStyle: {
								fontSize: 14,
								 color: '#808080'
							}
						},
						splitLine: {
							show:true,
							lineStyle: {
								color: '#EDEDED'
							}
						}
					}],
					series: [{
						name: '万分收益/元',
						type: 'line',
						smooth: false,
						lineStyle: {
							normal: {
								width: 1
							}
						},
						areaStyle: {
							normal: {
								color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
									offset: 0,
									color: 'rgba(238,185,44, 0.3)'
								}, {
									offset: 0.8,
									color: 'rgba(238,185,44, 0)'
								}], false),
								shadowColor: 'rgba(0, 0, 0, 0.1)',
								shadowBlur: 10
							}
						},
						itemStyle: {
							normal: {
								color: 'rgb(238,185,44)'
							}
						},
						data: sData1
					} ]
				
				}
				
				return optionTrade;
			
			}
				
				
			//初始化图表
			function initChartPoint1(chartOption)
			{
				if (chartOption && typeof chartOption === "object") {
					myChart1.setOption(chartOption, true);
				}
			
			}
			
        </script>
   

