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

    <div class="wrapper">
        <div class="banner">
            <div class="banner_swiper swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="banner_lis">
                            <div class="banner_bg" style="background-image: url(/Public/home/images/banner.jpg)"></div>
                            <div class="banner_wz">
                                <h3>本周青域精选办公楼</h3>
                                <h5>This week qingyu selected office buildings</h5>
                                <h2>— 华彩国际·曈昽佳苑 —</h2>
                                <div class="banner_btn">
                                    <a href="#">learn more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="banner_lis">
                            <div class="banner_bg" style="background-image: url(/Public/home/images/banner.jpg)"></div>
                            <div class="banner_wz">
                                <h3>本周青域精选办公楼</h3>
                                <h5>This week qingyu selected office buildings</h5>
                                <h2>— 华彩国际·曈昽佳苑 —</h2>
                                <div class="banner_btn">
                                    <a href="#">learn more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="banner_lis">
                            <div class="banner_bg" style="background-image: url(/Public/home/images/banner.jpg)"></div>
                            <div class="banner_wz">
                                <h3>本周青域精选办公楼</h3>
                                <h5>This week qingyu selected office buildings</h5>
                                <h2>— 华彩国际·曈昽佳苑 —</h2>
                                <div class="banner_btn">
                                    <a href="#">learn more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination banner_page"></div>
            </div>
            <div class="banner_nav">
                <ul>
                    <li>
                        <div class="banner_li">
                            <h3>大型家具</h3>
                            <p>
                                 <?php if(is_array($jiaju1)): $i = 0; $__LIST__ = $jiaju1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>"><?php echo (substr($vo["gname"],0,6)); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                            </p>
                            <div class="banner_jt">
                                <img src="/Public/home/images/jt.png" alt="">
                                <img src="/Public/home/images/jt1.png" alt="">
                            </div>
                        </div>
                        <div class="banner_down">
                            <div class="bannerD_left">
                                <div class="bannerD_li">
                                    <ul>
                                        <?php if(is_array($jiaju)): $i = 0; $__LIST__ = $jiaju;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>"><h2 style=" background-image: url(<?php echo ($vo["imgurl"]); ?>);"><img src="/Public/home/images/menu_le.png" alt=""></h2><span><?php echo ($vo["gname"]); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="bannerD_right">
                                <a href="#">
                                    <div class="bannerD_lis">
                                        <div class="bannerD_img">
                                            <img src="/Public/home/indexbg1.jpg" alt="">
                                        </div>
                                        <div class="bannerD_wz">
                                            <h3>立志营造一个高效舒适的办公环境，为客户奉献优质的产品、新潮的家具、周全的服务和真诚的心。</h3>
                                            
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="banner_li">
                            <h3>办公用品</h3>
                            <p>
                                 <?php if(is_array($bangong1)): $i = 0; $__LIST__ = $bangong1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>"><?php echo (substr($vo["gname"],0,6)); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                            </p>
                            <div class="banner_jt">
                                <img src="/Public/home/images/jt.png" alt="">
                                <img src="/Public/home/images/jt1.png" alt="">
                            </div>
                        </div>
                        <div class="banner_down">
                            <div class="bannerD_left">
                                <div class="bannerD_li">
                                    <ul>
                                        <?php if(is_array($bangong)): $i = 0; $__LIST__ = $bangong;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>"><h2 style=" background-image: url(<?php echo ($vo["imgurl"]); ?>);"><img src="/Public/home/images/menu_le.png" alt=""></h2><span><?php echo ($vo["gname"]); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="bannerD_right">
                                <a href="#">
                                    <div class="bannerD_lis">
                                        <div class="bannerD_img">
                                            <img src="/Public/home/indexbg2.jpg" alt="">
                                        </div>
                                        <div class="bannerD_wz">
                                            <h3>企业单位在日常工作中所使用的辅助用品.</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="banner_li">
                            <h3>绿植保洁</h3>
                            <p>
                                <?php if(is_array($lvzhi1)): $i = 0; $__LIST__ = $lvzhi1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>"><?php echo (substr($vo["gname"],0,6)); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                            </p>
                            <div class="banner_jt">
                                <img src="/Public/home/images/jt.png" alt="">
                                <img src="/Public/home/images/jt1.png" alt="">
                            </div>
                        </div>
                        <div class="banner_down">
                            <div class="bannerD_left">
                                <div class="bannerD_li">
                                    <ul>
                                        <?php if(is_array($lvzhi)): $i = 0; $__LIST__ = $lvzhi;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>"><h2 style=" background-image: url(<?php echo ($vo["imgurl"]); ?>);"><img src="/Public/home/images/menu_le.png" alt=""></h2><span><?php echo ($vo["gname"]); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="bannerD_right">
                                <a href="#">
                                    <div class="bannerD_lis">
                                        <div class="bannerD_img">
                                            <img src="/Public/home/indexbg3.jpg" alt="">
                                        </div>
                                        <div class="bannerD_wz">
                                            <h3>生活空间总是离不开绿植的点缀；有效的保洁时间放在专业的清洁工作上更有价值。</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="banner_li">
                            <h3>品牌策划</h3>
                            <p>
                                <?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>"><?php echo (substr($vo["title"],0,6)); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                            </p>
                            <div class="banner_jt">
                                <img src="/Public/home/images/jt.png" alt="">
                                <img src="/Public/home/images/jt1.png" alt="">
                            </div>
                        </div>
                        <div class="banner_down">
                            <div class="bannerD_left">
                                <div class="bannerD_li">
                                    <ul>
                                        <?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>"><h2 style=" background-image: url(<?php echo ($vo["imgurl"]); ?>);"><img src="/Public/home/images/menu_le.png" alt=""></h2><span><?php echo ($vo["gname"]); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="bannerD_right">
                                <a href="#">
                                    <div class="bannerD_lis">
                                        <div class="bannerD_img">
                                            <img src="/Public/home/indexbg4.jpg" alt="">
                                        </div>
                                        <div class="bannerD_wz">
                                            <h3>使消费者与企业品牌和产品品牌之间形成统一的价值观。</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="banner_li">
                            <h3>企业礼品</h3>
                            <p>
                                <?php if(is_array($qiye1)): $i = 0; $__LIST__ = $qiye1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>"><?php echo (substr($vo["gname"],0,6)); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                            </p>
                            <div class="banner_jt">
                                <img src="/Public/home/images/jt.png" alt="">
                                <img src="/Public/home/images/jt1.png" alt="">
                            </div>
                        </div>
                        <div class="banner_down">
                            <div class="bannerD_left">
                                <div class="bannerD_li">
                                    <ul>
                                        <?php if(is_array($qiye)): $i = 0; $__LIST__ = $qiye;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>"><h2 style=" background-image: url(<?php echo ($vo["imgurl"]); ?>);"><img src="/Public/home/images/menu_le.png" alt=""></h2><span><?php echo ($vo["gname"]); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="bannerD_right">
                                <a href="#">
                                    <div class="bannerD_lis">
                                        <div class="bannerD_img">
                                            <img src="/Public/home/indexbg5.jpg" alt="">
                                        </div>
                                        <div class="bannerD_wz">
                                            <h3>为了传承企业文化，定制专属企业的礼品。</h3>
                   
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="banner_li">
                            <h3>员工福利</h3>
                            <p>
                                <?php if(is_array($fuli1)): $i = 0; $__LIST__ = $fuli1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>"><?php echo (substr($vo["gname"],0,6)); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                            </p>
                            <div class="banner_jt">
                                <img src="/Public/home/images/jt.png" alt="">
                                <img src="/Public/home/images/jt1.png" alt="">
                            </div>
                        </div>
                        <div class="banner_down">
                            <div class="bannerD_left">
                                <div class="bannerD_li">
                                    <ul>
                                        <?php if(is_array($fuli)): $i = 0; $__LIST__ = $fuli;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>"><h2 style=" background-image: url(<?php echo ($vo["imgurl"]); ?>);"><img src="/Public/home/images/menu_le.png" alt=""></h2><span><?php echo ($vo["gname"]); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="bannerD_right">
                                <a href="#">
                                    <div class="bannerD_lis">
                                        <div class="bannerD_img">
                                            <img src="/Public/home/indexbg6.jpg" alt="">
                                        </div>
                                        <div class="bannerD_wz">
                                            <h3>让员工感受到公司给予的关爱，以促进企业的发展。</h3>
                                       
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="banner_li">
                            <h3>商城入口</h3>
                            <p>
                                <?php if(is_array($shang1)): $i = 0; $__LIST__ = $shang1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>"><?php echo (substr($vo["gname"],0,6)); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                            </p>
                            <div class="banner_jt">
                                <img src="/Public/home/images/jt.png" alt="">
                                <img src="/Public/home/images/jt1.png" alt="">
                            </div>
                        </div>
                        <div class="banner_down">
                            <div class="bannerD_left">
                                <div class="bannerD_li">
                                    <ul>
                                        <?php if(is_array($shang)): $i = 0; $__LIST__ = $shang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('aegis/info',array('id'=>$vo['id']));?>"><h2 style=" background-image: url(<?php echo ($vo["imgurl"]); ?>);"><img src="/Public/home/images/menu_le.png" alt=""></h2><span><?php echo ($vo["gname"]); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="bannerD_right">
                                <a href="#">
                                    <div class="bannerD_lis">
                                        <div class="bannerD_img">
                                            <img src="/Public/home/indexbg6.jpg" alt="">
                                        </div>
                                        <div class="bannerD_wz">
                                            <h3>企业一体化服务，放心靠谱。</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="ind_box">
            <ul>
                <li>
                    <a href="<?php echo U('news/index');?>">
                        <div class="ind1_lis">
                            <div class="ind1_img">
                                <img src="/Public/home/images/ind1.jpg" alt="">
                            </div>
                            <div class="ind1_wz">
                                <h5>青域享惊喜，活动乐不停</h5>
                                <h3>青域近期活动</h3>
                                <span>——了解更多</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('jifen/index');?>">
                        <div class="ind1_lis">
                            <div class="ind1_img">
                                <img src="/Public/home/images/ind2.jpg" alt="">
                            </div>
                            <div class="ind1_wz">
                                <h5>青域享惊喜，活动乐不停</h5>
                                <h3>青域积分商城</h3>
                                <span>——了解更多</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('consultant/index');?>">
                        <div class="ind1_lis">
                            <div class="ind1_img">
                                <img src="/Public/home/images/ind3.jpg" alt="">
                            </div>
                            <div class="ind1_wz">
                                <h5>青域享惊喜，活动乐不停</h5>
                                <h3>青域企业管家</h3>
                                <span>——了解更多</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('plot/index');?>">
                        <div class="ind1_lis">
                            <div class="ind1_img">
                                <img src="/Public/home/images/ind4.jpg" alt="">
                            </div>
                            <div class="ind1_wz">
                                <h5>青域享惊喜，活动乐不停</h5>
                                <h3>青域精彩案例</h3>
                                <span>——了解更多</span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
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

</body>
<script>
    $(function () {

        var bannerSwiper = new Swiper('.banner_swiper', {
            loop: true,
            autoplay: 5000,
            pagination: '.banner_page',
            paginationClickable: true,
        })

        if($('.banner_nav').outerHeight()<$(window).height()){
            $('.banner_nav').outerHeight($(window).height())
        }

        $('.banner_down').hover(function () {
            $(this).siblings('.banner_li').addClass('ban_hover')
        }, function () {
            $(this).siblings('.banner_li').removeClass('ban_hover')
        })

        $(window).scroll(function () {
            scrollT = $(window).scrollTop()
            if (scrollT > 0) {
                $('.header').addClass('scrollT')
            } else {
                $('.header').removeClass('scrollT')
            }
        })

    })
</script>

</html>