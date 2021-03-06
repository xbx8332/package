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
<!--/meta 作为公共模版分离出去-->

<title>管理员管理 </title>
</head>
<body>
<article class="page-container">
	<form action="<?php
echo parse_url_tag("u:admin|admin#roleins|"."".""); 
?>" method="post" class="form form-horizontal" id="form-admin-role-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="roleName" name="roleName">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="" name="bz">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">网站功能：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="hygl" name="user-Character-0" id="user-Character-0">
							会员管理</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="hylb" name="user-Character-0-0" id="user-Character-0-0">
									会员列表</label>
							</dt>
							<dt>
								<label class="">
									<input type="checkbox" value="yqhy" name="user-Character-0-1" id="user-Character-0-1">
									邀请好友列表</label>
							</dt>
							
						
					</dd>
				</dl>
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="dkgl" name="user-Character-1" id="user-Character-1">
							贷款管理</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="dklb" name="user-Character-1-0" id="user-Character-1-0">
									贷款列表</label>
							</dt>
							
							
						</dl>
					</dd>
				</dl>
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="zjgl" name="user-Character-2" id="user-Character-1">
							资金管理</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="czgl" name="user-Character-2-0" id="user-Character-1-0">
									充值管理</label>
							</dt>
							<dt>
								<label class="">
									<input type="checkbox" value="sytx" name="user-Character-2-1" id="user-Character-1-0">
									所有提现</label>
							</dt>
							<dt>
								<label class="">
									<input type="checkbox" value="hqzc" name="user-Character-2-2" id="user-Character-1-0">
									活期转出</label>
							</dt>
						</dl>
					</dd>
				</dl>
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="cpgl" name="user-Character-3" id="user-Character-1">
							产品管理</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="hqcp" name="user-Character-3-0" id="user-Character-1-0">
									活期产品</label>
							</dt>
							<dt>
								<label class="">
									<input type="checkbox" value="dqcp" name="user-Character-3-1" id="user-Character-1-0">
									定期产品</label>
							</dt>
							<dt>
								<label class="">
									<input type="checkbox" value="ddlb" name="user-Character-3-3" id="user-Character-1-0">
									订单列表</label>
							</dt>
							
						</dl>
					</dd>
				</dl>
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="lcgl" name="user-Character-4" id="user-Character-1">
							理财管理</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="shlb" name="user-Character-4-0" id="user-Character-1-0">
									赎回列表</label>
							</dt>
							<dt>
								<label class="">
									<input type="checkbox" value="fflb" name="user-Character-4-1" id="user-Character-1-0">
									发放列表</label>
							</dt>
						</dl>
					</dd>
				</dl>
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="qxgl" name="user-Character-6" id="user-Character-1">
							权限管理</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="jsgl" name="user-Character-6-0" id="user-Character-1-0">
									角色管理</label>
							</dt>
							<dt>
								<label class="">
									<input type="checkbox" value="zhgl" name="user-Character-6-1" id="user-Character-1-0">
									账户管理</label>
							</dt>
						</dl>
					</dd>
				</dl>
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="xtgl" name="user-Character-7" id="user-Character-1">
							系统管理</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="xtsz" name="user-Character-7-0" id="user-Character-1-0">
									系统设置</label>
							</dt>
							<dt>
								<label class="">
									<input type="checkbox" value="yjbl" name="user-Character-7-1" id="user-Character-1-0">
									佣金比例</label>
							</dt>
							<dt>
								<label class="">
									<input type="checkbox" value="xtrz" name="user-Character-7-2" id="user-Character-1-0">
									系统日志</label>
							</dt>
							
						</dl>
					</dd>
				</dl>
				
				
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
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
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}
		else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
	});
	
	$("#form-admin-role-add").validate({
		rules:{
			roleName:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				success: function(data){
					if(data)
						layer.msg('添加成功!',{icon:1,time:3000});
					
					else
						layer.msg('添加失败!',{icon:1,time:3000});
					
					 setTimeout(function () { 
						 var index = parent.layer.getFrameIndex(window.name);
							parent.layer.close(index);
							parent.location.reload(); 
					 }, 1500);
					 
					 
				},
			});
			
		}
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>