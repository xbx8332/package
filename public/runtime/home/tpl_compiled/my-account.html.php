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
        body{
            background:white;
        }
        
        .row-1{
            background:#fffbfb;
        }
        .panel-group{max-height:770px;overflow: auto;}
            .leftMenu{margin:10px;margin-top:5px;}
            .leftMenu .panel-heading{font-size:14px;padding-left:20px;height:36px;line-height:36px;color:white;position:relative;cursor:pointer;}/*转成手形图标*/
            .leftMenu .panel-heading span{position:absolute;right:10px;top:12px;}
            .leftMenu .menu-item-left{padding: 2px; background: transparent; border:1px solid transparent;border-radius: 6px;}
            .leftMenu .menu-item-left:hover{background:#C4E3F3;border:1px solid #1E90FF;}
    	.menu-bgcolor{
    		background:#fffbfb;
    	}
    	.accordion .link{
    		padding: 15px 15px 15px 42px !important;
    		color:gray !important;
    	}
    	 .submenu a{
    		color:black !important;
    	} 
    	/* .accordion:hover{
    		background:#F3F3F3;
    	} */
    </style>
    <script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/Application/Tpl/css/menu/style.css" media="screen" type="text/css" />
    <!-- <script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script> -->
     <script src="/Application/Tpl/js/menu/index.js"></script>
    
    <script>
	     $(function(){
	         $(".panel-heading").click(function(){
	             $(".collapse").removeClass("in");
	             
	         });
	     });
     </script>
</head>

    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    
    <?php echo $this->fetch('head.html'); ?>
<!--         Start of header area
        <header>
            <div class="header-bottom">
                <div class="container">
                    <div class="row header-middle-content">
                        <div class="col-md-5 col-sm-4 hidden-xs">
                            <div class="service-inner mt-10">
                                <span class="service-img b-img">
                                    <img alt="" src="/Application/Tpl/images/service.png">
                                </span>
                                <span class="service-content ml-15"><strong>+88 (012) 564 979 56</strong><br>We are open 9 am - 10pm</span>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                            <div class="header-logo text-center">
                                <a href="<?php
echo parse_url_tag("u:index|index|"."".""); 
?>"><img alt="" src="/Application/Tpl/images/logo.png"></a>
                            </div>
                        </div>
                        <div class="col-md-offset-0 col-md-5 col-sm-offset-0 col-sm-4 col-xs-offset-3 col-xs-6">
                            <div class="shopping-cart">
                                <a href="#">
                                    <span class="shopping-cart-control">
                                        <img alt="" src="/Application/Tpl/images/shop.png">
                                    </span>
                                    <span class="cart-size-value"><strong>Cart(3)</strong><br>$250</span>
                                </a>
                                <ul class="shopping-cart-down box-shadow white-bg">
                                    <li class="media">
                                        <a href="#"><img alt="" src="/Application/Tpl/images/cart/1.jpg"></a>
                                        <div class="cart-item-wrapper">
                                            <a href="#">Zelletria ostma</a>
                                            <span class="quantity">
                                                <span class="amount">$195</span>
                                                 x 2
                                            </span>
                                            <a title="Remove this item" class="remove" href="#">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a href="#"><img alt="" src="/Application/Tpl/images/cart/2.jpg"></a>
                                        <div class="cart-item-wrapper">
                                            <a href="#">Letria postma</a>
                                            <span class="quantity">
                                                <span class="amount">$145</span>
                                                 x 1
                                            </span>
                                            <a title="Remove this item" class="remove" href="#">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a href="#"><img alt="" src="/Application/Tpl/images/cart/3.jpg"></a>
                                        <div class="cart-item-wrapper">
                                            <a href="#">Montria jastma</a>
                                            <span class="quantity">
                                                <span class="amount">$155</span>
                                                 x 2
                                            </span>
                                            <a title="Remove this item" class="remove" href="#">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <span class="total-title pull-left">Sub Total</span>
                                        <span class="total pull-right">$845</span>
                                    </li>
                                    <li class="media">
                                        <a class="cart-btn" href="#">VIEW CART</a>
                                        <a class="cart-btn" href="#">CHECKOUT</a>
                                    </li>
                                </ul>                           
                            </div>
                        </div>
                        <nav class="primary-menu">
                            <ul class="header-top-style text-uppercase">
                                <li><a href="index.html">首页</a></li>
                                <li><a href="about.html">理财宝</a></li>
                                <li><a href="shop.html">好理财</a></li>
		      					<li><a href="<?php
echo parse_url_tag("u:index|loan#loaning|"."".""); 
?>">帮助中心</a></li>
		      					<li><a href="<?php
echo parse_url_tag("u:index|loan#index|"."".""); 
?>">我要贷款</a></li>
                                <li><a href="contact.html">个人中心</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            Start Breadcrumbs Area
        <div class="breadcrumbs-area breadcrumbs-bg ptb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumbs-inner">
                            <h5 class="breadcrumbs-disc m-0"></h5>
                            <h2 class="breadcrumbs-title text-black m-0">帮助中心</h2>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        End Breadcrumbs Area
        </header> -->
        <!-- End of header area -->
        
        <!-- Start page content -->
        <section id="page-content" class="page-wrapper pt-10">
            <div class="container">
            	<div class="row">
            		<div class="col-lg-3" style="background:#fff;padding:10px 0">
				 
				 <ul id="accordion" class="accordion">
		<li>
			<div class="link"><img alt="" width='12' height='12' src="/Application/Tpl/images/example/icon_side_profile_nor.png">&nbsp;&nbsp;我的账号<!-- <i class="fa fa-chevron-down"></i> --></div>
			<ul class="submenu">
				<li class="li_a" ><a href="<?php
echo parse_url_tag("u:index|usercenter#usercenter|"."".""); 
?>" target="user_center" >我的账户</a></li>
				<!-- <li><a href="<?php
echo parse_url_tag("u:index|usercenter#account_balance|"."".""); 
?>" target="user_center"  >账户余额</a></li>
				<li><a href="<?php
echo parse_url_tag("u:index|usercenter#recharge|"."".""); 
?>" target="user_center">充值</a></li> -->
				<li class="li_a" ><a href="<?php
echo parse_url_tag("u:index|usercenter#tixianlist|"."".""); 
?>" target="user_center">账号明细</a></li>
			</ul>
		</li>
		<li>
			<div class="link"><img alt="" width='12' height='12' src="/Application/Tpl/images/example/icon_side_count_nor.png">&nbsp;&nbsp;定期参股<!-- <i class="fa fa-chevron-down"></i> --></div>
			<ul class="submenu">
				<li class="li_a"><a href="<?php
echo parse_url_tag("u:index|usercenter#investment|"."".""); 
?>" target="user_center">购买记录</a></li>
				<li class="li_a"><a href="<?php
echo parse_url_tag("u:index|redeem#userredeem|"."".""); 
?>" target="user_center">赎回记录</a></li>
				<li class="li_a"><a href="<?php
echo parse_url_tag("u:index|redeem#profit|"."".""); 
?>" target="user_center">收益记录</a></li>
			</ul>
		</li>
		<li>
			<div class="link"><img alt="" width='12' height='12' src="/Application/Tpl/images/example/icon_side_coin_nor.png">&nbsp;&nbsp;活期参股<!-- <i class="fa fa-chevron-down"></i> --></div>
			<ul class="submenu">
				<li class="li_a"><a href="<?php
echo parse_url_tag("u:index|usercenter#current|"."".""); 
?>" target="user_center">转入记录</a></li>
				<li class="li_a"><a href="<?php
echo parse_url_tag("u:index|usercenter#current_out|"."".""); 
?>" target="user_center">转出记录</a></li>
				<li class="li_a"><a href="<?php
echo parse_url_tag("u:index|usercenter#current_list|"."".""); 
?>" target="user_center">收益记录</a></li>
			</ul>
		</li>
		<li><div class="link"><img alt="" width='12' height='12' src="/Application/Tpl/images/example/icon_side_security_nor.png">&nbsp;&nbsp;账户安全 <!-- <i class="fa fa-chevron-down"></i> --></div>
			<ul class="submenu">
				<li class="li_a"><a href="<?php
echo parse_url_tag("u:index|usercenter#security|"."".""); 
?>" target="user_center">账户安全</a></li>
				<li class="li_a"><a href="<?php
echo parse_url_tag("u:index|usercenter#bind_bankcard|"."".""); 
?>" target="user_center">银行卡绑定</a></li>
			</ul>
		</li>
		<li><div class="link"><img alt="" width='12' height='12' src="/Application/Tpl/images/example/icon_side_invit_nor.png">&nbsp;&nbsp;邀请好友 <!-- <i class="fa fa-chevron-down"></i> --></div>
			<ul class="submenu">
				<li class="li_a"><a href="<?php
echo parse_url_tag("u:index|usercenter#myfriend|"."".""); 
?>" target="user_center">邀请好友</a></li>
				<li class="li_a"><a href="<?php
echo parse_url_tag("u:index|usercenter#invitation|"."".""); 
?>" target="user_center">已邀请列表</a></li>
				
			</ul>
		</li>
	</ul>
		<script type="text/javascript">
			$(".submenu").find(".li_a").click(function(){
				console.log($(this));
				$(this).addClass("submenu_lia").siblings(".li_a").removeClass("submenu_lia").parent("li").siblings("li").children(".li_a").removeClass("submenu_lia");
				
			})
			$("#accordion").find("")
			
		</script>		 
				 
				 
				  <!-- <div class="panel-group table-responsive" role="tablist">
                    <div class="panel panel-primary leftMenu" style="border:1px solid #f05244;">
                        利用data-target指定要折叠的分组列表
                        <div class="panel-heading collapsed" id="collapseListGroupHeading1" style="background:#f05244;" data-toggle="collapse" data-target="#collapseListGroup1" role="tab" >
                            <h4 class="panel-title">
                               		个人中心
                                <span class="glyphicon glyphicon-chevron-up right"></span>
                            </h4>
                        </div>
                        .panel-collapse和.collapse标明折叠元素 .in表示要显示出来
                        <div id="collapseListGroup1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading1">
                            <ul class="list-group">
                            	<li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                    <a href="<?php
echo parse_url_tag("u:index|usercenter#usercenter|"."".""); 
?>" target="user_center">我的账户</a>
                                </button>
                              </li>
                              	<li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                	<a href="<?php
echo parse_url_tag("u:index|usercenter#account_balance|"."".""); 
?>" target="user_center">账户余额</a>
                                </button>
                              </li>
                              <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                	<a href="<?php
echo parse_url_tag("u:index|usercenter#recharge|"."".""); 
?>" target="user_center">充值</a>
                                </button>
                              </li>
                              <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                	<a href="<?php
echo parse_url_tag("u:index|usercenter#tixianlist|"."".""); 
?>" target="user_center">提现记录</a>
                                </button>
                              </li>
                            </ul>
                        </div>
                    </div>panel end
  					定期理财记录
  					<div class="panel panel-primary leftMenu" style="border:1px solid #f05244;">
                        <div class="panel-heading collapsed" id="collapseListGroupHeading6" style="background:#f05244;" data-toggle="collapse" data-target="#collapseListGroup6" role="tab" >
                            <h4 class="panel-title">
                                		定期理财
                                <span class="glyphicon glyphicon-chevron-down right"></span>
                            </h4>
                        </div>
                        <div id="collapseListGroup6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading2">
                            <ul class="list-group">
                              <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                    		<a href="<?php
echo parse_url_tag("u:index|usercenter#investment|"."".""); 
?>" target="user_center">购买记录</a>
                                </button>
                              </li>
                              <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                    		<a href="<?php
echo parse_url_tag("u:index|redeem#userredeem|"."".""); 
?>" target="user_center">赎回记录</a>
                                </button>
                              </li>
                              <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                    		<a href="<?php
echo parse_url_tag("u:index|redeem#profit|"."".""); 
?>" target="user_center">收益记录</a>
                                </button>
                              </li>
                            </ul>
                        </div>
                    </div>
                    活期理财
                    <div class="panel panel-primary leftMenu" style="border:1px solid #f05244;">
                        <div class="panel-heading collapsed" id="collapseListGroupHeading7" style="background:#f05244;" data-toggle="collapse" data-target="#collapseListGroup7" role="tab" >
                            <h4 class="panel-title">
                                		活期理财
                                <span class="glyphicon glyphicon-chevron-down right"></span>
                            </h4>
                        </div>
                        <div id="collapseListGroup7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading2">
                            <ul class="list-group">
                              <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                    		<a href="<?php
echo parse_url_tag("u:index|usercenter#current|"."".""); 
?>" target="user_center">转入记录</a>
                                </button>
                              </li>
                              <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                    		<a href="<?php
echo parse_url_tag("u:index|usercenter#current_out|"."".""); 
?>" target="user_center">转出记录</a>
                                </button>
                              </li>
                              <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                    		<a href="<?php
echo parse_url_tag("u:index|usercenter#current_list|"."".""); 
?>" target="user_center">收益记录</a>
                                </button>
                              </li>
                            </ul>
                        </div>
                    </div>
					<div class="panel panel-primary leftMenu" style="border:1px solid #f05244;">
                        <div class="panel-heading" id="collapseListGroupHeading4" style="background:#f05244;" data-toggle="collapse" data-target="#collapseListGroup4" role="tab" >
                            <h4 class="panel-title">
                                		银行卡
                                <span class="glyphicon glyphicon-chevron-down right"></span>
                            </h4>
                        </div>
                        <div id="collapseListGroup4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading2">
                            <ul class="list-group">
                              
                              <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                    		<a href="<?php
echo parse_url_tag("u:index|usercenter#bind_bankcard|"."".""); 
?>" target="user_center">银行卡绑定</a>
                                </button>
                              </li>
                            </ul>
                        </div>
                    </div>		
                    <div class="panel panel-primary leftMenu" style="border:1px solid #f05244;">
                        <div class="panel-heading" id="collapseListGroupHeading3" style="background:#f05244;" data-toggle="collapse" data-target="#collapseListGroup3" role="tab" >
                            <h4 class="panel-title">
                                		邀请好友
                                <span class="glyphicon glyphicon-chevron-down right"></span>
                            </h4>
                        </div>
                        <div id="collapseListGroup3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading2">
                            <ul class="list-group">
                              <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                    		<a href="<?php
echo parse_url_tag("u:index|usercenter#myfriend|"."".""); 
?>" target="user_center">邀请好友</a>
                                </button>
                              </li>
                              <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                    		<a href="<?php
echo parse_url_tag("u:index|usercenter#invitation|"."".""); 
?>" target="user_center">已邀请列表</a>
                                </button>
                              </li>
                            </ul>
                        </div>
                    </div>
                   
	                   
                    		<div class="panel panel-primary leftMenu" style="border:1px solid #f05244;">
                        <div class="panel-heading" id="collapseListGroupHeading5" style="background:#f05244;" data-toggle="collapse" data-target="#collapseListGroup5" role="tab" >
                            <h4 class="panel-title">
                                		安全设置
                                <span class="glyphicon glyphicon-chevron-down right"></span>
                            </h4>
                        </div>
                        <div id="collapseListGroup5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading2">
                            <ul class="list-group">
                              <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>
                                    		<a href="<?php
echo parse_url_tag("u:index|usercenter#security|"."".""); 
?>" target="user_center">账户安全</a>
                                </button>
                              </li>
                            </ul>
                        </div>
                    </div>		
				</div>  -->
              <!--  <div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" 
									   href="#collapseOne">
										<img alt="" width='10' height='10' src="/Application/Tpl/images/example/icon_side_profile_nor.png">
										我的账号
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in">
								<div class="panel-body">
									<ul class="list-group">
		                            	<li class="list-group-item">
		                                <button class="menu-item-left">
		                                    <span class="glyphicon glyphicon-triangle-right"></span>
		                                    <a href="<?php
echo parse_url_tag("u:index|usercenter#usercenter|"."".""); 
?>" target="user_center">我的账户</a>
		                                </button>
		                              </li>
		                              	<li class="list-group-item">
		                                <button class="menu-item-left">
		                                    <span class="glyphicon glyphicon-triangle-right"></span>
		                                	<a href="<?php
echo parse_url_tag("u:index|usercenter#account_balance|"."".""); 
?>" target="user_center">账户余额</a>
		                                </button>
		                              </li>
		                              <li class="list-group-item">
		                                <button class="menu-item-left">
		                                    <span class="glyphicon glyphicon-triangle-right"></span>
		                                	<a href="<?php
echo parse_url_tag("u:index|usercenter#recharge|"."".""); 
?>" target="user_center">充值</a>
		                                </button>
		                              </li>
		                              <li class="list-group-item">
		                                <button class="menu-item-left">
		                                    <span class="glyphicon glyphicon-triangle-right"></span>
		                                	<a href="<?php
echo parse_url_tag("u:index|usercenter#tixianlist|"."".""); 
?>" target="user_center">提现记录</a>
		                                </button>
		                              </li>
		                            </ul>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" 
									   href="#collapseTwo">
										<img alt="" width='10' height='10' src="/Application/Tpl/images/example/icon_side_count_nor.png">
										定期理财
									</a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse">
								<div class="panel-body">
									Nihil anim keffiyeh helvetica, craft beer labore wes anderson 
									cred nesciunt sapiente ea proident. Ad vegan excepteur butcher 
									vice lomo.
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" 
									   href="#collapseThree">
										<img alt="" width='10' height='10' src="/Application/Tpl/images/example/icon_side_coin_nor.png">
										活期理财
									</a>
								</h4>
							</div>
							<div id="collapseThree" class="panel-collapse collapse">
								<div class="panel-body">
									Nihil anim keffiyeh helvetica, craft beer labore wes anderson 
									cred nesciunt sapiente ea proident. Ad vegan excepteur butcher 
									vice lomo.
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" 
									   href="#collapseFour">
										<img alt="" width='10' height='10' src="/Application/Tpl/images/example/icon_side_security_nor.png">
										账号安全
									</a>
								</h4>
							</div>
							<div id="collapseFour" class="panel-collapse collapse">
								<div class="panel-body">
									Nihil anim keffiyeh helvetica, craft beer labore wes anderson 
									cred nesciunt sapiente ea proident. Ad vegan excepteur butcher 
									vice lomo.
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" 
									   href="#collapseFive">
										<img alt="" width='10' height='10' src="/Application/Tpl/images/example/icon_side_invit_nor.png">
										邀请好友
									</a>
								</h4>
							</div>
							<div id="collapseFive" class="panel-collapse collapse">
								<div class="panel-body">
									Nihil anim keffiyeh helvetica, craft beer labore wes anderson 
									cred nesciunt sapiente ea proident. Ad vegan excepteur butcher 
									vice lomo.
								</div>
							</div>
						</div>
					</div> -->
            	</div>
               <div  class="col-lg-9" >
               		<iframe src="/index.php?ctl=usercenter&act=usercenter" name="user_center"  width="100%" height="140%" scrolling="no" ></iframe>
               </div>
            </div>
        </section>
        <!-- End page content -->
        
		<?php echo $this->fetch('footer.html'); ?>       

