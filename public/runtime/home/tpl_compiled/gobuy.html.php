
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
        .table>p
        {
        	padding:15px 0px;
        }
        .txt-orange{
        	color:#ff7405;
        }
        .txt-bold{
        	font-weight:bold;
        	font-size:15px;
        	
        }
        .txt-gray{
        	color:gray;
        }
    </style>
    

<script src="Application/Tpl/js/vendor/jquery-1.12.4.min.js"></script>
<!--echarts -->      
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts-all-3.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/dataTool.min.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=PSFy3jtjuMs55uACdrtdW1nkLTO0GPFd"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.min.js"></script>
<!--end echarts-->
<script type="text/javascript">

	$(function(){
		$('#wytz').click(function(){
			pro={};
			pro.id=$('#id').val();
			pro.money=$('#money').val();
			pro.paypassword = $('#paypassword').val();
			pro.ajax =1;
			$.ajax({
				type: 'POST',
				url: "<?php
echo parse_url_tag("u:index|licai#bid|"."".""); 
?>",
				dataType: 'json',
				data:pro,
				success: function(data){
					alert(data.msg);
					
				},
				error:function(data) {
					console.log(data.msg);
				},
			});
	})
	
		

	
});
    </script>

    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    
    <?php echo $this->fetch('head.html'); ?>

        
        <!-- Start page content -->
        <section id="page-content" class="page-wrapper pt-10">
            <div class="container">
                <div class="row">
                	<div class="col-lg-9">
                		<p style="background:#f05244;color:white;height:50px;line-height:50px;padding:0px 20px;font-size:15px;">
                			<span style="font-size:20px;"><?php echo $this->_var['licai']['name']; ?></span>
                			<span>商品编号：<?php echo $this->_var['licai']['licai_sn']; ?></span>
                			<span style="float:right;">结束时间：<?php if ($this->_var['licai']['end_buy_date'] > 0): ?><?php echo $this->_var['licai']['end_buy_date']; ?><?php else: ?>不限<?php endif; ?></span>
                		</p>
                		<div class="row">
                			<div class="col-lg-5">
                				<img src="<?php echo $this->_var['licai']['img']; ?>" alt="暂无图片" width="100%" height="250" />	
                			</div>
                			<div class="col-lg-7">
                				<table style="width:100%;" class="table">
                					<tr>
                						<td>
                							<p class="txt-bold">预期到期收益率</p>
                							<p class="txt-orange txt-bold"><?php if ($this->_var['history']): ?>
													<span class="f_red"><?php echo $this->_var['history']; ?></span>
												<?php else: ?>
													
													<span class="f_red"><span class="f_red"><?php echo $this->_var['licai']['scope']; ?></span></span><font class="f14 f_red">%</font>
													
												<?php endif; ?></p>
                						</td>
                						<td>
                							<p class="txt-bold">理财期限</p>
                							<p class="txt-bold"><?php if ($this->_var['licai']['type'] > 0): ?>
                                            		<?php if ($this->_var['licai']['time_limit']): ?><?php echo $this->_var['licai']['time_limit']; ?>个月<?php else: ?>无限期<?php endif; ?>
                                                <?php else: ?>
                                                	<?php echo $this->_var['licai']['end_date']; ?>
                                                <?php endif; ?></p>
                						</td>
                						<td>
                							<p class="txt-bold">最低投资额（元）</p>
                							<p class="txt-bold"><?php echo $this->_var['licai']['min_money_format_num']; ?></p>
                						</td>
                					</tr>
                				</table>
                				<p class="txt-gray">注：一键理财不等同于银行存款，过往业绩不预示其未来表现。</p>
                				<p class="txt-gray">产品规模：<span style="color:#ff7405;"><?php echo $this->_var['licai']['product_size_format_num']; ?>万元</span></p>
                				
                			</div>
                			
                		</div>
                		<p class="txt-gray" style="margin-top:5px;">
                				<span class="txt-orange">*您需要满足年龄：18~65岁 条件才能投资此项目</span>
                				&nbsp;&nbsp;&nbsp;
                				<span>到期时间：<?php if (to_timespan ( $this->_var['licai'] [ 'end_date' ] ) == 0): ?>永久有效<?php else: ?><?php echo $this->_var['licai']['end_date']; ?><?php endif; ?></span>
                				<span> 获取收益方式：线上</span>
                		</p>
                	</div>
                	<div class="col-lg-3" style="border:1px solid #ebebeb;">
                		<!-- 登录框/购买款 -->
                		<div>
                			<p style="border-bottom:1px solid #ebebeb;height:50px;line-height:50px;font-weight:bold;"><span style="color:#ff7405;font-size:18px;">请这里购买产品</span></p>
                			<p>购买金额（元）:</p>
                			<p>
                			<input id="id" type="hidden" name="id" value=<?php echo $this->_var['licai']['id']; ?>>
                				
                				<input id="money" name="money" type="text" placeholder="<?php echo $this->_var['licai']['min_money_format_num']; ?>元起" readonly onfocus="this.removeAttribute('readonly');" />
                				<?php if ($this->_var['user']['id']): ?>
                				<p>
								<span class="note f_999 f_r" style="color: orange;" id="user_left_money_box">账户可用余额：<span id="user_left_money" data="<?php echo $this->_var['user_info']['money']; ?> "><?php 
$k = array (
  'name' => 'qian_format',
  'v' => $this->_var['user']['money'],
);
echo $k['name']($k['v']);
?></span></span>
								</p>
								<?php endif; ?>
                			</p>
                			<p>支付密码</p>
                			<p>
                				
                				<input id='paypassword' name='paypassword' type="password" placeholder="请输入支付密码" readonly onfocus="this.removeAttribute('readonly');"  />
                			</p>
                			<p>预计收益到账时间：<?php echo $this->_var['licai']['end_interest_date']; ?></p>
                			<p style="text-align:center;"><a id="wytz" class="btn btn-info">我要投资</a></p>
                			<br />
                		</div>
                	</div>
                </div>
                <div class="row" style="border:1px solid #ebebeb;">
                	<div class="col-lg-6" style="border-right:1px solid #ebebeb;">
                		<p style="height:50px;line-height:50px;">年化收益率表</p>
                		<div id="main1" style="width:100%;height:250px;">
                		
                		</div>
                	</div>
                	<div class="col-lg-6">
                		<p style="height:50px;line-height:50px;">规则说明</p>
                		<div style="padding:10px 15px;width:100%;height:250px;background:#ebebeb;">
                			<?php echo $this->_var['licai']['rule_info']; ?>
                		</div>
                		<br />
                	</div>
                </div>
                <div class="row">
                	<p style="width:100%;height:50px;line-height:50px;font-size:20px;font-weight:bold;border-bottom:1px solid #ebebeb;">产品详情</p>
                	<div class="col-lg-3" style="text-align:center;border-right:1px solid #ebebeb;">
                		<p>
                			<span>产品名称：</span> <?php echo $this->_var['licai']['name']; ?>
                		</p>
                		<p>
                			<span>风险等级：</span> <?php echo $this->_var['licai']['risk_rank_format']; ?>
                		</p>
                		
                	</div>
                	<div class="col-lg-4" style="text-align:center;border-right:1px solid #ebebeb;">
                		<p>
                			<span>赎回到账时间：</span> <?php echo $this->_var['licai']['purchasing_time']; ?>
                		</p>
                		<p>
                			<span>默认分红方式：</span> 现金分红
                		</p>
                		<p>
                			<span>收费方式：</span> 线上
                		</p>
                	</div>
                	  <?php if ($this->_var['licai']['buy_limit_format'] && $this->_var['licai']['type'] > 0): ?>
                                   <div class="jijin_lan" style="text-align:center;">
									<span class="name_jijin">运作期限：</span>
									<span class="canshu_jijin"><?php echo $this->_var['licai']['buy_limit_format']; ?>天</span>
                                   </div>
                             <?php endif; ?>
                             <p></p>
                	<div class="col-lg-5" style="text-align:center;">
                		<p>
                			<span>成立时间：</span> <?php echo $this->_var['licai']['begin_buy_date']; ?>
                		</p>
                	</div>
                		
                </div>
                <br />
                	<br />
            </div>
        </section>
        <!-- End page content -->
        <script>
	      	//基于准备好的dom，初始化echarts实例		--实时监测区域
			var dom = document.getElementById("main1");
			var myChart = echarts.init(dom);
			var mData1 = [];
			var sData1 = [];
			<?php $_from = $this->_var['bar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
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
									color: '#ff7405'
								}
							}
						},
						legend: {
							icon: 'rect',
							itemWidth: 14,
							itemHeight: 5,
							itemGap: 13,
							data: ['年化收益率'],
							right: '4%',
							textStyle: {
								fontSize: 12,
								color: '#000'
							}
						},
						grid: {
							show:false,
							left: '0%',
							right: '3%',
							bottom: '0%',
							containLabel: true
						},
						xAxis: [{
							splitLine:{show: false},
							type: 'category',
							boundaryGap: false,
							axisLine: {
								lineStyle: {
									color: '#ff7405'
								}
							},
							axisLabel: {
							  
								textStyle: {
									fontSize: 14,
									 color: '#000'
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
									color: '#ff7405'
								}
							},
							axisLabel: {
								margin: 10,
								textStyle: {
									fontSize: 14,
									 color: '#000'
								}
							},
							splitLine: {
								show:false,
								lineStyle: {
									color: '#ff7405'
								}
							}
						}],
						series: [{
							name: '年化收益率',
							type: 'line',
							smooth: true,
							lineStyle: {
								normal: {
									width: 1
								}
							},
							areaStyle: {
								normal: {
									color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
										offset: 0,
										color: 'rgba(255,116,5, 0.3)'
									}, {
										offset: 0.8,
										color: 'rgba(255,116,5, 0)'
									}], false),
									shadowColor: 'rgba(0, 0, 0, 0.1)',
									shadowBlur: 10
								}
							},
							itemStyle: {
								normal: {
									color: 'rgb(255,116,5)'
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
        </script>
<?php echo $this->fetch('footer_v1.html'); ?>       

