<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opção de Pagamento</title>
    <link rel="shortcut icon" href="../assets/style/imagens/icones/icon-monamour-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/css/style-tipo-pag.css">
    <script src="https://kit.fontawesome.com/ca14b9e588.js" crossorigin="anonymous"></script>
</head>
<body>

    <a href="../menus/carrinho.php" class="return-menu">
        <i class="fas fa-arrow-left"></i>
    </a>
 
    <main>
        <section>
            <h1>Selecione o Método de Pagamento</h1>

            <article class="pag-container">
                <div class="credit pag-card">
                    <div class="img-pag">
                        <img src="../assets/style/imagens/icones/credito-card_edited.png" alt="">
                    </div>
                    <div class="text-pag">
                        <p>Cartão de Crédito</p>
                        <div class="lineText"></div>
                    </div>
                    <div class="btn-next">
                        <a href="pagamentoCredit.php">Escolher Opção</a>
                    </div>
                </div>
                <div class="pix pag-card">
                    <div class="img-pag">
                        <img src="../assets/style/imagens/icones/pix-bc-logo.png" alt="">
                    </div>
                    <div class="text-pag">
                        <p>PIX <span>(5% de desconto)</span></p>
                        <div class="lineText"></div>
                    </div>
                    <div class="btn-next">
                        <a href="pagamentoPix.php">Escolher Opção</a>
                    </div>
                </div>
            </article>
        </section>
    </main>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="../assets/js/paymentAnime.js"></script>

</body>
</html>