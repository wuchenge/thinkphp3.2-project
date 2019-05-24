$(function(){
    
    $('body_bg').click(function(){
        $('html,body').css('overflow-y','auto')
        $('.body_bg,.addr_fixed,.fapiao_fixed,.qd_fixed').removeClass('into')
    })

    $('.fixed_right li').eq(0).click(function(){
        $('html,body').animate({'scrollTop':'0'},1000)
    })

    $('.phone_btn').click(function(){
        $('.menu_box').addClass('into')
    })

    $('.phone_close').click(function(){
        $('.menu_box').removeClass('into')
    })

    if($('.user_phone').length>0){
        $('.user_phone').click(function(){
            $('.userLC_cot').stop().slideToggle();
        })
    }
    
})