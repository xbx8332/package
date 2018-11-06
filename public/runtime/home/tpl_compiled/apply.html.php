<head>
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
        body{
            background:white;
        }
        .row-1{
            background:#fffbfb;
            width: 60%;
            margin: 0 auto;
        }
        td{
            text-align:center;

        }
        .form-control{
            width: 50%;
        }
        .td-1{
            width: 20%;
        }
    </style>
    <script>
 
    	function reg(){
    		var types=$('select[name="type"]').val();
    		var mortgage=$('select[name="mortgage"]').val();
    		var loanmoney=$('input[name="loanmoney"]').val();
    		var cycle=$('select[name="cycle"]').val();
    		var term=$('select[name="term"]').val();
    		var name=$('input[name="name"]').val();
    		var mobile=$('input[name="mobile"]').val();
    		if(!types){
    			alert("请选择借款用途");
    		}else if(!mortgage){
    			alert("请填写有无抵押");
    		}else if(!loanmoney){
    			alert("请填写借款金额");
    		}else if(!cycle){
				alert("请选择还款周期");
    		}else if(!term){
				alert("请选择借款期限");
    		}else if(!name){
				alert("请填写姓名");
    		}else if(!mobile){
				alert("请填写联系方式");
    		}else{
    			$("#asdf").submit();
    		}
    		
    		
			
    	}

    	
    </script>
</head>
<?php echo $this->fetch('head.html'); ?>
    <!-- Body main wrapper start -->
        <!-- Start of header area -->

        <!-- End of header area -->
        
        <!-- Start page content -->
        <section id="page-content" class="page-wrapper pt-10">
            <div class="container">
                <div class="row product-img b-img row-1" style="padding:10px;margin:0 auto;">
                    <div class="col-lg-12">
                        <form action="/index.php?ctl=loan&act=loaning" method="post" accept-charset="utf-8" id="asdf">
                            <table class="table">
                                <tr>
                                    <td class="td-1">借款用途：</td>
                                    <td>
                                        <select name="type" class="form-control">
                                            <option value="医疗支出">医疗支出</option>
                                            <option value="教育费用">教育费用</option>
                                            <option value="购房贷款">购房贷款</option>
                                            <option value="消费购物">消费购物</option>
                                            <option value="旅游度假">旅游度假</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>有无抵押：</td>
                                    <td>
                                        <select name="mortgage" class="form-control">
                                            <option value="1">有</option>
                                            <option value="0">无</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>借款金额：</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <input type="text" name="loanmoney" value="">
                                            </div>
                                            <div class="col-lg-9 text-left" >
                                                （借款金额3,000-100,000，需为五十的倍数。）
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>还款周期：</td>
                                    <td>
                                        <select name="cycle" class="form-control">
                                            <option value="m">按月还款</option>
                                            <option value="q">按季度还款</option>
                                            <option value="y">按年还款</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>借款期限：</td>
                                    <td>
                                        <select name="term" class="form-control">
                                            <option value="1">一个月</option>
                                            <option value="2">两个月</option>
                                            <option value="3">三个月</option>
                                            <option value="6">六个月</option>
                                            <option value="12">1年</option>
                                            <option value="24">2年</option>
                                        </select>
                                    </td>
                                </tr>
                                
                               
                                <tr>
                                    <td>借款人姓名：</td>
                                    <td>
                                       <div class="row">
                                            <div class="col-lg-8">
                                                <input type="text" name="name" value="">
                                            </div>
                                           
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>联系方式：</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <input type="text" name="mobile" value="">
                                            </div>
                                            
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       
                                    </td>
                                     <td>
                                      <input type="button" class="btn btn-success" id="tj"  value="提交" onclick="reg()"> 
                                    </td>
                                </tr>
                            </table>
                        </form>
                   
                   
                    </div>
                </div>
            </div>
        </section>
        <!-- End page content -->
<?php echo $this->fetch('footer.html'); ?>
