<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> <?php if(empty($newsxiugl['id'])): ?>商品添加<?php else: ?>商品修改<?php endif; ?> <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<article class="page-container">
	<form class="form form-horizontal" id="form-news-add" enctype='multipart/form-data' method="post" <?php if(empty($newsxiugl['id'])): ?>action="<?php echo U('Product/productAdd');?>"<?php else: endif; ?> >
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>一级分类：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select name="fcate" id="first" onchange="seconds(this)">
					<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($vo["id"]); ?>">
							<?php echo ($vo["title"]); ?>
						</option><?php endforeach; endif; else: echo "" ;endif; ?>	
				</select>
			</div>
			<div class="col-5"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>二级分类：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select name="scate" id='second' onchange="thirds(this)">
					<?php if(is_array($res2)): $i = 0; $__LIST__ = $res2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($vo["id"]); ?>">
							<?php echo ($vo["title"]); ?>
						</option><?php endforeach; endif; else: echo "" ;endif; ?>	
				</select>
			</div>
			<div class="col-5"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>三级分类：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<select name="tcate" id="third">
					<?php if(is_array($res3)): $i = 0; $__LIST__ = $res3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($vo["id"]); ?>">
							<?php echo ($vo["title"]); ?>
						</option><?php endforeach; endif; else: echo "" ;endif; ?>	
				</select>
			</div>
			<div class="col-5"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($newsxiugl["gname"]); ?>" placeholder="" id="gname" name="gname">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>原价：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 20%;">
				<input type="number" class="input-text" min="0"  value="<?php echo ($newsxiugl["yprice"]); ?>" placeholder="" id="" name="yprice">
			</div>
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>促销价：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 20%;">
				<input type="number" class="input-text" min="0"  value="<?php echo ($newsxiugl["price"]); ?>" placeholder="" id="" name="price">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>关键词：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($newsxiugl["keywords"]); ?>" placeholder="" id="keywords" name="keywords">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品摘要：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="description"  cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,200)"><?php echo ($newsxiugl["description"]); ?></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">描述2：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="description"  cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,200)"><?php echo ($newsxiugl["description2"]); ?></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">描述3：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="description"  cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,200)"><?php echo ($newsxiugl["description3"]); ?></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">运费：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="number" class="input-text" min="0" max="9999" value="<?php echo ($newsxiugl["yfmoney"]); ?>" placeholder="" id="" name="yfmoney">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>运费描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($newsxiugl["yunfei"]); ?>" placeholder="" id="keywords" name="yunfei">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">商品赠送积分：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 30%;">
				<input type="number" class="input-text" min="0" max="9999" value="<?php echo ($newsxiugl["jifen"]); ?>" placeholder="" id="" name="jifen">
			</div>
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 30%;">
				<input type="number" class="input-text" min="0" max="9999" value="0" placeholder="值越大越靠前" id="ordernum" name="sort">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">商品库存：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="number" min="0" max="9999" required style="width:90%;margin-top:10px" class="input-text" value="" placeholder="请输入数字" id="" name="num">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>规格：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($newsxiugl["guige"]); ?>"  id="keywords" name="guige"  placeholder="请用|隔开">
			</div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否有优惠：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="radio"  checked onclick="$('.nopen2').hide();" value="0" id="" name="is_you">否
				<input type="radio"  onclick="$('.nopen2').show();" value="1"  id="" name="is_you">是
				<div class="nopen2" style="display:none">
					优惠的个数：<input type="number" min="0" max="9999" required style="width:40%;margin-top:10px" class="input-text" value="" placeholder="请输入数字" id="" name="you_num"><br/>
					折扣比例：<input type="number" min="0" max="99" required style="width:40%;margin-top:10px" class="input-text" value="" placeholder="请输入数字" id="" name="you_bili">
				</div>
			</div>
		</div>
		<div  id="bunew" style="display: block;">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品封面图：</label>
			<div class="tusc_box fl" style="float:left;">
				<div class="tusc_page">
					<div class="sc_btn1 fl">
						<div class="upload-area">
							<input type="file" name="fileurl" id="file_uploadgl">
						</div>
					</div>
				</div>
				<div class="sctishi fl" style="font-size: 12px"><span class="c-red">*</span>支持 jpg/png/gif/jpeg ,建议428 X 428px
				</div>
				<div id="filenamegl"></div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品细节图：</label>
			<div class="tusc_box fl" style="float:left;">
				<div class="tusc_page">
					<div class="sc_btn1 fl">
						<div class="upload-area">
							<input type="file" name="fileurl" id="file_upload">
						</div>
					</div>
				</div>
				<div class="sctishi fl" style="font-size: 12px"><span class="c-red">*</span>支持 jpg/png/gif/jpeg ,建议428 X 428px</div>
				<div id="filename"></div>
			</div>
		</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">商品详情：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<textarea id="editor"  name="text"   style="width:100%;height:400px;"><?php echo ($newsxiugl["text"]); ?></textarea>
				</div>
			</div>
		</div>
          <input type="hidden" name="is_norm" value="-1">
<!-- 		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>开启规格：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="radio"  checked onclick="$('.nopen').show();$('.open').hide()" value="-1" id="" name="is_norm">否
				<input type="radio"  onclick="$('.nopen').hide();$('.open').show()" value="1"  id="" name="is_norm">是
				<div class="open" data-type=0 style="display:none">
					<input type="button" class="btn btn-primary radius" onclick="addnorms()" value="添加规格">
					<div class="addnorm">
					</div>
					<input type="button"   onclick='setnorm()' class="btn btn-primary radius qr" style='margin-top:15px;display:none'  value='设置规格参数'>
					<div class="setnorm" style='margin-top: 10px;'>
					</div>
				</div>
				<div class="nopen" style="display:block">
					商品价格：<input type="number" min="0" max="9999" required style="width:90%;margin-top:10px" class="input-text" value="" placeholder="请输入数字" id="" name="price"><br/>
					商品库存：<input type="number" min="0" max="9999" required style="width:90%;margin-top:10px" class="input-text" value="" placeholder="请输入数字" id="" name="num">
				</div>
			</div>
		</div> -->
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> <?php if(empty($newsxiugl['id'])): ?>提交<?php else: ?>修改<?php endif; ?></button>
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
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


<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/Public/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/Public/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script charset="utf-8" src="/Public/web/js/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/Public/js/previews.js"></script>
<script type="text/javascript">
$(function(){


	$("#form-news-add").validate({
		// rules:{
		// 	gname:{
		// 		required:true,
		// 		minlength:2
		// 	},
		// 	type:{
		// 		required:true,
		// 	},
		// 	keywords:{
		// 		required:true,
		// 		minlength:2
		// 	},
		// 	description:{
		// 		required:true,
		// 		minlength:2
		// 	},
		// 	text:{
		// 		required:true,
		// 		minlength:2
		// 	},
		// },
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			var content = $("input[name='imgurlglgo[]']").val();
			var content2 = $("input[name='imgurlgl[]']").val();
			//var val=$("input[type='radio']:checked").val();
			var fir=$('#first').val();
			var sec=$('#second').val();
			var thi=$('#third').val();
			if(fir == ''){
				alert('请选择一级分类');
				return false;
			}
			if(sec == ''){
				alert('请选择二级分类');
				return false;
			}
			if(thi == ''){
				alert('请选择三级分类');
				return false;
			}
			// if(val == 1){
			// 	var dt=$('.open').attr('data-type');
			// 	if(dt != 1){
			// 		alert('请正确设置规格参数再提交');
			// 		return false;
			// 	}
			// }else{
			// 	var num=$("input[name='num']").val();
			// 	var price=$("input[name='price']").val();
			// 	if(price == ''){
			// 		alert('请填写商品价格');
			// 		return false;
			// 	}
			// 	if(num == ''){
			// 		alert('请填写商品库存');
			// 		return false;
			// 	}
			// }
			if(content==undefined){
				alert('请上传商品图片');
				return false;
			}
			if(content2==undefined){
				alert('请上传商品细节图');
				return false;
			}
			$(form).ajaxSubmit();
			var index = parent.layer.getFrameIndex(window.name);
			parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});

	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	var ue = UE.getEditor('editor');
});

var img_id_upload=new Array();//初始化数组，存储已经上传的图片名
var i=0;//初始化数组下标
var uploadLimit=5;
var uploadLimit2=1;
$(function() {
	$('#file_upload').uploadify({
//	$('.glup').uploadify({
		'auto'     : true,//关闭自动上传
		'removeTimeout' : 0.5,//文件队列上传完成0.5秒后删除
		'swf'      : '/Public/web/js/uploadify/uploadify.swf',
		'fileObjName':'fileurl',
		'uploader' : '<?php echo U("Pic/uploadify");?>',
		'method'   : 'post',          //方法，服务端可以用$_POST数组获取数据
		'buttonText' : '选择图片',//设置按钮文本
		'multi'    : true,//允许同时上传多个
		'fileTypeDesc' : 'Image Files',//只允许上传图像
		'fileTypeExts' : '*.gif; *.jpg; *.png; *.jpeg',//限制允许上传的图片后缀
		'uploadLimit' : uploadLimit,//一次最多只允许上传
		'fileSizeLimit' : '3MB',//限制上传大小
		'width' 		: '70',  //@fanboo
		'height' 		: '30',  //@fanboo
		//返回一个错误，选择文件的时候触发
		'onSelectError': function (file, errorCode, errorMsg) {
			switch (errorCode) {
				case -100:
					alert("上传的文件数量已经超出系统限制的5个文件！");
//					alert("上传的文件数量已经超出系统限制的" + $('#file_upload').uploadify('settings', 'uploadLimit') + "个文件！");
					return false;
				case -110:
					alert("文件 [" + file.name + "] 大小超出系统限制的" + $('#file_upload').uploadify('settings', 'fileSizeLimit') + "大小！");
//					alert("文件 [" + file.name + "] 大小超出系统限制的" + $('#file_upload').uploadify('settings', 'fileSizeLimit') + "大小！");
					return false;
			}
		},
		'onUploadSuccess' : function(file, data, response) { //每次成功上传后执行的回调函数，从服务端返回数据到前端
			var str = "<div style='float:left;padding-top:10px'><input name='imgurlgl[]' type='hidden'  value='"+data+"'><img class='pic' src='"+data+"'  style='margin-left:10px' width='100' height='100'><img class='delete' style='margin-top: -80px;' onclick='djxs(this)' title='点击删除' src='/Public/admin/images/tubiao_delete.png' width='14' height='14'></div>";
			$("#filename").append(str);
		}
	});
	 img_id_upload=new Array();//初始化数组，存储已经上传的图片名
//	var i=0;//初始化数组下标
	$('#file_uploadgl').uploadify({
//	$('.glup').uploadify({
		'auto'     : true,//关闭自动上传
		'removeTimeout' : 0.5,//文件队列上传完成0.5秒后删除
		'swf'      : '/Public/web/js/uploadify/uploadify.swf',
		'fileObjName':'fileurl',
		'uploader' : '<?php echo U("Pic/uploadify");?>',
		'method'   : 'post',          //方法，服务端可以用$_POST数组获取数据
		'buttonText' : '选择图片',//设置按钮文本
		'multi'    : true,//允许同时上传多个
		'fileTypeDesc' : 'Image Files',//只允许上传图像
		'fileTypeExts' : '*.gif; *.jpg; *.png; *.jpeg',//限制允许上传的图片后缀
		'uploadLimit' : uploadLimit2,//一次最多只允许上传
		'fileSizeLimit' : '3MB',//限制上传大小
		'width' 		: '70',  //@fanboo
		'height' 		: '30',  //@fanboo
		//返回一个错误，选择文件的时候触发
		'onSelectError': function (file, errorCode, errorMsg) {
			switch (errorCode) {
				case -100:
					alert("上传的文件数量已经超出系统限制的1个文件！");
//					alert("上传的文件数量已经超出系统限制的" + $('#file_upload').uploadify('settings', 'uploadLimit') + "个文件！");
					return false;
				case -110:
					alert("文件 [" + file.name + "] 大小超出系统限制的" + $('#file_uploadgl').uploadify('settings', 'fileSizeLimit') + "大小！");
//					alert("文件 [" + file.name + "] 大小超出系统限制的" + $('#file_upload').uploadify('settings', 'fileSizeLimit') + "大小！");
					return false;
			}
		},
		'onUploadSuccess' : function(file, data, response) { //每次成功上传后执行的回调函数，从服务端返回数据到前端
			var str = "<div style='float:left;padding-top:10px'><input name='imgurlglgo[]' type='hidden' value='"+data+"'><img class='pic' src='"+data+"'  style='margin-left:10px' width='100' height='100'><img class='delete' onclick='djxs2(this)' title='点击删除' style='margin-top: -80px;'  src='/Public/admin/images/tubiao_delete.png' width='14' height='14'></div>";
			$("#filenamegl").append(str);
		}
	});
});


function djxs(o){
		uploadLimit=uploadLimit+1;
		var num=$('#file_upload').uploadify('settings','uploadLimit', uploadLimit);
		$(o).parent().remove();
}
function djxs2(o){
	uploadLimit2=uploadLimit2+1;
	var num=$('#file_uploadgl').uploadify('settings','uploadLimit', uploadLimit2);
	$(o).parent().remove();
}

//生成规格名
var i=0;
function addnorms(){
	$('.open').attr('data-type',0)
	var dis=$('.qr').css('display');
	if(dis='none'){
		$('.qr').show();
	}
	var str="<div class='normparent' style='width:90%;margin-top:10px'>规格名(例如：颜色)：<input type='text' required placeholder='请填写规格名' class='input-text normname' name='normname[]' value='' >&nbsp;&nbsp;规格项：<div class='normval' style='margin-bottom:10px'><input type='hidden' class='nson' name='nson[]'><input type='text'  placeholder='请填写规格项' required style='width:20%;margin-top:5px;' name='normson[]'  class='input-text normvalue"+i+"' value=''></div> <input type='button' onclick='addvalue(this)' class='btn btn-primary radius'  value='添加规格项'>&nbsp;&nbsp;<input type='button' class='btn btn-primary radius' onclick='delnmp(this)' style='background-color:#b74635;border-color:#b74635' value='删除规格'></div>";
	i++;
	if(i>4){
		i=4;
		alert('最多只能添加四种规格名');return false;
	}
	$(".addnorm").append(str);
	
}
//删除规格名
function delnmp(o){
	i--;
	$(o).parent().remove();
	$('.open').attr('data-type',0)
	var num = $('.normparent').length;
	if(num == 0){
		$('.qr').hide();
		$('.setnorm').find('table').remove();
		i=0
	}
}

//生成规格项
function addvalue(o){
	$('.open').attr('data-type',0)
	var ins=$(o).parent().index();
	var str="<input type='hidden' class='nson' name='nson[]'><input type='text' placeholder='请填写规格项' required style='width:20%;margin-top:5px;margin-left:5px' name='normson[]'  class='input-text normvalue"+ins+"' ><span onclick='delnm(this)' style='margin-left:5px;margin-right:5px;'>删除</span>";
	$(o).prev().append(str);
}
//删除规格项
function delnm(o){
	$('.open').attr('data-type',0)
	$(o).prev().remove();
	$(o).remove();
}

//生成库存价格表
function setnorm(){
	$('.open').attr('data-type',1);
	$('.normparent').each(function(){
		var ins=$(this).index();
		$(".normvalue"+ins+"").each(function(){
			var val=$(this).val();
			$(this).prev().val(ins+'|'+val);
		})
	})
	var order=$('.normparent').length;
	var r =true;
	switch (order) {
		//规格名有1个的情况
		case (1):
			var nstr="";
			var nv=$(".normname").val();
			if(nv == ''){
				alert('规则名不能为空');
				$('.open').attr('data-type',0);
				return false;
			}
			$(".normvalue0").each(function(){
				var novl=$(this).val();
				if(novl == ''){
					alert('规则项不能为空');
					r=false;
					$('.open').attr('data-type',0);
					return false;
				}
				nstr+="<tr><td style='width:100px'>"+novl+"</td><td style='width:100px'><input type='hidden' name='allnorm[]' value="+novl+"><input name='nums[]' class='input-text' required type='number' min='0' max='9999'></td><td style='width:100px'><input name='prices[]' required class='input-text' type='number' min='0' max='9999'></td></tr>";
			})
			if(r == true){
				var allstr="<table class='table table-border table-bordered table-hover table-bg table-sort'><thead><tr><th style='width:100px'>"+nv+"</th><th>库存</th><th>价格</th></tr></thead><tbody>"+nstr+"</tbody><table>";
				$('.setnorm').html(allstr);
			}
			break;
		//规格名有2个的情况
		case (2):
			var nmth="";
			var nstr="";
			$('.normparent').each(function(){
				var nmname=$(this).find('.normname').val();
				if(nmname == ''){
					alert('您选择的规格名必须填写');
					r=false;
					$('.open').attr('data-type',0);
					return false;
				}else{
					nmth+="<th style='width:100px'>"+nmname+"</th>";
				}
			})
			$(".normvalue0").each(function(){
				var novla=$(this).val();
				if(novla == ''){
					alert('您选择的规格项必须填写');
					r=false;
					$('.open').attr('data-type',0);
					return false;
				}else{
					$(".normvalue1").each(function(){
						var novlb=$(this).val();
						if(novlb == ''){
							alert('您选择的规格项必须填写');
							r=false;
							$('.open').attr('data-type',0);
							return false;
						}else{
							nstr+="<tr><td style='width:100px'>"+novla+"</td><td style='width:100px'>"+novlb+"</td><td style='width:100px'><input type='hidden' name='allnorm[]' value="+novla+"|"+novlb+"><input class='input-text' required name='nums[]' type='number' min='0' max='9999'></td><td style='width:100px'><input name='prices[]' required class='input-text' type='number' min='0' max='9999'></td></tr>";
						}
					})
				}
			})
			if( r == true){
				var allstr="<table class='table table-border table-bordered table-hover table-bg table-sort'><thead><tr>"+nmth+"<th>库存</th><th>价格</th></tr></thead><tbody>"+nstr+"</tbody><table>";
				$('.setnorm').html(allstr);
			}
			break;
		//规格名有3个的情况
		case (3):
			var nmth="";
			var nstr="";
			$('.normparent').each(function(){
				var nmname=$(this).find('.normname').val();
				if(nmname == ''){
					alert('您选择的规格名必须填写');
					r=false;
					$('.open').attr('data-type',0);
					return false;
				}else{
					nmth+="<th width='100px'>"+nmname+"</th>";
				}
			})
			$(".normvalue0").each(function(){
				var novla=$(this).val();
				if(novla == ''){
					alert('您选择的规格项必须填写');
					r=false;
					$('.open').attr('data-type',0);
					return false;
				}else{
					$(".normvalue1").each(function(){
						var novlb=$(this).val();
						if(novlb == ''){
							alert('您选择的规格项必须填写');
							r=false;
							$('.open').attr('data-type',0);
							return false;
						}else{
							$(".normvalue2").each(function(){
								var novlc=$(this).val();
								if(novlc == ''){
									alert('您选择的规格项必须填写');
									r=false;
									$('.open').attr('data-type',0);
									return false;
								}else{	
									nstr+="<tr><td style='width:100px'>"+novla+"</td><td style='width:100px'>"+novlb+"</td><td style='width:100px'>"+novlc+"</td><td style='width:100px'><input type='hidden' name='allnorm[]' value="+novla+"|"+novlb+"|"+novlc+"><input name='nums[]' required class='input-text' type='number' min='0' max='9999'></td><td style='width:100px'><input required name='prices[]' class='input-text' type='number' min='0' max='9999'></td></tr>";
								}
							})
						}
					})
				}
			})
			if(r == true){
				var allstr="<table class='table table-border table-bordered table-hover table-bg table-sort'><thead><tr>"+nmth+"<th>库存</th><th>价格</th></tr></thead><tbody>"+nstr+"</tbody><table>";
				$('.setnorm').html(allstr);
			}			
			break;
		//规格名有4个的情况
		case (4):
			var nmth="";
			var nstr="";
			$('.normparent').each(function(){
				var nmname=$(this).find('.normname').val();
				if(nmname == ''){
					alert('您选择的规格名必须填写');
					r=false;
					$('.open').attr('data-type',0);
					return false;
				}else{
					nmth+="<th width='100px'>"+nmname+"</th>";
				}
			})
			$(".normvalue0").each(function(){
				var novla=$(this).val();
				if(novla == ''){
					alert('您选择的规格项必须填写');
					r=false;
					$('.open').attr('data-type',0);
					return false;
				}else{
					$(".normvalue1").each(function(){
						var novlb=$(this).val();
						if(novlb == ''){
							alert('您选择的规格项必须填写');
							r=false;
							$('.open').attr('data-type',0);
							return false;
						}else{
							$(".normvalue2").each(function(){
								var novlc=$(this).val();
								if(novlc == ''){
									alert('您选择的规格项必须填写');
									r=false;
									$('.open').attr('data-type',0);
									return false;
								}else{
									$(".normvalue3").each(function(){
										var novld=$(this).val();
										if(novld == ''){
											alert('您选择的规格项必须填写');
											r=false;
											$('.open').attr('data-type',0);
											return false;
										}else{
											nstr+="<tr><td style='width:100px'>"+novla+"</td><td style='width:100px'>"+novlb+"</td><td style='width:100px'>"+novlc+"</td><td style='width:100px'>"+novld+"</td><td style='width:100px'><input type='hidden' name='allnorm[]' value="+novla+"|"+novlb+"|"+novlc+"|"+novld+"><input class='input-text' name='nums[]' required  type='number' min='0' max='9999'></td><td style='width:100px'><input class='input-text' name='prices[]' required type='number' min='0' max='9999'></td></tr>";
										}	
									})
								}
							})
						}
					})
				}
			})
			if(r == true){
				var allstr="<table class='table table-border table-bordered table-hover table-bg table-sort'><thead><tr>"+nmth+"<th>库存</th><th>价格</th></tr></thead><tbody>"+nstr+"</tbody><table>";
				$('.setnorm').html(allstr);
			}			
			break;
		default:
		alert('数据异常');return false;
	}
}


function glnew(){
	$("#bunew").toggle();
	$("#wonew").toggle();
}
function nonew(){
	$("#bunew").toggle();
	$("#wonew").toggle();
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
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>