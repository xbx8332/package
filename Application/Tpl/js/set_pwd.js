/*

  Template: Forge Ecommerce Responsive Bootstrap Template
  Author: author name
  Version: 1
  Design and Developed by: Khairul Basher Arif + Ashim Kumar
  NOTE: If you have any note put here. 

*/
/*================================================
[  Table of contents  ]
================================================
  1. Featured Carousel active
  2. Main Slider
  3. Countdown
  4. Best Saller Carousel Active
  5. Blog Carousel Active
  6. Testimonial List Active
  7. Brand Carousel Active
  8. Test Popup Link
  9. price-slider active
  10. Input Plus Minus Button
  11. venobox
  12. jQuery MeanMenu
  13. wow js active
  14.  Payment Accordion
======================================
[ End table content ]
======================================*/


$(document).ready(function(){
	
	//修改支付
	$("#login-valid-form").bind("submit",function(){
		var query = $(this).serialize();
		var action = $(this).attr("action");
		var step  = $("input[name='step']").val();
		var pwd  = $("input[name='oldpwd']").val();
		var paypassword  = $("input[name='paypassword']").val();
		var newpaypassword  = $("input[name='newpaypassword']").val();
		console.log(action);
		
		    
		
		
		
	});
	
	
	
	//修改支付
	$("#valid-form").bind("submit",function(){
		var query = $(this).serialize();
		var action = $(this).attr("action");
		var step  = $("input[name='step']").val();
		var pwd  = $("input[name='oldpwd']").val();
		var paypassword  = $("input[name='paypassword']").val();
		var newpaypassword  = $("input[name='newpaypassword']").val();
		console.log(query);
		if(step=='1')
		{
			if(!pwd){
				
				/*parent.layer.alert('请输入登录密码', {
					title:false,
					offset:'t',
					closeBtn: 0,
					shade:0.7
				}, function(index){
					parent.layer.close(index);
				 
				});*/
				layer.msg('请输入登录密码',{icon:2,time:1000,offset:'t'});
			    return false;
			}
		}
		
		if(step=='2')
		{
			if(paypassword!==newpaypassword)
			{
				/*parent.layer.alert('两次密码匹配不一致', {
					title:false,
					offset:'t',
					closeBtn: 0,
					shade:0.7
				}, function(index){
					parent.layer.close(index);
				 
				});*/
				layer.msg('两次密码匹配不一致',{icon:2,time:1000,offset:'t'});
			    return false;
			}
				
		}
		
		$.ajax({
			url:action,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(obj){
				console.log(obj);
				if(obj.status)
				{
					if(obj.step==2)
					{
						parent.layer.msg(obj.info,{icon:1,time:1000,offset:'t'},function(){
							
							parent.location.href = obj.jump;
						});
						
					}else if(obj.step==1){
						
						location.href = obj.jump;
					}
					/*parent.layer.msg('购买成功',{icon:1,time:1000});*/
					
					
					
				}
				else
				{
					layer.msg(obj.info,{icon:2,time:1000,offset:'t'});
				}
				
			}			
		});
		    
		
		
		
	});
	
	/*layer.open({
		  type: 1,
		  skin: 'layui-layer-demo', //样式类名
		  closeBtn: 0, //不显示关闭按钮
		  anim: 2,
		  shadeClose: true, //开启遮罩关闭
		  content: "hahah"
		});*/
	
	
	
	/*layer.open({
		  type: 2,
		  area: ['700px', '450px'],
		  fixed: false, //不固定
		  offset:'t',
		  maxmin: true,
		  content:url
		});*/
	
	/*layer.open({
		  type: 2,
		  title: false,
		  closeBtn: 0,
		  area: '516px',
		  skin: 'layui-layer-nobg', //没有背景色
		  shadeClose: true,
		  content: $('#showModal')
		});*/
	
	/*layer.open({
		  type: 1,
		  title: false,
		  closeBtn: 0,
		  anim:1,
		  area: ['500px', '300px'],
		  shadeClose: true,
		  skin: 'yourclass',
		  content: $('#showModal')
		});*/
});