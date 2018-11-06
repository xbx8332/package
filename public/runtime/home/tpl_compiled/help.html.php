<head>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/Application/Tpl/css/menu/style.css" media="screen" type="text/css" />
    <script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
     <script src="/Application/Tpl/js/menu/index.js"></script>
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
				<div class="col-lg-3">
				<ul id="accordion" class="accordion">
				<?php $_from = $this->_var['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'v');if (count($_from)):
    foreach ($_from AS $this->_var['v']):
?>
					<li>
						<div class="link">
							<?php echo $this->_var['v']['name']; ?><i class="fa fa-chevron-down"></i>
						</div>
						<ul class="submenu">
						<?php $_from = $this->_var['v']['wz']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vv');if (count($_from)):
    foreach ($_from AS $this->_var['vv']):
?>
							<li><a href="<?php
echo parse_url_tag("u:index|help#help_index|"."id=".$this->_var['vv']['id']."".""); 
?>" target="user_center"><?php echo $this->_var['vv']['name']; ?></a></li>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</ul>
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</div>	
               <div  class="col-lg-9" >
               		<iframe src="index.php?ctl=help&act=help_index&id=1" name="user_center"  width="100%" height="100%"  style="margin-top:30px;"></iframe>
               </div>
            </div>
        </section>
        <!-- End page content -->
        
		<?php echo $this->fetch('footer.html'); ?>       

