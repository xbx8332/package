<?php echo $this->fetch('head.html'); ?>  
<script src='http://kf.json.red/assets/libs/jquery/jquery.min.js'></script>
 <script src='http://kf.json.red/assets/js/index/kefu_online.js'></script>
<a href='http://kf.json.red' user_id='' username='' avatar='' web_id='admin' id='workerman-kefu'></a>
<script type="text/javascript" src="/Application/Tpl/js/vendor/script.js"></script> 
<link rel="stylesheet" type="text/css" href="/Application/Tpl/css/plugins/style.css" />
<style>
	.Div1_main_a1 li{
		display:inline-block;
		height:80px;
		float:left;
	}
	.ulli-index li{
		float:left;
	}
	.td-p p{
	margin:0px;
	line-height:1.5rem;
	}
	.td-p .p1{
		font-size:16px;
		color:white;
	}
	.td-p .p2{
	font-size:12px;
		color:white;
	}
	.owl-item{
		background:white;
		margin-right:20px;
	}
	.fuzzy{
		/* box-shadow: 50px 0px 200px 100px #ededed ; */
		position:relative;
	}
	.hidefuzzy{
		opacity:1;
		background: #fff;
		width:150px;
		height:130%;
		position:absolute;
		right:-50px;
		top:-50px;
		z-index:5;
		
	}
	.aa{
		box-shadow: -50px 0px 200px 50px #fff;
		background: -webkit-linear-gradient(right,rgba(255,255,240,0),rgba(255,255,240,1)); /* Safari 5.1 - 6 */
        background: -o-linear-gradient(left,rgba(255,255,240,0),rgba(255,255,240,1)); /* Opera 11.1 - 12*/
        background: -moz-linear-gradient(left,rgba(255,255,240,0),rgba(255,255,240,1)); /* Firefox 3.6 - 15*/
        background: linear-gradient(to left, rgba(255,255,240,0), rgba(255,255,240,1)); /* 标准的语法 */
	}
	.indicator-style.owl-theme .owl-controls .owl-buttons div.owl-prev{
		border-radius:10px !important;
	}
	.indicator-style.owl-theme .owl-controls .owl-buttons div.owl-next{
		border-radius:10px !important;
	}
	.kefu_box{
		top:62% !important;
	}
	.blur{
        filter: url(blur.svg#blur); /* FireFox, Chrome, Opera */
        -webkit-filter: blur(40px) contrast(200%) opacity(100%);; /* Chrome, Opera */
           -moz-filter: blur(40px) contrast(200%) opacity(100%);;
            -ms-filter: blur(40px) contrast(200%) opacity(100%);;   
                filter: blur(40px) contrast(200%) opacity(100%);;
        filter: progid:DXImageTransform.Microsoft.Blur(PixelRadius=10, MakeShadow=false); /* IE6~IE9 */
   
	}
	.left-cls{
		
		background:linear-gradient(to right top,#f9d87f 0,#EAB111 100%);;padding:25px 30px;height:320px;line-height:50px;
	}
</style>
        <!-- End of header area -->
        <!-- Start of slider area -->
         <div class="banner">
	        <ul class="">
	            <li><a href=""><img src="<?php echo $this->_var['icon']['WEBSITE_SLIDER_0']; ?>" alt=""></a></li>
	            <li><a href=""><img src="<?php echo $this->_var['icon']['WEBSITE_SLIDER_1']; ?>" alt=""></a></li>
	        </ul>
	        <div class="left-btn"></div>
	        <div class="right-btn"></div>
	        <div class="img-btn-list"></div>
	    </div>
        <!-- End of slider area -->
        
        <!-- Start page content -->
        <div class="container " style="margin-top:40px;">
        	<div class="col-lg-4 left-cls" >
        	<h3 style="font-size:30px;color:white;">活期参股</h3>
        		<table style="padding:15px;" class="index-white">
        			<tr>
        				<td style="vertical-align: middle;"><img src="/Application/Tpl/images/index/icon_safe.png" /></td>
        				<td class="td-p">
        					<p class="p1">安全</p>
        					<p class="p2">资金由华瑞银行保管</p>
        				</td>
        			</tr>
        			<tr>
        				<td style="vertical-align: middle;"><img src="/Application/Tpl/images/index/icon_PROFIT.png" /></td>
        				<td class="td-p">
        					<p class="p1">高收益</p>
        					<p class="p2">自选效益更高</p>
        				</td>
        			</tr>
        			<tr>
        				<td style="vertical-align: middle;"><img src="/Application/Tpl/images/index/icon_intel.png"/></td>
        				<td class="td-p">
        					<p class="p1">付息</p>
        					<p class="p2">到期还本付息</p>
        				</td>
        			</tr>
        		</table>
        		<!-- <div>
        			<ul class="ulli-index" style="margin:auto;">
        				<li>
        					<img src="/Application/Tpl/images/index/icon_safe.png" />
        				</li>
        				<li>
        					<p class="font-16">安全</p>
        					<p class="font-12">有欢子银行保管</p>
        				</li>
        			</ul>
        		</div> -->
        	</div>
        	<div class="col-lg-8" style=" height:320px;padding:25px;background:white;">
        		<div class="row" style="height:160px;">
        			<div class="col-lg-5">
        				<p class="index-p-1">预计收益率</p>
        				<p class="index-p-2"><?php if ($this->_var['licai_huo']['history']['rate']): ?><?php echo $this->_var['licai_huo']['history']['rate']; ?><?php else: ?><?php echo $this->_var['licai_huo']['scope']; ?><?php endif; ?>%</p>
        			</div>
        			<div class="col-lg-7">
        				<p class="index-p-1">最低起购金额</p>
        				<p class="index-p-2"><?php echo $this->_var['licai_huo']['min_money']; ?><span>元</span></p>
        			</div>
        			<div style="margin:42px 0px;height:1px;background:#e5e5e5" class="col-lg-12"></div>
        		</div>
        		<div class="row" style="height:160px;">
        			<div class="col-lg-5">
						<!-- <div class="index-p-3"><img src="/Application/Tpl/images/index/icon_date.png"/><span>截止日期：2018年1月1日</span></div>
						<p class="index-p-3"><img src="/Application/Tpl/images/index/icon_coin.png"/>最新净利元：<?php echo $this->_var['licai_huo']['history']['net_value']; ?></p> -->
						<table style="width:100%;">
							<tr style="margin-bottom:10px;">
								<td style="vertical-align: middle;text-align:center;"><img src="/Application/Tpl/images/index/icon_date.png"/></td>
								<td style="vertical-align: middle;color:#8C8C8C;" class="font-16">截止日期：2018年1月1日</td>
							</tr>
							<tr>
								<td style="vertical-align: middle;text-align:center;"><img src="/Application/Tpl/images/index/icon_coin.png"/></td>
								<td style="vertical-align: middle;color:#8C8C8C;" class="font-16">最新净利元：<?php if ($this->_var['licai_huo']['history']['net_value']): ?><?php echo $this->_var['licai_huo']['history']['net_value']; ?><?php else: ?><?php echo $this->_var['licai_huo']['net_value']; ?><?php endif; ?></td>
							</tr>
						</table>
					</div>
        			<div class="col-lg-7">
        				<a href="<?php
echo parse_url_tag("u:index|object|"."".""); 
?>" class="btn buy-btn-index" >立即购入</a>
        			</div>
        		</div>
        	</div>
        </div>
        <div class="container">
        	<div class="row" style="font-size:30px;margin:60px 0px 25px 0px;">	
        		定期参股
        	</div>	
        </div> 
        <!-- Start Blog Area -->

            <!-- End Blog Area -->
            <!-- Start Featured product Area -->
            <div class="featured-product-area section-padding" >
                <div class="container row-2">
                    
                    <div class="row rp-style fuzzy">
                    	<!-- <div class="hidefuzzy blur"></div> -->
                        <div class="featured-carousel indicator-style">
                        <?php $_from = $this->_var['licai_ding']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
                            <div class="product-container cp-style-2">
                                <div class="product-inner">
                                    <a href="<?php
echo parse_url_tag("u:index|gobuy#index|"."id=".$this->_var['list']['id']."".""); 
?>">
                                        <div>
                                           <div style="font-size:24px;font-family:PingFangSC-Medium;padding:20px 0 0 10px;"><?php echo $this->_var['list']['name']; ?></div>
                                           <div style="padding:15px 0px 15px 10px;margin-bottom:15px;">
                                           		<div style="float:left;width:33%;">
                                           			<p class="font-12">投资风险</p>
                                           			<p class="font-16"><?php if ($this->_var['list']['risk_rank'] == 0): ?>低<?php elseif ($this->_var['list']['risk_rank'] == 1): ?>中<?php else: ?>高<?php endif; ?></p>
                                           		</div>
                                           		<div style="float:left;width:33%;">
                                           			<p class="font-12">最新净利</p>
                                           			<p class="font-16">￥<?php if ($this->_var['list']['history']['net_value']): ?><?php echo $this->_var['list']['history']['net_value']; ?><?php else: ?><?php echo $this->_var['licai']['net_value']; ?><?php endif; ?></p>
                                           		</div>
                                           		<div style="float:left;width:33%;">
                                           			<p class="font-12">起购金额</p>
                                           			<p class="font-16"><?php echo $this->_var['list']['min_money']; ?></p>
                                           		</div>
                                           </div>
                                           <div style="clear:both;margin-top:75px;text-align:center;color:#EEB92C;font-size:48px;"><?php if ($this->_var['list']['history']['rate']): ?><?php echo $this->_var['list']['history']['rate']; ?><?php else: ?><?php echo $this->_var['list']['scope']; ?><?php endif; ?>%</div>
                                           <div style="clear:both;margin-top:50px;text-align:center;color:black;font-size:16px;">预计年化收益率</div>
		                                       
		                                   
                                           <!-- <h4><?php if ($this->_var['list']['history']['rate']): ?><?php echo $this->_var['list']['history']['rate']; ?><?php else: ?><?php echo $this->_var['list']['scope']; ?><?php endif; ?></h4>
                                          
                                           <p>预计年化收益率</p>
                                           <div style="margin-top:10px;">投资风险：<?php if ($this->_var['list']['risk_rank'] == 0): ?>低<?php elseif ($this->_var['list']['risk_rank'] == 1): ?>中<?php else: ?>高<?php endif; ?></div>
                                           <div>最新净利：<?php echo $this->_var['list']['history']['net_value']; ?></div>
                                           <div>起购金额：<?php echo $this->_var['list']['min_money']; ?>元</div><br> -->
                                           
                                        </div>
                                    </a>
                                    
                                </div>
                                	<div class="clean-a" style="text-align:center;clear:both;margin-top:25px;"> 
		                                <a href="<?php
echo parse_url_tag("u:index|object#regular|"."id=".$this->_var['list']['id']."".""); 
?>" class=" btn-index-buy" style="dieplay:inline-block;clear:both;">立即定购</a>
		                            </div>
		                            <p style="margin-top:25px;text-align:center;">截止<?php echo $this->_var['list']['end_buy_date']; ?></p>
                            </div>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                         
                        </div>                        
                    </div>
                </div>
            </div>
         <div class="container">
        	<div class="row" style="font-size:30px;margin:25px 0px 25px 0px;">	
        		大家都在抢
        	</div>	
        </div>
      <style>
        .aa {
        	background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
		    border-radius: 10px;
		    color: #282828;
		    display: inline-block;
		    font-size: 18px;
		    height: 24px;
		    line-height: 24px;
		    margin: 0;
		    opacity: 1;
		    padding: 0;
		    cursor: pointer;
		    text-align: center;
		    transition: all 0.4s ease 0s;
		    width: 24px;
		    margin-right:16px;
        }
        .aa:hover{
        	background: #ebebeb none repeat scroll 0 0;
        }
        .bb:hover{
        	background: #ebebeb none repeat scroll 0 0;
        }
        .bb{
            background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
		    border-radius: 10px;
		    color: #282828;
		    display: inline-block;
		    font-size: 18px;
		    height: 24px;
		    line-height: 24px;
		    margin: 0;
		    opacity: 1;
		    padding: 0;
		     cursor: pointer;
		    text-align: center;
		    transition: all 0.4s ease 0s;
		    width: 24px;
        }
        .cc{
        	position:relative;
        	
        }
        .ff{
        	position:absolute;
        	right:0%;
        	bottom:2px;
        }
      </style>
        <!-- <div class="container">
        <p style="text-align:right;"><a class="jiantou" onclick="leftzmd()">&lt;</a><a class="jiantou" onclick="rightzmd()">&gt;</a></p>
        	<div class="row" style="overflow:hidden;width:1200px;height:72px;position:relative;">
        		<div class="zmd-div">滚动
        		<?php $_from = $this->_var['licai_dealshow']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
        			<div class="zmd-div-div">
        				<div class="col-lg-4">
        					<img style="width:50px;height:50px;" />
        				</div>
        				<div class="col-lg-4">
        					<p class="font-12"><?php echo $this->_var['list']['user_name']; ?>小时前购入</p>
        					<p class="font-16"><?php echo $this->_var['list']['licainame']; ?></p>
        				</div>
        				<div class="col-lg-4 text-center" style="line-height:45px;">
        					<a style="font-size:12px;color:#EEB92C;">立即购买</a>
        				</div>
        			</div>
        		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        		<?php $_from = $this->_var['licai_dealshow']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
        			<div class="zmd-div-div">
        				<div class="col-lg-4">
        					<img style="width:50px;height:50px;" />
        				</div>
        				<div class="col-lg-4">
        					<p class="font-12">asdflkjasfd8小时前购入</p>
        					<p class="font-16">30天理财</p>
        				</div>
        				<div class="col-lg-4 text-center" style="line-height:45px;">
        					<a style="font-size:12px;color:#EEB92C;">立即购买</a>
        				</div>
        			</div>
        		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>	
        			
        			
        		</div>
        	</div>
        </div> -->
           
    		
            <!-- End Brand Area -->
       <div>
       
       </div>
       <style>
       .pbox{
		height:12px; 
		font-size:12px;
		font-family:PingFangSC-Regular;
		color:rgba(140,140,140,1);
		line-height:12px;
       }
       .pname{
		height:16px; 
		font-size:16px;
		font-family:PingFangSC-Regular;
		color:rgba(54,54,54,1);
		line-height:16px;
       }
       </style>
      <div style="width:1200px;margin:0 auto;height:100px;position:relative;">
      <!-- <b class="Div1_prev Div1_prev1" style="position:absolute;left:0px;top:25%;"><img width="30" height='30' src="/Application/Tpl/images/left-1.png" title="上一页" /></b> -->
      		<div class="owl-controls clickable cc ">
        		<div class="owl-buttons ff"><div class="owl-prev Div1_prev Div1_prev1 aa"><i class="fa fa-angle-left"></i></div><div class="owl-next Div1_next Div1_next1 bb"><i class="fa fa-angle-right"></i></div></div>
            </div> 
      		<div class="Div1" style="height:80px">

			    <div class="Div1_main">
			    <?php $this->_var['x']=0;?>
                 <?php $_from = $this->_var['licai_dealshow']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
                  <?php if ($this->_var['x'] % 3 == 0): ?><div style="margin:0 auto;"><?php endif; ?>
			        	<span class="Div1_main_span1" style="width:333px;height:80px;margin-right:20px;background:white;">
			            	<a href="<?php if ($this->_var['list']['type'] == 0): ?><?php
echo parse_url_tag("u:index|object|"."".""); 
?><?php else: ?><?php
echo parse_url_tag("u:index|object#regular|"."id=".$this->_var['list']['id']."".""); 
?><?php endif; ?>" class="Div1_main_a1">
			            		<ol style="width:333px;height:72px;">
			            			<li style="padding:10px 0;">
			            				<img src="/Application/Tpl/images/client/1.png"  style="width:50px;height:50px;" />
			            			</li>
			            			<li style="padding:15px 0;" class="pbox">
			            				<p style="text-align:center;white-space: nowrap;text-overflow:ellipsis;overflow:hidden;width:155px"><?php echo $this->_var['list']['user_name']; ?> 购买了该产品
			            					<br />
			            					<em class="pname"><?php echo $this->_var['list']['licainame']; ?></em>
			            				</p>
			            			</li>
			            			<li style="position:relative;border-left:1px dashed #eae6e6;line-height:70px;color:#EEB92C;margin-left:34px;padding:0 15px;vertical-align:middle;text-align:right;">
			            			<b style="position:absolute;width:2px;height:12px;left:-2px;top:0px;background:white;"></b>
			            			立即购买
			            			<b style="position:absolute;width:2px;height:12px;left:-2px;bottom:12px;background:white;"></b>
			            			</li>
			            		</ol>
			            	</a>
			            </span>
			          
			          
			        <?php if ($this->_var['x'] % 3 == 2): ?></div><?php endif; ?>
                                   <?php $this->_var['x']++;?>
			        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			    </div>
			</div>
			</div>
			<!-- <b class="Div1_next Div1_next1" style="position:absolute;right:0;top:25%;"><img width="30" height='30' src="/Application/Tpl/images/right-1.png"  title="下一页"/></b>  -->
      </div>      
		
        <!-- End page content -->
        <script>
  bannerListFn(
    $(".banner"),
    $(".img-btn-list"),
    $(".left-btn"),
    $(".right-btn"),
    2000,
    true
   
    
);
  var i = $('.zmd-div-div').length;
  var divwidth = 344*i+"px";
  var ii = $('.zmd-div-div').css('left');
  $('.zmd-div').css('width',divwidth);
	 function leftzmd(){
		 var iss = $('.zmd-div-div').length/2;
		  var divwidth = 344*iss;
		 var left = ii;
		 if(left=='auto'){
			 left = 0;
		 }
		 ii = left - 344;
		 
		 $('.zmd-div').css('left',ii+"px");
		 if(ii+divwidth==0){
			 ii=0;
			 $('.zmd-div').css('left',ii+"px");
		 }
	 } 
	 function rightzmd(){
		 var iss = $('.zmd-div-div').length/2;
		  var divwidth = 344*iss;
		 var left = ii;
		 if(left=='auto'){
			 left = 0;
		 }
		 ii = left - 344;
		 
		 $('.zmd-div').css('left',ii+"px");
		 if(ii+divwidth==0){
			 ii=0;
			 $('.zmd-div').css('left',ii+"px");
		 }
	 } 
	 
	 $(function(){
		 
		 $("#scrollUp").children("i").remove();
		 
	 })
    </script>      
<?php echo $this->fetch('footer_v1.html'); ?>     