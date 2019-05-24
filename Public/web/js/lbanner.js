/* banner的初始化及事件绑定 */
function lbanner(){
	var curNum = 0;
	var wwidth = $(window).width();
	var abImg = $("#lbanner .lb_wrap li");
	var oDot = $("#lbanner .dot");
	var oprev = $("#lbanner .prev");
	var onext = $("#lbanner .next");
	var total = abImg.length;

	
	/* 初始化 */
	abImg.each(function() {
        var ssrc = $(this).attr("src");
		$(this).css("background-image","url("+ ssrc+")");
    });	
	var sli = "";
	for(var i =0; i<total; i++){
		sli += "<li></li>";
	}
	oDot.html(sli);
	oDot.css("width", total*20+"px");
	oDot.css("left",parseInt((wwidth-total*20)/2)+"px");
	
	aDotLi = oDot.find("li");
	aDotLi.eq(curNum).addClass("active");
	abImg.eq(curNum).show();
	
	/* 绑定点击事件 */
	aDotLi.each(function(index, element) {
		var _this = $(this);
        _this.click(function(){
			curNum = $(this).index();
			$(this).addClass("active").siblings().removeClass("active");
			abImg.eq(curNum).show().siblings().hide();
		}) 
    });
	
	/* 定时轮播 */
	var timer=window.setInterval(timerFun,2000);
	
	/* 移入与移出 */
	$("#lbanner").mouseover( function(){
		window.clearInterval(timer);
	});
	$("#lbanner").mouseout( function(){
		timer = window.setInterval(timerFun, 2000);
	});

	/* 绑定切换事件 */
	oprev.click(function(){
		timerFun(-1);

	});

	onext.click(function(){
		timerFun(1);
	});

	/* 切换图片 */
	function timerFun(pnum){
		if ( pnum < 0 ){
			curNum > 0  ? curNum-- : curNum = abImg.length-1;
		} else{
			curNum < abImg.length-1 ? curNum++ : curNum = 0;
		}
		aDotLi.eq(curNum).addClass("active").siblings().removeClass("active");
		abImg.eq(curNum).show().siblings().hide();
	}
}