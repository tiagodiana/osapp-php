$(document).ready(function(){
    $('#checkmenu').click(function () {
        if($('#checkmenu').is(':checked')){
            $('.desktop').css({"left":"0px"})
        }else if(!$('#checkmenu').is(':checked')){
            $('.desktop').css({"left":"-280px"})
        }
    })

    $(window).resize(function(){
        if($(window).width > 1160){
            $('#checkmenu').prop('checked', false)
            $('#menu-mobile').removeClass('menu-mobile')
        }
        else if($(window.width < 1150)){
            $('#menu-mobile').addClass('menu-mobile')
        }
    })
})


