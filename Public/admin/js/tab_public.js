// JavaScript Document
$(function(){
  $(".tubiao_list,.caozuo_sub").mouseover(function(){
    $(".caozuo_sub").removeClass("yincang");
  })
  
  $(".tubiao_list,.caozuo_sub").mouseout(function(){
    $(".caozuo_sub").addClass("yincang");
  })
  		
  $(".biaoge_neirong:even").css("background-color","#f3f3f3");
 
  $(".biaoge_neirong").mouseover(function(){$(this).css("background-color","#e9a968");})
  
  $(".biaoge_neirong").mouseout(function(){
	if(!$(this).children().eq(0).children().children().attr("checked")){
	  var yushu = ($(this).index())%2
	  if(yushu == 0){$(this).css("background-color","#fff");	}else{$(this).css("background-color","#f3f3f3"); }
	}
  })
    
  $(".idboxAll").click(function(){//全选,及背景换色
     if($(this).attr("checked")){
		 $(".idbox").attr("checked","checked");$(".idbox").parent().parent().parent().css("background-color","#e9a968");
	 }else{
		 $(".idbox").removeAttr('checked');$(".biaoge_neirong:even").css("background-color","#f3f3f3");$(".biaoge_neirong:odd").css("background-color","#fff");		 
	 }
  }) 
  
  $(".idbox").click(function(){	
     if($(this).attr("checked")){
		 $(this).parent().parent().parent().css("background-color","#e9a968")
	 }else{
		 var yushu = ($(this).parent().parent().parent().index())%2;if(yushu == 1){$(this).parent().parent().parent().css("background-color","#fff")}else{$(this).parent().parent().parent().css("background-color","#f3f3f3")}
	 }
  }) 
    
 //点击展开分类  		  
  //鼠标经过 点击 离开 输入框效果
  $(".input_paixu_box").click(function() {
	$(this).find(".input_paixu").css("background-color","#fff");
  });
  $(".input_paixu_box").mouseout(function() {
	$(this).find(".input_paixu").css("background-color","");
	$(this).removeClass("mouseover")
  });
  $(".input_paixu_box").mouseover(function() {
	$(this).addClass("mouseover")	
  });
  
  $(".checkbox_all").click(function(){//添加角色 全选复选框
	 if($(this).attr("checked")){
	   $(this).parents('fieldset').find('input[type=checkbox]').attr('checked',true)
	 }else{
	   $(this).parents('fieldset').find('input[type=checkbox]').removeAttr('checked');	 
	 }
  })
	
  //新增产品 鼠标点击叉号 删除图片
  $(".sctu_del").click(function() {
	$(this).parent().css("display","none");
  });
  		  
})