<head>
<link rel="stylesheet" href="/Application/Tpl/css/style.css">
   <link rel="stylesheet" href="/Application/Tpl/swiper/swiper.min.css">

	<script src="/Application/Tpl/swiper/swiper.min.js"></script>
	<link href="/Application/Tpl/css/page_style.css" rel="stylesheet" type="text/css">
	<style>
	
        .table-tr-one{
            background-color:#edf7ff;
            font-size: 15px;
        }
        .table-tr-two{
             background-color: #d1e7f7;
             font-size: 15px;
        }
        .text-orange{
            color:#e49607;
        } 
       .btn-red{
       padding: 10px 50px;
    margin-right: 15px;
    font-size: 18px;
    font-weight: bold;
    border: 2px solid #f05244;
    background-color: #f05244;
    color: #fff;
    border-radius: 5px;
       }
        body{
            background:white;
        }
        .row-1{
            background:#fffbfb;
        }
        .ul-hen>li{
        float:left;
        border:1px solid #f05244;
        padding:15px 10px;
        margin-left:10px;
        border-radius:10px;
        color:#f05244;
        font-size:20px;
        font-weight:bold;
        }
        .top{
        margin-top:15px;
        
        }
        .four_bg{
        background:#ffffff
        }
        .hj{
       
        	padding:20px 0;
        }
        .rs_top{
        	padding: 11px 0;
        }
        .bord{
        	border-bottom:1px dashed #ededed;
        	margin-bottom:5px;
        }
        .title{
        	color:gray;
        	display:inline-block;
        	font-family:'黑体'
        }
        .detxt {
        	display:inline-block;
        	color:#675f5f;
        	font-weight:bold;
        	font-family:'黑体';
        	margin-left:10px;
        }
        .unit{
        	height:50px;
        	line-height:50px;
        }
        .loan_li{
        	font-weight:bold;
        	font-family:'黑体';
        	padding-left:20px;
        }
        .txt{
        font-size:17px;
        	font-family:'微软雅黑'
        }


input[type="radio"]{
display:none;
}
input[type="radio"]+label{
position:relative;
padding-left:30px;
line-height:20px;
color:#333;
font-weight:normal;
margin-left:1px;
}
label {
display:inline-block;
max-width:100%;
margin-bottom:5px;
font-weight:700;
}
input[type="radio"]+label::before {
content:"";
width:15px;
height:15px;
border-radius:20px;
border:1px solid #cecece;
position:absolute;
left:3;
top:3;
}
input[type="radio"]:checked+label::after {
top:5px;
left:5px;
content:"";
background-color:#282828;
width:10px;
height:10px;
border-radius:12px;
position:absolute;
vertical-align:middle;
}
select{
border-color:#F3F3F3 !important;
height:48px !important;
width:316px !important;
}
input{
border-color:#F3F3F3 !important;
height:48px !important;
width:316px !important;
}
.form-group{
line-height:30px !important;
}
    </style>
    
	<script>

    	function regaa(){
    		var types=$('select[name="type"]').val();
    		var mortgage=$('input[name="mortgage"]').val();
    		var loanmoney=$('input[name="loanmoney"]').val();
    		var cycle=$('select[name="cycle"]').val();
    		/* var term=$('select[name="term"]').val(); */
    		var name=$('input[name="name"]').val();
    		var mobile=$('input[name="mobile"]').val();
    		$("input").css('border-color','#ccc');
    		$("select").css('border-color','#ccc');
    		$(".errmsg").hide();
    		if(!types){
    			/* alert("请选择借款用途"); */
    			$("#jkyt").text("请选择借款用途");
    			$("#jkyt").css('color','#eea236');
    			$("#jkyt").css('font-size','12px');
    			$("#jkyt").show();
    			$("select[name='type']").css('border-color','#eea236');
    		}else if(!mortgage){
    			/* alert("请填写有无抵押"); */
    			$("#dy").text("请选择借款用途");
    			$("#dy").css('color','#eea236');
    			$("#dy").css('font-size','12px');
    			$("#dy").show();
    			$("select[name='mortgage']").css('border-color','#eea236');
    		}else if(!loanmoney){
    			/* alert("请填写借款金额"); */
    			$("#jkje").text("请填写借款金额");
    			$("#jkje").css('color','#eea236');
    			$("#jkje").css('font-size','12px');
    			$("#jkje").show();
    			$("input[name='loanmoney']").css('border-color','#eea236');
    		}else if(!cycle){
				/* alert("请选择还款周期"); */
    			$("#hkzq").text("请选择还款周期");
    			$("#hkzq").css('color','#eea236');
    			$("#hkzq").css('font-size','12px');
    			$("#hkzq").show();
    			$("select[name='cycle']").css('border-color','#eea236');
    		}/* else if(!term){
				alert("请选择借款期限");
    		} */else if(!name){
				/* alert("请填写姓名"); */
    			$("#mz").text("请填写姓名");
    			$("#mz").css('color','#eea236');
    			$("#mz").css('font-size','12px');
    			$("#mz").show();
    			$("input[name='name']").css('border-color','#eea236');
    		}else if(!mobile){
				/* alert("请填写联系方式"); */
    			$("#lxfs").text("请填写联系方式");
    			$("#lxfs").css('color','#eea236');
    			$("#lxfs").css('font-size','12px');
    			$("#lxfs").show();
    			$("input[name='mobile']").css('border-color','#eea236');
    		}else{
    			$("#loan-form").submit();
    		}
    		
    		
			
    	}

    	
    </script>
	
</head>


    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    
  <?php echo $this->fetch('head.html'); ?>
  <!--layer弹出层  -->
	  <!-- <link href="https://cdn.bootcss.com/layer/3.1.0/theme/default/layer.css" rel="stylesheet"> 
	<script type="text/javascript" src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script> -->
	<!--layer弹出层  -->
	
	<script type="text/javascript" src="/Application/Tpl/js/loan.js"></script>

  <body>
    
    <div class="container top">
    	<div class="row">
    		<div class="col-lg-12">
    			<div class="swiper-container">
					<div class="my-pagination">
					<ul class="my-pagination-ul">
						<li class="loan_li">贷款申请</li>
					</ul>
					</div>
					<div class="">
				    	
						<div class="">
				        	<!--手机绑定GO-->
				        	<div class="user_zc_body" style="padding:40px 0;">
				                <form action="/index.php?ctl=loan&act=loaning" method="post" onsubmit="return false;" accept-charset="utf-8"  class="form-horizontal user-common-form" id="loan-form" class="loan-form">
									<div class="form-group">
						                <label class="col-xs-5 control-label txt">借款用途</label>
						                <div class="col-xs-4 errorWrapper">
						                	<select class="form-control" name="type">
						                		<option value="">--</option>
											  	<option value="医疗支出">医疗支出</option>
	                                            <option value="教育费用">教育费用</option>
	                                            <option value="购房贷款">购房贷款</option>
	                                            <option value="消费购物">消费购物</option>
	                                            <option value="旅游度假">旅游度假</option>
											</select>
						                </div>
						                <label id="jkyt" class="col-xs-4 control-label txt errmsg" style="text-align:left;padding-left:0px;display:none;"></label>

						            </div>
						             <div class="form-group">
						                <label class="col-xs-5 control-label txt">有无抵押</label>
						                <div class="col-xs-4 " >
						                		<input id="adType1" name="mortgage" type="radio" value="1">
												<label for="adType1">有</label>
												<input id="adType2" name="mortgage" type="radio" value="0" checked="checked">
												<label for="adType2">无</label>

						                	<!-- <select class="form-control" name="mortgage">
						                		<option value="-1">请选择</option>
											  	<option value="1">有</option>
	                                            <option value="0">无</option>
											</select> -->
						                	<!-- <label class="radio-inline">
											  <input type="radio" style="-webkit-appearance:radio !important;appearance:radio !important;" name="mortgage" id="mortgage1" value="1" > 有
											</label>
											<label class="radio-inline">
											  <input type="radio" style="-webkit-appearance:radio !important;appearance:radio !important;" name="mortgage" id="mortgage2" value="0"> 无
											</label> -->
											
						                </div>
						                <label class="col-xs-4 control-label"></label>
						            </div> 
						            <div class="form-group">
						                <label class="col-xs-5 control-label txt">借款金额</label>
						                <div class="col-xs-4 errorWrapper">
						                	
						                    <input type="text" name="loanmoney" class="form-control valid" value="" placeholder="3000-100000、需为50的整数倍"  >
						                </div>
						                <label id="jkje" class="col-xs-4 control-label txt errmsg" style="text-align:left;padding-left:0px;display:none;"></label>
						            </div>
						            
						            <div class="form-group" style="margin-top:15px;">
						                <label class="col-xs-5 control-label txt">还款周期</label>
						                <div class="col-xs-4 errorWrapper">
						                	<select class="form-control" name="cycle">
						                		<option value="">--</option>
											  <option value="m">按月还款</option>
                                              <option value="q">按季度还款</option>
                                              <option value="y">按年还款</option>
											</select>
						                </div>
						                <label id="hkzq" class="col-xs-4 control-label txt errmsg" style="text-align:left;padding-left:0px;display:none;"></label>
						            </div>
									<div class="form-group">
						                <label class="col-xs-5 control-label txt">真实姓名</label>
						                <div class="col-xs-4 errorWrapper">
						                	
						                    <input type="text" name="name" class="form-control valid" value="" placeholder="请输入借款人真实姓名"  >
						                </div>
						                <label id="mz" class="col-xs-4 control-label txt errmsg" style="text-align:left;padding-left:0px;display:none;"></label>
						            </div>
						            <div class="form-group">
						                <label class="col-xs-5 control-label txt">手机号码</label>
						                <div class="col-xs-4 errorWrapper">
						                	<input type="text" style="display:none;"  name="user_id" class="form-control valid" value="<?php echo $this->_var['user']['id']; ?>">
						                    <input type="text" name="mobile" class="form-control valid" value="" placeholder="请输入借款人可用的手机号码"  >
						                </div>
						                <label id="lxfs" class="col-xs-4 control-label txt errmsg" style="text-align:left;padding-left:0px;display:none;"></label>
						            </div>
						            
			            			<div class="form-group">
			            				<label class="col-xs-4 control-label"></label>
						                <div id="guestIdentityButton" class="col-xs-4 ">
						                    <button onclick="regaa()" type="button" id="tj"  class="btn btn-warning  btn-identity btn-block btn-radius " style="background:rgb(238,185,44);width:405px;height:64px;font-size:32px;">提交</button>
						                </div>
						                <label class="col-xs-4 control-label"></label>
						            </div>
								</form>
				            </div>
				            
				        </div>
				       
					</div>
				</div>
				<!--我要贷款  -->
            </div>
            
            
    	</div>
    </div> 
    <?php echo $this->fetch('footer_v1.html'); ?>
