<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endereço</title>
    <link rel="shortcut icon" href="../assets/style/imagens/icones/icon-monamour-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/css/style-infoextra.css">
    <script src="https://kit.fontawesome.com/ca14b9e588.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <?php
        if(isset($_SESSION['erro_endereco'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'OPS! Algo deu Errado!'
                    })
                </script>";
            unset($_SESSION['erro_endereco']);

        }
    ?>

    <a href="tela-cadastro.php" class="return">
        <i class="fas fa-arrow-left"></i>
    </a>
 
    <section>
        <form method="POST" action="../assets/php/endereco-php.php">
            <h1>Informe seu Endereço</h1>
            <!--CEP E ESTADO-->
            <fieldset>
                <div class="container">                
                    <input type="text" required name="cep" class="cep" maxlength="9" onblur="pesquisacep(this.value);">
                    <label for="cep">CEP</label>
                </div>
                
            </fieldset>

            <!--ESTADO E CIDADE-->

            <fieldset class="row-content2">
                <div class="container">
                    <input type="text" required name="cidade" class="cidade">
                    <label for="cidade">Cidade</label>   
                </div>
                <div class="container">
                    <input type="text" required name="uf" class="uf">
                    <label for="uf">Estado</label>  
                </div>     
            </fieldset>

            <!--Bairro-->
            <fieldset>
                <div class="container">
                    <input type="text" required name="bairro" class="bairro">
                    <label for="bairro">Bairro</label>   
                </div>
            </fieldset>

            <!--Rua-->
            <fieldset>
                <div class="container">
                    <input type="text" required name="rua" class="rua">
                    <label for="rua">Rua</label>   
                </div>
            </fieldset>

            <!--Número e Complemento-->
            <fieldset class="row-content2">
                <div class="container"> 
                    <input type="text" required name="num" class="num">
                    <label for="num">Numero</label>                    
                </div>
                <div class="container"> 
                    <input type="text" required name="Cplement" class="Cplement">
                    <label for="Cplement">Complemento</label>                    
                </div>                
                
            </fieldset>
            <fieldset>
                <input type="submit" value="Finalizar Criação de Conta" name="acao">
            </fieldset>
            <a href="#" id="termosUso">Termos de Uso</a>
        </form>
    </section>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="../assets/js/jquery.mask.js"></script>
    <script src="../assets/js/cepComplet.js"></script>
    <script src="../assets/js/inputCheck.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.cep').mask('00000-000')
            
        });
    </script>

</body>
</html>