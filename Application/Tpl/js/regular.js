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
	
	$("#purchase").click(function(){
		
		var money = $("input[name='money']").val();
		var licai_id = $("input[name='licai_id']").val();
		var start = $("input[name='start']").val();
		var type = $("input[name='type']").val();
		var name = $("input[name='name']").val();
		var url = buy_url+"&id="+licai_id+"&money="+money+"&type="+type+"&name="+name;
		console.log(url);
		if(!user)
		{
			layer.msg('亲！请登录后再购买！',{icon:3,time:1000});
			return false;
		}
		
		if(!money)
		{
			layer.msg('亲！请输入买入金额！',{icon:3,time:1000});
			return false;
		}
		if(parseFloat(money)<parseFloat(start))
		{
			layer.msg('亲！买入金额不能低于起购金额',{icon:3,time:1000});
			return false;
		}
		console.log(url);
		layer.open({
			  type: 2,
			  title: '买入确认',
			  shadeClose: true,
			  fix: true, //不固定
			  shade: 0.5,
			  offset: ['70px', '35%'],
			  area: ['450px', '450px'],
			  content: [url,'no']
			}); 
		
		/*layer.open({
		  type: 1,
		  shade: 0.5,
		  title: false, //不显示标题
		  content: $('#showModal'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
		  cancel: function(){
		   $("#showModal").attr("style",'display:none')
		  }
		});*/
	})
	/*var html = "<p>充值请联系客服人员 </p>";*/
	//充值提示
	$("#recharge").click(function(){
		/*layer.alert('充值请联系客服人员<br/>服务热线：0591-26216956', {
			title:false,
			offset:'auto',
			area:['300px', '150px'],
			closeBtn: 0,
			shade:0.7
		}, function(index){
			layer.close(index);
		 
		});*/
		layer.msg('充值请联系客服人员<br/>服务热线：0591-26216956',{icon:3,time:1500});
		
	})
	
	
});