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

<title>修改密码 - 会员管理 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form action="/" method="post" class="form form-horizontal" id="form-change-password">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账户：</label>
			<div class="formControls col-xs-8 col-sm-9"><?php if ($this->_var['data']['user_name']): ?><?php echo $this->_var['data']['user_name']; ?><?php endif; ?></div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>新密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text" autocomplete="off" placeholder="不修改请留空" name="newpassword" id="newpassword">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text" autocomplete="off" placeholder="不修改请留空" name="newpassword2" id="new-password2">
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input type="hidden" name="id" value="<?php if ($this->_var['data']['id']): ?><?php echo $this->_var['data']['id']; ?><?php endif; ?>">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;保存&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/layer/2.4/layer.js"></script>  
<script type="text/javascript" src="/Admin/Tpl/public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){
	$.validator.addMethod("passvalid", function(value, element) {
		   var reg=/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,21}$/;	
		    
		   if(reg.test(value))
			{
			   return true;
			}else{
				return false;
			}
		    
		 }, "请输入6-21字母和数字组成"); 
	
	$("#form-change-password").validate({
		rules:{
			newpassword:{
				required:true,
				passvalid:true
			},
			newpassword2:{
				required:true,
				passvalid:true,
				equalTo: "#newpassword"
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$.ajax({
				type:'POST',
				url:"<?php
echo parse_url_tag("u:admin|member#change_pwd|"."".""); 
?>",
				data:$(form).serialize(),
				success:function(res)
				{
					console.log(res);
					 var res = Boolean(res);
					if(res)
						layer.msg('修改成功!',{icon:1,time:1000});
					else
						layer.msg('修改失败!',{icon:1,time:1000});
					setTimeout(function(){
						parent.$('.btn-refresh').click();
						var index = parent.layer.getFrameIndex(window.name);
						
						parent.layer.close(index);
						
					},2000)
					
				},
				fail:function(res){
					layer.msg('error!',{icon:1,time:1000});
				}
				
			});
			
		}
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>