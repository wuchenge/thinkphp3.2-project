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

		<div class="order_box">
			<div class="order_left">
				<div class="order_tit">
					<h3>确认订单信息</h3>
				</div>
				<div class="orderL_cot">
					<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="orderL_lis">
						<h3><?php echo ($vo["title"]); ?></h3>
						<div class="orderL_inner">
							<div class="orderL_img">
								<img src="<?php echo ($vo["imgurl"]); ?>" alt="">
							</div>
							<div class="orderL_wz">
								<div class="orderL_txt">
									<p>规格：<?php echo ($vo["title"]); ?></p>
									<!-- <p>编盆本色</p>
									<p>是否含花盆：带盆栽好</p> -->
								</div>
								<div class="orderL_count">
									<p>数量：<?php echo ($vo["amount"]); ?></p>
								</div>
							</div>
						</div>
					</div>
					<div class="orderL_li">
						<h3>运费</h3>
						<p><?php echo ($vo["yunfei"]); ?></p>
					</div>
					<div class="orderL_li">
						<h3>价格</h3>
						<p>￥<?php echo ($vo["price"]); ?></p>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>

<!-- 					<div class="orderL_li">
						<h3>优惠券</h3>
						<p id='yhje'>请选择<i  class="fa fa-angle-right"></i></p>
						<div class="orderL_coupon">
							<ul>
								<?php if(is_array($ucoup)): $i = 0; $__LIST__ = $ucoup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li onclick="showxt(this)" data-type=1>
										<a>满<?php echo ($vo["condition"]); ?>-￥
											<span hidden class="xianzhijine"><?php echo ($vo["condition"]); ?></span>
											<span class="youhuijine"><?php echo ($vo["money"]); ?>元</span>
											<input type="hidden" value="<?php echo ($vo["id"]); ?>" name="couponid"/>
										</a>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
								<?php if(empty($ucoup)): ?><li><a href="javascript:;">暂无优惠券</a></li><?php endif; ?>
							</ul>

						</div>
					</div> -->
					<input type="hidden" name="mid-yh" value='0'>
					<div class="orderL_li">
						<h3><b>总价</b></h3>
						<p><span id="zongjia">￥<?php echo ($order["total"]); ?></span></p>
					</div>
					  <input type="hidden" value="<?php echo ($order['total']); ?>"  name="totalprice">
					  <input type="hidden" value="<?php echo ($order['total']); ?>" name="total">
					  <input type="hidden" value="<?php echo ($addr["id"]); ?>" name="doushilei">
					  <input type="hidden" value="" name="cpid">
					  <input type="hidden" value="<?php echo ($cart); ?>" name="cart_id">
					  <input type="hidden" value="<?php echo ($amount); ?>" name="amount_list">
					  <input type="hidden" value="<?php echo ($_GET['quick']); ?>" name="is_quick">
					<?php if($_GET['quick'] == 1): ?><input type="hidden" value="<?php echo ($quick["amount"]); ?>" name="quick_amount">
					  <input type="hidden" value="<?php echo ($quick["id"]); ?>" name="quick_id">
					  <input type="hidden" value="<?php echo ($quick["norm"]); ?>" name="quick_norm">
					  <input type="hidden" value="<?php echo ($quick["val"]); ?>" name="quick_val"><?php endif; ?>
	            <?php if($is_pc == 2): ?><form id="dingque" method="post" action="<?php echo U('Order/payment');?>">
					<?php else: ?>
					    <form id="dingque" method="post" action="<?php echo U('Order/mpayment');?>"><?php endif; ?>

		                <input name="payment" type="hidden" value="1">
		                <input name="id" type="hidden" value="<?php echo ($quick["id"]); ?>">
                        <input name="adid" id="nowadd3" type="hidden" value="<?php echo ($address["0"]["id"]); ?>">
                        <input name="is_fa" id="is_fa" type="hidden" value="0">
					<div class="orderL_bott">
						<h3>给卖家留言</h3>
						<textarea placeholder="选填：填写内容已和卖家协商确认"></textarea>
					</div>
	</form>
				</div>
			</div>
			<div class="order_right">
				<div class="orderR_lis">
					<div class="order_tit">
						<h3>1.选择地址</h3>
					</div>
					<div class="orderR_wz">
						<h3>请选择正确的收货地址</h3>
					</div>
					<div class="orderR_addr">
						<ul>
							<?php if(is_array($address)): $k = 0; $__LIST__ = $address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="buhuixiejs">
									<!-- 选中的地址id -->
									<input hidden value="<?php echo ($vo["id"]); ?>" name="addr">
									<div <?php if($k == 1): ?>class="address_lis active"<?php else: ?>class="address_lis"<?php endif; ?>>
										<h3><span><?php echo ($vo["name"]); ?></span><i><?php echo ($vo["biaoqian"]); ?></i></h3>
										<p><?php echo ($vo["tel"]); ?></p>
										<p><?php echo ($vo["sheng"]); ?> <?php echo ($vo["shi"]); ?> <?php echo ($vo["xian"]); ?> <br><?php echo ($vo["address"]); ?></p>
										<div class="addr_btn">
											<a href="javascript:;" onclick="return xiu(this,<?php echo ($vo["id"]); ?>);"  class="addr_edit">编辑</a>
											<a href="javascript:;" onclick="return del(this,<?php echo ($vo["id"]); ?>);" class="addr_delet">删除</a>
										</div>
									</div>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
							<li>
								<a href="javascript:;">
									<div class="address_add">
										<img src="/Public/home/images/add.svg" alt="">
										<p>添加新地址</p>
									</div>
								</a>
							</li>
						</ul>
						<div class="orderR_btn">
							<a href="<?php echo U('address/index');?>">管理收货地址</a>
						</div>
					</div>
				</div>
				<div class="orderR_lis">
					<div class="order_tit">
						<h3>2.电子发票</h3>
					</div>
					<div class="orderR2_lis">
						<label>
							<span>不需要发票</span>
							<div class="orderR2_input">
								<input type="radio" id='bu_fa' name="fapiao" <?php if(empty($bill)): ?>checked<?php endif; ?>>
								<i></i>
							</div>
						</label>
					</div>
					<div class="orderR2_lis">
						<label>
							<span>需要电子发票 
								<?php if(empty($bill)): ?><a href="javascript:;">修改内容</a>
								<?php else: ?>
								    <a href="javascript:;" onclick="return xiubill(this,<?php echo ($bill["id"]); ?>);">修改内容</a><?php endif; ?>
							</span>
							<div class="orderR2_input">
								<input type="radio" id='qr_fa' name="fapiao" <?php if(!empty($bill)): ?>checked<?php endif; ?>>
								<i></i>
							</div>
						</label>
					</div>
				</div>
				<div class="orderR_lis">
					<div class="order_tit">
						<h3>3.购买方式</h3>
					</div>
					<div class="orderR3_lis">
						<label>
							<h3>
								<div class="orderR3_input">
									<input type="radio" name="zhifu" checked>
									<i></i>
								</div>
								<span>支付宝支付</span>
							</h3>
							<img src="/Public/home/images/zfb.png" alt="">
						</label>
					</div>
<!-- 					<div class="orderR3_lis">
						<label>
							<h3>
								<div class="orderR3_input">
									<input type="radio" name="zhifu">
									<i></i>
								</div>
								<span>微信支付</span>
							</h3>
							<img src="/Public/home/images/wxzf.png" alt="">
						</label>
					</div>
					<div class="orderR3_lis">
						<label>
							<h3>
								<div class="orderR3_input">
									<input type="radio" name="zhifu">
									<i></i>
								</div>
								<span>银联支付</span>
							</h3>
							<img src="/Public/home/images/ylzf.png" alt="">
						</label>
					</div>
					<div class="orderR3_lis">
						<label>
							<h3>
								<div class="orderR3_input">
									<input type="radio" name="zhifu">
									<i></i>
								</div>
								<span>百度钱包支付</span>
							</h3>
							<img src="/Public/home/images/bdzf.png" alt="">
						</label>
					</div> -->
				</div>
				<div class="orderR_bott">
					<div class="orderR_lis">
						<p><img src="/Public/home/images/zs.png">商家详情页（含主图）以图片或文字形式标注的一口价、促销价、优惠价等价格。</p>
						<p><img src="/Public/home/images/zs.png">商家详情页（含主图）以图片或文字形式标注的一口价、促销价、优惠价等价格。</p>
						<p><img src="/Public/home/images/zs.png">商家详情页（含主图）以图片或文字形式标注的一口价、促销价、优惠价等价格。</p>
					</div>
					<div class="orderR_lis">
						<h3><span>确认支付金额</span><i id="zongjia2">￥<?php echo ($order["total"]); ?></i></h3>
						<p id="nowadd1"><b>寄送至：</b><?php echo ($addr["sheng"]); ?> <?php echo ($addr["shi"]); ?> <?php echo ($addr["xian"]); echo ($addr["address"]); ?></p>
						<p id="nowadd2"><b>收货人：</b><?php echo ($addr["name"]); ?> <?php echo ($addr["tel"]); ?></p>
					</div>
				</div>
				<div class="orderRR_btn">
					<a onclick="return check();">确认支付</a>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	var p = $("#ho").attr('data-p');
	$("input[name=payment]").val(p);
		
	 function pay(p,o){
		$("input[name=payment]").val(p);
		$(o).attr('id','ho');
		$(o).siblings().attr('id','');
	 }
	 function check(){
		$('#dingque').submit();
	 }
</script>

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
	<div class="addr_fixed">
		<div class="addrF_tit">
			<h3><span>添加收货地址</span> <a href="javascript:;"><img src="/Public/home/images/close.svg" alt=""></a></h3>
		</div>
		<form class="form-inline">
		<div class="addrF_cot">
			<ul>
				<li><input type="text" id="name" name="name" placeholder="姓名"></li>
				<li><input type="text" id="tel"  name="tel" placeholder="手机号"></li>
				<li>
						<div data-toggle="distpicker">
							<div class="form-group">
								<label class="sr-only" for="province3">Province</label>
								<select class="form-control" name="sheng" id="province3" data-province="浙江省"></select>
							</div>
							<div class="form-group">
								<label class="sr-only" for="city3">City</label>
								<select class="form-control" name="shi" id="city3" data-city="杭州市"></select>
							</div>
							<div class="form-group">
								<label class="sr-only" for="district3">District</label>
								<select class="form-control" name="xian"  id="district3" data-district="西湖区"></select>
							</div>
						</div>
					<input hidden id="did" name="id" value="<?php echo ($addr["id"]); ?>">
				</li>
				<li><textarea id="dizhi" name="address" placeholder="详细地址"></textarea></li>
				<li><input type="text" name="youbian" id="youbian"  placeholder="邮政编码"></li>
				<li><input type="text" name="biaoqian" id="biaoqian" placeholder="地址标签"></li>
			</ul>
		</div>
		</form>
		<div class="addrF_bott">
			<a href="javascript:;" onclick="baocun();" id="addr" data-id="1" type="button" class="save">保存</a>
			<a href="javascript:;">取消</a>
		</div>
	</div>
	<div class="fapiao_fixed">
		<div class="addrF_tit">
			<h3><span>发票信息</span> <a href="javascript:;"><img src="/Public/home/images/close.svg" alt=""></a></h3>
		</div>
		<div class="addrF_cot">
			<div class="fapiao_lis">
				<h3>发票类型：</h3>
				<div class="fapiao_right">
					<div class="fapiao_btn">
						<a href="javascript:;" class="active">电子发票</a>
					</div>
					<p>电子发票与纸质发票具有相同法律效力，可作为报销、销售、维权凭证。</p>
					<p>推荐使用电子发票，不怕丢失、更发辫、更环保。</p>
				</div>
			</div>
			<div class="fapiao_lis">
				<h3>抬头类型：</h3>
				<div class="fapiao_right">
					<div class="fapiao_btn fapiao_xz">
						<?php if($bill['type'] == 2): ?><a href="javascript:;" >个人</a>
							<a href="javascript:;" class="active">单位</a>
						<?php else: ?>
						    <a href="javascript:;" class="active">个人</a>
							<a href="javascript:;">单位</a><?php endif; ?>
					</div>
				</div>
			</div>
			<form class="form-inline">
			<div class="fapiao_lis">
				<h3>发票抬头</h3>
				<div class="fapiao_right">
					<div class="fapiao_input">
						<input name="btitle" id="btitle" type="text" placeholder="请输入发票抬头">
					</div>
				</div>
			</div>
			<div class="fapiao_li">
				<div class="fapiao_lis">
					<h3>单位税号：</h3>
					<div class="fapiao_right">
						<div class="fapiao_input">
							<input name="bsuihao" id="bsuihao" type="text" placeholder="请填写购买方纳税人识别号或统一社会信用代码">
						</div>
					</div>
				</div>
			</div>
			<div class="fapiao_lis">
				<h3>收票手机：</h3>
				<div class="fapiao_right">
					<div class="fapiao_input">
						<input name="btel" id="btel" type="text" placeholder="收票人手机">
					</div>
				</div>
			</div>
			<input hidden name="oid" value="<?php echo ($_GET['id']); ?>">
			<input hidden name="billid" value="<?php echo ($bill['id']); ?>">
			<div class="fapiao_lis">
				<h3>收票邮箱：</h3>
				<div class="fapiao_right">
					<div class="fapiao_input">
						<input name="bemail" id="bemail"  type="text" placeholder="收票人邮箱">
					</div>
				</div>
			</div>
			<div class="fapiao_lis">
				<h3>收票明细：</h3>
				<div class="fapiao_right">
					<p><span>购买商品明细</span></p>
				</div>
			</div>
		
			<div class="fapiao_lis">
				<h3>发票须知：</h3>
				<div class="fapiao_right">
					<p>1.发票金额为实际支付金额，不包含优惠券、礼品卡等；</p>
					<p>2.发票金额为实际支付金额，不包含优惠券、礼品卡等；</p>
					<p>3.发票金额为实际支付金额，不包含优惠券、礼品卡等；</p>
					<p>4.发票金额为实际支付金额，不包含优惠券、礼品卡等。</p>
				</div>
			</div>
		</div>
		<div class="addrF_bott">
			<a onclick="bcbill();" id="bcbill" data-id="1" type="button" class="save">保存</a>
			<a href="javascript:;">取消</a>
		</div>
	</form>
	</div>

</body>
<script src="/Public/home/js/distpicker.data.js"></script>
<script src="/Public/home/js/distpicker.js"></script>
<script src="/Public/home/js/main.js"></script>
<script type="text/javascript">
//修改地址
function xiu(o,id){
    var url ="<?php echo U('address/xiu');?>";
    $.post(url,{"id":id},function(data){
        $("#did").attr("value",data['addr']['id']);
       $("#name").attr("value",data['addr']['name']);
       $("#tel").attr("value",data['addr']['tel']);
       $('#province3 option:selected') .text(data['addr']['sheng']);//选中的值
       $('#city3 option:selected') .text(data['addr']['shi']);//选中的值
       $('#district3 option:selected') .text(data['addr']['xian']);//选中的值
       document.getElementById("dizhi").innerHTML =data['addr']['address'];
       $("#youbian").attr("value",data['addr']['youbian']);
       $("#biaoqian").attr("value",data['addr']['biaoqian']);
    });
}

//保存地址
function baocun(){
  if($('#addr').attr('data-id') != 1){
    return false;
  }
  var url = "<?php echo U('address/doaddr');?>";
  $("#addr").val('保存中...');
  $('#addr').attr('data-id',0);
  $.post(url,$("form").serialize(),function(data){
    $('#addr').attr('data-id',1);
    if(data.status == 1){
      $("#addr").val('确认保存');
      alert(data.msg);
      var s = "<?php echo ($_GET['s']); ?>";
      if(s == 1){
        window.location="<?php echo ($_SESSION['s']); ?>";
      }else{
        //刷新当前文档
        location.href=document.referrer;
      }
    }else{
      $("#addr").val('确认保存');
      alert(data.msg);
    }
  })
}

function del(o,id){
  if(confirm("确定删除该数据？")){
    var url = "<?php echo U('address/addrdel');?>";
    $.post(url,{"id":id},function(data){
      if(data.status == 1){
            alert(data.msg);
            window.location="<?php echo U('address/index');?>";
      }else{
           alert(data.msg);
      }
    })
  }else{
    return false;
  }
}
//修改发票
function xiubill(o,id){
    var url ="<?php echo U('order/xiubill');?>";
    $.post(url,{"id":id},function(data){
       $("#btitle").attr("value",data['bill']['title']);
       $("#bsuinum").attr("value",data['bill']['suinum']);
       $("#btel").attr("value",data['bill']['tel']);
       $("#bemail").attr("value",data['bill']['email']);
    });
}
//保存发票
function bcbill(){
  if($('#bcbill').attr('data-id') != 1){
    return false;
  }
  var url = "<?php echo U('order/dobill');?>";
  $("#bcbill").val('保存中...');
  $('#bcbill').attr('data-id',0);
  $.post(url,$("form").serialize(),function(data){
    $('#bcbill').attr('data-id',1);
    if(data.status == 1){
        location.reload();
    }else{
       alert(data.msg);
      location.reload();
    }
  })
}
</script>
<script>
	function score(o) {
		$(o).keydown(function (event) {
			var num = event.which;
			if ((num < 48 || (num > 57 && num < 96) || num > 105) && num != 173 && num != 8 && num != 9 ) {
				return false;
			}
		});
	}
	function money(o) {
		$(o).keydown(function (event) {
			var num = event.which;
			if ((num < 48 || (num > 57 && num < 96) || num > 105) && num != 173 && num != 8 && num != 9 && num != 190 && num != 110) {
				return false;
			}
		});
	}

//计算总价
function check_all(){
	var score=$('.use_score').val();
	var money=$('.use_money').val();
	var rate="<?php echo ($_SESSION['config']['rate']); ?>";
	var youhui=$('#yhje').text();
	var total="<?php echo ($order['total']+$config['yunfei']); ?>";
	if(score == ''){
		score=0;
	}
	if(money == ''){
		money=0;
	}
	if(youhui == ''){
		youhui=0;
	}
	score=score*rate;
	var result = parseFloat(total) - parseFloat(money) - parseFloat(score) +parseFloat(youhui);
	if(result < 0){
		alert('累计优惠已大于总金额！');
		$("input[name='change-price']").val(parseFloat(total)+parseFloat(youhui));
		return 0;
	}else{
		$('#zongjia').text(result.toFixed(2));
		$("input[name='change-price']").val(result);
	}
}

	//选择优惠券
	function showxt(o){
		var limit=parseFloat($(o).find('.xianzhijine').text());
		var ttprice=parseFloat($("input[name='totalprice']").val());
			if(ttprice < limit){
				alert('商品总价未达到优惠券使用条件');
				return false;
			}
			var money = $(o).find('.youhuijine').text();
			var cha=parseFloat(ttprice)-parseFloat(money);
			if(cha < 0){
				alert('无法使用优惠券');
				return false;
			}
			//减掉的金额
			$('#yhje').text('-'+money);
			$('input[name=mid-yh]').val(money)
			cha=parseFloat(cha);
			var couponid =$(o).find("input[name='couponid']").val();
			$("input[name='cpid']").val(couponid);
			$('#zongjia').text(cha);
			$('#zongjia2').text(cha);		
		
	}
	//是否选择发票
	$('#qr_fa').click(function(){
		$("#is_fa").attr("value",1);
	});
	$('#bu_fa').click(function(){
		$("#is_fa").attr("value",0);
	});
	//地址选中传递
	$('.buhuixiejs').click(function(){
		var s = $(this).find('input').val();
		$("input[name=doushilei]").val(s);
		var url ="<?php echo U('address/xiu');?>";
		$.post(url,{"id":s},function(data){
		    // $("#nowadd1").attr("value",data['addr']['sheng']+data['addr']['shi']+data['addr']['xian']);
		    // $("#nowadd2").attr("value",data['addr']['name']+data['addr']['tel']);
		    document.getElementById("nowadd1").innerHTML =data['addr']['sheng']+data['addr']['shi']+data['addr']['xian']+data['addr']['address'];
		    document.getElementById("nowadd2").innerHTML =data['addr']['name']+data['addr']['tel'];
		    $("#nowadd3").attr("value",data['addr']['id']);
		});

	});

function order(){
	var addr = $("input[name=doushilei]").val();
	var amount = $("input[name=amount_list]").val();
	var id	= $("input[name=cart_id]").val();
	var score	= $(".use_score").val();
	var remain	= $(".use_money").val();
	var cpid	= $("input[name=cpid]").val();
    var token_push=$('input[name=token_push]').val();
	if(addr == ""){
		alert('请选择收货地址');
		return false;
	}
	var quick=$('input[name=is_quick]').val();
	var url = "<?php echo U('order/suborder');?>";
	$(".hddd_t1").find('a').text('提交中..');
	if(quick == 1){
		var quick_amount=$('input[name=quick_amount]').val();
		var quick_id=$('input[name=quick_id]').val();
		var quick_isnorm=$('input[name=quick_isnorm]').val();
		var quick_norm=$('input[name=quick_norm]').val();
        var quick_val=$('input[name=quick_val]').val();
		$.post(url,{'quick':quick,"quick_id":quick_id,"addr":addr,"score":score,'remain':remain,'cpid':cpid,'quick_amount':quick_amount,'quick_isnorm':quick_isnorm,'quick_norm':quick_norm,'quick_val':quick_val,'token_push':token_push},function(data){
			switch(data.status){
				case 0:
					alert(data.msg);
					return false;
				case 1:
					$(".hddd_t1").find('a').text('跳转中..');
					alert(data.msg);
					window.location="<?php echo U('order/pay');?>"+"?id="+data.id;
					break;
				case 2:
					alert(data.msg);
					location.href="/Order/index";
					break;
				default:
					alert('数据异常');
					return false;
			}
		})
	}else{
		$.post(url,{"id":id,"addr":addr,"amount":amount,"score":score,'remain':remain,'cpid':cpid,'token_push':token_push},function(data){
			switch(data.status){
				case 0:
					alert(data.msg);
					return false;
				case 1:
					$(".hddd_t1").find('a').text('跳转中..');
					alert(data.msg);
					window.location="<?php echo U('order/pay');?>"+"?id="+data.id;
					break;
				case 2:
					alert(data.msg);
					location.href="/Order/index";
					break;
				default:
					alert('数据异常');
					return false;
			}
		})
	}	
}
</script>
<script>
	$(function () {

		$('.address_lis').click(function () {
			$(this).addClass('active').parents('li').siblings().find('.address_lis').removeClass('active')
		})

		$('.addr_btn a:nth-child(1)').click(function () {
			$('html,body').css('overflow-y', 'hidden')
			$('.body_bg,.addr_fixed').addClass('into')
			$('.addr_fixed .addrF_tit h3 span').html('修改收货地址')
		})

		$('.address_add').click(function () {
			$('html,body').css('overflow-y', 'hidden')
			$('.body_bg,.addr_fixed').addClass('into')
			$('.addr_fixed .addrF_tit h3 span').html('添加收货地址')
		})

		$('.orderR2_lis label a').click(function () {
			$('html,body').css('overflow-y', 'hidden')
			$('.body_bg,.fapiao_fixed').addClass('into')
		})

		$('.addrF_tit img,.addrF_bott a').click(function () {
			$('.body_bg,.addr_fixed,.fapiao_fixed').removeClass('into')
			$('html,body').css('overflow-y', 'auto')
		})

		$('.order_left').outerHeight($(window).height() - $('.header.scrollT').height())
		$('.order_box').css('min-height', $(window).height() - $('.header.scrollT').height())

		$('.fapiao_xz a').click(function () {
			$(this).addClass('active').siblings().removeClass('active')
			if ($(this).index() == 1) {
				$('.fapiao_li').fadeIn()
			} else {
				$('.fapiao_li').hide()
			}
		})

		$('.orderL_li p').click(function(){
			$(this).next('.orderL_coupon').fadeIn()
		})
		$('.orderL_coupon li a').click(function(){
			$('.orderL_coupon').fadeOut()
		})

		$(window).scroll(function () {
			scrollT = $(window).scrollTop()
			if ($(window).width() > 768) {
				if (scrollT > $('.footer').offset().top - $(window).height()) {
					$('.order_left').css({
						'position': 'absolute',
						'top': $('.footer').offset().top - $(window).height() - 5
					})
				} else {
					$('.order_left').css({
						'position': 'fixed',
						'top': '80px'
					})
				}
			}
		})

		$(window).resize(function () {
			$('.order_left').height($(window).height() - $('.header.scrollT').height())
			$('.order_box').css('min-height', $(window).height() - $('.header.scrollT').height())
		})

	})
</script>

</html>