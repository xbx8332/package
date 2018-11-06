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

<title>好友佣金比例 </title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-member-edit">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>好友佣金比例(%)：</label>
			<div class="formControls col-xs-2 col-sm-3">
			<?php if ($this->_var['data']['name']): ?>
				<input type="text" class="input-text" value="<?php echo $this->_var['data']['value']; ?>" placeholder="" id="commission" name="commission">
			<?php else: ?>
			<input type="text" class="input-text" value="" placeholder="" id="commission" name="commission">
			<?php endif; ?>
			</div>
			<div class="formControls col-xs-3 col-sm-5">
				
			</div>
		</div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
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
<script type="text/javascript" src="/Admin/Tpl/public/lib/My97DatePicker/4.8/WdatePicker.js"></script>
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
	$.validator.addMethod("positiveinteger", function(value, element) {
		   var aint=parseFloat(value);	
		    return aint>0&& (aint+"")==value;   
		  }, "请输入正数金额");  
	
	$("#form-member-edit").validate({
		rules:{
			commission:{
				required:true,
				positiveinteger:true,
				minlength:2,
				maxlength:16
			}
			
		},
		submitHandler:function(form){
			console.log(form);
			$.ajax({
				type:'POST',
				dataType:'json',
				url:"<?php
echo parse_url_tag("u:admin|system#commissioninsert|"."".""); 
?>",
				data:$(form).serialize(),
				traditional:true,
				success:function(res)
				{
					console.log(res);
					var status = res.status;
					if(status)
					{
						layer.msg("好友佣金设置成功",{icon:1,time:2000});
					}else{
						layer.msg("好友佣金设置失败",{icon:2,time:2000});
					}
					//var index = parent.layer.getFrameIndex(window.name);
					//parent.$('.btn-refresh').click();
					//parent.layer.close(index);
				},
				fail:function(res){
					layer.msg("好友佣金设置失败",{icon:2,time:2000});
				}
				
			});
			
		}
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>