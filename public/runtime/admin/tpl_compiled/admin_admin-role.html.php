﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="Admin/Tpl/public/lib/html5shiv.js"></script>
<script type="text/javascript" src="Admin/Tpl/public/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Admin/Tpl/public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Admin/Tpl/public/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="Admin/Tpl/public/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Admin/Tpl/public/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Admin/Tpl/public/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="Admin/Tpl/public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>角色管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 权限管理 <span class="c-gray en">&gt;</span> 角色管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <!-- <a href="javascript:;" onclick="deldata()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> --> <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('添加角色','<?php
echo parse_url_tag("u:admin|admin#roleadd|"."".""); 
?>','800')"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a> </span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="6">角色管理</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" value="" name=""></th>
				<th width="40">ID</th>
				<th width="200">角色名</th>
				<th width="300">描述</th>
				<th width="70">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php $_from = $this->_var['role']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><?php echo $this->_var['list']['id']; ?></td>
				<td><?php echo $this->_var['list']['name']; ?></td>
				<td><?php echo $this->_var['list']['bz']; ?></td>
				<td class="f-14">
				<a title="删除" href="javascript:;" onclick="admin_role_del(this,<?php echo $this->_var['list']['id']; ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			
		</tbody>
	</table> 
	<div style="width:100%;margin-top:20px;">
		<div style="float:right;">
		<?php echo $this->_var['page']; ?>
		</div>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="Admin/Tpl/public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="Admin/Tpl/public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Admin/Tpl/public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="Admin/Tpl/public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript">
/* 批量删除 */
function deldata(){
	var checked = [];
   
        $('input:checkbox:checked').each(function() {
            checked.push($(this).val());
        });
		$.ajax({
			type: 'POST',
			url: "<?php
echo parse_url_tag("u:admin|admin#delrole|"."".""); 
?>",
			dataType: 'json',
			data:{
				'ids':checked
			},
			success: function(data){
				if(data)
				{
					layer.msg('已删除!',{icon: 1,time:3000});
					window.location.reload();
				}else{
					layer.msg('操作失败!',{icon: 2,time:3000});
					window.location.reload();
				}
				
			},
			error:function(data) {
				layer.msg('error!',{icon: 2,time:1000});
			},
		});	
        
}
/*管理员-角色-添加*/
function admin_role_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-编辑*/
function admin_role_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-删除*/
function admin_role_del(obj,id){
	layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
		pro={};
		pro.id=id;
		$.ajax({
			type: 'POST',
			url: "<?php
echo parse_url_tag("u:admin|admin#roledel|"."".""); 
?>",
			dataType: 'json',
			data:pro,
			success: function(data){
				if(data){
					$(obj).parents("tr").remove();
					layer.msg('已删除!',{icon:1,time:1000});
				}else
				layer.msg('删除失败!',{icon:1,time:1000});
				 setTimeout(function () { 
					 var index = parent.layer.getFrameIndex(window.name);
						parent.layer.close(index);
						parent.location.reload(); 
				 }, 1500);
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}
</script>
</body>
</html>