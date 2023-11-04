function verificaInput(input, inputVal) {
    if(inputVal == 0) {
        input.classList.add('InputError');
        var father = input.closest('div');
        var child = father.querySelectorAll('label');

        child.forEach(function() {
            input.classList.add('labelError');

        })
    } else {
        input.classList.remove('InputError');
        var father = input.closest('div');
        var child = father.querySelectorAll('label');

        child.forEach(function() {
            input.classList.remove('labelError');
        })
        
    }
}   

var input = document.querySelectorAll('input');

input.forEach((element) => {
    if(element.getAttribute('type') != 'submit' &&
        element.getAttribute('type') != 'checkbox') { 
        var inputContent = element;

        $(element).keyup(function() {
            var inputVal = element.value.length;
            verificaInput(inputContent, inputVal);
        
        })
    }

})


$("input[type='submit']").on('click', function(e) {
    $('input').each(function() {
        input.forEach((element) => {
            if(element.getAttribute('type') != 'submit' &&
                element.getAttribute('type') != 'checkbox') { 
                var inputContent = element;
                var inputVal = element.value.length;
                verificaInput(inputContent, inputVal);
                
            }

        })
    })

    var checkBox = document.getElementById('aceitarT');  

    if(!checkBox.checked) {
        Swal.fire({
            icon: 'warning',
            text: 'Por favor, aceite os termos de uso para continuar.'
        })

    }
})