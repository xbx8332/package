<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Admin/Tpl/public/lib/html5shiv.js"></script>
<script type="text/javascript" src="/Admin/Tpl/public/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Admin/Tpl/public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Admin/Tpl/public/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Admin/Tpl/public/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Admin/Tpl/public/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Admin/Tpl/public/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Admin/Tpl/public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>编辑管理员 </title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-edit">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理员：</label>
		<div class="formControls col-xs-8 col-sm-9">
		<?php if ($this->_var['data']['adm_name']): ?>
			<span class="text-c"><?php echo $this->_var['data']['adm_name']; ?></span>
			<input type="text" class="input-text" value="<?php echo $this->_var['data']['adm_name']; ?>" placeholder="" id="adminName" name="adm_name" hidden >
		<?php endif; ?>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理员密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off" value="" placeholder="密码" id="password" name="adm_password">
		</div>
	</div>
	
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否有效：</label>
		<div class="formControls col-xs-2 col-sm-3 radio-box">
			<input type="radio" id="" name="is_effect" value="1" <?php if ($this->_var['data']['is_effect'] == "1"): ?> checked <?php endif; ?> >
    		<label for="is_effect">有效</label>
		</div>
		<div class="formControls col-xs-2 col-sm-3">
			<input type="radio" id="" name="is_effect" value="0" <?php if ($this->_var['data']['is_effect'] == "0"): ?> checked <?php endif; ?> >
    		<label for="is_effect">无效</label>
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input type="text" class="input-text" value="<?php echo $this->_var['data']['id']; ?>" placeholder="" id="id" name="id" hidden >
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;编辑&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Admin/Tpl/public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-admin-edit").validate({
		rules:{
			adm_name:{
				required:true,
				minlength:4,
				maxlength:16
			},
			adm_password:{
				required:true,
			}
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "<?php
echo parse_url_tag("u:admin|admin#adminupdate|"."".""); 
?>" ,
				success: function(data){
					
					 if(data)
						layer.msg('更新成功!',{icon:1,time:1000});
					 	
						
					else
						layer.msg('更新失败!',{icon:1,time:1000});
					 parent.$('.btn-refresh').click(); 	
					var index = parent.layer.getFrameIndex(window.name);
					parent.layer.close(index); 
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					 layer.msg('error!',{icon:1,time:1000});
					 parent.$('.btn-refresh').click();
					var index = parent.layer.getFrameIndex(window.name);
					parent.layer.close(index);
					
				}
			});
			//var index = parent.layer.getFrameIndex(window.name);
		//	parent.$('.btn-refresh').click();
			//parent.layer.close(index);
		}
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>