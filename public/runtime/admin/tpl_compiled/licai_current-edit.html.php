<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>

<![endif]-->
<link rel="stylesheet" type="text/css" href="/Admin/Tpl/public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Admin/Tpl/public/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Admin/Tpl/public/lib/Hui-iconfont/1.0.8/iconfont.css" />

<link rel="stylesheet" type="text/css" href="/Admin/Tpl/public/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Admin/Tpl/public/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->
<script type="text/javascript" src="Application/Tpl/js/vendor/jquery-1.12.4.min.js"></script>
<link href="/Admin/Tpl/public/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<script>
	var url = '<?php
echo parse_url_tag("u:admin|licai#current_update|"."".""); 
?>';
	
</script>
</head>
<body>
<div class="page-container">
	<form action="" method="post" onsubmit="return false;" class="form form-horizontal" id="form-article-edit" autocomplete="off">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>名称：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $this->_var['data']['name']; ?>" placeholder="" id="name" name="name">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">理财代码：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $this->_var['data']['licai_sn']; ?>" placeholder="" id="licai_sn" name="licai_sn">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				<span style="color:orange">不填则由系统随机生成</span>
			</div>
		</div>
		<!-- <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>发起人：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="user_name" name="user_name">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div> -->
		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-2">是否推荐：</label>
			<div class="formControls col-xs-2 col-sm-2"> 
				<span class="select-box">
				<select class="select" id="is_recommend" name="is_recommend" >
					<option value="-1" >请选择</option>
					<option value="0" <?php if ($this->_var['data']['is_recommend'] == 0): ?> selected="selected" <?php endif; ?>>否</option>
					<option value="1"  <?php if ($this->_var['data']['is_recommend'] == 1): ?> selected="selected" <?php endif; ?>>是</option>
					
				</select>
				</span> 
			</div>
			<div class="formControls col-xs-8 col-sm-8"></div>
		</div>
		<!-- <div class="row cl">
			<label class="form-label col-xs-2 col-sm-2">推荐类型：</label>
			<div class="formControls col-xs-2 col-sm-2"> 
				<span class="select-box">
				<select class="select" id="re_type" name="re_type">
					<option value="0">无</option>
					<option value="1">类型1</option>
					<option value="2">类型2</option>
					
				</select>
				</span> 
			</div>
			<div class="formControls col-xs-8 col-sm-8"></div>
		</div> -->
		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-2">理财类型：</label>
			<div class="formControls col-xs-7 col-sm-7">
				<input type="hidden" name="type" value="0">垚鑫宝
			</div>
			<div class="formControls col-xs-8 col-sm-8"></div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">开始购买时间：</label>
			
			<div class="formControls col-xs-1 col-sm-3">
				<input name = "begin_buy_date" type="date" value="<?php echo $this->_var['data']['begin_buy_date']; ?>"/>
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">结束时间：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input name="end_date" type="date"  value="<?php echo $this->_var['data']['end_date']; ?>"/>
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2" >起始金额：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $this->_var['data']['min_money']; ?>" placeholder="" id="min_money" name="min_money">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">单笔最大购买限额：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $this->_var['data']['max_money']; ?>" placeholder="" id="max_money" name="max_money">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-2">利息类型：</label>
			<div class="formControls col-xs-2 col-sm-2"> 
				<span class="select-box">
				<select class="select" id="begin_interest_type" name="begin_interest_type">
					<option value="0" <?php if ($this->_var['data']['begin_interest_type'] == 0): ?> selected="selected"<?php endif; ?>>当天生效</option>
					<option value="1"  <?php if ($this->_var['data']['begin_interest_type'] == 1): ?> selected="selected"<?php endif; ?>>次日生效</option>
					<option value="2" <?php if ($this->_var['data']['begin_interest_type'] == 2): ?> selected="selected"<?php endif; ?>>下个工作日生效</option>
					<option value="3" <?php if ($this->_var['data']['begin_interest_type'] == 3): ?> selected="selected"<?php endif; ?>>下两个工作日生效</option>
				</select>
				</span> 
			</div>
			<div class="formControls col-xs-8 col-sm-8"></div>
		</div>
		<!-- <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2" ><span class="c-red">*</span>购买手续费率：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="site_buy_fee_rate" name="site_buy_fee_rate">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				<span>%</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>平台收益率：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="platform_rate" name="platform_rate">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				<span>%</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>赎回手续费率：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="redemption_fee_rate" name="redemption_fee_rate">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				<span>%</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>成交服务率：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="service_fee_rate" name="service_fee_rate">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				<span>%</span>
			</div>
		</div> -->
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">默认利率：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $this->_var['data']['scope']; ?>" placeholder="" id="scope" name="scope">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">默认万分收益：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="net_value" name="net_value">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">产品规模</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $this->_var['data']['product_size']; ?>" placeholder="" id="product_size" name="product_size">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				<span style="color:orange">填写数字</span>
			</div>
		</div>
		<input type="hidden" name='id' value="<?php echo $this->_var['data']['id']; ?>">
		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-2">风险类型：</label>
			<div class="formControls col-xs-2 col-sm-2"> 
				<span class="select-box">
				<select class="select" id="risk_rank" name="risk_rank">
					<option value="0">低</option>
					<option value="1">高</option>
					
				</select>
				</span> 
			</div>
			<div class="formControls col-xs-8 col-sm-8"></div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">理财详情：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<script id="editor" name="description" type="text/plain" style="width:100%;height:400px;"><?php echo $this->_var['data']['description']; ?></script> 
			</div>
		</div>
		 <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">赎回到账时间描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea id="purchasing_time" name="purchasing_time" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="$.Huitextarealength(this,200)" value="<?php echo $this->_var['data']['purchasing_time']; ?>"><?php echo $this->_var['data']['purchasing_time']; ?></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div> 
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">规则：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<!-- <textarea id="rule_info" name="rule_info" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="$.Huitextarealength(this,200)" value="<?php echo $this->_var['data']['rule_info']; ?>"><?php echo $this->_var['data']['rule_info']; ?></textarea> -->
				<script id="rule_info" name="rule_info" type="text/plain" style="width:100%;height:400px;" value=""></script> 
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		<!--  <div class="row cl">
			<label class="form-label col-xs-2 col-sm-2">是否托管：</label>
			<div class="formControls col-xs-2 col-sm-2"> 
				<span class="select-box">
				<select class="select" id="is_deposit" name="is_deposit">
					<option value="1">是</option>
					<option value="0">否</option>
					
				</select>
				</span> 
			</div>
			<div class="formControls col-xs-8 col-sm-8"></div>
		</div> -->
		<!-- <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">获取收益方式:</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="profit_way" name="profit_way">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序:</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="sort" name="sort">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div> -->
		<!-- <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">简介：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea id="brief" name="brief" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="$.Huitextarealength(this,200)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div> -->
		<!-- <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">最新净值:</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="net_value" name="net_value">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div> -->
		<!-- <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">关联的基金编号:</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="fund_key" name="fund_key">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-2">基金种类：</label>
			<div class="formControls col-xs-2 col-sm-2"> 
				<span class="select-box">
				<select class="select" id="fund_type_id" name="fund_type_id">
					<option value="1">货币型</option>
					<option value="2">股票型</option>
					<option value="3">债券型</option>
				</select>
				</span> 
			</div>
			<div class="formControls col-xs-8 col-sm-8"></div>
		</div> -->
		<!-- <div class="row cl">
			<label class="form-label col-xs-2 col-sm-2">基金品牌：</label>
			<div class="formControls col-xs-2 col-sm-2"> 
				<span class="select-box">
				<select class="select" id="fund_brand_id" name="fund_brand_id">
					<option value="1">嘉实</option>
					<option value="2">嘉实1</option>
					<option value="3">嘉实2</option>
				</select>
				</span> 
			</div>
			<div class="formControls col-xs-8 col-sm-8"></div>
		</div> -->
		
		<!-- <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">缩略图：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="uploader-thum-container">
					<div id="fileList" class="uploader-list"></div>
					<div id="filePicker">选择图片</div>
					<button id="btn-star" class="btn btn-default btn-uploadstar radius ml-10">开始上传</button>
				</div>
			</div>
		</div> -->
		<!-- <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">项目图片：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="uploader-list-container">
					<div class="queueList">
						<div id="dndArea" class="placeholder">
							<div id="filePicker-2"></div>
							<p>或将照片拖到这里，单次最多可选300张</p>
						</div>
					</div>
					<div class="statusBar" style="display:none;">
						<div class="progress"> <span class="text">0%</span> <span class="percentage"></span> </div>
						<div class="info"></div>
						<div class="btns">
							<div id="filePicker2"></div>
							<div class="uploadBtn">开始上传</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- <div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						产品图片：</label>
					<div class="formControls col-xs-3 col-sm-3">
						<input type="file" id="img" name="img" placeholder="" value="" class="input-text" onchange="showPreview(this)">
					</div>
					<div class="formControls col-xs-5 col-sm-7">
						<input type="hidden" name="imgflag" id="imgflag" value="<?php if ($this->_var['data']['img']): ?>1<?php else: ?>0<?php endif; ?>">
						<img id="portrait" src="<?php if ($this->_var['data']['img']): ?><?php echo $this->_var['data']['img']; ?><?php endif; ?>"   width="70" height="75"> 
					</div>
				</div> -->
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
				<button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Admin/Tpl/public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Admin/Tpl/public/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/Admin/Tpl/public/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/Admin/Tpl/public/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/Admin/Tpl/public/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
function article_save_submit()
{
	var is_error = 0 ;
	var product_name = $("input[name='name']").val();
	var user_name =  $("input[name='user_name']").val();
	var licai_sn = $("input[name='licai_sn']").val();
	var is_recommend = $("select[name='is_recommend']").val();
	var site_buy_fee_rate = $("input[name='site_buy_fee_rate']").val();
	var platform_rate = $("input[name='platform_rate']").val();
	var redemption_fee_rate = $("input[name='redemption_fee_rate']").val();
	var service_fee_rate = $("input[name='service_fee_rate']").val();
	var decToHex = function(str) {
		  var res=[];
		  for(var i=0;i < str.length;i++)
		    res[i]=("00"+str.charCodeAt(i).toString(16)).slice(-4);
		  return "\\u"+res.join("\\u");
		}
	 if(!product_name&&is_error==0)
	{
		var index = layer.open({
			btn:['确定'],
			yes:function(index){
				layer.close(index);
				$("#name").focus();
			},
			area: ['250px', '150px'],
			type: 1,
			title: "警告",
			content: "产品名称不能为空"
		});
		is_error =1;
		
		return false;
	} 
	 
	/*  if(!licai_sn&&is_error==0)
		{
			var index = layer.open({
				btn:['确定'],
				yes:function(index){
					layer.close(index);
					$("#licai_sn").focus();
				},
				area: ['250px', '150px'],
				type: 1,
				title: "警告",
				content: "理财代码不能为空"
			});
			is_error =1;
			
			return false;
		} */
	/*  if(!user_name&&is_error==0)
		{
			var index = layer.open({
				btn:['确定'],
				yes:function(index){
					layer.close(index);
					$("#user_name").focus();
				},
				area: ['250px', '150px'],
				type: 1,
				title: "警告",
				content: "发起人不能为空"
			});
			is_error =1;
			
			return false;
		} */
	 if(is_recommend==-1&&is_error==0)
		{
			var index = layer.open({
				btn:['确定'],
				yes:function(index){
					layer.close(index);
					$("#is_recommend").focus();
				},
				area: ['250px', '150px'],
				type: 1,
				title: "警告",
				content: "请选择是否推荐"
			});
			is_error =1;
			
			return false;
		}
	 /* if(!site_buy_fee_rate&&is_error==0)
		{
			var index = layer.open({
				btn:['确定'],
				yes:function(index){
					layer.close(index);
					$("#site_buy_fee_rate").focus();
				},
				area: ['250px', '150px'],
				type: 1,
				title: "警告",
				content: "购买手续费率不能为空"
			});
			is_error =1;
			
			return false;
		}
	 if(!platform_rate&&is_error==0)
		{
			var index = layer.open({
				btn:['确定'],
				yes:function(index){
					layer.close(index);
					$("#platform_rate").focus();
				},
				area: ['250px', '150px'],
				type: 1,
				title: "警告",
				content: "平台收益率不能为空"
			});
			is_error =1;
			
			return false;
		}
	 if(!redemption_fee_rate&&is_error==0)
		{
			var index = layer.open({
				btn:['确定'],
				yes:function(index){
					layer.close(index);
					$("#redemption_fee_rate").focus();
				},
				area: ['250px', '150px'],
				type: 1,
				title: "警告",
				content: "赎回手续费不能为空"
			});
			is_error =1;
			
			return false;
		}
	 if(!service_fee_rate&&is_error==0)
		{
			var index = layer.open({
				btn:['确定'],
				yes:function(index){
					layer.close(index);
					$("#service_fee_rate").focus();
				},
				area: ['250px', '150px'],
				type: 1,
				title: "警告",
				content: "成交服务费率不能为空"
			});
			is_error =1;
			
			return false;
		} 
	 */
	//alert(is_error);
	if(!is_error)
	{
		$("#form-article-edit").ajaxSubmit({
			type:'POST',
			url:url,
			data:$("#form-article-edit").serialize(),
			beforeSerialize:function(form,options){
				//console.log(form);
				console.log(options);
			},
			beforeSubmit:function(a,form,options){
				//console.log(form);
				
				console.log(options);
			},
			success:function(res)
			{
				var r =  JSON.parse(res);
				console.log(r);
				  if(r.status)
					layer.alert(r.msg);
				  else if(r.status==-1)
					{
					  layer.alert(r.msg);return;
					}
				else{
					layer.alert(r.msg); 
				}
					
				setTimeout(function(){
					parent.$('.btn-refresh').click();
					var index = parent.layer.getFrameIndex(window.name);
					
					parent.layer.close(index);
				},1500);
			},
			fail:function(res){
				parent.$('.btn-refresh').click();
				console.log(res);
			}
			
		});
	}
	
}
/* $(function(){
	
	
	
	
	
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$list = $("#fileList"),
	$btn = $("#btn-star"),
	state = "pending",
	uploader;

	var uploader = WebUploader.create({
		auto: true,
		swf: 'lib/webuploader/0.1.5/Uploader.swf',
	
		// 文件接收服务端。
		server: 'lib/webuploader/0.1.5/server/fileupload.php',
	
		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		pick: '#filePicker',
	
		// 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
		resize: false,
		// 只允许选择图片文件。
		accept: {
			title: 'Images',
			extensions: 'gif,jpg,jpeg,bmp,png',
			mimeTypes: 'image/*'
		}
	});
	uploader.on( 'fileQueued', function( file ) {
		var $li = $(
			'<div id="' + file.id + '" class="item">' +
				'<div class="pic-box"><img></div>'+
				'<div class="info">' + file.name + '</div>' +
				'<p class="state">等待上传...</p>'+
			'</div>'
		),
		$img = $li.find('img');
		$list.append( $li );
	
		// 创建缩略图
		// 如果为非图片文件，可以不用调用此方法。
		// thumbnailWidth x thumbnailHeight 为 100 x 100
		uploader.makeThumb( file, function( error, src ) {
			if ( error ) {
				$img.replaceWith('<span>不能预览</span>');
				return;
			}
	
			$img.attr( 'src', src );
		}, thumbnailWidth, thumbnailHeight );
	});
	// 文件上传过程中创建进度条实时显示。
	uploader.on( 'uploadProgress', function( file, percentage ) {
		var $li = $( '#'+file.id ),
			$percent = $li.find('.progress-box .sr-only');
	
		// 避免重复创建
		if ( !$percent.length ) {
			$percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo( $li ).find('.sr-only');
		}
		$li.find(".state").text("上传中");
		$percent.css( 'width', percentage * 100 + '%' );
	});
	
	// 文件上传成功，给item添加成功class, 用样式标记上传成功。
	uploader.on( 'uploadSuccess', function( file ) {
		$( '#'+file.id ).addClass('upload-state-success').find(".state").text("已上传");
	});
	
	// 文件上传失败，显示上传出错。
	uploader.on( 'uploadError', function( file ) {
		$( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
	});
	
	// 完成上传完了，成功或者失败，先删除进度条。
	uploader.on( 'uploadComplete', function( file ) {
		$( '#'+file.id ).find('.progress-box').fadeOut();
	});
	uploader.on('all', function (type) {
        if (type === 'startUpload') {
            state = 'uploading';
        } else if (type === 'stopUpload') {
            state = 'paused';
        } else if (type === 'uploadFinished') {
            state = 'done';
        }

        if (state === 'uploading') {
            $btn.text('暂停上传');
        } else {
            $btn.text('开始上传');
        }
    });

    $btn.on('click', function () {
        if (state === 'uploading') {
            uploader.stop();
        } else {
            uploader.upload();
        }
    });

});

(function( $ ){
    // 当domReady的时候开始初始化
    $(function() {
        var $wrap = $('.uploader-list-container'),

            // 图片容器
            $queue = $( '<ul class="filelist"></ul>' )
                .appendTo( $wrap.find( '.queueList' ) ),

            // 状态栏，包括进度和控制按钮
            $statusBar = $wrap.find( '.statusBar' ),

            // 文件总体选择信息。
            $info = $statusBar.find( '.info' ),

            // 上传按钮
            $upload = $wrap.find( '.uploadBtn' ),

            // 没选择文件之前的内容。
            $placeHolder = $wrap.find( '.placeholder' ),

            $progress = $statusBar.find( '.progress' ).hide(),

            // 添加的文件数量
            fileCount = 0,

            // 添加的文件总大小
            fileSize = 0,

            // 优化retina, 在retina下这个值是2
            ratio = window.devicePixelRatio || 1,

            // 缩略图大小
            thumbnailWidth = 110 * ratio,
            thumbnailHeight = 110 * ratio,

            // 可能有pedding, ready, uploading, confirm, done.
            state = 'pedding',

            // 所有文件的进度信息，key为file id
            percentages = {},
            // 判断浏览器是否支持图片的base64
            isSupportBase64 = ( function() {
                var data = new Image();
                var support = true;
                data.onload = data.onerror = function() {
                    if( this.width != 1 || this.height != 1 ) {
                        support = false;
                    }
                }
                data.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
                return support;
            } )(),

            // 检测是否已经安装flash，检测flash的版本
            flashVersion = ( function() {
                var version;

                try {
                    version = navigator.plugins[ 'Shockwave Flash' ];
                    version = version.description;
                } catch ( ex ) {
                    try {
                        version = new ActiveXObject('ShockwaveFlash.ShockwaveFlash')
                                .GetVariable('$version');
                    } catch ( ex2 ) {
                        version = '0.0';
                    }
                }
                version = version.match( /\d+/g );
                return parseFloat( version[ 0 ] + '.' + version[ 1 ], 10 );
            } )(),

            supportTransition = (function(){
                var s = document.createElement('p').style,
                    r = 'transition' in s ||
                            'WebkitTransition' in s ||
                            'MozTransition' in s ||
                            'msTransition' in s ||
                            'OTransition' in s;
                s = null;
                return r;
            })(),

            // WebUploader实例
            uploader;

        if ( !WebUploader.Uploader.support('flash') && WebUploader.browser.ie ) {

            // flash 安装了但是版本过低。
            if (flashVersion) {
                (function(container) {
                    window['expressinstallcallback'] = function( state ) {
                        switch(state) {
                            case 'Download.Cancelled':
                                alert('您取消了更新！')
                                break;

                            case 'Download.Failed':
                                alert('安装失败')
                                break;

                            default:
                                alert('安装已成功，请刷新！');
                                break;
                        }
                        delete window['expressinstallcallback'];
                    };

                    var swf = 'expressInstall.swf';
                    // insert flash object
                    var html = '<object type="application/' +
                            'x-shockwave-flash" data="' +  swf + '" ';

                    if (WebUploader.browser.ie) {
                        html += 'classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ';
                    }

                    html += 'width="100%" height="100%" style="outline:0">'  +
                        '<param name="movie" value="' + swf + '" />' +
                        '<param name="wmode" value="transparent" />' +
                        '<param name="allowscriptaccess" value="always" />' +
                    '</object>';

                    container.html(html);

                })($wrap);

            // 压根就没有安转。
            } else {
                $wrap.html('<a href="http://www.adobe.com/go/getflashplayer" target="_blank" border="0"><img alt="get flash player" src="http://www.adobe.com/macromedia/style_guide/images/160x41_Get_Flash_Player.jpg" /></a>');
            }

            return;
        } else if (!WebUploader.Uploader.support()) {
            alert( 'Web Uploader 不支持您的浏览器！');
            return;
        }

        // 实例化
        uploader = WebUploader.create({
            pick: {
                id: '#filePicker-2',
                label: '点击选择图片'
            },
            formData: {
                uid: 123
            },
            dnd: '#dndArea',
            paste: '#uploader',
            swf: 'lib/webuploader/0.1.5/Uploader.swf',
            chunked: false,
            chunkSize: 512 * 1024,
            server: 'lib/webuploader/0.1.5/server/fileupload.php',
            // runtimeOrder: 'flash',

            // accept: {
            //     title: 'Images',
            //     extensions: 'gif,jpg,jpeg,bmp,png',
            //     mimeTypes: 'image/*'
            // },

            // 禁掉全局的拖拽功能。这样不会出现图片拖进页面的时候，把图片打开。
            disableGlobalDnd: true,
            fileNumLimit: 300,
            fileSizeLimit: 200 * 1024 * 1024,    // 200 M
            fileSingleSizeLimit: 50 * 1024 * 1024    // 50 M
        });

        // 拖拽时不接受 js, txt 文件。
        uploader.on( 'dndAccept', function( items ) {
            var denied = false,
                len = items.length,
                i = 0,
                // 修改js类型
                unAllowed = 'text/plain;application/javascript ';

            for ( ; i < len; i++ ) {
                // 如果在列表里面
                if ( ~unAllowed.indexOf( items[ i ].type ) ) {
                    denied = true;
                    break;
                }
            }

            return !denied;
        });

        uploader.on('dialogOpen', function() {
            console.log('here');
        });

        // uploader.on('filesQueued', function() {
        //     uploader.sort(function( a, b ) {
        //         if ( a.name < b.name )
        //           return -1;
        //         if ( a.name > b.name )
        //           return 1;
        //         return 0;
        //     });
        // });

        // 添加“添加文件”的按钮，
        uploader.addButton({
            id: '#filePicker2',
            label: '继续添加'
        });

        uploader.on('ready', function() {
            window.uploader = uploader;
        });

        // 当有文件添加进来时执行，负责view的创建
        function addFile( file ) {
            var $li = $( '<li id="' + file.id + '">' +
                    '<p class="title">' + file.name + '</p>' +
                    '<p class="imgWrap"></p>'+
                    '<p class="progress"><span></span></p>' +
                    '</li>' ),

                $btns = $('<div class="file-panel">' +
                    '<span class="cancel">删除</span>' +
                    '<span class="rotateRight">向右旋转</span>' +
                    '<span class="rotateLeft">向左旋转</span></div>').appendTo( $li ),
                $prgress = $li.find('p.progress span'),
                $wrap = $li.find( 'p.imgWrap' ),
                $info = $('<p class="error"></p>'),

                showError = function( code ) {
                    switch( code ) {
                        case 'exceed_size':
                            text = '文件大小超出';
                            break;

                        case 'interrupt':
                            text = '上传暂停';
                            break;

                        default:
                            text = '上传失败，请重试';
                            break;
                    }

                    $info.text( text ).appendTo( $li );
                };

            if ( file.getStatus() === 'invalid' ) {
                showError( file.statusText );
            } else {
                // @todo lazyload
                $wrap.text( '预览中' );
                uploader.makeThumb( file, function( error, src ) {
                    var img;

                    if ( error ) {
                        $wrap.text( '不能预览' );
                        return;
                    }

                    if( isSupportBase64 ) {
                        img = $('<img src="'+src+'">');
                        $wrap.empty().append( img );
                    } else {
                        $.ajax('lib/webuploader/0.1.5/server/preview.php', {
                            method: 'POST',
                            data: src,
                            dataType:'json'
                        }).done(function( response ) {
                            if (response.result) {
                                img = $('<img src="'+response.result+'">');
                                $wrap.empty().append( img );
                            } else {
                                $wrap.text("预览出错");
                            }
                        });
                    }
                }, thumbnailWidth, thumbnailHeight );

                percentages[ file.id ] = [ file.size, 0 ];
                file.rotation = 0;
            }

            file.on('statuschange', function( cur, prev ) {
                if ( prev === 'progress' ) {
                    $prgress.hide().width(0);
                } else if ( prev === 'queued' ) {
                    $li.off( 'mouseenter mouseleave' );
                    $btns.remove();
                }

                // 成功
                if ( cur === 'error' || cur === 'invalid' ) {
                    console.log( file.statusText );
                    showError( file.statusText );
                    percentages[ file.id ][ 1 ] = 1;
                } else if ( cur === 'interrupt' ) {
                    showError( 'interrupt' );
                } else if ( cur === 'queued' ) {
                    percentages[ file.id ][ 1 ] = 0;
                } else if ( cur === 'progress' ) {
                    $info.remove();
                    $prgress.css('display', 'block');
                } else if ( cur === 'complete' ) {
                    $li.append( '<span class="success"></span>' );
                }

                $li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
            });

            $li.on( 'mouseenter', function() {
                $btns.stop().animate({height: 30});
            });

            $li.on( 'mouseleave', function() {
                $btns.stop().animate({height: 0});
            });

            $btns.on( 'click', 'span', function() {
                var index = $(this).index(),
                    deg;

                switch ( index ) {
                    case 0:
                        uploader.removeFile( file );
                        return;

                    case 1:
                        file.rotation += 90;
                        break;

                    case 2:
                        file.rotation -= 90;
                        break;
                }

                if ( supportTransition ) {
                    deg = 'rotate(' + file.rotation + 'deg)';
                    $wrap.css({
                        '-webkit-transform': deg,
                        '-mos-transform': deg,
                        '-o-transform': deg,
                        'transform': deg
                    });
                } else {
                    $wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');
                    // use jquery animate to rotation
                    // $({
                    //     rotation: rotation
                    // }).animate({
                    //     rotation: file.rotation
                    // }, {
                    //     easing: 'linear',
                    //     step: function( now ) {
                    //         now = now * Math.PI / 180;

                    //         var cos = Math.cos( now ),
                    //             sin = Math.sin( now );

                    //         $wrap.css( 'filter', "progid:DXImageTransform.Microsoft.Matrix(M11=" + cos + ",M12=" + (-sin) + ",M21=" + sin + ",M22=" + cos + ",SizingMethod='auto expand')");
                    //     }
                    // });
                }


            });

            $li.appendTo( $queue );
        }

        // 负责view的销毁
        function removeFile( file ) {
            var $li = $('#'+file.id);

            delete percentages[ file.id ];
            updateTotalProgress();
            $li.off().find('.file-panel').off().end().remove();
        }

        function updateTotalProgress() {
            var loaded = 0,
                total = 0,
                spans = $progress.children(),
                percent;

            $.each( percentages, function( k, v ) {
                total += v[ 0 ];
                loaded += v[ 0 ] * v[ 1 ];
            } );

            percent = total ? loaded / total : 0;


            spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
            spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
            updateStatus();
        }

        function updateStatus() {
            var text = '', stats;

            if ( state === 'ready' ) {
                text = '选中' + fileCount + '张图片，共' +
                        WebUploader.formatSize( fileSize ) + '。';
            } else if ( state === 'confirm' ) {
                stats = uploader.getStats();
                if ( stats.uploadFailNum ) {
                    text = '已成功上传' + stats.successNum+ '张照片至XX相册，'+
                        stats.uploadFailNum + '张照片上传失败，<a class="retry" href="#">重新上传</a>失败图片或<a class="ignore" href="#">忽略</a>'
                }

            } else {
                stats = uploader.getStats();
                text = '共' + fileCount + '张（' +
                        WebUploader.formatSize( fileSize )  +
                        '），已上传' + stats.successNum + '张';

                if ( stats.uploadFailNum ) {
                    text += '，失败' + stats.uploadFailNum + '张';
                }
            }

            $info.html( text );
        }

        function setState( val ) {
            var file, stats;

            if ( val === state ) {
                return;
            }

            $upload.removeClass( 'state-' + state );
            $upload.addClass( 'state-' + val );
            state = val;

            switch ( state ) {
                case 'pedding':
                    $placeHolder.removeClass( 'element-invisible' );
                    $queue.hide();
                    $statusBar.addClass( 'element-invisible' );
                    uploader.refresh();
                    break;

                case 'ready':
                    $placeHolder.addClass( 'element-invisible' );
                    $( '#filePicker2' ).removeClass( 'element-invisible');
                    $queue.show();
                    $statusBar.removeClass('element-invisible');
                    uploader.refresh();
                    break;

                case 'uploading':
                    $( '#filePicker2' ).addClass( 'element-invisible' );
                    $progress.show();
                    $upload.text( '暂停上传' );
                    break;

                case 'paused':
                    $progress.show();
                    $upload.text( '继续上传' );
                    break;

                case 'confirm':
                    $progress.hide();
                    $( '#filePicker2' ).removeClass( 'element-invisible' );
                    $upload.text( '开始上传' );

                    stats = uploader.getStats();
                    if ( stats.successNum && !stats.uploadFailNum ) {
                        setState( 'finish' );
                        return;
                    }
                    break;
                case 'finish':
                    stats = uploader.getStats();
                    if ( stats.successNum ) {
                        alert( '上传成功' );
                    } else {
                        // 没有成功的图片，重设
                        state = 'done';
                        location.reload();
                    }
                    break;
            }

            updateStatus();
        }

        uploader.onUploadProgress = function( file, percentage ) {
            var $li = $('#'+file.id),
                $percent = $li.find('.progress span');

            $percent.css( 'width', percentage * 100 + '%' );
            percentages[ file.id ][ 1 ] = percentage;
            updateTotalProgress();
        };

        uploader.onFileQueued = function( file ) {
            fileCount++;
            fileSize += file.size;

            if ( fileCount === 1 ) {
                $placeHolder.addClass( 'element-invisible' );
                $statusBar.show();
            }

            addFile( file );
            setState( 'ready' );
            updateTotalProgress();
        };

        uploader.onFileDequeued = function( file ) {
            fileCount--;
            fileSize -= file.size;

            if ( !fileCount ) {
                setState( 'pedding' );
            }

            removeFile( file );
            updateTotalProgress();

        };

        uploader.on( 'all', function( type ) {
            var stats;
            switch( type ) {
                case 'uploadFinished':
                    setState( 'confirm' );
                    break;

                case 'startUpload':
                    setState( 'uploading' );
                    break;

                case 'stopUpload':
                    setState( 'paused' );
                    break;

            }
        });

        uploader.onError = function( code ) {
            alert( 'Eroor: ' + code );
        };

        $upload.on('click', function() {
            if ( $(this).hasClass( 'disabled' ) ) {
                return false;
            }

            if ( state === 'ready' ) {
                uploader.upload();
            } else if ( state === 'paused' ) {
                uploader.upload();
            } else if ( state === 'uploading' ) {
                uploader.stop();
            }
        });

        $info.on( 'click', '.retry', function() {
            uploader.retry();
        } );

        $info.on( 'click', '.ignore', function() {
            alert( 'todo' );
        } );

        $upload.addClass( 'state-' + state );
        updateTotalProgress();
    });

})( jQuery ); */

$(function(){
	var ue = UE.getEditor('editor',{
		
	});
	
	
	
	var ue1 = UE.getEditor('rule_info');
	ue.ready(function(){
		 
	    var cont = '<?php echo $this->_var['data']['description']; ?>';
	   ue.setContent(cont)
	});
	ue1.ready(function(){
		 
	    var cont1 = '<?php echo $this->_var['data']['rule_info']; ?>';
	   ue1.setContent(cont1)
	})
});

/*预览图  */
function showPreview(source) {  
    var file = source.files[0];  
    if (window.FileReader) {  
        var fr = new FileReader();  
        fr.onloadend = function(e) {  
            document.getElementById("portrait").src = e.target.result;  
        };  
        fr.readAsDataURL(file);  
    }  
}

</script>
</body>
</html>