$(document).ready(function() {
    $('.btnEdit').on('click', function(e) {
        var btnTarget = e.target;
        var containerContent = btnTarget.closest('section');
        var InputText = containerContent.querySelector('input.categ');
        var btnSub = containerContent.querySelector('input.btnSub');

        if($(this).text() == 'Editar') {
            $(this).text('Cancelar');
            $(this).css('background-color', '#A81010');


        } else {
            $(this).text('Editar');
            $(this).css('background-color', '#196670');  
            
        }

        $(btnSub).toggle();

        if($(InputText).attr('disabled')) {       
            $(InputText).attr('disabled', false);

        } else {
            $(InputText).attr('disabled', true);

        }
        

        
    })
})