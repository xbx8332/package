﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
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
<title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 会员管理 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success btn-refresh radius r" style="line-height:1.6em;margin-top:3px" onclick="refresh()" href="javascript:void(0)" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="row-demo">
		<div class="row cl pd-5 bg-1 bk-gray mt-20"> 
			<span class="l col-md-2"><a href="javascript:;" onclick="deldata()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="member_add('添加用户','<?php
echo parse_url_tag("u:admin|member#member_add|"."".""); 
?>','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span>   
			<form  method="post" action='<?php
echo parse_url_tag("u:admin|member#index|"."".""); 
?>' enctype="multipart/form-data" class="col-md-6 ">
				
				<div class="col-md-3"><div class='row cl'><span class="form-label col-md-5">用户名:</span><input  type="text" name="user_name"  placeholder="用户名搜索" class="input-text radius col-md-7 " /></div></div>
				<div class="col-md-3"><span class="">邮箱：</span><input  type="text" name="email" placeholder="邮箱搜索" class="input-text radius " /></div>
				<div class="col-md-3"><span class="">手机号：</span><input  type="text" name="mobile" placeholder="手机号搜索" class="input-text radius " /></div>
				<div class="col-md-3"><div class="" style="width:100%;height:20px;"></div><input class="btn btn-success btn-lg" type="submit"  value="搜索" /></div>
				
			</form>
			<form style="float:right;" method="post" action='<?php
echo parse_url_tag("u:admin|member#excelimport|"."".""); 
?>' class="col-md-4" enctype="multipart/form-data">
				<!-- <label>请选择导入文件</label>
		     	<input  type="file" name="file_stu"  />
		      	<input class="btn btn-success" type="submit"  value="导入" /> -->
		      	<span class="btn-upload form-group">
				  <input class="input-text upload-url radius" type="text" name="uploadfile-1" id="uploadfile-1" readonly><a href="javascript:void();" class="btn btn-primary radius"><i class="iconfont">&#xf0020;</i> 选择文件</a>
				  <input type="file" multiple name="file_stu" class="input-file">
				  
				</span>
				<input class="btn btn-success" type="submit"  value="导入" />
			</form>
	</div>
	</div>
	
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="90">手机</th>
				<th width="150">邮箱</th>
				<th width="">余额</th>
				<th width="">冻结</th>
				<th width="130">加入时间</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php $_from = $this->_var['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'user');if (count($_from)):
    foreach ($_from AS $this->_var['user']):
?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $this->_var['user']['id']; ?>" name="del_id"></td>
				<td><?php echo $this->_var['user']['id']; ?></td>
				<td><?php echo $this->_var['user']['user_name']; ?></td>
				<td><?php echo $this->_var['user']['mobile']; ?></td>
				<td><?php echo $this->_var['user']['email']; ?></td>
				<td class="text-l"><?php echo $this->_var['user']['money']; ?></td>
				<td><?php echo $this->_var['user']['lock_money']; ?></td>
				<td><?php 
$k = array (
  'name' => 'to_date',
  'v' => $this->_var['user']['create_time'],
);
echo $k['name']($k['v']);
?></td>
				<td class="td-status"><?php if ($this->_var['user']['is_effect'] == 0): ?><span class="label label-default radius">已停用<?php else: ?><span class="label label-success radius">已启用<?php endif; ?></span></td>
				<td class="td-manage">
				<a style="text-decoration:none" class="ml-5" onClick="member_stop(this,<?php echo $this->_var['user']['id']; ?>)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> 
				<a style="text-decoration:none" class="ml-5" onClick="member_start(this,<?php echo $this->_var['user']['id']; ?>)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6a7;</i></a>
				<a title="编辑" href="javascript:;"class="ml-5"  onclick="member_edit('编辑','<?php
echo parse_url_tag("u:admin|member#memberedit|"."".""); 
?>','<?php echo $this->_var['user']['id']; ?>','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
				<a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','<?php
echo parse_url_tag("u:admin|member#change_password|"."".""); 
?>','<?php echo $this->_var['user']['id']; ?>','600','270')" href="javascript:;" title="修改密码"><i class="Hui-iconfont">&#xe63f;</i></a> 
				<a title="删除" href="javascript:;" class="ml-5" onclick="member_del(this,<?php echo $this->_var['user']['id']; ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
				<a title="充值" href="javascript:;" class="ml-5" onclick="user_charge('用户充值','<?php
echo parse_url_tag("u:admin|member#user_charge|"."".""); 
?>','<?php echo $this->_var['user']['id']; ?>','800','400')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe600;</i></a>
				</td>
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
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Admin/Tpl/public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Admin/Tpl/public//Admin/Tpl/public/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
function refresh()
{
	location.replace(location.href);
}

$(function(){
	/* $('.table-sort').dataTable({
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
		]
	}); */
	
});

/* 批量删除 */
function deldata(){
	var checked = [];
	layer.confirm('确认要批量删除吗？',function(index){
		 $('input:checkbox:checked').each(function() {
	            checked.push($(this).val());
	        });
			$.ajax({
				type: 'POST',
				url: "<?php
echo parse_url_tag("u:admin|member#memberdelall|"."".""); 
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
	});
       
        
}
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		pro ={};
		pro.id = id;
		pro.is_effect = 0;
		$.ajax({
			type: 'POST',
			url: "<?php
echo parse_url_tag("u:admin|member#memberset|"."".""); 
?>",
			dataType: 'json',
			data:pro,
			success: function(data){
				if(data)
				{
					//$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
					$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
					//$(obj).remove();
					layer.msg('已停用!',{icon: 1,time:1000});
				}else{
					layer.msg('操作失败!',{icon: 2,time:1000});
				}
				
			},
			error:function(data) {
				layer.msg('error!',{icon: 2,time:1000});
			},
		});		
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		pro ={};
		pro.id = id;
		pro.is_effect = 1;
		$.ajax({
			type: 'POST',
			url: "<?php
echo parse_url_tag("u:admin|member#memberset|"."".""); 
?>",
			dataType: 'json',
			data:pro,
			success: function(data){
				if(data)
				{
					//$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
					$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
					//$(obj).remove();
					layer.msg('已启用!',{icon: 1,time:1000});
				}else{
					layer.msg('操作失败!',{icon: 2,time:1000});
				}
				
			},
			error:function(data) {
				layer.msg('error!',{icon: 2,time:1000});
			},
		});
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	var u = url+'&id='+id;
	layer_show(title,u,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	var url = url+"&id="+id;
	layer_show(title,url,w,h);	
}


/*用户充值*/
function user_charge(title,url,id,w,h){
	var url = url+"&id="+id;
	layer_show(title,url,w,h);	
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		pro ={};
		pro.id = id;
		pro.is_delete = 1;
		$.ajax({
			type: 'POST',
			url: "<?php
echo parse_url_tag("u:admin|member#memberdel|"."".""); 
?>",
			dataType: 'json',
			data:pro,
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
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