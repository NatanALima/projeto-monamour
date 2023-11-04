<?php
    session_start();
    include('../assets/php/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria</title>
    <link rel="shortcut icon" href="../assets/style/imagens/icones/icon-monamour-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/css/style-menu-footer.css">
    <link rel="stylesheet" href="../assets/style/css/style-categ.css">
    <link rel="stylesheet" href="../assets/style/css/style-modal.css">
    <!--Icones-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Alerta-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body onresize='heightAt()'>
    
    <?php
        //Consulta CATEGORIA
        $sqlCateg = "SELECT ID, 
                            CATEGORIA,
                            DATE_FORMAT(CREATED, '%d-%m-%Y %H:%i:%s') AS CREATED,
                            DATE_FORMAT(MODIFIED, '%d-%m-%Y %H:%i:%s') AS MODIFIED
                     FROM TB_CATEGORIA";
        $resultCateg = mysqli_query($conn, $sqlCateg) or die(mysqli_error($conn));

        //Edição de CATEGORIA
        if(isset($_SESSION['sucesso_editCateg'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        text: 'Categoria Editada com Sucesso!'
                    })
                </script>";
            unset($_SESSION['sucesso_editCateg']);

        } else if(isset($_SESSION['erro_editCateg'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'Não foi possível Editar a Categoria!'
                    })
                </script>";
            unset($_SESSION['erro_editCateg']);  

        }

        //Adição de CATEGORIA
        if(isset($_SESSION['sucesso_addCateg'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        text: 'Categoria Adicionada com Sucesso!'
                    })
                </script>";
            unset($_SESSION['sucesso_addCateg']);

        } else if(isset($_SESSION['erro_addCateg'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'Não foi possível Adicionar a Categoria!'
                    })
                </script>";
            unset($_SESSION['erro_addCateg']);  

        }

        //Exclusão de Categoria
        if(isset($_SESSION['sucesso_delCateg'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        text: 'Categoria Excluída com Sucesso!'
                    })
                </script>";
            unset($_SESSION['sucesso_delCateg']);

        } else if(isset($_SESSION['erro_delCateg'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'Não foi possível Excluir a Categoria!'
                    })
                </script>";
            unset($_SESSION['erro_delCateg']);  

        }

    ?>
 
    <?php
        //Estou pegando a aba de Navegação 
        include('header.php');
    ?>

    <div class="modal-add" style="display: none;">  
        <section class="msg-add" style="display: none;">
            <i class="fa-solid fa-x" id="close"></i>
            <form method="POST" action="../assets/php/categoria-php.php?acao=ctgAdd">
                <article class="info-categ">
                    <label for="categ"> ADICIONAR CATEGORIA</label>
                    <input type="text" name="addCateg" class="addCateg" required>
                    <div class="btn-func">
                        <input type="submit" class="btnSub" value="Confirmar">
                    </div>
                </article>
            </form>
        </section>
    </div>
    <div class="modal" style="display: none;">
        <section class="msg" style="display: none;">
            <p>Você tem certeza que deseja excluir esta Categoria?</p>
            <span>
                <a href="#cancel" class="cancel">Cancelar</a>
                <a href="../assets/php/categoria-php.php" class="confirm">Confirmar</a>
            </span>
        </section>
    </div>

    <main>
        
    

        <?php 
            while ($rowCateg = mysqli_fetch_assoc($resultCateg)): 
                if($rowCateg['MODIFIED'] == NULL) {
                    $dateMod = $rowCateg['CREATED'];

                } else {
                    $dateMod = $rowCateg['MODIFIED'];

                }
        ?>
            <section class="categ-container">
                <form method="POST" action="../assets/php/categoria-php.php?acao=ctgE&id=<?php echo $rowCateg['ID']?>">
                    <article class="top-categ">
                        <p><strong>Última Edição em:</strong> <?php echo $dateMod; ?></p>
                        <span class="del-icon">
                            <a href=".msg?acao=ctgDel&id=<?php echo $rowCateg['ID']?>" class="href-modal"><i class="fas fa-trash"></i></a>
                        </span>
                    </article>
                    <article class="info-categ">
                        <label for="categ">CATEGORIA</label>
                        <input type="text" name="categ" class="categ" value="<?php echo $rowCateg['CATEGORIA']; ?>" required disabled>
                        <div class="btn-func">
                            <input type="submit" class="btnSub" value="Confirmar" style="display: none;">
                            <button type="button" class="btnEdit">Editar</button>
                        </div>
                    </article>
                </form>
            </section>
        <?php endwhile; ?>
        <span class="add-categ">
            <a href=".msg-add" class="href-add"><i class="fa-solid fa-plus"></i></a>
        </span>
    </main>

    <footer>
        <div class="footer-info" id="href-contact">
            
            <div class="footer-info-contact">
                <h2>Contate-nos em caso de Dúvidas</h2>
                <p id="phone">
                    <i class="fas fa-phone-alt"></i>
                    (14)996047286
                </p>
                <p id="footer-socialmedia">
                    <a href="">
                        <i class="fab fa-facebook"></i> 
                    </a>
                    <a href="">
                        <i class="fab fa-instagram"></i> 
                    </a>
                    <a href="">
                        <i class="fab fa-twitter"></i> 
                    </a>
                </p>
            </div>
        </div>
 
        <hr>

        <div class="final-info">
            <p>Todos os Direitos reservados à padaria Monamour</p>
            <p>Desenvolvido por: <span id="color-name">NT</span>erprise</p>
        </div>
    </footer>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="../assets/js/navBar-responsive.js"></script>
    <script src="../assets/js/btnEditCateg-jquery.js"></script>
    <script src="../assets/js/sessionAnimInpage-jquery.js"></script>
    <script src="../assets/js/modal-jquery.js"></script>
    <script src="../assets/js/alertAdmin.js"></script>


</body>
</html>