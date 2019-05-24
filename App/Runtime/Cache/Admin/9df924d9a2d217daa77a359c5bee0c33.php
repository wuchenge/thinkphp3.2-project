<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Public/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>后台管理系统</title>
<meta name="keywords" content="H-ui.admin v2.4,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v2.4，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<!-- 导入头部文件 -->
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/admin.php">帷拓科技WEETOP后台管理系统</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml">H-ui</a> <span class="logo navbar-slogan f-l mr-10 hidden-xs"></span> <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
<!-- 			<nav class="nav navbar-nav">
				<ul class="cl">
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<!--<li><a href="javascript:;" onclick="article_add('添加资讯','/admin.php/Index/../News/newsAdd.html')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>-->
							<!-- <li><a href="javascript:;" onclick="picture_add('添加图片,'/admin.php/Index/../Image/imgAdd.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li> -->
							<!--<li><a href="javascript:;" onclick="product_add('添加产品','/admin.php/Index/../Product/productAdd.html')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>-->
							<!--<li><a href="javascript:;" onclick="member_add('添加用户','/admin.php/Index/../Member/memberAdd.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>-->
						<!-- </ul>
					</li>
				</ul>
			</nav> --> 
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
				<ul class="cl">
					<!-- <li><?php echo ($glb["rname"]); ?></li> -->
					<li><a href="/" target="_blank">前台首页</a></li>
					<li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?php echo ($_SESSION['name']); ?>  <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<!--<li><a href="#">个人信息</a></li>-->
							<!--<li><a href="#">切换账户</a></li>-->
							<li><a href="<?php echo U('Login/logout');?>">退出</a></li>
						</ul>
					</li>
					<!-- <li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li> -->
					<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" data-val="default" title="默认（橙色）">默认（橙色）</a></li>
							<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
							<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
							<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
							<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
							<li><a href="javascript:;" data-val="orange" title="黑色">黑色</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>
<!-- 导入菜单文件 -->
<aside class="Hui-aside">
	<input runat="server" id="divScrollValue" type="hidden" value="" />

	<div class="menu_dropdown bk_2">
		<dl id="menu-article1">
			<dt><i class="Hui-iconfont">&#xe616;</i> 办公空间<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('Space/lists');?>" data-title="办公空间" target="feiiframe" >办公空间</a></li>
					<li><a href="<?php echo U('Spacecate/lists');?>" data-title="办公分类" target="feiiframe" >办公分类</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-article1">
			<dt><i class="Hui-iconfont">&#xe616;</i> 财税法权<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('Caifa/lists');?>" data-title="财税法权" target="feiiframe" >财税法权</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-article1">
			<dt><i class="Hui-iconfont">&#xe616;</i> 品牌策划<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('Brand/lists');?>" data-title="品牌策划" target="feiiframe" >品牌策划</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-product2">
			<dt><i class="Hui-iconfont">&#xe620;</i> 商品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('Product/productList');?>" data-title="商品管理" target="feiiframe">商品管理</a></li>
					<li><a href="<?php echo U('Productcate/lists');?>" data-title="商品分类" target="feiiframe">商品分类</a></li>
					<li><a href="<?php echo U('Jifen/lists');?>" data-title="积分商城" target="feiiframe">积分商城</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-order">
			<dt><i class="Hui-iconfont">&#xe627;</i> 订单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('Order/orderList');?>" data-title="订单列表" target="feiiframe">订单列表</a></li>
					<!-- <li><a href="<?php echo U('order/tuihuanList');?>" data-title="退换列表" target="feiiframe">退换列表</a></li> -->
					<li><a href="<?php echo U('Order/pingjiaList');?>" data-title="评价列表" target="feiiframe">评价列表</a></li>
				</ul>
			</dd>
		</dl>
		
<!-- 		<dl id="menu-coupon">
			<dt><i class="Hui-iconfont">&#xe6ca;</i> 优惠券管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('Coupon/couponList');?>" data-title="优惠券列表" target="feiiframe">优惠券列表</a></li>
					<li><a href="<?php echo U('Coupon/usercouponList');?>" data-title="优惠券记录" target="feiiframe">优惠券记录</a></li>
				</ul>
			</dd>
		</dl> -->
		<dl id="menu-user">
			<dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a style="text-decoration:none;" data-title="会员列表" href="<?php echo U('User/lists');?>" target="feiiframe"><i class="Hui-iconfont"></i>会员列表</a></li>
					<!-- <li><a style="text-decoration:none;" data-title="提现管理" href="<?php echo U('Withdraw/lists');?>" target="feiiframe"><i class="Hui-iconfont"></i>提现管理</a></li>
					<li><a style="text-decoration:none;" data-title="等级管理" href="<?php echo U('Level/lists');?>" target="feiiframe"><i class="Hui-iconfont"></i>等级管理</a></li> -->
				</ul>
			</dd>
		</dl>
		<dl id="menu-article1">
			<dt><i class="Hui-iconfont">&#xe616;</i> 新闻中心<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('News/lists');?>" data-title="新闻中心" target="feiiframe" >新闻中心</a></li>
					<!-- <li><a href="<?php echo U('news/cate');?>" data-title="新闻分类" target="feiiframe" >新闻分类</a></li> -->
				</ul>
			</dd>
		</dl>
		<dl id="menu-article1">
			<dt><i class="Hui-iconfont">&#xe616;</i> 联系我们<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('Message/lists');?>" data-title="联系我们" target="feiiframe" >联系我们</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-article1">
			<dt><i class="Hui-iconfont">&#xe616;</i> 关于我们<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('Honor/lists');?>" data-title="关于我们" target="feiiframe" >关于我们</a></li>
				</ul>
			</dd>
		</dl>

<!-- 		<dl id="menu-article5">
			<dt><i class="Hui-iconfont">&#xe6f2;</i> 单页管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('danye/lists');?>" data-title="单页列表" target="feiiframe">单页列表</a></li>
				</ul>
			</dd>
		</dl> -->
<!-- 		<dl id="menu-article5">
			<dt><i class="Hui-iconfont">&#xe66c;</i> 导航栏管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('Nav/Lists');?>" data-title="导航栏列表" target="feiiframe">导航栏列表</a></li>
				</ul>
			</dd>
		</dl> -->
		<dl id="menu-article6">
			<dt><i class="Hui-iconfont">&#xe646;</i> 图片管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('Lunbo/index');?>" data-title="首页图" target="feiiframe">轮播图</a></li>
					<li><a href="<?php echo U('banner/index');?>" data-title="其它图片" target="feiiframe">其他图片</a></li>
				</ul>
			</dd>
		</dl>
		

		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<!-- <li><a href="/admin.php/admin/adminRole" data-title="角色管理" target="feiiframe">角色管理</a></li>
					<li><a href="/admin.php/admin/adminRoleAdd" data-title="角色添加" target="feiiframe">角色添加</a></li> -->
					<!--<li><a href="/admin.php/admin/adminPermission" data-title="权限管理" target="feiiframe">权限管理</a></li>-->
					<li><a href="/admin.php/Admin/adminList" data-title="管理员列表" target="feiiframe">管理员列表</a></li>
					<li><a href="/admin.php/Admin/adminAdd" data-title="管理员添加" target="feiiframe">管理员添加</a></li>
					<li><a href="/admin.php/Admin/resetpwd" data-title="重置密码" target="feiiframe">重置密码</a></li>
				</ul>
			</dd>
		</dl>
<!-- 		<dl id="menu-link">
			<dt><i class="Hui-iconfont">&#xe6f1;</i> 友情链接管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('Link/lists');?>" data-title="友情链接" target="feiiframe">友情链接列表</a></li>
				</ul>
			</dd>
		</dl> -->
		<dl id="menu-system">
			<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('System/edit');?>" data-title="系统设置" target="feiiframe">系统设置</a></li>
				</ul>
			</dd>
		</dl>
	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active"><span title="后台管理系统" data-href="welcome.html">后台管理系统</span><em></em></li>
			</ul>
		</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
	</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe id="feiiframe" name='feiiframe' scrolling="yes" frameborder="0" src="/admin.php/Index/welcome1.html"></iframe>
		</div>
	</div>
</section>
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
/*资讯-添加*/
function article_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
</script> 
<script type="text/javascript">
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s)})();
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F080836300300be57b7f34f4b3e97d911' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>