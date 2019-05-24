<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Public/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css" />
<link href="/Public/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="/Public/web/js/uploadify/uploadify.css" media="all">

<link href="/Public/css/mypage.css" rel="stylesheet" type="text/css" />
<style>
        input[type=number] {
            -moz-appearance:textfield;
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
<title><?php echo ($title); ?></title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 商品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<form method="get">
		<span class="select-box inline">
			<select name="fcate" id="first" onchange="seconds(this)">
				<option value=''>一级分类</option>
				<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($search['fcate'] == $vo['id']): ?><option  selected value="<?php echo ($vo["id"]); ?>">
						<?php echo ($vo["title"]); ?>
					</option>
					<?php else: ?>
					<option value="<?php echo ($vo["id"]); ?>">
						<?php echo ($vo["title"]); ?>
					</option><?php endif; endforeach; endif; else: echo "" ;endif; ?>	
			</select>
		</span>
		<span class="select-box inline">
			<select name="scate" id='second' onchange="thirds(this)">
				<option value=''>二级分类</option>
				<?php if(is_array($res2)): $i = 0; $__LIST__ = $res2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($search['scate'] == $vo['id']): ?><option  selected value="<?php echo ($vo["id"]); ?>">
						<?php echo ($vo["title"]); ?>
					</option>
					<?php else: ?>
					<option value="<?php echo ($vo["id"]); ?>">
						<?php echo ($vo["title"]); ?>
					</option><?php endif; endforeach; endif; else: echo "" ;endif; ?>	
			</select>
		</span>	
		<span class="select-box inline">
			<select name="tcate" id="third">
				<option value=''>三级分类</option>
				<?php if(is_array($res3)): $i = 0; $__LIST__ = $res3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($search['tcate'] == $vo['id']): ?><option  selected value="<?php echo ($vo["id"]); ?>">
						<?php echo ($vo["title"]); ?>
					</option>
					<?php else: ?>
					<option value="<?php echo ($vo["id"]); ?>">
						<?php echo ($vo["title"]); ?>
					</option><?php endif; endforeach; endif; else: echo "" ;endif; ?>	
			</select>
		</span>	
			日期范围：
			<input type="text" onfocus="WdatePicker()" id="txtBeginDate" name="start" value="<?php echo ($search["start"]); ?>" class="input-text Wdate" style="width:120px;">
			-
			<input type="text" onfocus="WdatePicker()" id="txtEndDate" name="end" value="<?php echo ($search["end"]); ?>" class="input-text Wdate" style="width:120px;">
			<input type="text" name="title" id="title" value="<?php echo ($search["title"]); ?>" placeholder=" 商品标题" style="width:250px" class="input-text">
			<button name="subgl" id="subgl" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜商品
			</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
		<a class="btn btn-primary radius" data-title="添加商品"  onclick="add()" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加商品</a></span> <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="80">ID</th>
					<th width="120">标题</th>
					<th width="75">一级分类</th>
					<th width="75">二级分类</th>
					<th width="75">三级分类</th>
					<th width="116">图片</th>
					<th width="120">上传时间</th>
					<th width="60">商品排序</th>
					<th width="60">上架状态</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
					<td><?php echo ($vo["id"]); ?></td>
					<td ><?php echo ($vo["gname"]); ?></td>
					<td ><?php echo ($vo["ftitle"]); ?></td>
					<td ><?php echo ($vo["stitle"]); ?></td>
					<td ><?php echo ($vo["ttitle"]); ?></td>
					<td><img src="<?php echo ($vo["imgurl"]); ?>" width="57px" height="auto"></td>
					<td><?php echo (date('Y-m-d H:i',$vo["addtime"])); ?></td>
					<td><?php echo ($vo["sort"]); ?></td>
					<td class="td-status"><?php if($vo['is_up'] == 1): ?><span class="label label-success radius">已上架</span><?php else: ?><span class="label label-error radius">已下架</span><?php endif; ?></td>
					<td class="f-14 td-manage">
						<?php if($vo['is_up'] == 1): ?><a style="text-decoration:none" onClick="article_stop(this,'<?php echo ($vo["id"]); ?>')" href="javascript:;"
							   title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
							<?php else: ?>
							<a style="text-decoration:none" onClick="article_start(this,'<?php echo ($vo["id"]); ?>')" href="javascript:;"
							   title="上架"><i class="Hui-iconfont">&#xe603;</i></a><?php endif; ?>
						<a style="text-decoration:none" class="ml-5" href="<?php echo U('Product/productEdit?id='.$vo['id']);?>" title="编辑"><i class="Hui-iconfont">&#xe6df;</i>
						</a>
						<a style="text-decoration:none" onClick="article_del(this,'<?php echo ($vo["id"]); ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe60b;</i></a>	
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
		<?php if(empty($list)): ?><div align="center">
				<span style="text-align: center; padding-top: 20px;display: block; font-size:16px; color: #ff7800;">没有你要查询的数据！</span>
			</div><?php endif; ?>
		<div class="pages" style="text-align: center;"><?php echo ($page); ?>
			<div class="clear"></div>
		</div>
	</div>
</div>

<style type="text/css">
	.page-container
	{
		margin-bottom:  25px;
	}
</style>

<div style="position: fixed; bottom: 0; width:100%; height:25px; line-height: 25px; text-align: center;background:#eee;">Copyright&nbsp; 2003-2017&nbsp; WEETOP &nbsp;all &nbsp;rights&nbsp; reserved&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.zjteam.com/" target="_blank">杭州帷拓科技有限公司版权所有</a>
</div>

<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Public/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/static//h-ui.admin/js/H-ui.admin.js"></script>
<script language="javascript" type="text/javascript" src="/Public/js/My97DatePicker/WdatePicker.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/js/icheck/icheck.css" />
<script language="javascript" type="text/javascript" src="/Public/js/icheck/jquery.icheck.min.js"></script>


<script type="text/javascript">
//打开页面没有层级头
	function add(){
		location.href="<?php echo U('Product/productAdd');?>";
	}
/*资讯-添加*/
function article_add(title,url,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-编辑*/
function article_edit(title,url,id,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var url = "<?php echo U('Product/delproduct');?>";
		$.post(url, {id: id}, function (data) {
			if (data.code == 1) {
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			} else {
				layer.msg('删除失败!',{icon:5,time:1000});
			}
		},'json')
//		$(obj).parents("tr").remove();
		layer.msg('已删除!',1);
	});
}
/*资讯-审核*/
function article_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过','取消'], 
		shade: false,
		closeBtn: 0
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已上架</span>');
		$(obj).remove();
		layer.msg('已上架', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}
/*资讯-下架*/
function article_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		var url = "<?php echo U('product/xiaglgood');?>";
		$.post(url, {id: id}, function (data) {
			if (data.code == 1) {
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,<?php echo ($vo["id"]); ?>)" href="javascript:;" title="上架"><i class="Hui-iconfont">&#xe603;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
				$(obj).remove();
				layer.msg('已下架!',{icon: 6,time:1000});
				//location.reload();
			} else {
				alert(data.msg);
			}
		},'json')

	});
}

/*资讯-上架*/
function article_start(obj,id){
	layer.confirm('确认要上架吗？',function(index){
			var url = "<?php echo U('product/upglgood');?>";
			$.post(url, {id: id}, function (data) {
				if (data.code == 1) {
					$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,<?php echo ($vo["id"]); ?>)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
					$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已上架</span>');
					$(obj).remove();
					layer.msg('已上架!',{icon: 6,time:1000});
					//location.reload();
				} else {
					alert(data.msg);
				}
			},'json')

	});
}
/*资讯-申请上线*/
function article_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}
//获取二级分类
function seconds(o){
	var id=$(o).val();
	var url ="<?php echo U('Product/second');?>";
	$.post(url,{"id":id},function(data){
		$("#second").html(data['str']);
		$("#third").html(data['ttr']);
	});
}

//获取三级分类
function thirds(o){
	var id=$(o).val();
	var url ="<?php echo U('Product/third');?>";
	$.post(url,{"id":id},function(data){
		$("#third").html(data);
	});
}
</script>
</body>
</html>