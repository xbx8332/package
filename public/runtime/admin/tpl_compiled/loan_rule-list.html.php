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
<title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 贷款管理 <span class="c-gray en">&gt;</span> 申请贷款 <a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:void(0);" onclick="refresh();" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="deldata()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="rule_add('添加规则','<?php
echo parse_url_tag("u:admin|loanmanage#ruleadd|"."".""); 
?>','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i>添加规则</a></span> </div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="9">规则列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="150">名称</th>
				<th >规则说明</th>
				<th width="90">类型</th>
				
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php $_from = $this->_var['admin']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $this->_var['list']['id']; ?>" name=""></td>
				<td><?php echo $this->_var['list']['id']; ?></td>
				<td><?php echo $this->_var['list']['rule_name']; ?></td>
				<td><?php echo $this->_var['list']['rule_msg']; ?></td>
				<td><?php if ($this->_var['list']['type'] == 1): ?>贷款规则<?php elseif ($this->_var['list']['type'] == 2): ?>贷款资格<?php elseif ($this->_var['list']['type'] == 3): ?>快速问答<?php endif; ?></td>
				
				<td class="td-status">
					<a title="编辑" href="javascript:;" onclick="admin_edit('规则编辑','<?php
echo parse_url_tag("u:admin|loanmanage#loanedit|"."".""); 
?>','<?php echo $this->_var['list']['id']; ?>','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
					<a title="删除" href="javascript:;" onclick="admin_del(this,<?php echo $this->_var['list']['id']; ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
				</td>
				
				<!-- <td class="td-manage"><a style="text-decoration:none" onClick="admin_stop(this,'<?php echo $this->_var['list']['id']; ?>')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> --> 
				
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
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Admin/Tpl/public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Admin/Tpl/public/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
function  refresh()
{
	location.replace(location.href);
}

/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
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
echo parse_url_tag("u:admin|loanmanage#delloanall|"."".""); 
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
/*管理员-增加*/
function rule_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-删除*/
function admin_del(obj,id){
	pro={};
	pro.id=id;
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '<?php
echo parse_url_tag("u:admin|loanmanage#delloan|"."".""); 
?>',
			dataType: 'json',
			data:pro,
			success: function(data){
				if(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
				}else{
					layer.msg('删除失败!',{icon:1,time:1000});
				}
				},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}

/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
	var url = url+"&id="+id;
	layer_show(title,url,w,h);
}
/*管理员-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
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
		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
		$(obj).remove();
		layer.msg('已停用!',{icon: 5,time:1000});
	});
}

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		
		
		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!', {icon: 6,time:1000});
	});
}
</script>
</body>
</html>