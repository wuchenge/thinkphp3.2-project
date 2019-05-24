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
        <div class="main_ban">
            <div class="swiper-contianer mainB_swiper">
                <div class="swiper-wrapper">
                    <?php if(is_array($banner)): $k = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="swiper-slide">
                            <div class="mainB_img">
                                <img src="<?php echo ($vo["img"]); ?>" alt="">
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="swiper-pagination banner_page"></div>
            </div>
        </div>

        <div class="aegis_box">
            <div class="aegis_nav">
                <div class="container">
                    <div class="aegisN_lcot">
                        <div class="aegisN_left">
                            <div class="aegisN_select">
                                <h3><span>类目种类</span><i class="fa fa-angle-down"></i></h3>
                            </div>
                            <div class="aegisN_down">
                                <div class="container">
                                    <div class="aegisND_close"><img src="/Public/home/images/close.svg" alt=""></div>
                                    <div class="aegisND_nav">
                                        <ul>
                                            <?php if(is_array($cate)): $k = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li <?php if($k == 1): ?>class="active"<?php endif; ?>><a href="javascript:;"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul>
                                    </div>
                                    <div class="aegisND_cot">
                                        <?php if(is_array($cate)): $k = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="aegisND_lis">
                                            <div class="aegisNDL_cot">
                                                <ul>
                                                     <?php if(is_array($vo["sxjihe"])): $i = 0; $__LIST__ = $vo["sxjihe"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?><li>
                                                            <a href="<?php echo U('ambient/index',array('tcate'=>$v2['id']));?>">
                                                                <label>
                                                                    <input  name="lz">
                                                                    <i></i>
                                                                    <span><?php echo ($v2["title"]); ?></span>
                                                                </label>
                                                            </a>
                                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>

                                                </ul>
                                            </div>
                                        </div><?php endforeach; endif; else: echo "" ;endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="aegisN_right">
                            <form id="topic_search" method="get" action="<?php echo U('ambient/index');?>" onkeydown="if(event.keyCode==13)return topicsearch()">
                                <div class="aegisN_search">
                                    <i class="fa fa-search"></i><input name="title" value="<?php echo ($_GET['title']); ?>" type="text" placeholder="搜索产品">
                                </div>
                            </form>

                            <div class="aegisN_jx">
                                <i class="sort_desc"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aegis_show">
                <div class="container">
                    <div class="aegisS_cot">
                        <div class="aegisS_left">
                            <p>当前产品数 <span>1-12</span> 总计<?php echo ($count); ?>件</p>
                        </div>
                        <div class="aegisS_right">
                            <ul>
                                <h5>展示方式</h5>
                                <li><a href="javascript:;"><img src="/Public/home/images/show3_1.png" alt=""><img src="/Public/home/images/show3_2.png" alt=""></a></li>
                                <li class="active"><a href="javascript:;"><img src="/Public/home/images/show4_1.png" alt=""><img src="/Public/home/images/show4_2.png"
                                         alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aegis_cot">
                <div class="row">
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-sm-3 col-xs-6">
                        <a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>">
                            <div class="aegis_lis">
                                <div class="aegis_img" style="background: url(<?php echo ($vo["imgurl"]); ?>)  center /cover;">
                                    <img src="/Public/home/xianbg.png" alt="">
                                    <div class="swiper-container aegis_swiper">
                                        <span class="aegis_arrl"><i class="fa fa-angle-left"></i></span>
                                        <span class="aegis_arrr"><i class="fa fa-angle-right"></i></span>
                                        <div class="swiper-wrapper">
                                            <?php if(is_array($vo["imgs"])): $i = 0; $__LIST__ = $vo["imgs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
                                                    <img src="<?php echo ($v2); ?>" alt="">
                                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="aegis_wz">
                                    <div class="aegis_visib">
                                        <h3><?php echo ($vo["gname"]); ?></h3>
                                        <p>￥<?php echo ($vo["price"]); ?></p>
                                    </div>
                                    <div class="aegis_hide">
                                        <h3>产品规格</h3>
                                        <p>25cm 35cm 45cm 55cm 65cm 1m</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>

  
                </div>
                <div class="aegis_page">
                    <ul>
                         <?php echo ($page); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="footer">
        <div class="container">
            <div class="footer_top">
                <div class="footer_menu">
                    <ul>
                        <li>
                            <h3>办公空间推荐</h3>
                            <?php if(is_array($kongjian)): $i = 0; $__LIST__ = $kongjian;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p><a href="<?php echo U('space/info',array('id'=>$vo['id']));?>" target="_blank"><?php echo ($vo["title"]); ?></a></p><?php endforeach; endif; else: echo "" ;endif; ?>
                        </li>
                        <li>
                            <h3>办公环境维护</h3>
                            <?php if(is_array($weihu)): $i = 0; $__LIST__ = $weihu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p><a href="<?php echo U('ambient/index',array('tcate'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></p><?php endforeach; endif; else: echo "" ;endif; ?>
                        </li>
                        <li>
                            <h3>精选商城</h3>
                            <?php if(is_array($jingxuan)): $i = 0; $__LIST__ = $jingxuan;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p><a href="<?php echo U('mall/index',array('tcate'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></p><?php endforeach; endif; else: echo "" ;endif; ?>
                        </li>
                        <li>
                            <h3>了解我们</h3>
                            <p><a href="<?php echo U('about/index');?>">关于我们</a></p>
                            <p><a href="<?php echo U('contact/index');?>">联系我们</a></p>
                            <p><a href="<?php echo U('news/index');?>">新闻中心</a></p>
                        </li>
                    </ul>
                </div>
                <div class="footer_contact">
                    <div class="foot_btn">
                        <!-- <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($config["qq"]); ?>&site=qq&menu=yes" > -->
                        <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($config["qq"]); ?>&site=qq&menu=yes" title="QQ客服：<?php echo ($config["qq"]); ?>">
                            <img src="/Public/home/images/kf.svg" alt="">
                            <span>在线客服</span>
                        </a>
                    </div>
                    <div class="foot_wz">
                        <h3><?php echo ($config["tel"]); ?></h3>
                        <p>24小时全国热线</p>
                        <p style="margin-top: 10px;font-size: 14px;">公司地址： <?php echo ($config["address"]); ?></p>
                    </div>
                </div>
            </div>
            <div class="footer_bott">
                <div class="copy"><?php echo ($config["copy"]); ?> DESIGN BY : <a hre="http://www.zjteam.com/"
                     target="_blank">WEETOP</a></div>
                <div class="follow">
                    <ul>
                        <li>关注我们：</li>
                        <li><a href="javascript:;"><i class="fa fa-qq"></i></a></li>
                        <li><a href="javascript:;"><i class="fa fa-weixin"></i></a></li>
                        <li><a href="javascript:;"><i class="fa fa-weibo"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php if(CONTROLLER_NAME != 'Index'): ?><div class="fixed_right">
        <ul>
            <li><a><i class="fa fa-angle-up"></i></a></li>
            <li><a href="/"><i class="fa fa-home"></i></a></li>
            <li><a href="<?php echo U('user/cart');?>"><i class="fa fa-shopping-cart"></i></a></li>
            <li><a href="<?php echo U('order/index');?>"><i class="fa fa-user"></i></a></li>
            <li><a href="<?php echo U('collect/space');?>"><i class="fa fa-heart"></i></a></li>
        </ul>
    </div><?php endif; ?>

    <div class="body_bg"></div>
</body>
<script>
    $(function () {

        var bannerSwiper = new Swiper('.mainB_swiper', {
            loop: true,
            autoplay: 5000,
            pagination: '.banner_page',
            paginationClickable: true,
        })

        var aegis_swiper = new Swiper('.aegis_swiper', {
            loop: true,
            prevButton: '.aegis_arrl',
            nextButton: '.aegis_arrr',
        })

        $('.aegisND_nav li').click(function () {
            $(this).addClass('active').siblings().removeClass('active')
            $('.aegisND_lis').hide()
            $('.aegisND_lis').eq($(this).index()).fadeIn()
        })

        $('.aegisN_select').click(function () {
            $('.body_bg').toggleClass('into')
            $('.aegisN_down').stop().fadeToggle()
        })

        $('.aegisND_close').click(function () {
            $('.body_bg').removeClass('into')
            $('.aegisN_down').stop().fadeOut()
        })

        $('.aegisS_right li').eq(0).click(function () {
            $(this).addClass('active').siblings().removeClass('active')
            $('.aegis_cot>.row>div').attr('class', 'col-sm-4 col-xs-6')
            aegis_swiper = new Swiper('.aegis_swiper', {
                loop: true,
                prevButton: '.aegis_arrl',
                nextButton: '.aegis_arrr',
            })
        })

        $('.aegisS_right li').eq(1).click(function () {
            $(this).addClass('active').siblings().removeClass('active')
            $('.aegis_cot>.row>div').attr('class', 'col-sm-3 col-xs-6')
            aegis_swiper = new Swiper('.aegis_swiper', {
                loop: true,
                prevButton: '.aegis_arrl',
                nextButton: '.aegis_arrr',
            })
        })

        $('.sort_desc').click(function () {
            $(this).toggleClass('sort_up')
        })

    })
</script>

</html>