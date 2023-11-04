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
    <link rel="stylesheet" href="../assets/style/css/style-paymentCredit.css">
    <script src="https://kit.fontawesome.com/ca14b9e588.js" crossorigin="anonymous"></script>
</head>
<body>
 
    <a href="tipo_pagamento.php" class="return">
        <i class="fas fa-arrow-left"></i>
    </a>

    <section>
        <form method="POST" action="../assets/php/finaliza-compra-php.php?tPag=credt">
            <h1>Efetue o Pagamento</h1>
            <!--Tipos de Cartões Aceitos-->
            <fieldset>
                <div class="container">
                    <div class="container-img">
                        <img src="../assets/style/imagens/icones/visa-logo.png" alt="">
                    </div>
                    <div class="container-img">
                        <img src="../assets/style/imagens/icones/mastercard-logo.png" alt="">
                    </div>
                </div>
            </fieldset>
            <!--CEP E ESTADO-->
            <fieldset>
                <div class="container">
                    <input type="text" required name="numCart" id="numCart">
                    <label for="numCart">Número do Cartão</label>   
                </div>
                
            </fieldset>

            <!--Data e Codigo do Cartão-->

            <fieldset class="row-content2">
                <div class="container">
                    <input type="text" required name="dataCart" id="dataCart">
                    <label for="dataCart">Data Venc. Cartão</label>   
                </div>
                <div class="container">
                    <input type="text" required name="cvc" id="cvc">
                    <label for="cvc">CVC</label>  
                </div>     
            </fieldset>

            <!--Nome do Usuário do cartão-->
            <fieldset>
                <div class="container">
                    <input type="text" required name="nomeCart" id="nomeCart">
                    <label for="nomeCart">Nome no Cartão</label>   
                </div>
            </fieldset>

            <!--CPF -> Identificação do Individuo-->
            <fieldset>
                <div class="container">
                    <input type="text" required name="cpf" id="cpf">
                    <label for="cpf">CPF</label>   
                </div>
            </fieldset>

            <fieldset>
                <input type="submit" value="Finalizar Compra" name="acao">
            </fieldset>
        </form>
    </section>


    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="../assets/js/jquery.mask.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#numCart').mask('0000.0000.0000.0000');           
            $('#dataCart').mask('00/00');
            $('#cvc').mask('000');
            $('#cpf').mask('000.000.000-00');
            
        });
    </script>

</body>
</html>