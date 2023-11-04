$(document).ready(function() {
    $('article.content section').each(function() {
        $('article.content section').css('display', 'none');

    })
    $('article.content section:eq(0)').css('display', 'block');
    $('.nav-content .action-btn button:eq(0)').addClass('active');


    /*OBS: Tanto .on('click', function () {})
        Quanto .click(function (){}) funcionaria neste caso*/
    $('.nav-content .action-btn button').on('click', function() {
        var value = this.className;
        //alert(value);

        //percorre a div.content
        $('article.content section').each(function() {
            //Verifica se há uma classe dentro dessa div igual a classe do botão clicado
            if($(this).is('.'+value)) {
                //Torna todas as divs, exceto ao da condição true, em none;
                $('article.content section').css('display','none');
                $('article.content section.'+value).css('display', 'block');
                
                $('.nav-content .action-btn button').removeClass('active');
                $('.nav-content .action-btn button.'+value).addClass('active');

                //Posso Utilizar Esta opção -> animada
                /*
                $('div.'+value).slideToggle('fast');
                */

                /*ESTILO DE CSS -> Form: width: 521px*/

            }
                
                

        })


    })
})