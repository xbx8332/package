
        <?php echo $this->fetch('head.html'); ?>
        <!-- Start page content -->
            <!-- Start Register Area -->
            <div class="register-area pt-90">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="registered-customers">
                                <h4 class="text-uppercase mb-20"><strong>登录</strong></h4>
                                <form action="<?php
echo parse_url_tag("u:index|login#dologin|"."".""); 
?>" method="post">
                                    <div class="login-account p-30 box-shadow">
                                        <p>如果您已经注册过本网站会员，请在此登录！</p>
                                        <input type="text" placeholder="用户名" name="user_name" readonly onfocus="this.removeAttribute('readonly');">
                                        <input type="password" placeholder="密码" name="user_pwd" readonly onfocus="this.removeAttribute('readonly');">
                                        <p><small><a href="#">忘记密码?</a></small></p>
                                        <button type="submit" class="cart-button text-uppercase">登录</button>
                                    </div>
                                </form>                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="registered-customers new-customers">
                                <div class="section-title text-uppercase mb-40">
                                    <h4>新用户注册</h4>
                                </div>
                                <form action="<?php
echo parse_url_tag("u:index|login#register|"."".""); 
?>" method="post">
                                    <div class="login-account p-30 box-shadow">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" name="user_name" placeholder="用户名" readonly onfocus="this.removeAttribute('readonly');">
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="password" name="user_pwd" placeholder="密码" readonly onfocus="this.removeAttribute('readonly');">
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="password" name="user_pwd_confirm" placeholder="确认密码">
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" name = "phone" placeholder="手机号">
                                            </div>
                                            <?php if ($this->_var['code']): ?>
                                            		<div class="col-sm-12">
                                                        <input type="text" name = "pid" value="<?php echo $this->_var['code']; ?>">
                                                    </div>
                                            <?php else: ?>
                                            		<div class="col-sm-12">
                                                        <input type="text" name = "p_name" placeholder="推荐人">
                                                    </div>
                                            <?php endif; ?>
                                                    
                                                    <!-- <div class="col-sm-6">
                                                       <button class="btn btn-danger">获取验证码</button>
                                                    </div> -->
                                            
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button value="register" type="submit" class="cart-button text-uppercase mt-20">注册</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="reset" class="cart-button text-uppercase mt-20">重置</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Register Area -->
            <!-- Start Brand Area -->
            <div class="brand-area section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-center mb-35">
                                <h2 class="text-uppercase"><strong>OUR BRAND</strong></h2>
                                <p class="text-defualt">BRAND</p>
                                <img alt="" src="/Application/Tpl/images/section-border.png">
                            </div>
                            <div class="brand-carousel">
                                <div class="col-md-12">
                                    <div class="single-brand text-center">
                                        <a href="#">
                                            <img src="/Application/Tpl/images/brand/1.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-brand text-center">
                                        <a href="#">
                                            <img src="/Application/Tpl/images/brand/2.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-brand text-center">
                                        <a href="#">
                                            <img src="/Application/Tpl/images/brand/3.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-brand text-center">
                                        <a href="#">
                                            <img src="/Application/Tpl/images/brand/4.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-brand text-center">
                                        <a href="#">
                                            <img src="/Application/Tpl/images/brand/5.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-brand text-center">
                                        <a href="#">
                                            <img src="/Application/Tpl/images/brand/1.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-brand text-center">
                                        <a href="#">
                                            <img src="/Application/Tpl/images/brand/2.png" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-brand text-center">
                                        <a href="#">
                                            <img src="/Application/Tpl/images/brand/3.png" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
<?php echo $this->fetch('footer.html'); ?>   
