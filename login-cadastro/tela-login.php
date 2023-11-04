<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="../assets/style/imagens/icones/icon-monamour-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/css/style-login.css">
    <script src="https://kit.fontawesome.com/ca14b9e588.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <?php
        if(isset($_SESSION['nao_autenticado'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'Erro: Email e/ou Senha Inválido'
                    })
                </script>";
            unset($_SESSION['nao_autenticado']);
        }

        //Alerta de usuário cadastrado! 
        if(isset($_SESSION['status_endereco'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        text: 'Endereço Cadastrado com Sucesso! Efetue o Login para Entrar em sua Conta!'
                    })
                </script>";

            unset($_SESSION['status_endereco']); 
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
        <form method="POST" action="../assets/php/login-php.php">
            <h1>Efetue Seu Login</h1>
            <fieldset>
                <div class="container">
                    <input type="text" required name="email" id="email">
                    <label for="email">Email</label>   
                </div>
            </fieldset>
            <fieldset>
                <div class="container">
                    <i class="fas fa-eye olho-pass"></i>
                    <input type="password" required name="senha" class="senha">
                    <label for="senha">Senha</label>                    
                </div>
            </fieldset>
            <fieldset class="msg">
                <p>Não tem uma Conta?<a href="tela-cadastro.php">Faça o Cadastro</a></p>
            </fieldset>
            <fieldset>
                <input type="submit" value="Fazer Login" name="acao">
            </fieldset>
        </form>
    </section>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="../assets/js/viewPass.js"></script>
    <script src="../assets/js/inputCheck.js"></script>

</body>
</html>