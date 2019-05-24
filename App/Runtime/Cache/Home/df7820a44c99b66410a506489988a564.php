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

		<div class="cart_box">
			<div class="container">
				<div class="cart_cot">
					<div class="cart_tit">
						<h3>购物车</h3>
						<a onclick=" return alldel(this)"><img src="/Public/home/images/delect.png" alt="">删除</a>
					</div>
					<div class="cart_cont">
                       <?php if(is_array($glist)): $i = 0; $__LIST__ = $glist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="cart_lis leijia">
							<div class="cart_info ">
								<label>
									<div class="cart_input">
										<input type="checkbox" class="fxk" onchange="sigselect(this)" >
										<i></i>
									</div>
									<a href="<?php echo U('aegis/info',array('id'=>$vo['gid']));?>">
										<div class="cart_img">
											<img src="<?php echo ($vo["imgurl"]); ?>" alt="">
										</div>
										<div class="cart_wz">
											<h5><?php echo ($vo["gname"]); ?></h5>
										</div>
									</a>
								</label>
							</div>
							<div class="cart_price">
								<p>￥<span><?php echo ($vo["price"]); ?></span></p>
							</div>
							<!-- <input hidden name="amount" class="amount"  value="<?php echo ($vo["num"]); ?>"/> -->
							<input class="price"  type="hidden" value="<?php echo ($vo["price"]); ?>"/>
							<div class="cart_count">
								<div class="cart_calc" >
									<i onclick="jian(this)">-</i>
									<span><?php echo ($vo["num"]); ?></span>
									<i onclick="zengjia(this)">+</i>
									<input hidden name="amount" class="amount"  value="<?php echo ($vo["num"]); ?>"/>
									<input type="hidden" value="<?php echo ($vo["nums"]); ?>" name="nums">
								</div>
							</div>
							
							<div class="cart_cz">
								<a style="cursor:pointer" onclick=" return cartdel(this,'<?php echo ($vo["id"]); ?>')">
									<input name="cartid" type="hidden" value="<?php echo ($vo["id"]); ?>"/>
									<img src="/Public/home/images/delect.png" alt="">
								</a>
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<b  hidden id="num">0</b>
					<div class="cart_bott">
						<div class="cart_left">
							<a href="#" onClick="javascript :history.back(-1);"><img src="/Public/home/images/cart.svg" alt="">继续选购</a>
						</div>
						<div class="cart_right">
							<p>应付： <span>￥<i class="totalprice">0</i></span></p>
							<div class="cart_btn">
								<a onclick="return check()" type="submit">立即购买</a>
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
<script type="text/javascript">
	
	//单独点击复选框
	function sigselect(o){
		$(o).prop('checked', $(o).prop('checked'));
		addall();
	}
	//商品移除购物车
	function cartdel(o,id){
		//var id=$(o).next().val();
		if(confirm('确定将此商品移除购物车？')){
			var url="<?php echo U('/User/cartdel');?>";
			$.post(url,{id:id},function(data){
				if(data.status==1){
					alert(data.msg);
					//location.reload();
				}else{
					alert(data.msg);
					return false;
				}
			})
		}
	}
	//全部移除购物车
	function alldel(o){
		//var id=$(o).next().val();
		if(confirm('确定删除全部购物车？')){
			var url="<?php echo U('/User/alldel');?>";
			$.post(url,function(data){
				if(data.status==1){
					alert(data.msg);
					location.reload();
				}else{
					alert(data.msg);
					return false;
				}
			})
		}
	}
	//减少购物车商品数量
	function jian(o){
		//alert('dasd');
		var rh=parseInt($(o).next().next().next().val());
		rt= rh-1;
		if(rt <1){
			alert('购买数量至少为1！');
			return false;
		}else{
			$(o).next().next().next().val(rt);
		}
		addall();
	}
	
	//增加购物车商品数量
	function zengjia(o){
		var rh=parseInt($(o).next().val());
		var num=parseInt($(o).next().next().val());
		rt = rh +1;
		//alert(rt);
		if(rt > num){
			alert('超出商品库存');
			return false;
		}else{
			$(o).next().val(rt);
		}
		addall();
	}
	
	//全选与全不选
	function allselect(obj){
		$(".fxk").prop('checked', $(obj).prop('checked'));
		if($(obj).is(':checked')){
			addall();
		}else{
			$('.totalprice').text('0');
			$('#num').text('0');
			$('#jiesuanbutton').css("background","#6c6c6c");
		}
	}
	
	//计算总和
	function addall(){
		var sum=0;
		var num=0;
		var none=0;
		$('.leijia').each(function(){
			if($(this).find('.fxk').is(':checked')){
				num=num+1;
				var amount=$(this).find('.amount').val();
				var price=$(this).find('.price').val();
				sum=sum+amount*price;
				sum2 = sum.toFixed(2);
				$('.totalprice').text(sum2);
				$('#num').text(num);
			}	
		})
		if(num==0){
			$('.totalprice').text("0");
			$('#num').text("0");
			$('#jiesuanbutton').css("background","#6c6c6c");
		}
	}

	//下订单之前检查判断
	function check(){
		var sum=$('.totalprice').text();
		var num=$('#num').text();
		if(sum=='0'|| num=="0"){
			alert('请选择要结算的商品！');
			return false;
		}
		if(confirm("确定结算？")){
			var at="";
			var gd="";
			$('.leijia').each(function(){
				if($(this).find('.fxk').is(':checked')){
					var amount=$(this).find('.amount').val();
					at=at+','+amount;
					var gid=$(this).find("input[name='cartid']").val();
					gd=gd+','+gid;
				}	
			})
			var url="<?php echo U('order/cartbuy');?>";
			$.post(url,{at:at,gd:gd},function(data){
				if(data.status==1){
					//location.href="/Order/order/id/"+data.id;
					location.href="<?php echo U('Order/order');?>?id="+data.id;
				}else{
					return false;
					
				}
			})
		}else{
			return false;
		}
	}
</script>
<script>
	$(function () {
		$('.cart_cz a').click(function () {
			$(this).parents('.cart_lis').remove()
		})
		$('.cart_tit a').click(function () {
			for (i = $('.cart_input input').length - 1; i >= 0; i--) {
				if ($('.cart_input input').eq(i).prop('checked') == true) {
					$('.cart_input input').eq(i).parents('.cart_lis').remove()
				}
			}
		})
		$('.cart_calc i:nth-child(3)').click(function () {
			cart_count = $(this).siblings('span').html()
			$('.cart_calc i:nth-child(1)').css('opacity', '1')
			cart_count++
			$(this).siblings('span').html(cart_count)
		})
		$('.cart_calc i:nth-child(1)').click(function () {
			cart_count = $(this).siblings('span').html()
			if (cart_count > 1) {
				cart_count--
			} else if (cart_count == 1) {
				cart_count--
				$(this).css('opacity', '0.2')
			} else {
				$(this).css('opacity', '0.2')
			}
			$(this).siblings('span').html(cart_count)
		})

	})
</script>

</html>