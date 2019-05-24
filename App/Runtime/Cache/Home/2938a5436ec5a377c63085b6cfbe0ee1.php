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
            <img src="/Public/home/images/about.jpg" alt="">
            <div class="mainB_wz">
                <h3>关于我们</h3>
                <h5>about us</h5>
            </div>
        </div>

        <div class="about" style="background-image: url(/Public/home/images/about_bg.jpg)">
            <div class="ab_box1">
                <div class="container">
                    <div class="ab1_cot">
                        <div class="ab1_left">
                            <div class="ab_tit">
                                <h5>company profile</h5>
                                <h3>公司概况</h3>
                            </div>
                            <div class="ab1_wz">
                                <p>杭州青域律禾创业服务有限公司是专注于专业服务(咨询/财会/法律/翻译等)行业的公司，并通过国家工商管理局注册成立的专业化的公司，成立于2017年06月30日，注册资本100万人民币元。公司坐落于浙江省杭州市余杭区仓前街道龙潭路7号杭州未来研创园A座6楼601-1室，杭州青域律禾创业服务有限公司以规范、专业、创新、共赢的经营理念，高效贴心的服务，团结协作、敬业负责、服务奉献、求实进取的企业精神，始终贯彻以追求合作伙伴最大利益为目标，竭诚为合作伙伴提供最大程度的保障。我们将立志打造最精良的优秀团队，并为合作伙伴提供最优秀、最科学、最专业的服务，以获得合作者的信任和支持，打造属于我们自己的品牌。</p>
                            </div>
                        </div>
                        <div class="ab1_right">
                            <div class="ab1_img" style="background-image: url(/Public/home/images/about1.jpg)"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ab_box2">
                <div class="ab_tit tit_center">
                    <h3>公司荣誉</h3>
                    <h5>glories of company</h5>
                </div>
                <div class="ab2_cot">
                    <div class="swiper-container ab2_swiper">
                        <a href="javascript:;" class="ab2_arrl"><i class="fa fa-angle-left"></i></a>
                        <a href="javascript:;" class="ab2_arrr"><i class="fa fa-angle-right"></i></a>
                        <div class="swiper-wrapper">

                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
                                <a href="/Public/home/images/about2_1_1.jpg" rel="lightbox-myGroup">
                                    <div class="ab2_lis">
                                        <div class="ab2_img">
                                            <img src="/Public/home/images/about2_1.jpg" alt="">
                                            <img src="<?php echo ($vo["imgurl"]); ?>" alt="">
                                        </div>
                                        <div class="ab2_wz">
                                            <h5><i class="fa fa-angle-right"></i> <?php echo ($vo["title"]); ?></h5>
                                        </div>
                                    </div>
                                </a>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            <div class="swiper-slide">
                                <a href="/Public/home/images/about2_1_1.jpg" rel="lightbox-myGroup">
                                    <div class="ab2_lis">
                                        <div class="ab2_img">
                                            <img src="/Public/home/images/about2_1.jpg" alt="">
                                            <img src="/Public/home/images/about2_1_1.jpg" alt="">
                                        </div>
                                        <div class="ab2_wz">
                                            <h5><i class="fa fa-angle-right"></i> 高新技术企业</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ab_box3">
                <div class="container">
                    <div class="ab_tit tit_center">
                        <h3>公司文化</h3>
                        <h5>company culture</h5>
                    </div>
                    <div class="ab3_cot">
                        <div class="ab3_lis ab3_lis1">
                            <div class="ab31_cot">
                                <div class="ab31_img" style="background-image: url(/Public/home/images/about3_1.jpg)"></div>
                            </div>
                        </div>
                        <div class="ab3_lis ab3_lis2">
                            <div class="ab32_cot">
                                <div class="ab32_left">
                                    <div class="ab32_img" style="background-image: url(/Public/home/images/about3_2.jpg)"></div>
                                </div>
                                <div class="ab32_right">
                                    <div class="ab3_wz">
                                        <h3>团结，友爱<br>自强，不惜</h3>
                                        <p>企业文化，或称组织文化（Corporate Culture或Organizational
                                            Culture），是一个组织由其价值观、信念、仪式、符号、处事方式等组成的其特有的文化形象，简单而言，就是企业在日常运行中所表现出的各方各面。企业文化，或称组织文化（Corporate
                                            Culture或Organizational Culture），是一个组织由其价值观、信念、仪式、符号、处事方式等组成的其特有的文化形象，简单而言，就是企业在日常运行中所表现出的各方各面。</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ab3_lis ab3_lis3">
                            <div class="ab33_cot">
                                <div class="ab33_left">
                                    <div class="ab3_wz">
                                        <h3>团结，友爱</h3>
                                        <p>企业文化，或称组织文化（Corporate Culture或Organizational
                                            Culture），是一个组织由其价值观、信念、仪式、符号、处事方式等组成的其特有的文化形象，简单而言，就是企业在日常运行中所表现出的各方各面。企业文化，或称组织文化（Corporate
                                            Culture或Organizational Culture），是一个组织由其价值观、信念、仪式、符号、处事方式等组成的其特有的文化形象，简单而言，就是企业在日常运行中所表现出的各方各面。</p>
                                    </div>
                                </div>
                                <div class="ab33_right">
                                    <div class="ab33_img" style="background-image: url(/Public/home/images/about3_3.jpg)"></div>
                                </div>
                            </div>
                        </div>
                        <div class="ab3_lis ab3_lis4">
                            <div class="ab34_cot">
                                <div class="ab34_img" style="background-image: url(/Public/home/images/about3_4.jpg)"></div>
                                <div class="ab3_wz ab34_wz">
                                    <p>企业文化，或称组织文化（Corporate Culture或Organizational
                                        Culture），是一个组织由其价值观、信念、仪式、符号、处事方式等组成的其特有的文化形象，简单而言，就是企业在日常运行中所表现出的各方各面。企业文化，或称组织文化（Corporate
                                        Culture或Organizational
                                        Culture），是一个组织由其价值观、信念、仪式、符号、处事方式等组成的其特有的文化形象，简单而言，就是企业在日常运行中所表现出的各方各面。企业文化，或称组织文化（Corporate
                                        Culture或Organizational
                                        Culture），是一个组织由其价值观、信念、仪式、符号、处事方式等组成的其特有的文化形象，简单而言，就是企业在日常运行中所表现出的各方各面。企业文化，或称组织文化（Corporate
                                        Culture或Organizational Culture），是一个组织由其价值观、信念、仪式、符号、处事方式等组成的其特有的文化形象，简单而言，就是企业在日常运行中所表现出的各方各面。</p>
                                </div>
                            </div>
                        </div>
                    </div>
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

</body>
<link rel="stylesheet" type="text/css" href="/Public/home/js/lightbox/css/lightbox.css">
<script src="/Public/home/js/lightbox/js/lightbox.js"></script>
<script>
    $(function () {

        lightbox.option({
            'disableScrolling': true,
            'wrapAround': true
        })
        
        if($(window).width()>1440){
            slidesPerView=5
        }else if($(window).width()>768 && $(window).width()<=1440){
            slidesPerView=4
        }else{
            slidesPerView=1
        }

        var mySwiper = new Swiper('.ab2_swiper', {
            prevButton: '.ab2_arrl',
            nextButton: '.ab2_arrr',
            slidesPerView: slidesPerView,
            loop: true,
            autoplay: 5000
        })

    })
</script>

</html>