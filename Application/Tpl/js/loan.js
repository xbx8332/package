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
	
	
	
	
	//购买提示
	$("#loan-form").bind("submit",function(){
		var query = $(this).serialize();
		var action = $(this).attr("action");
		
		var types=$('select[name="type"]').val();
		var mortgage=$('select[name="mortgage"]').val();
		var loanmoney=$('input[name="loanmoney"]').val();
		var cycle=$('select[name="cycle"]').val();
		/* var term=$('select[name="term"]').val(); */
		var name=$('input[name="name"]').val();
		var mobile=$('input[name="mobile"]').val();
		
		if(!types)
		{
			/*layer.alert('请选择借款用途！', {
				title:false,
				offset:'auto',
				closeBtn: 0,
				shade:0.7
			}, function(index){
				layer.close(index);
			 
			});*/
			layer.msg('请选择借款用途！',{icon:3,time:1000});
		    return false;
		}
		
		if(mortgage==-1)
		{
			/*layer.alert('请选择是否有无抵押！', {
				title:false,
				offset:'auto',
				closeBtn: 0,
				shade:0.7
			}, function(index){
				layer.close(index);
			 
			});*/
			layer.msg('请选择是否有无抵押！',{icon:3,time:1000});
		    return false;
		}
		
		var loanMoneyReg =  /^[1-9]\d*$/;
		if(!loanMoneyReg.test(loanmoney)){
			
			/*layer.alert('请输入正确的借款金额', {
				title:false,
				offset:'auto',
				closeBtn: 0,
				shade:0.7
			}, function(index){
				layer.close(index);
			 
			});*/
			layer.msg('请输入正确的借款金额！',{icon:3,time:1000});
		    return false;
		}
		
		if(!cycle)
		{
			/*layer.alert('请选择还款周期！', {
				title:false,
				offset:'auto',
				closeBtn: 0,
				shade:0.7
			}, function(index){
				layer.close(index);
			 
			});*/
			layer.msg('请选择还款周期！',{icon:3,time:1000});
		    return false;
		}
		
		
		var nameReg =  /^([a-zA-Z0-9\u4e00-\u9fa5\·]{1,10})$/;
		
		if(!name)
		{
			/*layer.alert('请输入真实姓名！', {
				title:false,
				offset:'auto',
				closeBtn: 0,
				shade:0.7
			}, function(index){
				layer.close(index);
			 
			});*/
			layer.msg('请输入真实姓名！',{icon:3,time:1000});
		    return false;
		}
		
		var mobileReg = /^1(3|4|5|7|8)\d{9}$/;
		if(!mobileReg.test(mobile))
		{
			/*layer.alert('请输入正确的手机号码格式！', {
				title:false,
				offset:'auto',
				closeBtn: 0,
				shade:0.7
			}, function(index){
				layer.close(index);
			 
			});*/
			layer.msg('请输入正确的手机号码格式！',{icon:3,time:1000});
		    return false;
		}
		
		/*console.log(query);return;*/
		$.ajax({
			url:action,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(obj){
				console.log(obj);
				if(obj.status)
				{
					layer.msg(obj.info,{icon:1,time:1000},function(){
						
						location.href = obj.jump;
					});
					
				}
				else
				{
					layer.msg(obj.info,{icon:2,time:1000},function(){
						
						location.href = obj.jump;
					});
				}
				
			}			
		});
		/*var reg=/^[1-9]+\d*$/;
		if(!reg.test(money)){
			
			layer.alert('请输入正确的金额格式', {
				title:false,
				offset:'auto',
				closeBtn: 0,
				shade:0.7
			}, function(index){
				layer.close(index);
			 
			});
		    return false;
		}else{
			
			$.ajax({
				url:action,
				data:query,
				type:"POST",
				dataType:"json",
				success:function(obj){
					if(obj.status)
					{
						layer.msg('购买成功',{icon:1,time:1000});
					}
					else
					{
						layer.msg('购买失败',{icon:2,time:1000});
					}
					
				}			
			});
		    
		}*/
		
		
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
function dkmain(){
	//alert(123);
	//location.href = "{url x="index" r="loan#loansuccess"}";
	location.href = "/index.php?ctl=loan&act=loansuccess";
}