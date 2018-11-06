
jQuery(document).ready(function() {
	
	//登录操作
	
	$("#login-form").bind('submit',function(){
		
		var obj = new Object();
		obj.adm_name = $("input[name='adm_name']").val();
		obj.adm_password = $("input[name='adm_password']").val();
		obj.adm_dog_key = $("input[name='adm_dog_key']").val();
		obj.verify = $("input[name='verify']").val();
		
		if(!obj.adm_name)
		{
			layer.msg('管理员帐号不能为空', {
				  offset: 't',
				  anim: 6
				});
			return false;
		}
		
		if(!obj.adm_password)
		{
			layer.msg('管理员密码不能为空', {
				  offset: 't',
				  anim: 6
				});
			return false;
		}
		if(!obj.verify)
		{
			layer.msg('验证码不能为空', {
				  offset: 't',
				  anim: 6
				});
			return false;
		}
		 $.ajax({
			url: ajax_url,
			type: 'post',
			data:obj,
			dataType: "json",
			success: function(data){
				console.log(data);
				
				if(data)
				{
					if(data.status==1)
					{
						
						
						layer.load(2);
						//此处演示关闭
						setTimeout(function(){
							 layer.closeAll('loading');
							 
							 
							 layer.open({
								  type: 1
								  ,title: false //不显示标题栏
								  ,closeBtn: false
								  ,area: '300px;'
								  ,shade: 0.8
								  ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
								  ,resize: false
								  ,btn: ['直接登录', '残忍拒绝']
								  ,btnAlign: 'c'
								  ,moveType: 1 //拖拽模式，0或者1
								  ,content: '<div style="padding: 50px; line-height: 22px; background: -webkit-linear-gradient(left top, #ef4300 , #eee); color: #fff; font-weight: 300;">'+data.msg+'√<br/>争做一流员工<br/>共造一流产品<br/>同创一流企业</div>'
								  ,success: function(layero){
								    var btn = layero.find('.layui-layer-btn');
								    btn.find('.layui-layer-btn0').attr({
								      href: data.jump
								    });
								  }
								});
							 
						 /* layer.msg(data.msg,function(){
							  
							  location.href=data.jump;
						  });*/
						 
						 
						}, 2000);
						
						
					}else if(data.status==0)
					{
						layer.msg(data.msg, {
							  offset: 't',
							  anim: 6
							});
						
						return false;
					}
					else if(data.status==2){
						layer.msg(data.msg, {
							  offset: 't',
							  anim: 6
							});
						 $('#verifyImg').attr('src',verifyImg_url+'&r='+Math.random());
						return false;
					}
				}else{
					layer.msg('系统错误，请联系客服！', {
						  offset: 't',
						  anim: 6
						});
					return false;
				}
				
				
				
				/*if(data=='登录成功'){
					location.href=jump_url;
				}else{
					 $('#verifyImg').attr('src',verifyImg_url+'&r='+Math.random());
				}*/
			},
			error:function(data) {
				layer.msg(data.msg, {
					  offset: 't',
					  anim: 6
					});
			}
		});
	})
	
	
	
	//验证码
	$('#verifyImg').attr('src',verifyImg_url+'&r='+Math.random());
	$('#verifyImg').click(function(){
		$('#verifyImg').attr('src',verifyImg_url+'&r='+Math.random());
	});
	
});
