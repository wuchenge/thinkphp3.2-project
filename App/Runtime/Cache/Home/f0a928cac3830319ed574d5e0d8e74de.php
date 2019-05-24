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
<style>
    @media(max-width:768px){
      .user_tit th:nth-child(2), .user_lis td:nth-child(2){
        display: none;
      }
    }
  </style>
  <div class="wrapper wrapper_marg">
    <div class="user_box" style="background-image: url(/Public/home/images/user_bg.jpg)">
      <div class="container1">
        <div class="user_cot">


         <div class="user_left">
    <div class="userL_top">
        <div class="userL_setting">
            <a href="<?php echo U('userinfo/index');?>"><img src="/Public/home/images/setting.png" alt=""></a>
        </div>
        <div class="userL_qd">
            <a href="javscript:;">签到</a>
        </div>
        <div class="userL_info">
            <a href="<?php echo U('userinfo/index');?>">
                  <div class="<?php echo U('userinfo/index');?>">
                    <img src="<?php echo ($user["pic"]); ?>" alt="" style="width: 78px;height: auto;">
                    <div class="user_ico">
                      <img src="/Public/home/images/level1.png" alt="">
                    </div>
                  </div>
                  <h3><?php echo ($user["uname"]); ?> <img src="/Public/home/images/girl.png" alt=""></h3>
                </a>
        </div>
        <div class="userT_wz">
            <p>上次登录： <?php echo (date("Y-m-d H:i",$user["lastlogin"])); ?></p>
            <p>会员积分：<span><?php echo ($user["integral"]); ?></span></p>
        </div>
        <div class="userT_bott">
            <ul>
                <?php if(empty($user['card'])): ?><li style="width: 44.33%;">
                        <a href="<?php echo U('userinfo/index');?>">
                      <img src="/Public/home/images/user_card.svg" alt="">
                      <p>未认证</p>
                    </a>
                    </li>
                    <?php else: ?>
                    <li class="active" style="width: 44.33%;">
                        <a href="javascript:;">
                      <img src="/Public/home/images/user_card1.svg" alt="">
                      <p>已认证</p>
                    </a>
                    </li><?php endif; ?>
                <!--                   <li>
                    <a href="#">
                      <img src="/Public/home/images/user_phone.svg" alt="">
                      <p>未认证</p>
                    </a>
                  </li> -->
                <li class="active" style="width: 44.33%;">
                    <a href="javascript:;">
                      <img src="/Public/home/images/user_phone1.svg" alt="">
                      <p>已认证</p>
                    </a>
                </li>
                <!--                   <li>
                    <a href="#">
                      <img src="/Public/home/images/user_email.svg" alt="">
                      <p>未认证</p>
                    </a>
                  </li> -->
                <!-- <li class="active">
                    <a href="javascript:;">
                      <img src="/Public/home/images/user_email1.svg" alt="">
                      <p>已认证</p>
                    </a>
                  </li> -->
            </ul>
        </div>
    </div>
    <div class="userL_cot">
        <div class="userL_tit">
            <h3><img src="/Public/home/images/login.svg" alt=""> 个人中心</h3>
            <a href="<?php echo U('order/mglist');?>"><img src="/Public/home/images/uesr_mail.png" alt=""></a>
            <div class="user_phone"><span><i></i></span>
            </div>
        </div>
        <div class="userLC_cot">
            <div class="userLC_lis">
                <h3>订单中心</h3>
                <ul>
                    <li><a href="<?php echo U('order/index');?>">我的订单</a></li>
                </ul>
            </div>
            <div class="userLC_lis">
                <h3>购物车</h3>
                <ul>
                    <li><a href="<?php echo U('user/cart');?>">我的购物车</a></li>
                </ul>
            </div>
            <div class="userLC_lis">
                <h3>收货地址</h3>
                <ul>
                    <li><a href="<?php echo U('address/index');?>">常用地址</a></li>
                </ul>
            </div>
            <!--                 <div class="userLC_lis">
                  <h3>优惠券</h3>
                  <ul>
                    <li><a href="<?php echo U('coupon/index');?>">我的优惠券</a></li>
                  </ul>
                </div> -->
            <div class="userLC_lis">
                <h3>收藏产品</h3>
                <ul>
                    <li><a href="<?php echo U('collect/space');?>">办公空间收藏</a></li>
                    <li><a href="<?php echo U('collect/product');?>">商品收藏</a></li>
                </ul>
            </div>
            <div class="userLC_lis">
                <h3>评价中心</h3>
                <ul>
                    <li><a href="<?php echo U('order/evaluate');?>">我的评价</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

          <div class="user_right">
            <div class="user_nav">
              <ul>
                <li <?php if(empty($st)): ?>class="active"<?php endif; ?>><a href="<?php echo U('/order/index');?>">所有订单</a></li>
                <li <?php if($st == 1): ?>class="active"<?php endif; ?>><a href="<?php echo U('/order/index?st=1');?>">待支付</a></li>
                <li <?php if($st == 2): ?>class="active"<?php endif; ?>><a href="<?php echo U('/order/index?st=2');?>">待发货</a></li>
                <li <?php if($st == 3): ?>class="active"<?php endif; ?>><a href="<?php echo U('/order/index?st=3');?>">待收货</a></li>
                <li <?php if($st == 4): ?>class="active"<?php endif; ?>><a href="<?php echo U('/order/index?st=4');?>">待评价</a></li>
                <li <?php if($st == 5): ?>class="active"<?php endif; ?>><a href="<?php echo U('/order/index?st=5');?>">已完成</a></li>
                <!-- <li <?php if($st == complited): ?>class="active"<?php endif; ?>>
                  <a href="<?php echo U('/order/index?st=complited');?>">已关闭</a>
                </li> -->
              </ul>
            </div>
            <div class="user_search">
              <div class="user_sear">
                <input type="text" name="key" placeholder="输入商品名称或订单号搜索">
                <input type="button" value="搜索">
              </div>
              <div class="user_sele">
                <span>订单状态：</span>
                <select name="type" id="pid" onchange="gradeChange()">
                  <option value="0">全部</option>
                  <option value="1">待支付</option>
                  <option value="2">待发货</option>
                  <option value="3">待收货</option>
                  <option value="4">待评价</option>
                  <option value="5">已完成</option>
                </select>
              </div>
            </div>
            <div class="user_cot">
              <div class="user_tit">
                <table>
                  <tr>
                    <th>
                      <label>
                       <!--  <input type="checkbox"> -->
                        <!-- <i></i> -->
                        <span></span>
                       <!--  <span>全选</span> -->
                      </label>
                    </th>
                    <th>数量</th>
                    <th>金额</th>
                    <th>状态</th>
                    <th>操作</th>
                  </tr>
                </table>
              </div>

              <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="user_lis">
                <table>
                  <thead>
                    <tr>
                      <th colspan="5">
                        <label>
                          <div class="user_input">
                            <!-- <input type="checkbox"> -->
                           <!--  <i></i> -->
                          </div>
                          <span><img src="/Public/home/images/sp.png" alt=""><?php echo ($vo["res"]["0"]["gname"]); ?></span>
                          <span>订单号：<?php echo ($vo["orderid"]); ?></span>
                          <span><?php echo (date("Y年m月d日",$vo["addtime"])); ?></span>
                        </label>
                        <!-- <a href="javascript:;" class="order_delet">
                          <img src="/Public/home/images/delect.png" alt="">
                        </a> -->
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(is_array($vo["res"])): $k = 0; $__LIST__ = $vo["res"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($k % 2 );++$k;?><tr>
                      <td>
                        <div class="user_info">
                          <?php if($v2['gtype'] == 2): ?><a href="<?php echo U('jifen/info',array('id'=>$v2['gid']));?>">
                          <?php else: ?>
                               <a href="<?php echo U('aegis/info',array('id'=>$v2['gid']));?>"><?php endif; ?>
                            <div class="user_img">
                              <img src="<?php echo ($v2["gurl"]); ?>" alt="">
                            </div>
                            <div class="user_wz">
                              <h3><?php echo ($v2["gname"]); ?></h3>
                              <p><?php echo ($v2["ggname"]); ?></p>
                              <!-- <p>红色特香</p> -->
                            </div>
                          </a>
                        </div>
                      </td>
                      <td><?php echo ($v2["amount"]); ?></td>
                      <?php if($k == 1): ?><td rowspan="<?php echo ($vo["geshu"]); ?>">
                        <div class="user_price">
                          <h5>￥<?php echo ($vo["totalprice"]); ?></h5>
                          <p>（含运费：￥<?php echo ($vo["yunfei"]); ?>）</p>
                        </div>
                      </td>
                      <td rowspan="<?php echo ($vo["geshu"]); ?>">
                        <p><?php echo ($vo["zt"]); ?></p>
                        <a href="<?php echo U('order/info',array('id'=>$vo['id']));?>">查看详情</a>
                      </td>
                      <td rowspan="<?php echo ($vo["geshu"]); ?>">
                        <?php if($vo['status'] == 1): if($vo['ordertype'] == 2): ?><a href="<?php echo U('jifen/order',array('id'=>$vo['id']));?>" class="order_dzf">待兑换
                             </a>
                          <?php else: ?>
                               <?php if($is_pc == 2): ?><a href="<?php echo U('order/payment2',array('id'=>$vo['id']));?>" class="order_dzf">待支付</a>
                               <?php else: ?>
                                   <a href="<?php echo U('order/mpayment2',array('id'=>$vo['id']));?>" class="order_dzf">待支付</a><?php endif; endif; ?>
                          <a onClick="order_del(this,'<?php echo ($vo["id"]); ?>')" href="javascript:; class="order_qx">取消订单</a>
                        <?php elseif($vo['status'] == 2): ?>
                            <a  class="order_dzf">等待发货</a>
                        <?php elseif($vo['status'] == 3): ?>
                            <a onclick="return confirmbill(<?php echo ($vo["id"]); ?>)" class="order_dzf">确认收货</a>
                        <?php elseif($vo['status'] == 4): ?>
                            <a href="<?php echo U('order/judge',array('id'=>$vo['id']));?>" class="order_dzf">评价</a>
                        <?php elseif($vo['status'] == 5): ?>
                            <a  class="order_dzf">已评价</a>
                        <?php else: ?>
                            <a  class="order_dzf">已取消</a><?php endif; ?>
                      </td><?php endif; ?>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                  </tbody>
                </table>
              </div><?php endforeach; endif; else: echo "" ;endif; ?>

              <div class="user_bott">
                <label>
                  <!-- <input type="checkbox">
                  <i></i> -->
                  <span></span>
                  <a></a>
                  <!-- <span>全选</span>
                  <a href="javascript:;">删除</a> -->
                </label>
              </div>
              <div class="aegis_page">
                <ul>
                  <?php echo ($page); ?>
                </ul>
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
    <div class="body_bg"></div>
    <div class="qd_fixed">
        <h3>每日赠送<span>1</span>积分，连续7天再送<span>5</span>积分</h3>
        <div class="qd_btn">
            <a href="javascript:;"  onclick="return qian()">立即签到</a>
        </div>
        <div class="qd_cot">
            <ul>
                <li>
                    <?php if($sign['sign_count'] >= 1): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第1天</p>
                        <div class="qd_num">
                            <span>+1</span>
                        </div>
                    </div>
                </li>
                <li>
                    <?php if($sign['sign_count'] >= 2): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第2天</p>
                        <div class="qd_num qd_num1">
                            <span>+1</span>
                        </div>
                    </div>
                </li>
                <li>
                    <?php if($sign['sign_count'] >= 3): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第3天</p>
                        <div class="qd_num qd_num1">
                            <span>+1</span>
                        </div>
                    </div>
                </li>
                <li>
                    <?php if($sign['sign_count'] >= 4): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第4天</p>
                        <div class="qd_num qd_num1">
                            <span>+1</span>
                        </div>
                    </div>
                </li>
                <li>
                    <?php if($sign['sign_count'] >= 5): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第5天</p>
                        <div class="qd_num qd_num1">
                            <span>+1</span>
                        </div>
                    </div>
                </li>
                <li>
                    <?php if($sign['sign_count'] >= 6): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第6天</p>
                        <div class="qd_num qd_num1">
                            <span>+1</span>
                        </div>
                    </div>
                </li>
                <li>
                    <?php if($sign['sign_count'] >= 7): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第7天</p>
                        <div class="qd_num qd_num1">
                            <span>+1</span>
                        </div>
                    </div>
                </li>
                <!-- <li>
                    <?php if($sign['sign_count'] >= 8): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第8天</p>
                        <div class="qd_num qd_num1">
                            <span>+1</span>
                        </div>
                    </div>
                </li>
                <li>
                    <?php if($sign['sign_count'] >= 9): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第9天</p>
                        <div class="qd_num qd_num1">
                            <span>+1</span>
                        </div>
                    </div>
                </li>
                <li>
                    <?php if($sign['sign_count'] >= 10): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第10天</p>
                        <div class="qd_num qd_num1">
                            <span>+1</span>
                        </div>
                    </div>
                </li>
                <li>
                    <?php if($sign['sign_count'] >= 11): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第11天</p>
                        <div class="qd_num qd_num1">
                            <span>+1</span>
                        </div>
                    </div>
                </li>
                <li>
                    <?php if($sign['sign_count'] >= 12): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第12天</p>
                        <div class="qd_num qd_num1">
                            <span>+1</span>
                        </div>
                    </div>
                </li>
                <li>
                    <?php if($sign['sign_count'] >= 13): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第13天</p>
                        <div class="qd_num qd_num1">
                            <span>+1</span>
                        </div>
                    </div>
                </li>
                <li>
                    <?php if($sign['sign_count'] >= 14): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第14天</p>
                        <div class="qd_num qd_num1">
                            <span>+1</span>
                        </div>
                    </div>
                </li>
                <li>
                   <?php if($sign['sign_count'] >= 15): ?><div class="qd_lis active">
                    <?php else: ?>
                         <div class="qd_lis"><?php endif; ?>
                        <p>第15天</p>
                        <div class="qd_num qd_num1">
                            <span>+1</span>
                        </div>
                    </div>
                </li> -->
            </ul>
        </div>
    </div>
<script type="text/javascript">
    //签到功能
    function qian(){
        var url = "<?php echo U('Userinfo/sign');?>";
        $.post(url, function (data) {
           // console.log(data);
            if (data.status == 1) {
                alert(data.msg);
                location.reload();
            }else{
                alert(data.msg);
            }
        });
    }
</script>
</body>
<script>
  function gradeChange(){ 
        //var objS = document.getElementById("pid"); 
       var objS = $('select  option:selected').val();
        if(objS==0){
              location.href="/index.php/Order/index";
         }else{
             location.href="/index.php/Order/index/st/"+objS;
         }
       } 
  /*取消订单*/
function order_del(obj,id){
  if(confirm("确定取消该订单？")){
    var url = "<?php echo U('order/billdel');?>";
    $.post(url,{"id":id},function(data){
      if(data.status == 1){
            alert(data.msg);
            location.reload();
      }else{
        location.reload();
      }
    })
  }else{
    return false;
  }
}
  //确认收货
  function confirmbill(o){
    if(confirm("确认收货？")){
      var id=o;
      var url ="<?php echo U('order/confirmbill');?>";
      $.post(url,{id:id},function(data){
        if(data.status == 1){
          location.reload();
        }else{
          alert(data.msg);
          return false;
        }
      })
    }

  }
    //评价商品
function pingjia(o){
  if(confirm('确定评价商品？')){
    var bid=$("input[name='bid']").val();
    var gid=$(o).prev().val();
    var ggid=$(o).prev().prev().val();
    var url="<?php echo U('Order/dojudge');?>";
    $.post(url,{bid:bid,gid:gid,ggid:ggid},function(data){
      if(data.status == 1){
        location.href="/Order/judge/id/"+data.id;
      }else{
        alert(data.msg);
        return false;
      }
    })
  }else{
    return false;
  }
} 
  $(function () {

    $('.userL_qd a').click(function () {
      $('html,body').css('overflow-y', 'hidden')
      $('.qd_fixed,.body_bg').addClass('into')
    })

    $('.body_bg').click(function () {
      $('.body_bg,.qd_fixed').removeClass('into')
      $('html,body').css('overflow-y', 'auto')
    })

    $('.user_tit label input').click(function () {
      if ($(this).prop('checked') == false) {
        $('.user_input input,.user_bott label input').prop('checked', false)
      } else {
        $('.user_input input,.user_bott label input').prop('checked', true)
      }
    })


    $('.user_bott label input').click(function () {
      if ($(this).prop('checked') == false) {
        $('.user_input input,.user_tit label input').prop('checked', false)
      } else {
        $('.user_input input,.user_tit label input').prop('checked', true)
      }
    })

    $('.order_delet').click(function () {
      $(this).parents('.user_lis').remove()
    })

    $('.user_bott a').click(function () {
      for (var i = $('.user_input input').length - 1; i >= 0; i--) {
        if ($('.user_input input').eq(i).prop('checked') == true) {
          $('.user_input input').eq(i).parents('.user_lis').remove()
        }
      }
      $('.user_bott input,.user_tit label input').prop('checked', false)
    })

  })
</script>

</html>