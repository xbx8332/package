﻿
<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>Phoenix后台管理系统</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="/Admin/Tpl/public/assets/css/reset.css">
        <link rel="stylesheet" href="/Admin/Tpl/public/assets/css/supersized.css">
        <link rel="stylesheet" href="/Admin/Tpl/public/assets/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<script type="text/javascript">
			var verifyImg_url = '<?php
echo parse_url_tag("u:admin|login#getVerify|"."".""); 
?>';
			var ajax_url = "<?php
echo parse_url_tag("u:admin|login#dologin|"."".""); 
?>";
			var jump_url ='<?php
echo parse_url_tag("u:admin|index#index|"."".""); 
?>'; 
		</script>
    </head>
	
    <body>

        <div class="page-container">
            <h1>Phoenix后台管理系统</h1>
            <form id="login-form" action="<?php
echo parse_url_tag("u:admin|login#dologin|"."".""); 
?>" method="POST" onsubmit='return false;'>
                <input type="text" name="adm_name" class="username" placeholder="请输入您的账号">
                <input name="adm_password" type="password" class="password" placeholder="请输入您的密码">
               
                <input  type="text" name="verify" placeholder="验证码"   >
                 <img id = "verifyImg" style='margin-top:25px;' src="" width='300' height='42' ></img>
                <button id="dologin" name=""  type="submit"  >登录</button>
                <div class="error"><span>+</span></div>
            </form>
            <!-- <div class="connect">
                <p>Or connect with:</p>
                <p>
                    <a class="facebook" href=""></a>
                    <a class="twitter" href=""></a>
                </p>
            </div> -->
        </div>
        <!-- Javascript -->
        <script>
        
        </script>
        <script type="text/javascript" src="/Admin/Tpl/public/lib/jquery/1.9.1/jquery.min.js"></script> 
        <script type="text/javascript" src="/Admin/Tpl/public/lib/jquery/1.9.1/jquery.min.js"></script> 
		<script type="text/javascript" src="/Admin/Tpl/public/static/layer/layer.js"></script> 
        <script src="/Admin/Tpl/public/assets/js/supersized.3.2.7.min.js"></script>
        <script src="/Admin/Tpl/public/assets/js/supersized-init.js"></script>
        <script src="/Admin/Tpl/public/assets/js/scripts.js"></script>
		<script src="/Admin/Tpl/public/assets/js/login.js"></script>
		
    </body>


</html>

