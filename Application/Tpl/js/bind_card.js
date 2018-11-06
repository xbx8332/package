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
	
	function test_carno(card_no)
	{
		var regex = /^([1-9]{1})(\d{14}|\d{18})$/;
		if (regex.test(card_no)) {  
            return true;  
        }  
        return false;  
	}
	// [\u4E00-\uFA29]|[\uE7C7-\uE7F3]汉字编码范围 
	function checkName(str){ 
		
		var re1 = new RegExp("/^[\u4e00-\u9fa5 ]{2,20}$/"); 
		if (!re1.test(str)){ 
		
			return false; 
		} 
		
			return true; 
	} 
	
	//修改支付
	$("#bind-card").bind("submit",function(){
		var query = $(this).serialize();
		var action = $(this).attr("action");
		/* var name  = $("input[name='name']").val(); */
		var name  = $("input[name='name']").val();
		var bankcard  = $("input[name='bankcard']").val();
		var bankname  = $("input[name='bankname']").val();
		
		if(!name)
		{
			layer.msg('亲！姓名不能为空!',{icon:3,time:1000});
			return false;
		}
		var is_name = checkName(name);
		
		/*if(!is_name)
		{
			layer.msg('亲！请输入正确的中文姓名!',{icon:3,time:1000});
			return false;
		}*/
		if(!bankcard)
		{
			layer.msg('亲！银行卡号不能为空!',{icon:3,time:1000});
			return false;
		}
		var is_ok = test_carno(bankcard);
		
		if(!is_ok)
		{
			layer.msg('亲！请输入正确的银行卡号!',{icon:3,time:1000});
			return false;
		}
		if(!bankname)
		{
			layer.msg('亲！开户行不能为空!',{icon:3,time:1000});
			return false;
		}
		//
		
		$.ajax({
			url:action,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(obj){
				console.log(obj);
				if(obj.status)
				{
					
					layer.msg(obj.info,{icon:1,time:1000,offset:'t'},function(){
						
						location.href = obj.url;
					});
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