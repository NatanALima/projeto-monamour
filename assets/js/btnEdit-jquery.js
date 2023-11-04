//Executa a função apenas quando todo o documento estiver carregado
$(document).ready(function() {
    //Executa a função quando o botão de alterar informações for clicado
    $('.divOpEdit button.opEdit').on('click', function() {
        //Encontro o elemento desejado ('pai') -> Section
        var classParent = this.closest('section');
        var className = classParent.className;

        /*Ideia iniciada -> Pega a posição do espaço para separar as classes; 
        depois eu elimino a outra classe e efetuo a verificação*/
        var pos = className.indexOf(' ');
        //Apago a segunda classe presente no Elemento
        var classNameEdit = className.substring(0, pos);
        //Coloco o ponto antes para se comportar como classe
        classNameEdit = '.'+classNameEdit;
        console.log(classNameEdit);
        
        
        //Verfico se o texto do botão editar $(this) é igual a "Editar"
        //Caso a condição seja verdadeira, ele altera o texto para "Cancelar" e também altera a cor de fundo
        //Caso a condição seja falsa, ou seja, o texto não seja Editar, ele retorna o estilo para o padrão
        if($(this).text() == 'Editar') {
            $(this).text('Cancelar');
            $(this).css('background-color', '#A81010');

        } else {
            $(this).text('Editar');
            $(this).css('background-color', '#362A70');
        }
        //Percorro todos os inputs dentro da classe em questão
        $(`section${classNameEdit} .containerInput input`).each(function() {
            //Pegando os inputs a cada repetição, eu verifico se eles possuem o atributo "disabled"
            //Caso os inputs possuam, esse atributo é definido como false e o botão de envio de formulário assim como os inputs entram a disposição do usuário
            //Verifica se os inputs estão desabilitados
            if($(this).attr('disabled')) {
                $(this).attr('disabled', false);
                $('.olho-pass').css('cursor', 'pointer');           
                //$(`section${classParentName} .btn-edit`).css('display', 'block');

            } else if (!$(this).attr('disabled')) {
                $(this).attr('disabled', true);
                $('.olho-pass').css('cursor', 'auto');
                //$(`section${classParentName} .btn-edit`).css('display', 'none');

            }

        });

        //Ativa e Desativa os inputs de edição (enviar para o banco de dados)
        $(`section${classNameEdit} .btn-edit`).toggle();

        //Desabilito o EMAIL
        if(!$('section.content-dadosUser .containerInput input:eq(2)').attr('disabled')) {
            $('.containerInput input:eq(2)').attr('disabled', true);
        }

        //A partir desta condição eu impeço o input de Data de Nascimento de ser desabilitado; 
        if(!$('section.content-dadosUser .containerInput input:eq(3)').attr('disabled')) {
            $('.containerInput input:eq(3)').attr('disabled', true);
        }
        

        
    });

})
