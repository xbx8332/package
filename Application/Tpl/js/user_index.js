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


$(function() {
	
	$("#contact").click(function(){
		layer.msg('充值请联系客服人员<br/>服务热线：0591-26216956',{icon:3,time:1500,offset:'auto'});
		/*layer.alert('充值请联系客服人员<br/>服务热线：0591-26216956', {
				title:'',
				offset:'t',
				area:['300px', '150px'],
				closeBtn: 0,
				shade:false
			}, function(index){
				layer.close(index);
			 
			});*/
	})
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