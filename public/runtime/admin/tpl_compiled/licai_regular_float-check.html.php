<!DOCTYPE HTML>
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
<title>定期浮动查看</title>
<link rel="stylesheet" href="/Admin/Tpl/public/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
</head>
<body >
	
	<div class="page-container">
		<div class="mt-20">
			
			<table class="table table-border table-bordered table-bg table-hover table-sort">
				<thead>
					<tr class="text-c">
						<th width="40"><!-- <input name="" type="checkbox" value=""> --></th>
						<th width="40">编号</th>
						<th width="60">日期</th>
						<th width="60">利率</th>
						<th width="60">净利</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $_from = $this->_var['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
					<tr class="text-c va-m">
						<td><input name="" type="checkbox" value=""></td>
						<td><?php echo $this->_var['list']['id']; ?></td>
						<td><?php echo $this->_var['list']['history_date']; ?></td>
						<td ><?php echo $this->_var['list']['rate']; ?></td>
						<td ><?php echo $this->_var['list']['net_value']; ?></td>
						<td class="td-manage"> <a style="text-decoration:none" class="ml-5" onClick="regular_rate_del(this,'10002')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						
					</tr>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</tbody>
				
			</table>
		</div>
	</div>
	

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Admin/Tpl/public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Admin/Tpl/public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Admin/Tpl/public/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
<script type="text/javascript" src="/Admin/Tpl/public/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

/*产品-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}


/*产品-查看*/
function product_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-审核*/
function product_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过'], 
		shade: false
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}
/*产品-下架*/
function product_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
		$(obj).remove();
		layer.msg('已下架!',{icon: 5,time:1000});
	});
}

/*产品-发布*/
function product_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布!',{icon: 6,time:1000});
	});
}

/*产品-申请上线*/
function product_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}

/*产品-编辑*/
function product_edit(title,url,id){
	alert(url);
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*产品-删除*/
function regular_rate_del(obj,id){
	layer.confirm('确认要删除该利率吗？',
		
		{btn:["确定","取消"]},	
		function(index,layero){
		console.log(layero);
		$.ajax({
			type: 'POST',
			data:{id:id},
			url: '<?php
echo parse_url_tag("u:admin|licai#regular_rate_del|"."".""); 
?>',
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data==1)
				{
					$(obj).parents("tr").remove();
					layer.msg('已删除!',{icon:1,time:1000});
				}else{
					layer.msg('删除失败!',{icon:2,time:1000});
				}
				
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	},function(index,layero){
		//alert(index);
	})
}
</script>
</body>
</html>