// JavaScript Document
$(function(){	
    //设置页面内容部分左侧默认位置
	var caidanLeft = $(".center_l_xiushi").offset().left;
	var mainLeft = caidanLeft+180;
	var mainLeftMax = caidanLeft+10;
	var dianjiLeft = caidanLeft+165;
	var dianjiLeftMax = caidanLeft;
	$("#center_dianji").css("left",dianjiLeft);
	$("#center_main").css("left",mainLeft);
	
	
	$(".biaoti_da").click(function(){//左侧点击显示隐藏
		$(".left_a .xiushi,.left_a ul").hide();
		$(this).next().fadeIn(800).show();
		$(this).next().next().slideDown(500).show();
	})
	
	$("#center_dianji").click(function(){//切换主要页面大小
		var a = $("#center_dianji").attr("ok")==0?1:0;
		if(a==1){				 
		  $("#center_dianji").attr("class","center_dianji2"); 
		  $("#center_main").attr("class","center_main2"); 
		  $(".center_l").addClass("yincang"); 
		  $("#center_dianji").css("left",dianjiLeftMax);
	      $("#center_main").css("left",mainLeftMax);
		}else{
		  $("#center_dianji").attr("class","center_dianji"); 
		  $("#center_main").attr("class","center_main");
		  $(".center_l").removeClass("yincang"); 
		  $("#center_dianji").css("left",dianjiLeft);
	      $("#center_main").css("left",mainLeft);
		}		
		$("#center_dianji").attr("ok",a);	
	});
	
	$(".biaoti_li").click(function(){//切换主要页面的静态页面
		//在这里显示加载gif图片，在被加载页面的结尾隐藏加载gif图片
		$(".biaoti_li").removeClass("biaoti_li_click");
		$(this).addClass("biaoti_li_click");		
		$("#center_main").attr("src",$(this).attr("html"));
		$(".Login_tubiao").removeClass("yincang");
	})
	
	//GIF加载图片定位
	$(".Login_tubiao").css({"left":($(window).width()-86)/2,"top":($(window).height()-83)/2});
	$(".center_main").load(function(){$(".Login_tubiao").addClass("yincang");}); 	
})
//公告上下滚动
function AutoScroll(obj) {
   $(obj).find("ul:first").animate({
     marginTop: "-15px"
     }, 500, function() {
     $(this).css({ marginTop:"0px" }).find("li:first").appendTo(this);
     });
   }
   $(document).ready(function() {
   var myar = setInterval('AutoScroll("#gonggao_gundong")', 2000)
   $("#gonggao_gundong").hover(function() { clearInterval(myar); }, function() { myar = setInterval('AutoScroll("#gonggao_gundong")', 2000) }); //当鼠标放上去的时候，滚动停止，鼠标离开的时候滚动开始
});