<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>用户赎回</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src='/Application/Tpl/js/vendor/jquery-1.12.4.min.js'></script>
  <script src='/Application/Tpl/layer/layui/lay/dest/layui.all.js'></script>
  <style>
  body{
  margin:0px;
  padding:0px;
  }
  	input{
  		width:100%;
  		height:48px;
  		margin:0 auto;
  		margin:10px 0px;
  		padding-left:5px;
  		border:1px solid #F3F3F3;
  		font-size:20px;
  	}
  	.cart-button{
  		width:100%;
  		height:60px;
  		line-height:60px;
  		background:#EEB92C;
  		color:white;
  		border:1px solid #EEB92C;
  	}
  	.cart-button2{
  		width:100%;
  		height:60px;
  		line-height:64px;
  		background:white;
  		color:#EEB92C;
  		border:1px solid #EEB92C;
  	}
  	a{
  		text-decoration : none;
  		color:black;
  	}
	td{
		width:50%;
	}
  </style>
<SCRIPT>

function redeem_out(){
	var id=$('input[name = "id"]').val();
	var redeem_money = $('input[name="redeem_money"]').val();
	var paypassword = $('input[name="paypassword"]').val();
	
	$.ajax({
		url:"<?php
echo parse_url_tag("u:index|redeem#uc_redeem_add|"."".""); 
?>",
		type:"POST",
		data:{
			"id":id,
			"redeem_money":redeem_money,
			"paypassword":paypassword
		},
		async: false ,
		success:function(obj){
			obj = JSON.parse(obj);
			console.log(obj.msg);
			if(obj.msg.success==1){
				var index = parent.layer.getFrameIndex(window.name);
				parent.layer.close(index);
				layer.msg('提交成功，请等待审核');
				parent.history.go(0);
				
			}else{
				//layer.msg('提交失败，请再次填写',{time:9999999999});
				alert(obj.msg.msg);
			}
			
		},
		error:function(a,b,c){
			console.log(a);
			console.log(b);
			console.log(c);
		}
	});
}

function cancel(){
	var index = parent.layer.getFrameIndex(window.name);
	parent.layer.close(index);
}



</SCRIPT>
</head>
	<body>
	<form method="post" style="width:90%;margin:0 auto;">
		<p style="font-size:24px;">转出确认</p>
		<table style="width:100%;line-height:30px;">
			<?php if ($this->_var['data']): ?>
			<tr>
				<td>账户余额</td>
				<td style="text-align:right;"><?php echo $this->_var['data']['pay_money']; ?>元</td>
			</tr>
			<tr>
				<td>转出金额</td>
				<td style="text-align:right;">
					<input type="text" name="redeem_money" value="<?php echo $this->_var['data']['pay_money']; ?>" style="text-align:center;" placeholder="请输入转出金额"  />
					<input type="hidden" value="<?php echo $this->_var['id']; ?>" name="id" />
				</td>
			</tr>
			<?php else: ?>
			<tr>
				<td>账户余额</td>
				<td style="text-align:right;"> <?php echo $this->_var['h_sum_money']; ?>元</td>
			</tr>
			<tr>
				<td>转出金额</td>
				<td style="text-align:right;">
					<input type="text" name="redeem_money" style="text-align:center;" placeholder="请输入转出金额"  />
					<input  type="hidden" value="<?php echo $this->_var['id']; ?>" name="id" />
				</td>
			</tr>
			<?php endif; ?>
			
			<tr>
				<td>支付密码</td>
				<td style="text-align:right;"><input type="password" name="paypassword" style="text-align:center;" placeholder="请输入支付密码" /></td>
			</tr>
			<tr style="width:100%;height:50px;">
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><button onclick="cancel()"  class="cart-button2">取消赎回</button></td>
				<td><button onclick="redeem_out()"  class="cart-button">赎回</button></td>
			</tr>
		</table>
	</form>
</body>
</html>