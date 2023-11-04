<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
    <link rel="shortcut icon" href="../assets/style/imagens/icones/icon-monamour-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/css/style-paymentPix.css">
    <script src="https://kit.fontawesome.com/ca14b9e588.js" crossorigin="anonymous"></script>
</head>
<body>
 
    <a href="tipo_pagamento.php" class="return">
        <i class="fas fa-arrow-left"></i>
    </a>

    <main>
        <section>
            <form method="POST" action="../assets/php/finaliza-compra-php.php?tPag=pix">
                <div class="img-qrcode">
                    <img src="../assets/style/imagens/pix/qrcode_pix.png" alt="">
                </div>

                <div class="content-input">
                    <input type="submit" value="Pagar PIX">
                </div>
            </form>
        </section>
    </main>

</body>
</html>