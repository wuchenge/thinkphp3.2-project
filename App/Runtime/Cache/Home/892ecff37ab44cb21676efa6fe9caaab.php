<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=XrYFzXOOW5Gpulp5m8P4xBI6fbWdOrnO"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
            <img src="/Public/home/images/contact.jpg" alt="">
            <div class="mainB_wz">
                <h3>联系我们</h3>
                <h5>contact us</h5>
            </div>
        </div>

        <div class="contact_box1" style="background-image: url(/Public/home/images/contact1_bg.jpg)">
            <div class="container">
                <div class="main_tit tit_center">
                    <h3>公司地址</h3>
                </div>
                <div class="contact1_cot">
                    <div class="contact1_left">
                        <div class="contact1_wz">
                            <h3>我们期待与您相遇</h3>
                            <h5>we look forward to meeting you</h5>
                            <p><img src="/Public/home/images/phone.png" alt=""> <span>电话：0571-87980690</span></p>
                            <p><img src="/Public/home/images/email.png" alt=""> <span>邮箱：123456789@qq.com</span></p>
                            <p><img src="/Public/home/images/address.png" alt=""> <span>地址：浙江省杭州市余杭区仓前街道龙潭路7号杭州未来研创园A座6楼601-1</span></p>
                            <p><img src="/Public/home/images/weixin.png" alt=""> <span>微信：Snails_qylh <img src="/Public/home/images/ewm.png" alt=""></span></p>
                        </div>
                    </div>
                    <div class="contact1_right">
                        <div class="contact1_map">
                            <div style="width:100%;height:450px;" id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact_box2" style="background-image: url(/Public/home/images/contact2_bg.jpg)">
            <div class="container">
                <div class="contact2_cot">
                    <div class="contact2_tit">
                        <h3>留言板</h3>
                        <img src="/Public/home/images/tit.png" alt="">
                    </div>

                    <form method="post" id="form_user1" onsubmit="return false;" id="feedback">
                    <div class="contact2_wz">
                        <ul>
                            <li>
                                <div class="contact2_lis">
                                    <span>姓名：</span>
                                    <input type="text" name="name">
                                </div>
                            </li>
                            <li>
                                <div class="contact2_lis">
                                    <span>公司：</span>
                                    <input type="text" name="company">
                                </div>
                            </li>
                            <li>
                                <div class="contact2_lis">
                                    <span>电话：</span>
                                    <input type="text" name="tel">
                                </div>
                            </li>
                            <li>
                                <div class="contact2_lis">
                                    <span>地址：</span>
                                    <input type="text" name="address">
                                </div>
                            </li>
                            <li>
                                <div class="contact2_lis">
                                    <span>邮箱：</span>
                                    <input type="text" name="email">
                                </div>
                            </li>
                            <li>
                                <div class="contact2_lis">
                                    <span>合作意向：</span>
                                    <input type="text" name="yixiang">
                                </div>
                            </li>
                            <li>
                                <div class="contact2_lis">
                                    <span>留言：</span>
                                    <textarea name="text"></textarea>
                                </div>
                            </li>
                        </ul>
                        <div class="contact2_bott">
                            <p>*所有信息均会为您严格保密。不会向第三方进行提供</p>
                            <div class="contact2_btn">
                                <input type="button" value="提交信息" onclick="xiu();return false;" id="tijiao" style="cursor: pointer;"  data-id="1">
                            </div>
                        </div>
                    </div>
                </form>

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
<script src="/Public/home/js/jquery-1.8.3.min.js"></script>
<script src="/Public/home/js/jquery.SuperSlide.2.1.1.js"></script>
<script src="/Public/lib/layer/2.1/layer.js" type="text/javascript"></script>
</body>
<script type="text/javascript">
        function xiu(){
            if($('#tijiao').attr('data-id')!=1){
                return false;
            }
            $('#tijiao').val('提交中..');
            $('#tijiao').attr('data-id',0);
            var url = "<?php echo U('contact/ti');?>";
            var index = layer.load(2);
            $.post(url,$('#form_user1').serialize(),function(data){
                layer.close(index);
                $('#tijiao').val('提交');
                $('#tijiao').attr('data-id',1);
                if(data.stu == 1){
                    layer.msg(data.msg,{icon:6,time:2000},function(){
                    location.href="<?php echo U('contact/index');?>";
                    })
                }else{
                    layer.alert(data.msg,{icon:5,time:2000});
                }
            });
            return false;
        }
</script>
<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap() {
        createMap(); //创建地图
        setMapEvent(); //设置地图事件
        addMapControl(); //向地图添加控件
        addMapOverlay(); //向地图添加覆盖物
    }

    function createMap() {
        map = new BMap.Map("map");
        map.centerAndZoom(new BMap.Point(119.994097, 30.282338), 17);
    }

    function setMapEvent() {
        map.enableScrollWheelZoom();
        map.enableKeyboard();
        map.enableDragging();
        map.enableDoubleClickZoom()
    }

    function addClickHandler(target, window) {
        target.addEventListener("click", function () {
            target.openInfoWindow(window);
        });
    }

    function addMapOverlay() {
        var markers = [{
            content: "浙江省杭州市余杭区仓前街道龙潭路7号杭州未来研创园A座6楼601-1",
            title: "杭州青域律禾创业服务有限公司",
            imageOffset: {
                width: -69,
                height: -21
            },
            position: {
                lat: 30.282276,
                lng: 119.993415
            }
        }];
        for (var index = 0; index < markers.length; index++) {
            var point = new BMap.Point(markers[index].position.lng, markers[index].position.lat);
            var marker = new BMap.Marker(point, {
                icon: new BMap.Icon("http://api.map.baidu.com/lbsapi/createmap//Public/home/images/icon.png", new BMap.Size(20, 25), {
                    imageOffset: new BMap.Size(markers[index].imageOffset.width, markers[index].imageOffset.height)
                })
            });
            var label = new BMap.Label(markers[index].title, {
                offset: new BMap.Size(25, 5)
            });
            var opts = {
                width: 200,
                title: markers[index].title,
                enableMessage: false
            };
            var infoWindow = new BMap.InfoWindow(markers[index].content, opts);
            marker.setLabel(label);
            addClickHandler(marker, infoWindow);
            map.addOverlay(marker);
        };
    }
    //向地图添加控件
    function addMapControl() {
        var scaleControl = new BMap.ScaleControl({
            anchor: BMAP_ANCHOR_BOTTOM_LEFT
        });
        scaleControl.setUnit(BMAP_UNIT_IMPERIAL);
        map.addControl(scaleControl);
        var navControl = new BMap.NavigationControl({
            anchor: BMAP_ANCHOR_TOP_LEFT,
            type: BMAP_NAVIGATION_CONTROL_LARGE
        });
        map.addControl(navControl);
        var overviewControl = new BMap.OverviewMapControl({
            anchor: BMAP_ANCHOR_BOTTOM_RIGHT,
            isOpen: true
        });
        map.addControl(overviewControl);
    }
    var map;
    initMap();
</script>
<script>
    $(function () {



    })
</script>

</html>