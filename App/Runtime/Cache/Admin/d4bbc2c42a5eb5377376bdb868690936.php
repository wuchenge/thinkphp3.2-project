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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 品牌管理 <span class="c-gray en">&gt;</span> 品牌列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<form method="get">
<!-- 		<span class="select-box inline">
		<select name="cate" class="select">
			<?php echo ($cate); ?>
		</select>
		</span> -->
			日期范围：
			<input type="text" onfocus="WdatePicker()" id="txtBeginDate" name="start" value="<?php echo ($search["start"]); ?>" class="input-text Wdate" style="width:120px;">
			-
			<input type="text" onfocus="WdatePicker()" id="txtEndDate" name="end" value="<?php echo ($search["end"]); ?>" class="input-text Wdate" style="width:120px;">
			<input type="text" name="title" id="title" value="<?php echo ($search["title"]); ?>" placeholder=" 品牌标题" style="width:250px" class="input-text">
			<button name="subgl" id="subgl" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜品牌
			</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"><span class="l">
		<!--<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>-->
		<a class="btn btn-primary radius" data-title="添加品牌"  href="<?php echo U('brand/add');?>"><i class="Hui-iconfont">&#xe600;</i> 添加品牌</a></span> <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<!--<th width="25"><input type="checkbox" name="" value=""></th>-->
					<!-- <th width="60">ID</th> -->
					<th>标题</th>
					<th>价格</th>
					<th>图片</th>
					<th width="60">排序</th>
					<!-- <th width="80">分类</th> -->
					<th width="140">添加时间</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
					<!--<td><input type="checkbox" value="" name=""></td>-->
					<!-- <td><?php echo ($vo["id"]); ?></td> -->
					<td ><?php echo ($vo["title"]); ?></td>
					<td ><?php echo ($vo["price"]); ?>/月</td>
					<td ><img src="<?php echo ($vo["imgurl"]); ?>" width="100px" height="30px"></td>
					<td ><?php echo ($vo["sort"]); ?></td>
					<!-- <td><?php echo ($vo["cate_name"]); ?></td> -->
					<td><?php echo (date('Y-m-d H:i',$vo["addtime"])); ?></td>
					<td class="f-14 td-manage"><a style="text-decoration:none" class="ml-5"  href="<?php echo U('brand/edit?id='.$vo['id']);?>" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_del(this,'<?php echo ($vo["id"]); ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
		<?php if(empty($list)): ?><div align="center">
				<span style="text-align: center; padding-top: 20px;display: block; font-size:16px; color: #ff7800;">没有你要查询的数据！</span>
			</div><?php endif; ?>
		<div  class="pages" style="text-align: center;"><?php echo ($page); ?>
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
/*删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var url = "<?php echo U('brand/del');?>";
		$.post(url, {id: id}, function (data) {
			if (data.code == 1) {
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			} else {
				layer.msg('删除失败!',{icon:5,time:1000});
			}
		},'json')

	});
}
</script>
</body>
</html>