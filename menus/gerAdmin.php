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
    <title>Gerenciamento de Administradores</title>
    <link rel="shortcut icon" href="../assets/style/imagens/icones/icon-monamour-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/css/style-menu-footer.css">
    <link rel="stylesheet" href="../assets/style/css/style-gerAdmin.css">
    <link rel="stylesheet" href="../assets/style/css/style-modal.css">
    <!--Icones-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Alerta-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body onresize='heightAt()'>

    <?php
        $sqlAcess = "SELECT * FROM TB_USER
                     WHERE ACESSO = 2";
        $resultAcess = mysqli_query($conn, $sqlAcess) or die(mysqli_error($conn));

    ?>

    <?php
        if(isset($_SESSION['sucesso_edtAcss'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        text: 'Nível de Acesso Alterado com Sucesso!'
                    })
                </script>";
            unset($_SESSION['sucesso_edtAcss']);

        } else if(isset($_SESSION['erro_edtAcss'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'Não foi possível Alterar o Nível de Acesso!'
                    })
                </script>";
            unset($_SESSION['erro_edtAcss']); 
        }

    ?>
 
    <?php
        //Estou pegando a aba de Navegação 
        include('header.php');
    ?>

    <main>
        <div class="modal" style="display: none;">
            <section class="msg" style="display: none;">
                <p>Você tem certeza que deseja Alterar o nível de Acesso?</p>
                <p>(Essa ação <strong>NÃO PODERÁ SER DESFEITA</strong>)</p>
                <span>
                    <a href="#cancel" class="cancel">Cancelar</a>
                    <a href="../assets/php/altNivAcess-php.php" class="confirm">Confirmar</a>
                </span>
            </section>
        </div>
        <h1>Administradores</h1>
        <?php 
            if(mysqli_num_rows($resultAcess) != 0):
                while($rowAcess = mysqli_fetch_assoc($resultAcess)):
        ?>
            <section>
                <article class="info-admin">
                    <p class="nomeinfo">Nome</p>
                    <p class="info"><?php echo $rowAcess['NOME'] ?></p>
                    <p class="nomeinfo">Email</p>
                    <p class="info"><?php echo $rowAcess['EMAIL'] ?></</p>
                    <p class="nomeinfo">Nível de Acesso</p>
                    <p class="info"><?php echo $rowAcess['ACESSO'] ?></</p>
                </article>
                <div class="alt-container">
                    <a href=".msg?acao=acsEdt&id=<?php echo $rowAcess['ID']?>" class="href-modal">Alterar nível de Acesso</a>
                </div>
            </section>
        <?php
                endwhile;
            else:
        ?>
            <p>Não há Administradores Disponíveis</p>
        <?php
            endif;
        ?>

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
    <script src="../assets/js/sessionAnimInpage-jquery.js"></script>
    <script src="../assets/js/modal-jquery.js"></script>
    <script src="../assets/js/alertAdmin.js"></script>

</body>
</html>