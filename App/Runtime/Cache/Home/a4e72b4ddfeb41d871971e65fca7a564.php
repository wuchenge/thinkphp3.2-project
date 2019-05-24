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

        <div class="aegisD_box">
            <div class="col-sm-8">
                <div class="aegisD_left">
                    <div class="aegisD_img">
                        <?php if(is_array($imgjihe)): $i = 0; $__LIST__ = $imgjihe;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="aegisD_lis active">
                                <img src="<?php echo ($vo); ?>" alt="">
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <a href="javascript:;" class="aegisD_arrr"><i class="fa fa-angle-right"></i></a>
                    <a href="javascript:;" class="aegisD_arrl"><i class="fa fa-angle-left"></i></a>
                    <div class="aegisD_small">
                        <ul>
                            <?php if(is_array($imgjihe)): $k = 0; $__LIST__ = $imgjihe;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li <?php if($k == 1): ?>class="active"<?php endif; ?>><a href="javascript:;"><img src="<?php echo ($vo); ?>" alt=""></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="aegisD_right">
                    <h3><?php echo ($danye["title"]); ?></h3>
                    <h4 style="color:#c5a77c;font-size: 14px"><?php echo ($danye["keywords"]); ?></h4>
                    <hr>
                    <div class="spaceD_wz">
                        <ul class="spaceD_t">
                            <li>
                                <div class="spaceD_li">
                                    <h3><?php echo ($danye["price"]); ?></h3>
                                    <p>租金（元/月）</p>
                                </div>
                            </li>
                            <li>
                                <div class="spaceD_li">
                                    <h3><?php echo ($danye["c1name"]); ?></h3>
                                    <p>装修</p>
                                </div>
                            </li>
                            <li>
                                <div class="spaceD_li">
                                    <h3><?php echo ($danye["c2name"]); ?></h3>
                                    <p>面积（平米）</p>
                                </div>
                            </li>
                            <li>
                                <div class="spaceD_li">
                                    <h3><?php echo ($danye["c3name"]); ?>个</h3>
                                    <p>工位</p>
                                </div>
                            </li>
                        </ul>
                        <ul class="spaceD_b">
                             <?php echo ($danye["description"]); ?>
                            <!-- <li>小区：青域律禾</li>
                            <li>楼层：中楼层/18层</li>
                            <li>朝向：南北</li>
                            <li>装修：精装</li>
                            <li>楼型：其他</li>
                            <li>年代：2009年</li>
                            <li>出租方式：整租</li>
                            <li>看房时间：随时看房</li>
                            <li>商圈：九堡</li> -->
                        </ul>
                    </div>
                    <hr>
                    <div class="spaced_lx">
                        <div class="spaced_wz">
                            <div class="spaced_user">
                                <div class="spaced_img">
                                    <img src="<?php echo ($config["gwimgurl"]); ?>" alt="">
                                </div>
                                <div class="spaced_txt">
                                    <h3><?php echo ($config["gwname"]); ?> <span><?php echo ($config["ygwname"]); ?></span></h3>
                                    <!-- <p>欧美金融城专属顾问</p> -->
                                </div>
                            </div>
                            <a href="javsacript:;">免费咨询 <?php echo ($config["gwtel"]); ?></a>
                        </div>
                        <div class="spaced_ewm">
                            <img src="<?php echo ($config["wximgurl"]); ?>" alt="">
                            <!-- <p>微信扫码一键拨号</p> -->
                        </div>
                    </div>
                    <div class="aegisD_txt">
                        <p><img src="/Public/home/images/zs.png">商家详情页（含主图）以图片或文字形式标注的一口价、促销价、优惠价等价格。</p>
                        <p><img src="/Public/home/images/zs.png">商家详情页（含主图）以图片或文字形式标注的一口价、促销价、优惠价等价格。</p>
                        <p><img src="/Public/home/images/zs.png">商家详情页（含主图）以图片或文字形式标注的一口价、促销价、优惠价等价格。</p>
                    </div>
                    <div class="aegisD_follow">
                        <ul>
                           <li><div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more" style="margin: 0"><img src="/Public/home/images/share.svg">分享链接</a></div>
                        <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
                        </script>
                                <!-- <a href="#"><img src="/Public/home/images/share.svg" alt="">分享</a> -->
                            </li>
                            <li>
                                <?php if($danye['is_coll'] == 1): ?><img style="cursor:pointer;"  data-id=1 onclick="bucoll(this,<?php echo ($danye["id"]); ?>)" src="/Public/home/images/collect.svg" alt="">
                                <?php else: ?>
                                    <img style="cursor:pointer;"  data-id=1 onclick="docoll(this,<?php echo ($danye["id"]); ?>)" src="/Public/home/images/collect.svg"><?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="aegisD_box1" style="background-image: url(/Public/home/images/aegisDot_bg.jpg)">
            <div class="container">
                <div class="aegisD1_cot">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>产品参数：</h3>
                            <div class="spaced1_cot">
                                <ul>
                                    <?php echo ($danye["description2"]); ?>
<!--                                     <li><span>可注册</span>否</li>
                                    <li><span>带窗</span>否</li>
                                    <li><span>免租时间</span>面议</li>
                                    <li><span>面积信息</span>面积30㎡</li>
                                    <li><span>价格优势</span>位于大厦地区（共31层）</li>
                                    <li><span>可注册</span>否</li>
                                    <li><span>带窗</span>否</li>
                                    <li><span>免租时间</span>面议</li>
                                    <li><span>面积信息</span>面积30㎡</li>
                                    <li><span>价格优势</span>位于大厦地区（共31层）</li>
                                    <li><span>可注册</span>否</li>
                                    <li><span>带窗</span>否</li>
                                    <li><span>免租时间</span>面议</li>
                                    <li><span>面积信息</span>面积30㎡</li>
                                    <li><span>价格优势</span>位于大厦地区（共31层）</li>
                                    <li><span>可注册</span>否</li>
                                    <li><span>带窗</span>否</li>
                                    <li><span>免租时间</span>面议</li>
                                    <li><span>面积信息</span>面积30㎡</li>
                                    <li><span>价格优势</span>位于大厦地区（共31层）</li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h3>产品参数：</h3>
                            <div class="spaced1_lis">
                                <h5>基础服务：</h5>
                                <ul>
                                     <?php echo ($danye["description3"]); ?>
                                    <!-- <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li> -->
                                </ul>
                            </div>
        <!--                     <div class="spaced1_lis">
                                <h5>基础服务：</h5>
                                <ul>
                                     <?php echo ($danye["description3"]); ?>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                    <li>
                                        <div class="spaced1_li">
                                            <img src="/Public/home/images/login.svg" alt="">前台接见
                                        </div>
                                    </li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="aegisD_box2" style="background-image: url(/Public/home/images/aegisDot2_bg.jpg)">
            <div class="container1">
                <div class="aegisD2_cot">
                    <ul>
                        <li class="active" style="width: 100%;"><a href="javascript:;">产品详情</a></li>
                    </ul>
                    <div class="aegisD2_wz">
                        <?php echo (htmlspecialchars_decode($danye["text"])); ?>
                        <!-- <img src="/Public/home/images/aegis_xq.jpg" alt=""> -->
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
<script type="text/javascript">
//收藏
function docoll(o,gid){
    var url = "<?php echo U('Collect/docoll2');?>";
    if ($(o).attr('data-id') != 1) {
        return false;
    }
    $(o).attr('data-id', 0);
    $.post(url, {gid: gid}, function (data) {
        if (data.status == 1) {
            alert(data.msg);
            location.reload();
        }else{
            $(o).attr('data-id', 1);
            alert(data.msg);
        }
    });
}

//取消收藏
function bucoll(o,gid) {
    if (confirm("确定取消收藏？")) {
        var url = "<?php echo U('Collect/bucoll2');?>";
        if ($(o).attr('data-id') != 1) {
            return false;
        }
        $(o).attr('data-id', 0);
        $.post(url, {gid: gid}, function (data) {
            if (data.status == 1) {
                alert(data.msg);
                location.reload();
            } else {
                $(o).attr('data-id', 1);
                alert(data.msg);
            }
        });
    } else {
        return false;
    }
}
</script>
<script>
    $(function () {

        $('.aegisD2_cot li').click(function () {
            if ($(this).index() == 0) {
                $('html,body').animate({
                    'scrollTop': $('.aegisD2_cot').offset().top - 80
                })
            } else {
                $('html,body').animate({
                    'scrollTop': $('.aegisD3_cot').offset().top - 80
                })
            }
        })

        if ($(window).width() > 768) {
            $('html,body').animate({
                'scrollTop': 0
            }, 100)

            if ($('.aegisD_right').outerHeight() < $(window).height() - $('.header').height()) {
                $('.aegisD_left,.aegisD_right').outerHeight($(window).height() - $('.header').height())
            } else {
                $('.aegisD_left').outerHeight($('.aegisD_right').outerHeight())
            }

            $('.aegisD_img').click(function () {
                if ($(this).hasClass('bigg')) {
                    $('html').css('overflow-y', 'auto')
                    $(this).removeClass('bigg')
                    $('.aegisD_right').removeClass('move')
                } else {
                    $('html,body').animate({
                        'scrollTop': 0
                    }, 100)
                    $('html').css('overflow-y', 'hidden')
                    $(this).addClass('bigg')
                    $('.aegisD_right').addClass('move')
                }
            })
        } else {
            $('.aegisD_left').height($(window).height() * 0.5)
        }

        function aegisd_right() {
            aegis_ind = $('.aegisD_lis.active').index()
            if (aegis_ind < $('.aegisD_lis').length - 1) {
                aegis_ind++
            } else {
                aegis_ind = 0
            }
            $('.aegisD_small li').eq(aegis_ind).addClass('active').siblings().removeClass('active')
            $('.aegisD_lis').eq(aegis_ind).addClass('active').siblings().removeClass('active')
        }

        function aegisd_left() {
            aegis_ind = $('.aegisD_lis.active').index()
            if (aegis_ind > 0) {
                aegis_ind--
            } else {
                aegis_ind = $('.aegisD_lis').length - 1
            }
            $('.aegisD_small li').eq(aegis_ind).addClass('active').siblings().removeClass('active')
            $('.aegisD_lis').eq(aegis_ind).addClass('active').siblings().removeClass('active')
        }

        $('.aegisD_arrr').click(function () {
            aegisd_right()
        })

        $('.aegisD_arrl').click(function () {
            aegisd_left()
        })

        $('.aegisD_small li').click(function () {
            aegis_ind = $(this).index()
            $('.aegisD_small li').eq(aegis_ind).addClass('active').siblings().removeClass('active')
            $('.aegisD_lis').eq(aegis_ind).addClass('active').siblings().removeClass('active')
        })

        $(window).resize(function () {
            if ($('.aegisD_right').outerHeight() < $(window).height() - $('.header').height()) {
                $('.aegisD_left,.aegisD_right').outerHeight($(window).height() - $('.header').height())
            } else {
                $('.aegisD_left').outerHeight($('.aegisD_right').outerHeight())
            }

            if ($(window).width() > 768) {
                $('html,body').animate({
                    'scrollTop': 0
                }, 100)

                if ($('.aegisD_right').outerHeight() < $(window).height() - $('.header').height()) {
                    $('.aegisD_left,.aegisD_right').outerHeight($(window).height() - $('.header').height())
                } else {
                    $('.aegisD_left').outerHeight($('.aegisD_right').outerHeight())
                }

                $('.aegisD_img').click(function () {
                    if ($(this).hasClass('bigg')) {
                        $('html').css('overflow-y', 'auto')
                        $(this).removeClass('bigg')
                        $('.aegisD_right').removeClass('move')
                    } else {
                        $('html,body').animate({
                            'scrollTop': 0
                        }, 100)
                        $('html').css('overflow-y', 'hidden')
                        $(this).addClass('bigg')
                        $('.aegisD_right').addClass('move')
                    }
                })
            } else {
                $('.aegisD_left').height($(window).height() * 0.5)
            }
        })

    })
</script>

</html>