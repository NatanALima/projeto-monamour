<?php

    session_start();
    include('../assets/php/conexao.php');
    include('../assets/php/verifica-adm-php.php');

    if(isset($_GET['acao'])) {
        if($_GET['acao'] == 'visu') {
            $id = $_GET['id'];
            $sql = "SELECT  TB_PRODUTOS.ID,
                            TB_PRODUTOS.IMG,
                            TB_CATEGORIA.ID AS ID_CATEG,
                            TB_CATEGORIA.CATEGORIA,
                            TB_PRODUTOS.NOME_PROD,
                            TB_PRODUTOS.DESCRICAO,
                            TB_PRODUTOS.PRECO,
                            TB_PRODUTOS.CREATED,
                            TB_PRODUTOS.MODIFIED
                    FROM TB_PRODUTOS
                    INNER JOIN TB_CATEGORIA ON TB_CATEGORIA.ID = TB_PRODUTOS.CATEG
                    WHERE TB_PRODUTOS.ID = '$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $sqlCateg = "SELECT * FROM TB_CATEGORIA";
            $resultCateg = mysqli_query($conn, $sqlCateg);


        }
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="shortcut icon" href="../assets/style/imagens/icones/icon-monamour-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/css/style-add-up.css">
    <script src="https://kit.fontawesome.com/ca14b9e588.js" crossorigin="anonymous"></script>
    <!--Alerta-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <?php
        if (isset($_SESSION['existe_edit'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        text: 'Produto já Existe!'
                    })
                  </script>";
            unset($_SESSION['existe_edit']);
        }
    ?>

    <a href="../menus/menu.php" class="return-menu">
        <i class="fas fa-arrow-left"></i>
    </a>


    
    <form method="POST" action="../assets/php/edit-php.php" enctype="multipart/form-data">
        <div class="container">
            <section class="card-container">
                <div class="opcao-categ">
                    <select name="opCateg" id="opCateg">
                        <option value="<?php echo $row['ID_CATEG']?>"><?php echo $row['CATEGORIA']?></option>
                        <?php 
                            while($rowCateg = mysqli_fetch_assoc($resultCateg)): 
                                if($row['ID_CATEG'] != $rowCateg['ID']):
                        ?>
                                <option value="<?php echo $rowCateg['ID'] ?>"><?php echo $rowCateg['CATEGORIA'] ?></option>
                        <?php
                                endif; 
                            endwhile; 
                        
                        ?>
                    </select>
                </div>
                <div class="icon-indica">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="conteudo-img">
                    <div class="add-img">    
                        <label for="imagem" class="btn-img">
                            <i class="fas fa-upload"></i>
                        </label>
                        <input type="file" name="imagem" id="imagem" onchange="previewImagem()" style="display: none;">
                    </div>
                    <img src="../assets/style/imagens/menu/<?php echo $row['IMG'] ?>" alt="imagem">
                </div>
                <div class="conteudo-text">
                    <!--Inputs hidden-->
                    <input type="hidden" name="id" id="id" value="<?php echo $row['ID']?>">
                    <input type="hidden" name="imgB" id="imgB" value="<?php echo $row['IMG']?>">

                    <!---->
                    <div class="text-nome">
                        <input type="text" name="nome-prod" id="nome-prod" value="<?php echo $row['NOME_PROD'] ?>" placeholder="Insira o Título" required>
                    </div>
                    <div class="text-desc">
                        <textarea name="descricao" id="descricao" required><?php echo $row['DESCRICAO'] ?></textarea>
                    </div>
                    <div class="text-preco">
                        <p>R$
                            <input type="text" name="preco-prod" id="preco-prod" value="<?php echo $row['PRECO'] ?>" step="any" min="1" required>
                        </p>
                    </div>
                </div>
                <div class="conteudo-buy">
                    <input type="submit" value="Finalizar Edição" name="editar">
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