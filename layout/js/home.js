$(document).ready(function(){
    $('#slider').nivoSlider({
        pauseTime:5000
    });
    $('#menu').find('> li').hover(function(){
        $(this).find('ul')
        .removeClass('noJS')
        .stop(true, true).slideToggle('fast');
    });
    $("#latest").carouFredSel({
        circular: false,
        infinite: false,
        auto 	: false,
        prev	: {	
            button	: "#latest_prev",
            key		: "left"
        },
        next	: { 
            button	: "#latest_next",
            key		: "right"
        }
    });
    $("#popular").carouFredSel({
        circular: false,
        infinite: false,
        auto 	: false,
        prev	: {	
            button	: "#popular_prev",
            key		: "left"
        },
        next	: { 
            button	: "#popular_next",
            key		: "right"
        }
    });
});