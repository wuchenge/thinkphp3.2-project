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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 品牌管理 <span class="c-gray en">&gt;</span> 品牌添加 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<article class="page-container">
	<form class="form form-horizontal" name="form1" id="form-news-add" enctype='multipart/form-data' method="post" action="<?php echo U('brand/add');?>" >
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>品牌标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($newsxiugl["title"]); ?>" placeholder="" id="title" name="title">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 30%;">
				<input type="number" class="input-text" min="0" max="999" value="0" id="ordernum" name="sort" width="200px"><span class="c-red">值越大越靠前</span>
			</div>
			<label class="form-label col-xs-4 col-sm-2">添加时间：</label>
            <div class="formControls col-xs-8 col-sm-9" style="width: 30%;">
                <input type="text" onfocus="WdatePicker()"  name="addtime"  class="input-text Wdate" style="width:120px;" placeholder="添加时间" autoComplete="off">
            </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">价格：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 30%;">
				<input type="number" class="input-text" min="0"  value="" id="ordernum" name="price" width="200px">
			</div>
			<label class="form-label col-xs-4 col-sm-2">原价：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 30%;">
				<input type="number" class="input-text" min="0"  value="<?php echo ($newsxiugl["yprice"]); ?>" id="ordernum" name="yprice" width="200px">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">关键词keywords：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($newsxiugl["keywords"]); ?>" placeholder="" id="keywords" name="keywords">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="description"  cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,200)"><?php echo ($newsxiugl["description"]); ?></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">描述2：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="description2"  cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,200)"><?php echo ($newsxiugl["description2"]); ?></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">描述3：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="description3"  cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,200)"><?php echo ($newsxiugl["description3"]); ?></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
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
				<div class="sctishi fl" style="font-size: 12px"><span class="c-red">*</span>支持 jpg/png/gif/jpeg ,建议854 X 434px
				</div>
				<div id="filenamegl"></div>
			</div>
		</div>
        <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>细节图：</label>
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
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>详情：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<textarea id="editor" name="text"   style="width:100%;height:400px;"><?php echo ($newsxiugl["text"]); ?></textarea>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<input id="newid" name="newid" hidden value="<?php echo ($newsxiugl["id"]); ?>" />
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
<script type="text/javascript" src="/Public/js/previews.js"></script>
<script charset="utf-8" src="/Public/web/js/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/Public/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script>
    $('#yjx').load(function(){
        $('#yjx').css('padding-bottom','5px')
    })
    function tx(o){
        var type=$(o).val();
        if(type==3){
            $(".tx").parent("span").show()
            $(".tx").html("1920 X 600");
        }else if(type==4){
            $(".tx").parent("span").show()
            $(".tx").html("960 X 600");
        }else{
            $(".tx").parent("span").hide()
        }
    }
</script>
<script type="text/javascript">
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
$(function(){
	var ue = UE.getEditor('editor');
	$("#form-news-add").validate({
		rules:{
			title:{
				required:true,
				minlength:2
			},
			cate_id:{
				required:true
			},
			keywords:{
				required:true,
				minlength:2
			},
			description:{
				required:true,
				minlength:2
			}
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			var title = $.trim($("input[name='title']").val());
			var cate_id = $("select[name='cate_id']").val();
			var keywords = $.trim($("input[name='keywords']").val());
			var description = $.trim(document.form1.description.value);
			if(title == ''){
				alert('请输入品牌标题');
				return false;
			}
			if(cate_id == ''){
				alert('请选择品牌分类');
				return false;
			}
			if(keywords == ''){
				alert('请输入品牌关键词');
				return false;
			}
			if(description==''){
				alert('请输入品牌摘要');
				return false;
			}
			if(!UE.getEditor('editor').hasContents()){
				alert("请输入品牌内容");
				return false;
			}
			$(form).ajaxSubmit();
			var index = parent.layer.getFrameIndex(window.name);
			parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
	
});
function djxs(o){
		uploadLimit=uploadLimit+1;
		var num=$('#file_upload').uploadify('settings','uploadLimit', uploadLimit);
		$(o).parent().remove();
}
function djxs2(o){
		uploadLimit=uploadLimit+1;
		var num=$('#file_upload1').uploadify('settings','uploadLimit', uploadLimit);
		$(o).parent().remove();
}
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>