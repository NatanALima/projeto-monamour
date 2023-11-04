document.querySelector('.olho-pass').addEventListener('mousedown', function() {
    document.querySelector('.senha').type = 'text';
    //Verifico se existe o input de Confirmar Senha
    //OBS: Essa verificação é feita para que não exiba erro algum ao pressionar o olho na tela de login que não possui o campo de confimar senha;
    if(document.querySelector('.confirmS') != null) {
        document.querySelector('.confirmS').type = 'text';
    }
    

});

document.querySelector('.olho-pass').addEventListener('mouseup', function() {
    document.querySelector('.senha').type = 'password';
    if(document.querySelector('.confirmS') != null) {
        document.querySelector('.confirmS').type = 'password';
    }
    
});

// Para que o password não fique exposto apos mover a imagem.
document.querySelector('.olho-pass').addEventListener('mousemove', function() {
    document.querySelector('.senha').type = 'password';
    if(document.querySelector('.confirmS') != null) {
        document.querySelector('.confirmS').type = 'password';
    }
    
});