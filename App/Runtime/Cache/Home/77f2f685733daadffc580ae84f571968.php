<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <link rel="shortcut icon" href="/Public/home/images/logo.ico" />
    <title>杭州青域律禾创业服务有限公司</title>
    <meta name="keywords" content="杭州青域律禾创业服务有限公司" />
    <meta name="description" content="杭州青域律禾创业服务有限公司" />
    <meta name="author" content="杭州帷拓科技有限公司-专业网络服务供应商-高端网站建设：http://www.zjteam.com">
    <link rel="stylesheet" type="text/css" href="/Public/home/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/Public/home/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="/Public/home/css/common.css">
    <link rel="stylesheet" href="/Public/home/css/swiper.min.css">
    <script src="/Public/home/js/jquery.min.js"></script>
    <script src="/Public/home/js/bootstrap.js"></script>
    <script src="/Public/home/js/swiper.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/home/css/index.css">
    <script src="/Public/home/js/index.js"></script>
    <script>
        if (navigator.appName == "Microsoft Internet Explorer" && (navigator.appVersion.match(/7./i) == "7." || navigator.appVersion
                .match(/8./i) == "8." || navigator.appVersion.match(/9./i) == "9.") && (document.documentMode == "9" || document.documentMode ==
                "8")) {
            self.location.href = "ie/ie.html"
        }
    </script>

</head>

<body>
    <div class="header scrollT">
        <div class="head_cot">
            <div class="logo">
                <a href="/">
                    <img src="/Public/home/images/logo.svg" alt="">
                </a>
            </div>
            <div class="head_menu">
                <ul>
                    <li><a href="<?php echo U('space/index');?>">办公空间推荐</a></li>
                    <li><a href="<?php echo U('aegis/index');?>">办公用品</a></li>
                    <li><a href="<?php echo U('ambient/index');?>">办公环境维护</a></li>
                    <li><a href="<?php echo U('consultant/index');?>">财税法权</a></li>
                    <li><a href="<?php echo U('plot/index');?>">品牌策划</a></li>
                    <li><a href="<?php echo U('gift/index');?>">企业礼品</a></li>
                    <li><a href="<?php echo U('weal/index');?>">员工福利</a></li>
                    <li><a href="<?php echo U('mall/index');?>">精选商城</a></li>
                </ul>
            </div>
            <div class="head_btn">
                <div class="head_sele">
                    <a href="/">
                        <img src="/Public/home/images/ico.svg" alt="">
                        <img src="/Public/home/images/ico1.svg" alt="">
                    </a>
                    <div class="head_nav">
                        <ul>
                            <li><a href="<?php echo U('user/cart');?>"><img src="/Public/home/images/cart.svg" alt=""><span>购物车</span></a></li>
                            <li><a href="<?php echo U('order/index');?>"><img src="/Public/home/images/order.svg" alt=""><span>我的订单</span></a></li>
                            <li><a href="<?php echo U('order/index');?>"><img src="/Public/home/images/user.svg" alt=""><span>个人中心</span></a></li>
                            <?php if(empty($_SESSION['uid'])): ?><li><a href="<?php echo U('login/register');?>"><img src="/Public/home/images/register.svg" alt=""><span>注册</span></a></li>
                                <li><a href="<?php echo U('login/login');?>"><img src="/Public/home/images/login.svg" alt=""><span>登录</span></a></li>
                            <?php else: ?>
                                <li><a><img src="/Public/home/images/register.svg" alt=""><span><?php echo ($_SESSION["tel"]); ?></span></a></li>
                                <li><a href="<?php echo U('login/out');?>"><img src="/Public/home/images/login.svg" alt=""><span>注销</span></a></li><?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="head_search">
                    <a href="<?php echo U('search/index');?>"><img src="/Public/home/images/search.svg" alt=""><img src="/Public/home/images/search1.svg" alt=""></a>
                </div>
                <div class="phone_btn">
                    <span><i></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="menu_box">
        <div class="phone_menu">
            <ul>
                <li><a href="<?php echo U('space/index');?>">办公空间推荐</a></li>
                <li><a href="<?php echo U('aegis/index');?>">办公用品</a></li>
                <li><a href="<?php echo U('ambient/index');?>">办公环境维护</a></li>
                <li><a href="<?php echo U('consultant/index');?>">财税法权</a></li>
                <li><a href="<?php echo U('plot/index');?>">品牌策划</a></li>
                <li><a href="<?php echo U('gift/index');?>">企业礼品</a></li>
                <li><a href="<?php echo U('weal/index');?>">员工福利</a></li>
                <li><a href="<?php echo U('mall/index');?>">精选商城</a></li>
                <li><a href="<?php echo U('jifen/index');?>">积分商城</a></li>
                <li><a href="<?php echo U('news/index');?>">了解我们</a></li>
                <li><a href="<?php echo U('order/index');?>">个人中心</a></li>
            </ul>
        </div>
        <div class="phone_close">
            <img src="/Public/home/images/close1.svg" alt="">
        </div>
    </div>

    <div class="wrapper wrapper_marg">
        <div class="login_box" style="background-image: url(/Public/home/images/login_bg.jpg)">
            <div class="login_cot">
                <div class="login_back">
                    <a href="javascript:history.go(-1)"><i class="fa fa-angle-left"></i></a>
                </div>
                <div class="login_tit">
                    <h3>欢迎加入青域律禾</h3>
                </div>
           <form name="form" method="post" onsubmit="return false;">
                <div class="login_wz">
                    <div class="login_li">
                        <div class="login_lis">
                            <input type="text" name="tel" placeholder="请输入手机号">
                        </div>
                        <div class="login_lis login_lis1">
                            <input type="text" name="phone_code"  placeholder="请输入验证码">
                            <a style="cursor: pointer;" id="yzm2" data-id="1" value="获取验证码">获取验证码</a>
                           <!--  <a style="cursor: pointer;" href="javascript:;">获取验证码</a> -->
                        </div>
                        <div class="login_lis">
                            <input type="password" name="password" placeholder="请输入密码（6-12位数字和字母组合）">
                        </div>
                        <div class="login_lis">
                             <input type="password" name="cfmpwd" placeholder="确认密码">
                        </div>
                        <div class="login_lis">
                            <input type="button" id="cxgl" data-id="1" onclick="return zhuce();" value="注册">
                        </div>
                        <div class="login_xy">
                            <h5>注册代表你已同意<a href="javascript">《青域律禾用户协议》</a></h5>
                        </div>
                    </div>
                </div>

 </form>    
            </div>
        </div>
    </div>

</body>
<script>
    $(function () {
        $('.login_box').height($(window).height() - $('.header').height())

        $(window).resize(function () {
            $('.login_box').height($(window).height() - $('.header').height())
        })
    })
    $(function(){
        $("#yzm2").click(function(){
            if($(this).attr('data-id') == 0){
                return false;
            }
            $("#yzm2").val('发送中...');
            var url = "<?php echo U('Login/codesend');?>";
            var tel = $("input[name='tel']").val();
            var reg = /^1[3|4|5|7|8|9][0-9]\d{7,}$/;
            if(!reg.test(tel)){
                $("#yzm2").val('获取验证码');
                alert("请输入正确的手机号码");
                return false;
            }
            $.post(url,{"tel":tel},function(data){
                if(data.status == 1){
                    curCount = count;
                    //设置button效果，开始计时
                    $("#yzm2").attr("data-id",'0');
                    $("#yzm2").val(curCount+"秒");
                    InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
                    alert(data.msg);
                }else{
                    $("#yzm2").val('获取验证码');
                    alert(data.msg);
                    return false;
                }
            })
        });

    })
    function zhuce(){
        if($("#cxgl").attr('data-id') != 1){
            return false;
        }
        var url = "<?php echo U('Login/doregist');?>";
        $("#cxgl").val('注册中...');
        $("#regist").attr('data-id',0);
        $.post(url,$("form").serialize(),function(data){
            if(data.status == 1){
                $("#cxgl").val('跳转中...');
//                alert('注册成功,正在跳转...');
                window.location="<?php echo U('order/index');?>";
            }else{
                $("#regist").attr('data-id',1);
                $("#cxgl").val('注册');
                alert(data.msg);
                return false;
            }
        })
    }
</script>

</html>