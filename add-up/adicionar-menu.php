<?php
    session_start();
    include('../assets/php/conexao.php');
    include('../assets/php/verifica-adm-php.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link rel="shortcut icon" href="../assets/style/imagens/icones/icon-monamour-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/css/style-add-up.css">
    <script src="https://kit.fontawesome.com/ca14b9e588.js" crossorigin="anonymous"></script>
    <!--Alerta-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <?php
        $sqlCateg = "SELECT * FROM TB_CATEGORIA";
        $resultCateg = mysqli_query($conn, $sqlCateg);
    ?>

    <?php
        if(isset($_SESSION['erro_nome_add'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        text: 'Produto já Existe!'
                    })
                  </script>";
            unset($_SESSION['erro_nome_add']);

        } 
        
        if (isset($_SESSION['erro_add'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'Não foi Possível Adicionar o Conteudo'
                    })
                    </script>";
            unset($_SESSION['erro_add']);

        }
    ?>

    <a href="../menus/menu.php" class="return-menu">
        <i class="fas fa-arrow-left"></i>
    </a>


    
    <form method="POST" action="../assets/php/add-php.php" enctype="multipart/form-data">
        <div class="container">
            <section class="card-container">
                <div class="opcao-categ">
                    <select name="opCateg" id="opCateg" required>
                        <option value="" disabled selected hidden>CATEGORIA</option>
                        <?php 
                            while($rowCateg = mysqli_fetch_assoc($resultCateg)): 
                        ?>
                            <option value="<?php echo $rowCateg['ID'] ?>"><?php echo $rowCateg['CATEGORIA']?></option>
                                
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="icon-indica">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="conteudo-img">
                    <div class="add-img">    
                        <label for="imagem" class="btn-img">
                            <i class="fas fa-upload"></i>
                        </label>
                        <input type="file" name="imagem" id="imagem" onchange="previewImagem()" style="display: none;">
                    </div>
                    <img src="#" alt="">
                </div>
                <div class="conteudo-text">
                    <div class="text-nome">
                        <input type="text" name="nome-prod" id="nome-prod" placeholder="Insira o Título" required>
                    </div>
                    <div class="text-desc">
                        <textarea name="descricao" id="descricao" placeholder="Insira a Descrição..." required></textarea>
                    </div>
                    <div class="text-preco">
                        <p>R$
                            <input type="number" name="preco-prod" id="preco-prod" step="any" min="1" required>
                        </p>
                    </div>
                </div>
                <div class="conteudo-buy">
                    <input type="submit" value="ADICIONAR" name="enviar">
                </div>
            </section>
            
        </div>
    </form>
    
 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function previewImagem() {
            var imagem = document.querySelector('input[name=imagem]').files[0];
            var preview = document.querySelector('img');

            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;

            }

            if(imagem) {
                reader.readAsDataURL(imagem);

            } else {
                preview.src = "";

            }
        }
    </script>
    
</body>
</html>