﻿<!--_meta 作为公共模版分离出去-->
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
<link rel="stylesheet" type="text/css" href="Admin/Tpl/public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="Admin/Tpl/public/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="Admin/Tpl/public/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="Admin/Tpl/public/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="Admin/Tpl/public/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>基本设置</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
	<span class="c-gray en">&gt;</span>
	系统管理
	<span class="c-gray en">&gt;</span>
	基本设置
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<form action=""  class="form form-horizontal" id="form-system-add" method="post" >
		<div id="tab-system" class="HuiTab">
			<div class="tabBar cl">
				<span>基本设置</span>
				<span>安全设置</span>
				<span>邮件设置</span>
				<span>其他设置</span>
			</div>
			
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						网站名称：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website_title" name="website_title" placeholder="控制在25个字、50个字节以内" value="<?php if ($this->_var['data']['website_title']): ?><?php echo $this->_var['data']['website_title']; ?><?php endif; ?>" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						LOGO图片：</label>
					<div class="formControls col-xs-3 col-sm-3">
						<input type="file" id="website_logo" name="website_logo" placeholder="" value="" class="input-text" onchange="showPreview(this)">
					</div>
					<div class="formControls col-xs-4 col-sm-6">
						
						<img id="portrait" src="<?php if ($this->_var['data']['website_logo']): ?><?php echo $this->_var['data']['website_logo']; ?><?php endif; ?>"   width="70" height="75"> 
					</div>
					<div class="formControls col-xs-1 col-sm-1">
						<input type="hidden" name='flag' id='flag' value="<?php if ($this->_var['data']['website_logo']): ?>1<?php else: ?>0<?php endif; ?>" />
						
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						移动电话：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website_mobile" name="website_mobile" placeholder="请输入公司移动电话" value="<?php if ($this->_var['data']['website_mobile']): ?><?php echo $this->_var['data']['website_mobile']; ?><?php endif; ?>" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						电话号码：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="tel" name="website_tel" placeholder="请输入公司电话号码" value="<?php if ($this->_var['data']['website_tel']): ?><?php echo $this->_var['data']['website_tel']; ?><?php endif; ?>" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						公司地址：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website_addr" name="website_addr" placeholder="请输入公司地址" value="<?php if ($this->_var['data']['website_addr']): ?><?php echo $this->_var['data']['website_addr']; ?><?php endif; ?>" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						邮箱地址：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website_email" name="website_email" placeholder="@" value="<?php if ($this->_var['data']['website_email']): ?><?php echo $this->_var['data']['website_email']; ?><?php endif; ?>" class="input-text">
					</div>
				</div>
				
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						描述：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website_description" name="website_description" placeholder="空制在80个汉字，160个字符以内" value="<?php if ($this->_var['data']['website_description']): ?><?php echo $this->_var['data']['website_description']; ?><?php endif; ?>" class="input-text">
					</div>
				</div>
				<!-- <div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						css、js、images路径配置：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-static" placeholder="默认为空，为相对路径" value="" class="input-text">
					</div>
				</div> -->
				<!-- <div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						上传目录配置：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-uploadfile" placeholder="默认为uploadfile" value="" class="input-text">
					</div>
				</div> -->
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						底部版权信息：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website_copyright" name="website_copyright" placeholder="&copy; 2017 www.xxx.com" value="<?php if ($this->_var['data']['website_copyright']): ?><?php echo $this->_var['data']['website_copyright']; ?><?php endif; ?>" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">备案号：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website_icp" name="website_icp" placeholder="京ICP备00000000号" value="<?php if ($this->_var['data']['website_icp']): ?><?php echo $this->_var['data']['website_icp']; ?><?php endif; ?>" class="input-text">
					</div>
				</div>
				<!-- <div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">统计代码：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<textarea class="textarea"></textarea>
					</div>
				</div> -->
			</div>
			<!-- <div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">允许访问后台的IP列表：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<textarea class="textarea" name="" id=""></textarea>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">后台登录失败最大次数：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="5" id="" name="" >
					</div>
				</div>
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">邮件发送模式：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text"  class="input-text" value="" id="" name="">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">SMTP服务器：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="" value="" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">SMTP 端口：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="25" id="" name="" >
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">邮箱帐号：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="5" id="emailName" name="emailName" >
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">邮箱密码：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="password" id="email-password" value="" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">收件邮箱地址：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="email-address" value="" class="input-text">
					</div>
				</div>
			</div>
			<div class="tabCon">
			</div> -->
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="Admin/Tpl/public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="Admin/Tpl/public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="Admin/Tpl/public/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="Admin/Tpl/public/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="Admin/Tpl/public/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="Admin/Tpl/public/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="Admin/Tpl/public/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="Admin/Tpl/public/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$("#tab-system").Huitab({
		index:0
	});
	
	$.validator.addMethod('isTel',function(value,element){
		var tel = /^0\d{2,3}-\d{7,8}(-\d{1,6})?$/;
		var e = new RegExp(tel);
		if(e.test(value))
		{
			return true;
		}else{
			return false;
		}
	},"请输入正确的电话号码!")
	
	
	$("#form-system-add").validate({
		rules:{
			website_title:{
				required:true,
				minlength:2,
				maxlength:16
			},/* 
			website_logo:{
				required:true,
			}, */
			website_mobile:{
				required:true,
				isMobile:true
			},
			website_tel:{
				required:true,
				isTel:true
			},
			website_addr:{
				required:true,
			},
			website_email:{
				required:true,
				email:true
			},
			website_description:{
				required:true,
			},
			website_copyright:{
				required:true,
			},
			website_icp:{
				required:true
			}
			
		},
		submitHandler:function(form){
			console.log(form);
			$(form).ajaxSubmit({
				type:'POST',
				dataType:'json',
				url:"<?php
echo parse_url_tag("u:admin|system#sysSetInfoInsert|"."".""); 
?>",
				data:$(form).serialize(),
				beforeSerialize:function(form,options){
					
					//console.log(options);
				},
				beforeSubmit:function(a,form,options){
				
					
				},
				success:function(res)
				{
					console.log(res);
					
					if(res.msg)
					{
						alert(res.msg);
					}
				},
				fail:function(res){
					
				}
				
			});
			var index = parent.layer.getFrameIndex(window.name);
			//parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
});

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

function article_save_submit()
{
	

}
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>
