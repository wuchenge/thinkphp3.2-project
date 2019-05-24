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
						<?php if(is_array($rollimg)): $i = 0; $__LIST__ = $rollimg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="aegisD_lis active">
								<img src="<?php echo ($vo); ?>" alt="">
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<a href="javascript:;" class="aegisD_arrr"><i class="fa fa-angle-right"></i></a>
					<a href="javascript:;" class="aegisD_arrl"><i class="fa fa-angle-left"></i></a>
					<div class="aegisD_small">
						<ul>
							<?php if(is_array($rollimg)): $k = 0; $__LIST__ = $rollimg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li <?php if($k == 1): ?>class="active"<?php endif; ?>>
									<a href="javascript:;"><img src="<?php echo ($vo); ?>" alt=""></a>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="aegisD_right">
					<h3><?php echo ($result["gname"]); ?><!-- <span>gardenia</span> --></h3>
					<h4>促销价：￥<?php echo ($result["price"]); ?></h4>
					<h5>原价：￥<?php echo ($result["yprice"]); ?></h5>
					<hr>
					<div class="aegisD_des">
						<p><?php echo ($result["description"]); ?></p>
						<a href="javscript:;">更多描述</a>
					</div>
					<hr>
					<div class="aegisD_wz">
						<p><b>运费</b><span><?php echo ($result["yunfei"]); ?> 快递：<?php echo ($result["yfmoney"]); ?></span></p>
						<p><b>销量</b><span style="color: #f25328">99568</span></p>
						<p><b>评论</b><span style="color: #f25328">10000</span></p>
						<p><b>积分</b><span style="color: #f25328"><?php echo ($result["jifen"]); ?> 青域分</span></p>
					</div>
				<!--需要提交的参数，隐藏 -->
				<form name="form1" method="get" action="<?php echo U('Order/order');?>">
					<div class="aegisD_btn">
						<select name="guige" id="guige">
							<option selected value="">规格</option>
							 <?php if(is_array($guige)): $i = 0; $__LIST__ = $guige;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<select name="amount" id="shuliang">
							<option selected value="">数量</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
						<a onclick="add_order(this,<?php echo ($result["id"]); ?>)" data-id=1 style="cursor: pointer;"><img src="/Public/home/images/aegisD1.png">
							<span>立即购买</span>
						</a>
						<a onclick="add_cart(this,<?php echo ($result["id"]); ?>)" data-id=1 style="cursor: pointer;"><img src="/Public/home/images/aegisd2.png">
							<span>加入购物车</span>
						</a>
					</div>
					<!-- <input name="amount" type="hidden" value="1"/> -->
					<input type='hidden' value="<?php echo ($result["nums"]); ?>" name='goodsnums'/>
					<input type='hidden' value="" name='quick'/>
					<input type='hidden' value="<?php echo ($result["id"]); ?>" name='id'/>
				</form>
					<div class="aegisD_txt">
						<p><img src="/Public/home/images/zs.png">商家详情页（含主图）以图片或文字形式标注的一口价、促销价、优惠价等价格。</p>
						<p><img src="/Public/home/images/zs.png">商家详情页（含主图）以图片或文字形式标注的一口价、促销价、优惠价等价格。</p>
						<p><img src="/Public/home/images/zs.png">商家详情页（含主图）以图片或文字形式标注的一口价、促销价、优惠价等价格。</p>
					</div>
					<div class="aegisD_follow">
						<ul>
							<li><a>
								<?php if($result['is_coll'] == 1): ?><img style="cursor:pointer;"  data-id=1 onclick="bucoll(this,<?php echo ($result["id"]); ?>)" src="/Public/home/images/collect.svg" alt="">
								<?php else: ?>
									<img style="cursor:pointer;"  data-id=1 onclick="docoll(this,<?php echo ($result["id"]); ?>)" src="/Public/home/images/collect.svg"><?php endif; ?>
							收藏商品</a>
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
						<div class="col-sm-8">
							<h3>产品参数：</h3>
							<ul>
								<?php echo ($result["description"]); ?>
							</ul>
						</div>
						<div class="col-sm-4">
							<h3>青域承诺：</h3>
							<p><?php echo ($result["description"]); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="aegisD_box2" style="background-image: url(/Public/home/images/aegisDot2_bg.jpg)">
			<div class="container1">
				<div class="aegisD2_cot">
					<ul>
						<li class="active"><a href="javascript:;">产品详情</a></li>
						<li><a href="javascript:;">用户评价</a></li>
					</ul>
					<div class="aegisD2_wz">
						 <?php echo (htmlspecialchars_decode($result["text"])); ?>
					</div>
				</div>
				<div class="aegisD3_cot" id="pjlist">
					<div class="aegisD3_tit">
						<h3>用户评价</h3>
					</div>
					<div class="aegisd3_nav" >
						<ul>
							<li <?php if(empty($_GET['ping'])): ?>class="active"<?php endif; ?>><a href="/index.php/aegis/info/id/<?php echo ($_GET["id"]); ?>/#pjlist">全部（<?php echo ($count["count"]); ?>）</a></li>
							<li <?php if($_GET['ping'] == 1): ?>class="active"<?php endif; ?>><a href="/index.php/aegis/info/id/<?php echo ($_GET["id"]); ?>/ping/1#pjlist">晒图（<?php echo ($count["hcount"]); ?>）</a></li>
							<li <?php if($_GET['ping'] == 2): ?>class="active"<?php endif; ?>><a href="/index.php/aegis/info/id/<?php echo ($_GET["id"]); ?>/ping/2#pjlist">追评（<?php echo ($count["zcount"]); ?>）</a></li>
						</ul>
						<select onchange="pingChange()" id="pingpai">
							<option value="0" selected>推荐评价</option>
							<option value="1">好评优先</option>
							<option value="2">时间优先</option>
						</select>
					</div>
					<input hidden id="nowid" value="<?php echo ($_GET["id"]); ?>">
					<script>
                    function pingChange(){ 
					       var objS = $("#pingpai").find("option:selected").val();
					       //var nowid = document.getElementByName("nowid").value;
					        var nowid =document.getElementById("nowid").value;
					        if(objS==0){
					        	location.href="/index.php/aegis/info/id/"+nowid+"#pjlist";
					             ///location.href=window.location.href+"#pjlist";
					         }else{
					         	location.href="/index.php/aegis/info/id/"+nowid+"/pai/"+objS+"#pjlist";
					            //location.href=window.location.href+"/pai/"+objS+"#pjlist";
					         }
					 } 
					</script>
					<div class="aegisd3_bott">

						<?php if(is_array($comments)): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="aegisd3_lis">
							<div class="aegisd3_user">
								<div class="aegisd3_img">
									<img src="<?php echo ($vo["headimg"]); ?>" alt="" style="width: 35px;height: auto;">
								</div>
								<div class="aegisd3U_wz">
									<h3><?php echo ($vo["username"]); ?></h3>
									<p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
								</div>
							</div>
							<div class="aegisd3_wz">
								<p><?php echo ($vo["content"]); ?></p>
								<?php if(!empty($vo['huifu'])): ?><div class="aegisd3_hf">
									<p><span>官方回复：</span><?php echo ($vo["huifu"]); ?></p>
								</div><?php endif; ?>
							<?php if($vo['status'] == 2): ?><div class="aegisd3_zp">
									<p><span>追评：</span><?php echo ($vo["zuiping"]); ?></p>
								</div><?php endif; ?>
							</div>
							<div class="aegisd3_date">
								<span><?php echo (date('Y-m-d',$vo["addtime"])); ?></span>
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
						
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
<script type="text/javascript" src="/Public/lib/layer/2.1/layer.js"></script>   
<script>
function topicsearch(){
    var val = $("#topic_search").find('input').val();
    if($.trim(val)==""){
        layer.alert('请输入搜索关键字');
        return false;
    }
    $("#topic_search").submit();
}
</script>
<script type="text/javascript">
//收藏
function docoll(o,gid){
    var url = "<?php echo U('Collect/docoll');?>";
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
    if (confirm("确定取消收藏该商品？")) {
        var url = "<?php echo U('Collect/bucoll');?>";
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

//数量加减
function sums(o){
    var amount = $("input[name=amount]").val();
    if(amount <= 1 && o == -1){
        $(".kuang").val(1);
        $("input[name=amount]").val(1);
    }else{
        var sum = parseInt(amount)+parseInt(o);
        $(".kuang").val(sum);
        $("input[name=amount]").val(sum);
    }
}

//加入购物车
function add_cart(o,gid){
    //cookie读取商品数量
    //限制只让点击一次加入购物车
    // var did=$(o).attr('data-id');
    // if(did != 1){
    //     return false;
    // }
    $(o).attr('data-id',0);
    var gnum = jQuery("#shuliang  option:selected").val();
    var stock=$("input[name=goodsnums]").val();
    var guige =jQuery("#guige  option:selected").text();
        if(parseInt(gnum) > parseInt(stock)){
                alert('库存不足');
                $(o).attr('data-id',1);
                return false;
            }
            var url="<?php echo U('Goods/cart');?>";
            $.post(url,{gid:gid,gnum:gnum,guige:guige},function(data){
                if(data.status == 1){
                    alert(data.msg);
                    $(o).attr('data-id',1);
                }else{
                    alert(data.msg);
                    $(o).attr('data-id',1);
                    return false;
                }
            })
}

//立即购买
function add_order(o,gid){
    var did=$(o).attr('data-id');
    if(did != 1){
        return false;
    }
    var quick=1;
    $('input[name=quick]').val(1);
    $(o).attr('data-id',0);
    var gnum = jQuery("#shuliang  option:selected").text();
    var stock=$("input[name=goodsnums]").val();
    var val =jQuery("#guige  option:selected").text();
    if(parseInt(gnum) > parseInt(stock)){
                alert('库存不足');
                $(o).attr('data-id',1);
                return false;
    }
    var url="<?php echo U('Order/buy');?>";
    $.post(url,{gid:gid,val:val,gnum:gnum},function(data){
             if(data.status == 1){
                  //alert('订单提交成功');
                 // $('form[name=form1]').submit();
                  window.location="<?php echo U('order/order');?>"+"?id="+data.id+"&quick=1";
             }else{
                 alert(data.msg);
                 $(o).attr('data-id',1);
                 return false;
             }
    })

    //$('form[name=form1]').submit();

}

function detail(o){
    $('.pjlb,.pjfy').hide();
    $("#goods_detail").hide();
    $(o).find('span').removeAttr('id');
    $(o).siblings('a').find('span').attr('id','dangqian');
    $("#shouhou").show();
}

$(document).ready(function () {
    $("#imgurl li").mouseover(function(){
        $(this).find('a').attr('id','dqimg');
        $(this).siblings('li').find('a').removeAttr('id');
        $('.mousetrap').find('img').attr('src',$(this).find('img').attr('src'));
    })
    
    //评价切换
    $("#picurl li").mouseover(function(){
        var src = $(this).find('img').attr('src');
        var b = $(this).attr('data-id');
        $("#img_"+b).attr('src',src);
    })
    $("#picurl2 li").mouseover(function(){
        var src = $(this).find('img').attr('src');
        var b = $(this).attr('data-id');
        $("#img2_"+b).attr('src',src);
    })
    $("#gltab li").click(function () {
        $(this).siblings('li').removeAttr('class');
        $(this).attr('class', 'active');
        $tab = $(this).attr('data-id');
        if ($tab == 3) {
            $('#div_product_attribute').hide();
            $('.p_description').hide();
            $('.evaluate').show();
        } else if ($tab == 2) {
            $('.p_description').show();
            $('.evaluate').hide();
            $('#div_product_attribute').hide();
        } else {
            $("#pingjia").removeClass('active');
            $('#div_product_attribute').show();
            $('.evaluate').hide();
            $('.p_description').hide();
        }
    })

});

</script>
<script>
	$(function () {
		$('.aegisD_des a').click(function () {
			$('html,body').animate({
				'scrollTop': $('.aegisD2_cot').offset().top - 80
			})
		})

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