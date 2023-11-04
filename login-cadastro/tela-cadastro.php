<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar-se</title>
    <link rel="shortcut icon" href="../assets/style/imagens/icones/icon-monamour-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/css/style-cadastro.css">
    <script src="https://kit.fontawesome.com/ca14b9e588.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <?php

        if(isset($_SESSION['erro_email'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'EMAIL INVÁLIDO!'
                    })
                  </script>";
            unset($_SESSION['erro_email']);
        }

        if(isset($_SESSION['data_invalida'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'DATA INVÁLIDA!'
                    })
                  </script>";
            unset($_SESSION['data_invalida']);

        } else if (isset($_SESSION['idade_invalida'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'MENOR DE IDADE!'
                    })
                  </script>";
            unset($_SESSION['idade_invalida']);

        } 

        if(isset($_SESSION['confirma_senha'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'Senhas diferentes! Tente Novamente'
                    })
                  </script>";
            unset($_SESSION['confirma_senha']);
        }

    ?>

    <a href="../index.php" class="return">
        <i class="fas fa-arrow-left"></i>
    </a>
 
    <section class="form-container">
        <div class="content-coffee">
            <section class="coffee-container">
                <div class="fumacaContainer">
                    <div id="fumaca1"></div>
                    <div id="fumaca2"></div>
                    <div id="fumaca3"></div>
                    <div id="fumaca4"></div>
                    <div id="fumaca5"></div>
                </div>
                <div class="xicContainer">
                    <div class="xicara"></div>
                    <div class="alcaxic"></div>
                </div>
            </section>
        </div>
        <form method="POST" action="../assets/php/cadastro-php.php?acao=addU">
            <h1>Efetue Seu Cadastro</h1>
            <!--Nome e Sobrenome-->
            <fieldset>
                <div class="container">                
                    <input type="text" required name="nome" id="nome">
                    <label for="nome">Nome</label>
                </div>
                <div class="container">
                    <input type="text" required name="sobreN" id="sobreN">
                    <label for="sobreN">Sobrenome</label>  
                </div>
            </fieldset>
            <!--Email-->

            <fieldset>
                <div class="container">
                    <input type="text" required name="email" id="email">
                    <label for="email">Email</label>   
                </div>
            </fieldset>

            <!--Date-->
            <fieldset>
                <div class="container">
                    <input type="number" required name="diaNasc" id="diaNasc">
                    <label for="email">Dia</label>   
                </div>
                <div class="container">
                    <input type="number" required name="mesNasc" id="mesNasc">
                    <label for="email">Mês</label>   
                </div>
                <div class="container">
                    <input type="number" required name="anoNasc" id="anoNasc">
                    <label for="email">Ano</label>   
                </div>
            </fieldset>

            <!--Senha e CfSenha-->
            <fieldset>
                <div class="container">
                    <input type="password" required name="senha" class="senha">
                    <label for="senha">Senha</label>                    
                </div>
                <div class="container">
                    <i class="fas fa-eye olho-pass"></i>
                    <input type="password" required name="confirmS" class="confirmS">
                    <label for="confirmS">Confirmar Senha</label>            
                </div>
            </fieldset>
            <fieldset>
                <div id="check">
                    <input type="checkbox" name="aceitarT" id="aceitarT">
                    <label>Concordo e Aceito os Termos de Uso</label>
                </div>
            </fieldset>
            <fieldset class="msg">
                <p>Já tem uma Conta?<a href="tela-login.php">Faça Login</a></p>
            </fieldset>
            <fieldset>
                <input type="submit" value="Criar Conta" name="acao">
            </fieldset>
            <a href="#" id="termosUso">Termos de Uso</a>
        </form>
    </section>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="../assets/js/jquery.mask.js"></script>
    <script src="../assets/js/viewPass.js"></script>
    <script src="../assets/js/inputCheck.js"></script>

    <script>
        $(document).ready(function() {
            $('#diaNasc, #mesNasc').mask('00');
            $('#anoNasc').mask('0000');
            
        });

        


    </script>

</body>
</html>