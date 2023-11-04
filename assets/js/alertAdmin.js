$('a.adminBuy').on('click', function(e) {
    e.preventDefault();
    Swal.fire({
        icon: 'error',
        text: 'Você é um Administrador, portanto não pode efetuar uma compra.'
    });
})