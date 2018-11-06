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
<title>提现管理</title>
<link rel="stylesheet" href="/Admin/Tpl/public/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
</head>
<body >
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 资金管理 <span class="c-gray en">&gt;</span> 提现管理 <a class="btn btn-success btn-refresh radius r" style="line-height:1.6em;margin-top:3px" href="javascript:void(0)" onclick="refresh()" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	
	<div class="page-container">
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover table-sort">
				<thead>
					<tr class="text-c">
						<th width="40"><input name="" type="checkbox" value=""></th>
						<th width="40">编号</th>
						<th width="60">用户名</th>
						<th width="100">提现金额</th>
						<th width="200">开户行</th>
						<th width="200">银行卡号</th>
						<th width="100">申请时间</th>
						<th width="60">手续费</th>
						<th width="60">状态</th>
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
						<td><?php echo $this->_var['list']['user_name']; ?></td>
						<td class="text-l"><?php echo $this->_var['list']['money']; ?></td>
						<td class="text-l"><?php echo $this->_var['list']['bankzone']; ?></td>
						<td><?php echo $this->_var['list']['bankcard']; ?></td>
						<td><?php echo $this->_var['list']['create_time']; ?></td>
						<td><?php echo $this->_var['list']['fee']; ?></td>
						
						<td class="td-status"><?php if ($this->_var['list']['status'] == 0): ?><span class="label label-default  radius">待审核</span><?php elseif ($this->_var['list']['status'] == 1): ?><span class="label label-success radius">已通过</span><?php elseif ($this->_var['list']['status'] == 2): ?><span class="label label-default radius">已拒绝</span><?php endif; ?></td>
						<td class="td-manage"><?php if ($this->_var['list']['status'] == 0): ?><a style="text-decoration:none" onClick="product_refuse(this,'<?php echo $this->_var['list']['id']; ?>')" href="javascript:;" title="拒绝"><i class="Hui-iconfont">&#xe6a6;</i></a> <a style="text-decoration:none" class="ml-5" onClick="product_agree(this,'<?php echo $this->_var['list']['id']; ?>')" href="javascript:;" title="同意"><i class="Hui-iconfont">&#xe6a7;</i></a> <?php endif; ?> <a style="text-decoration:none" class="ml-5" onClick="product_del(this,'<?php echo $this->_var['list']['id']; ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
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
<script type="text/javascript" src="/Admin/Tpl/public/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
<script type="text/javascript" src="/Admin/Tpl/public/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Admin/Tpl/public/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
function refresh()
{
	location.replace(location.href);
}
var setting = {
	view: {
		dblClickExpand: false,
		showLine: false,
		selectedMulti: false
	},
	data: {
		simpleData: {
			enable:true,
			idKey: "id",
			pIdKey: "pId",
			rootPId: ""
		}
	},
	callback: {
		beforeClick: function(treeId, treeNode) {
			var zTree = $.fn.zTree.getZTreeObj("tree");
			if (treeNode.isParent) {
				zTree.expandNode(treeNode);
				return false;
			} else {
				//demoIframe.attr("src",treeNode.file + ".html");
				return true;
			}
		}
	}
};

var zNodes =[
	{id:1, pId:0, name:"一级分类", open:true},
	{id:11, pId:1, name:"二级分类"},
	{id:111, pId:11, name:"三级分类"},
	{id:112, pId:11, name:"三级分类"},
	{id:113, pId:11, name:"三级分类"},
	{id:114, pId:11, name:"三级分类"},
	{id:115, pId:11, name:"三级分类"},
	{id:12, pId:1, name:"二级分类 1-2"},
	{id:121, pId:12, name:"三级分类 1-2-1"},
	{id:122, pId:12, name:"三级分类 1-2-2"},
];
		
		
		
$(document).ready(function(){
	var t = $("#treeDemo");
	t = $.fn.zTree.init(t, setting, zNodes);
	//demoIframe = $("#testIframe");
	//demoIframe.on("load", loadReady);
	var zTree = $.fn.zTree.getZTreeObj("tree");
	//zTree.selectNode(zTree.getNodeByParam("id",'11'));
});

/* $('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  {"orderable":false,"aTargets":[0,7]}// 制定列不参与排序
	]
}); */
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
/*提现-拒绝*/
function product_refuse(obj,id){
	layer.confirm('确定拒绝提现吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '<?php
echo parse_url_tag("u:admin|moneymanage#withdraw_refuse|"."".""); 
?>',
			data:{id:id},
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data.msg)
				{
					layer.msg(data.msg,{icon:1,time:3000},function(){parent.location.reload();});
				}
				
				/* setTimeout(function(){
					 $('.btn-refresh').click();
				},3000) */
				 	
				/* $(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000}); */
			},
			error:function(data) {
				console.log(data.msg);
			},
		});	
	});
}

/*提现-同意*/
function product_agree(obj,id){
	layer.confirm('确定同意提现吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '<?php
echo parse_url_tag("u:admin|moneymanage#withdraw_agree|"."".""); 
?>',
			data:{id:id},
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data.msg)
				{
					//layer.msg(data.msg,{icon:1});
					layer.msg('提现成功!',{icon:1,time:2000});
				}
				setTimeout(function(){
					 $('.btn-refresh').click();
				},3000)
				/* $(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000}); */
			},
			error:function(data) {
				console.log(data);
			},
		});	
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
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*产品-删除*/
function product_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '<?php
echo parse_url_tag("u:admin|moneymanage#withdraw_del|"."".""); 
?>',
			data:{id:id},
			dataType: 'json',
			success: function(data){
				if(data)
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
	});
}
</script>
</body>
</html>