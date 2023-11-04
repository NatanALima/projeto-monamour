function heightAt() {
    heightDisplay = window.outerHeight;

    $('.modal').css({'height': heightDisplay});
    $('.modal-add').css({'height': heightDisplay});
    
}
$(document).ready(function() {
    $('a.href-add').on('click', function(e) {
        e.preventDefault();

        var heightDisplay = $(window).height();

        $('html, body').css('overflow-y', 'hidden');

        var href = $(this).attr('href');
        var modalName = '.modal-add';

        $('div'+modalName).css('display', 'flex');
        $('div'+modalName).css({'height': heightDisplay});
        $('section'+href).toggle('fast');

        var posModal = $(modalName).offset().top;
        $('html, body').animate({scrollTop:posModal}, 'fast');

        $('i#close').on('click', function() {
            $('div'+modalName).css('display', 'none');
            $('section'+href).css('display', 'none');
            $('html, body').css('overflow-y', 'auto');
        })

    })

    $('a.href-modal').on('click', function(e) {
        e.preventDefault();
        windowOffset = $(this).offset().top;
      

        //var widthDisplay = window.screen.width;
        var heightDisplay = $(window).height();
        //console.log(heightDisplay);

        var href = $(this).attr('href');
        //Pego a ação que será realizada a partir do "?"
        var idProdHref = href.substring(4, href.length);
        //Pego a classe da mensagem da janela modal
        var classHref = href.substring(0, 4);

        console.log(idProdHref);
        console.log(classHref);
        var modalName = '.modal';

        $('div'+modalName).css('display', 'flex');
        $('div'+modalName).css({'height': heightDisplay});
        $('section'+classHref).toggle('fast');
        

        var posModal = $(modalName).offset().top;
        $('html, body').animate({scrollTop: posModal}, 'fast');
        $('html, body').css('overflow-y', 'hidden');

        $('a.cancel').on('click', function () {
            $('div'+modalName).css('display', 'none');
            $('section'+classHref).css('display', 'none');
            $('html, body').css('overflow-y', 'auto'); 
            
            $('html, body').animate({scrollTop: windowOffset - 100}, 50);
        })
        
        $('a.confirm').on('click', function (ev) {
            ev.preventDefault();
            var hrefLink = $(this).attr('href');
            var linkDel = hrefLink.concat(idProdHref)
            window.location.href = `${linkDel}`;
        })
    })
})