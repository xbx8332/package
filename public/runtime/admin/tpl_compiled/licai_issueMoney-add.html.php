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

<link href="/Admin/Tpl/public/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<script>
	var url = '<?php
echo parse_url_tag("u:admin|licai#issueMoney_insert|"."".""); 
?>';
</script>
</head>
<body>
<div class="page-container">
	<form action="" method="post" onsubmit="return false;" class="form form-horizontal" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>类型名称：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="name" name="name">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2" >体验金额度：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="money" name="money">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2" >过期时长：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="time_limit" name="time_limit">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">最高可获金额 ：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="max_money" name="max_money">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">开始时间：</label>
			
			<div class="formControls col-xs-1 col-sm-3">
				<input name = "begin_time" type="date" />
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">结束时间：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input name="end_time" type="date" />
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-2">发放类型：</label>
			<div class="formControls col-xs-2 col-sm-2"> 
				<span class="select-box">
				<select class="select" id="type" name="type">
					<option value="0">注册送</option>
					<option value="1">邀请送</option>
					<option value="2">管理员发放</option>
				</select>
				</span> 
			</div>
			<div class="formControls col-xs-8 col-sm-8"></div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-2">是否有效：</label>
			<div class="formControls col-xs-2 col-sm-2"> 
				<span class="select-box">
				<select class="select" id="is_effect" name="is_effect" >
					<option value="-1">请选择</option>
					<option value="0">否</option>
					<option value="1">是</option>
					
				</select>
				</span> 
			</div>
			<div class="formControls col-xs-8 col-sm-8"></div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">简介：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea id="brief" name="brief" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="$.Huitextarealength(this,200)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
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



$(function(){
	
	$("#form-article-add").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				maxlength:16
			},
			money:{
				required:true,
				number:true
			},
			time_limit:{
				required:true,
				number:true
			},
			max_money:{
				required:true,
				number:true
			},
			is_effect:{
				required:true,
			},
			
			type:{
				required:true
			},
			
			begin_time:{
				required:true,
			},
			end_time:{
				required:true,
			},
			brief:{
				required:true,
			}
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				dataType:"json",
				url: "<?php
echo parse_url_tag("u:admin|licai#issueMoneyinsert|"."".""); 
?>" ,
				success: function(data){
					console.log(data.msg);
					if(data.status)
						layer.msg(data.msg,{icon:1,time:1000});
					else
						layer.msg(data.msg,{icon:2,time:1000});
					setTimeout(function(){
						parent.$('.btn-refresh').click(); 	
						var index = parent.layer.getFrameIndex(window.name);
						parent.layer.close(index); 
					},2000);
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('error!',{icon:1,time:1000});
				}
			});
			//var index = parent.layer.getFrameIndex(window.name);
		//	parent.$('.btn-refresh').click();
			//parent.layer.close(index);
		}
	});
	
});

/* $(function(){
	var ue = UE.getEditor('editor');
}); */

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