$('.pag-card').on('mouseenter', function() {
    var contentImg = $(this).children('.img-pag');
    var line = $(this).children('.text-pag').children('.lineText');

    if(!$(contentImg).hasClass('animateUp')) {
        if($(contentImg).hasClass('animateDown')) {
            $(contentImg).removeClass('animateDown');
        }
        $(contentImg).addClass('animateUp');
    }

    if(!$(line).hasClass('lineAnimate')) {
        if($(line).hasClass('lineReverse')) {
            $(line).removeClass('lineReverse');
        }
        $(line).addClass('lineAnimate');
    }

})

$('.pag-card').on('mouseleave', function() {
    var contentImg = $(this).children('.img-pag');
    var line = $(this).children('.text-pag').children('.lineText');

    if($(contentImg).hasClass('animateUp')) {
        $(contentImg).removeClass('animateUp').addClass('animateDown');

    }

    if($(line).hasClass('lineAnimate')) {
        $(line).removeClass('lineAnimate').addClass('lineReverse');
    }

})