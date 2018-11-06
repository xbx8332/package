        <!-- Start footer area -->
        <style>
        .emphsis{
        	color:rgba(140,140,140,1);
        }
        .coordinatebrand{
        	
        	font-weight:bolder;
        }	
        </style>
        <footer id="footer" class="footer-area" style="background:white;margin-top:100px;">
        
        	<div class="container" style="height:192px;padding:15px 0px;line-height:35px;">
        		<div class="row">
        			<div class="col-lg-2">
        				<div class="font-16 coordinatebrand">网站地图</div>
        				<table style="width:100%;">
        					<tr class="font-16" class="emphsis" >
        						<td><a class="emphsis" href="<?php
echo parse_url_tag("u:index|index|"."".""); 
?>">首页</a></td>
        						<td><a class="emphsis" href="<?php
echo parse_url_tag("u:index|loan|"."".""); 
?>">我要贷款</a></td>
        					</tr>
        					<tr class="font-16" >
        						<td><a class="emphsis" href="<?php
echo parse_url_tag("u:index|object|"."".""); 
?>">活期理财</a></td>
        						<td><a class="emphsis" href="<?php
echo parse_url_tag("u:index|help|"."".""); 
?>">帮助中心</a></td>
        					</tr>
        					<tr class="font-16" >
        						<td><a class="emphsis" href="<?php
echo parse_url_tag("u:index|object#regular|"."".""); 
?>">定期理财</a></td>
        						<td><a  class="emphsis" href="<?php
echo parse_url_tag("u:index|usercenter|"."".""); 
?>">个人中心</a></td>
        					</tr>
        				</table>
        			</div>
        			<div class="col-lg-3">
        				<div class="font-16 coordinatebrand">关于我们</div>
        				<table style="width:100%;">
        					<tr class="font-16" style="color:rgba(140,140,140,1);">
        						<td>联系方式：</td>
        						<td><?php echo $this->_var['icon']['WEBSITE_TEL']; ?></td>
        					</tr>
        					<tr class="font-16" style="color:rgba(140,140,140,1);">
        						<td>服务时间：</td>
        						<td>08:00-18:00</td>
        					</tr>
        					<tr class="font-16" style="color:rgba(140,140,140,1);">
        						<td>电子邮箱：</td>
        						<td><?php echo $this->_var['icon']['WEBSITE_EMAIL']; ?></td>
        					</tr>
        				</table>
        			</div>
        			<div class="col-lg-2" style="text-align:center;">
        				<img  src="/Application/Tpl/images/index/erwei.jpg" />
        			</div>
        			<div class="col-lg-5">
        				<p class="coordinatebrand" style="color:#000;">合作品牌</p>
        				<img src="/Application/Tpl/images/index/3333.png" />
        			</div>
        		</div>
        	</div>
        
        
        
        	<!-- <div class="footer-top-area text-center ptb-40" >
              
                    <div class="row">
                        <div class="col-md-12">
                            <div class="footer-top-content">
                                <a href="index.html">
                                    <img src="/Application/Tpl/images/footer/logo1.png" alt="">
                                </a>
                                <p class="pb-30"></p>
                                 <ul class="social-icon">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li>< a href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
               
            </div> -->
        	<!-- <div class="footer-middle-area footer-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="single-footer-inner">
                                <h5 class="footer-title text-white">关于我们</h5>
                                <ul class="footer-contact">
                                   
                                    <li class="footer-text text-ash">
                                        <p><img alt="" src="<?php echo $this->_var['icon']['WEBSITE_LOGO']; ?>"></p>
                                        
                                    </li>
                                </ul>
                                <ul class="footer-contact">
                                    
                                    <li class="footer-text text-ash">
                                        <p>固定电话 : <?php echo $this->_var['icon']['WEBSITE_TEL']; ?></p>
                                        <p>移动电话 : <?php echo $this->_var['icon']['WEBSITE_MOBILE']; ?></p>
                                    </li>
                                </ul>
                                <ul class="footer-contact">
                                   
                                    <li class="footer-text text-ash">
                                        <p>Email : <?php echo $this->_var['icon']['WEBSITE_EMAIL']; ?></p>
                                        <p>Web : www.shenniu.com</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="single-footer-inner">
                                <h5 class="footer-title text-white">网站地图</h5>
                                <ul class="footer-menu">
	                                <li><a href="<?php
echo parse_url_tag("u:index|index|"."".""); 
?>">首页</a></li>
	                                <li><a href="<?php
echo parse_url_tag("u:index|object#index|"."".""); 
?>">垚鑫宝</a></li>
	                                <li><a href="<?php
echo parse_url_tag("u:index|object#regular|"."".""); 
?>">定期宝</a></li>
	                                <li><a href="<?php
echo parse_url_tag("u:index|loan#index|"."".""); 
?>">我要贷款</a></li>
			      					<li><a href="#">帮助中心</a></li>
	                                <li><a href="<?php
echo parse_url_tag("u:index|usercenter#index|"."".""); 
?>">个人中心</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="single-footer-inner">
                                <h5 class="footer-title text-white">帮助中心</h5>
                                <ul class="footer-menu">
                                    <li><a href="#">Delivery information</a></li>
                                    <li><a href="3">Order tracking</a></li>
                                    <li><a href="#">Return product</a></li>
                                    <li><a href="#">Gift card</a></li>
                                    <li><a href="#">Home delivery</a></li>
                                    <li><a href="#">Online support</a></li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div> -->
            <!-- <div class="footer-bottom-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="copyright">
                                <p>Copyright &copy; <?php echo $this->_var['icon']['WEBSITE_COPYRIGHT']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-5 hidden-sm hidden-xs">
                            <nav>
                                <ul class="footer-bottom-menu">
                                    <li><a>备案号：<?php echo $this->_var['icon']['WEBSITE_ICP']; ?></a></li>
                                    <li><a>网站名称：<?php echo $this->_var['icon']['WEBSITE_TITLE']; ?></a></li>
                                    
                                </ul>
                            </nav>
                        </div>
                        
                    </div>
                </div>
            </div> -->
            
        </footer>
        <!-- End footer area -->  
           
    <!-- Body main wrapper end -->    

    <!-- Placed js at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="/Application/Tpl/js/bootstrap.min.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="/Application/Tpl/js/plugins.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="/Application/Tpl/js/main.js"></script>
	<style>
		.footer-top-area {
		height:200px;
		   background: rgba(0, 0, 0, 0) url("<?php echo $this->_var['icon']['WEBSITE_SLIDER_2']; ?>") no-repeat fixed center center / cover ;
		}
	</style>

</html>  