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

<title>充值管理 </title>
</head>
<body>
<article class="page-container">
	<form action="<?php
echo parse_url_tag("u:admin|moneymanage#rechargeinsert|"."".""); 
?>" method="post" class="form form-horizontal" id="form-member-edit">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 会员名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" <?php if ($this->_var['data']['user_name']): ?>value="<?php echo $this->_var['data']['user_name']; ?>" readonly ="readonly"<?php else: ?>value=""<?php endif; ?> placeholder="" id="username" name="user_name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">类型：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<label>人工操作</label>	
				<input type="text" class="input-text" hidden name="type" id="type">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>金额：</label>
			<div class="formControls col-xs-4 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="money" name="money">
			</div>
			<div class="formControls col-xs-4 col-sm-6">
				<label>【输入正数金额则为充值，负数为扣减（用户误充后扣回）】</label>
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="mark" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" onKeyUp="$.Huitextarealength(this,100)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius sub" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
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
	
	$("#username").change(function(){
		console.log(111);
		$(".sub").attr('disabled',false);
	})
	
	
	var msgg = '';
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$.validator.addMethod("positiveinteger", function(value, element) {
		   var aint=parseInt(value);	
		    return (aint+"")==value;   
		  }, "输入金额不能为空");  
	
	$("#form-member-edit").validate({
		rules:{
			username:{
				required:true,
				minlength:2,
				maxlength:16
			},
			money:{
				required:true,
				positiveinteger:true
			}
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			console.log(form);
			$(form).ajaxSubmit({
				type:'POST',
				url:"<?php
echo parse_url_tag("u:admin|moneymanage#rechargeinsert|"."".""); 
?>",
				dataType:'json',
				data:$(form).serialize(),
				beforeSerialize:function(form,options){
					
					//console.log(options);
				},
				beforeSubmit:function(a,form,options){
				
					
				},
				success:function(res)
				{
					//console.log(res);return;
					//var r =  JSON.parse(res);
					if(res.status){
						
						//alert(r.msg);
						layer.msg(res.info,{icon:1,time:2000},function(){
							
						$(".sub").attr("disabled",true);
						$("input[name='money']").val('');	
						var index = parent.layer.getFrameIndex(window.name);
						/* $('.btn-refresh').click(); */
						
						parent.layer.close(index);
						});	
					}else{
						
						var index = layer.msg(res.info,{icon:0,time:2000},function(){
						layer.style(index,{
							width: '200px',
							height:'200px'
						})
						$("input[name='money']").val('');	
						var index = parent.layer.getFrameIndex(window.name);
						/* $('.btn-refresh').click(); */
						
						layer.close(index);
						});
					}
					
						
				},
				fail:function(res){
					
				}
				
			});

			
			
		}
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>