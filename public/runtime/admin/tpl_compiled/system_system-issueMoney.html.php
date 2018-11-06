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
<title>体验金管理列表</title>
<link rel="stylesheet" href="/Admin/Tpl/public/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
</head>
<body >
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 体验金设置 <a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:void(0);" onclick="refresh();" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> --> <a href="javascript:;" onclick="product_add('添加体验金','<?php
echo parse_url_tag("u:admin|licai#issueMoney_add|"."".""); 
?>','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加</a></span> <span class="r"></div>
	
	<div class="page-container">
		<div class="mt-20">
			
			<table class="table table-border table-bordered table-bg table-hover table-sort">
				<thead>
					<tr class="text-c">
						<th width="40"><input name="" type="checkbox" value=""></th>
						<th width="40">编号</th>
						<th width="60">类型名称</th>
						<th width="100">体验金额度</th>
						<th width="100">最高可获金额</th>
						<th width="100" >发放类型</th>
						<th width="100">开始时间</th>
						<th width="60">结束时间</th>
						<th width="60">状态</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<?php $_from = $this->_var['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
				<tbody>
					<tr class="text-c va-m">
						<td><input name="" type="checkbox" value=""></td>
						<td><?php echo $this->_var['list']['id']; ?></td>
						<td><?php echo $this->_var['list']['name']; ?></td>
						<td class="text-l"><?php echo $this->_var['list']['money']; ?></td>
						<td class="text-l"><?php echo $this->_var['list']['max_money']; ?></td>
						<td><?php if ($this->_var['list']['type'] == 0): ?>注册送<?php endif; ?><?php if ($this->_var['list']['type'] == 1): ?>邀请送<?php endif; ?><?php if ($this->_var['list']['type'] == 2): ?>管理员发放<?php endif; ?></td>
						<td><?php echo $this->_var['list']['begin_time']; ?></td>
						<td><?php echo $this->_var['list']['end_time']; ?></td>
						<td class="td-status"><span class="label label-success radius"><?php if ($this->_var['list']['is_effect'] == 0): ?>无效<?php else: ?>有效<?php endif; ?></span></td>
						<td class="td-manage"><a style="text-decoration:none" class="ml-5" onClick="product_edit('体验金编辑','<?php
echo parse_url_tag("u:admin|licai#issueMoney_edit|"."".""); 
?>','<?php echo $this->_var['list']['id']; ?>')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="product_del(this,'<?php echo $this->_var['list']['id']; ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						
						
					</tr>
					
				</tbody>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
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
function  refresh()
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

$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  {"orderable":false,"aTargets":[0,7]}// 制定列不参与排序
	]
});
/*产品-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*浮动查看  */
function current_float_check(title,url,id,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	 layer.full(index);
}

/*设置利率  */
 function set_rate(title,url,id,w,h)
 {
	 var u  =  url+'&id='+id;
	 layer_show(title,u,w,h);
 }


/*产品-查看*/
function product_show(title,url,id){
	var u  =  url+'&id='+id;
	var index = layer.open({
		type: 2,
		title: title,
		content: u
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
	//alert(url+"&id="+id);
	var url = url+"&id="+id;
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*产品-删除*/
function product_del(obj,id){
	layer.confirm('确认要删除吗？',
		
		{btn:["确定","取消"]},	
		function(index,layero){
		console.log(layero);
		$.ajax({
			type: 'POST',
			data:{id:id},
			url: '<?php
echo parse_url_tag("u:admin|licai#issueMoney_del|"."".""); 
?>',
			dataType: 'json',
			success: function(res){
				if(res)
				{
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
	},function(index,layero){
		//alert(index);
	})
}


</script>
</body>
</html>