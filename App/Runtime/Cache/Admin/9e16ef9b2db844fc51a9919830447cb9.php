<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/deng/css1/css.css" rel="stylesheet" type="text/css" />
<!-- <script src="/Public/deng/js/jquery-3.2.1.js"></script>
<script src="/Public/deng/js/layer.js"></script> -->
<title>weetop网站后台管理系统WEB2.0</title>
</head>
<body>
 <div class="body">
  <div class="top">
   <div class="top1"><img src="/Public/deng/images/top1.jpg"/></div>
   <div class="top2">
    <div class="top2_1"><img src="/Public/deng/images/top1_1.jpg"></div>
    <div class="top2_2"><img src="/Public/deng/images/top2.jpg"/></div>
   </div>
  </div>

  <form name="form1" method="post">
  <div class="zhong">
   <div class="zhong1"><img src="/Public/deng/images/zhongzuo.jpg"></div>
   <div class="zhong2">
   <table width="275" border="0" cellpadding="0" cellspacing="0" class="zhong2_1">
  <tr>
    <td width="64" align="right" style="padding:5px;"><img src="/Public/deng/images/yonghuming.jpg"/></td>
    <td width="211" style="padding:5px;"><input name="username" type="text" / style="width:170px; height:18px;"></td>
  </tr>
  <tr>
    <td align="right" style="padding:5px;"><img src="/Public/deng/images/mima.jpg"/></td>
    <td style="padding:5px;"><input name="password" type="password" / style="width:170px; height:18px;"></td>
  </tr>
  <tr id='captcha-container'>
    <td align="right" style="padding:5px;">
      <img src="/Public/deng/images/yanzhengma.jpg"/>
    </td>
    <td style="padding:5px;">
      <input name="verify"  placeholder="验证码" type="text" / style="width:70px; height:18px;">&nbsp;&nbsp;
      <img id='yzm' src="/admin.php/login/verify" onclick="this.src='/admin.php/login/verify/m='+Math.random();" alt="验证码" width='80' height='27' title="点击刷新"/>
    </td>
  </tr>
</table>
   </div>
  <div class="zhong3"><input name="" id='denglu' onclick="return check();" type="submit" value=""   style="width:52px; height:52px;cursor: pointer; background:url(/Public/deng/images/login.jpg) no-repeat; border:0px;"></div>
  </div>
</form>

  <div class="bottom">后台技术支持：<a href="http://www.zjteam.com" target="_blank">帷拓科技</a></div>
 </div>
</body>
<script>
function check(){
    var username=document.form1.username.value;
    var password=document.form1.password.value;
    var verify=document.form1.verify.value;
    
    if(username == ''){
        alert('请输入用户名');
        return false;
    }
    
    if(password == ''){
        alert('请输入密码');
        return false;
    }
    
    if(verify == ''){
        alert('请输入验证码');
        return false;
    }
}
</script>
</html>