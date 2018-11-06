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
echo parse_url_tag("u:admin|help#wenzhang_ins|"."".""); 
?>';
</script>
</head>
<body>
<div class="page-container">
	<form action="" method="post" onsubmit="return false;" class="form form-horizontal" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>名称：</label>
			<div class="formControls col-xs-1 col-sm-3">
				<input type="text" class="input-text" value="<?php echo $this->_var['wenzhang']['name']; ?>" placeholder="" id="name" name="name">
			</div>
			<div class="formControls col-xs-7 col-sm-7">
				
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
			<label class="form-label col-xs-2 col-sm-2">是否有效：</label>
			<div class="formControls col-xs-2 col-sm-2"> 
				<span class="select-box">
				<select class="select" id="is_effect" name="is_effect" >
					<option value="-1">请选择</option>
					<option value="1" <?php if ($this->_var['wenzhang']['is_effect'] == 1): ?> selected="selected" <?php endif; ?>>是</option>
					<option value="0" <?php if ($this->_var['wenzhang']['is_effect'] == 0): ?> selected="selected" <?php endif; ?>>否</option>
					
				</select>
				</span> 
			</div>
			<div class="formControls col-xs-8 col-sm-8"></div>
		</div>
			<div class="row cl">
		<label class="form-label col-xs-2 col-sm-2">分类：</label>
		<div class="formControls col-xs-2 col-sm-2"> <span class="select-box" style="width:150px;">
			<select class="select" name="cate_id" size="1">
				<!-- <option value="1" <?php if ($this->_var['wenzhang']['cate_id'] == 1): ?> selected="selected" <?php endif; ?> >分类1</option>
				<option value="2" <?php if ($this->_var['wenzhang']['cate_id'] == 2): ?> selected="selected" <?php endif; ?>>分类2</option>
				<option value="3" <?php if ($this->_var['wenzhang']['cate_id'] == 3): ?> selected="selected" <?php endif; ?>>分类3</option> -->
				 <?php $_from = $this->_var['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
				<option value="<?php echo $this->_var['list']['id']; ?>" <?php if ($this->_var['wenzhang']['cate_id'] == $this->_var['list']['id']): ?> selected="selected" <?php endif; ?> ><?php echo $this->_var['list']['name']; ?></option>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
			</select>
			</span> </div>
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
			<label class="form-label col-xs-4 col-sm-2">文章内容：</label>
			<div class="formControls col-xs-8 col-sm-9">
				 <!-- <textarea id="purchasing_time" name="wenzhang" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="$.Huitextarealength(this,200)"><?php echo $this->_var['wenzhang']['wenzhang']; ?></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>  -->
				
				<script id="editor" name="wenzhang" type="text/plain" style="width:100%;height:400px;"></script>
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
		
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<input type="hidden" name="wz_id" value="<?php echo $this->_var['wenzhang']['id']; ?>" >
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
				required:true
			},
			cate_id:{
				required:true,
			}
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			
			$.ajax({
				type:'POST',
				url:url,
				data:$(form).serialize(),
				success:function(res)
				{
					console.log(res);
					var res = Boolean(res);
					if(res)
						layer.msg('添加成功!',{icon:1,time:1000});
					else
						layer.msg('添加失败!',{icon:1,time:1000});
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
    
    var ue = UE.getEditor('editor');
    /* var cont = '<?php echo $this->_var['wenzhang']['wenzhang']; ?>';
    	ue.setContent(cont) */
});
var ue = UE.getEditor('editor');
ue.ready(function(){
	 
	    var cont = '<?php echo $this->_var['wenzhang']['wenzhang']; ?>';
	    	ue.setContent(cont)
})


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