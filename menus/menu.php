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
    <title>Cardapio</title>
    <link rel="shortcut icon" href="../assets/style/imagens/icones/icon-monamour-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/css/style-menu-footer.css">
    <link rel="stylesheet" href="../assets/style/css/style-cardapio.css">
    <link rel="stylesheet" href="../assets/style/css/style-modal.css">
    <!--Icones-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Alerta-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body onresize='heightAt()'>

    <?php
        //Efetuando todas as consultas para todas as Categorias...
        //Efetuando Consulta para Categoria;
        

        $sqlCateg = "SELECT * FROM TB_CATEGORIA";
        $resultCateg = mysqli_query($conn, $sqlCateg);

        $sqlCategPesq = "SELECT * FROM TB_CATEGORIA";
        $resultCategPesq = mysqli_query($conn, $sqlCategPesq);


        /*Arrays para remover acentos e espaçamentos futuramente*/
        $acent = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú', ' ');
        $remAcent = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', '_');

    ?>
    
    <?php
        //Aviso relacionado ao ADD de Produtos -> Realizado pelo ADMIN
        if(isset($_SESSION['sucesso_add'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        text: 'Conteudo Inserido com Sucesso'
                    })
                    </script>";
            unset($_SESSION['sucesso_add']);

        }        

        //Aviso Sucesso Compra 
        if(isset($_SESSION['sucesso_compra'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        text: 'Compra Efetuada com Sucesso! Para vê-la, entre em seu Perfil!'
                    })
                    </script>";
            unset($_SESSION['sucesso_compra']);

        } else if (isset($_SESSION['erro_compra'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'Compra Não efetuada! Tente novamente'
                    })
                    </script>";
            unset($_SESSION['erro_compra']);
        }

        //Aviso Sucesso de Edição
        if(isset($_SESSION['sucesso_edit'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        text: 'Conteudo Alterado com Sucesso!'
                    })
                    </script>";
            unset($_SESSION['sucesso_edit']);

        } 

        //Aviso Delete
        if(isset($_SESSION['delete_aviso'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        text: 'Produto Excluído com Sucesso!'
                    })
                    </script>";
            unset($_SESSION['delete_aviso']);

        } else if (isset($_SESSION['erro_del_menu'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'Não foi possível Excluir o Produto!'
                    })
                    </script>";
            unset($_SESSION['erro_del_menu']);
        } 


    ?>

    <?php
        //Estou pegando a aba de Navegação 
        include('header.php');
    ?>

    <!--Botão de adicionar conteudo -> aparece sempre no canto da tela-->
    <!--Exclusivo apenas para o Admin-->
    <?php
        if(isset($_SESSION['user']) && $_SESSION['acesso'] >= 2):
    ?>
        <a href="../add-up/adicionar-menu.php" class="btn-add">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" class="icon-add"></path></svg>
        </a>
    <?php
        endif;
    ?>

    <main>
        <div class="modal" style="display: none;">
            <section class="msg" style="display: none;">
                <p>Você tem certeza que deseja excluir o Produto?</p>
                <span>
                    <a href="#cancel" class="cancel">Cancelar</a>
                    <a href="../assets/php/delete-menu-php.php" class="confirm">Confirmar</a>
                </span>
            </section>
        </div>
        <div class="nav-categ">
            <h3>Navegue pelas Categorias clicando abaixo</h3>
            <nav>
                <ul>
                    <?php 
                        while($rowCategPesq = mysqli_fetch_assoc($resultCategPesq)): 
                            $idCateg = str_replace($acent, $remAcent, $rowCategPesq['CATEGORIA']);    
                    ?>
                        
                        <li class="inpage"><a href="#href-<?php echo $idCateg ?>"><?php echo $rowCategPesq['CATEGORIA'] ?></a></li> 
                    <?php endwhile; ?>
                        <?php
                            if(isset($_SESSION['user']) && $_SESSION['acesso'] >= 2):
                        ?>
                            <li><a href="categoria.php" id="edit-categ"><i class="fa-solid fa-pencil"></i></a></li>
                        <?php endif; ?>
                </ul>
            </nav>
        </div>
        <?php 
            while($rowCateg = mysqli_fetch_assoc($resultCateg)):
                $nomeCateg = $rowCateg['CATEGORIA'];
                $idCateg = str_replace($acent, $remAcent, $rowCateg['CATEGORIA']);

                $sqlP = "SELECT  TB_PRODUTOS.ID,
                                    TB_PRODUTOS.IMG,
                                    TB_CATEGORIA.CATEGORIA,
                                    TB_PRODUTOS.NOME_PROD,
                                    TB_PRODUTOS.DESCRICAO,
                                    TB_PRODUTOS.PRECO,
                                    TB_PRODUTOS.CREATED,
                                    TB_PRODUTOS.MODIFIED
                            FROM TB_PRODUTOS
                            INNER JOIN TB_CATEGORIA ON TB_CATEGORIA.ID = TB_PRODUTOS.CATEG
                            WHERE CATEGORIA = '$nomeCateg'";
                $resultP = mysqli_query($conn, $sqlP);
        ?>
            
            <div id="href-<?php echo $idCateg ?>">
                <div class="container">
                    <h1><?php echo $rowCateg['CATEGORIA'] ?></h1>
                    <div class="card-container">
                        <?php
                            while($rowP = mysqli_fetch_assoc($resultP)):
                        ?>
                            <section class="card-content">
                                <?php
                                    if(isset($_SESSION['user']) && $_SESSION['acesso'] >= 2):
                                ?>
                                    <div class="conteudo-btn">
                                        <a href="../add-up/update-menu.php?acao=visu&id=<?php echo $rowP['ID']?>">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <a href=".msg?acao=del&id=<?php echo $rowP['ID']?>" class="href-modal">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                <?php
                                    endif;
                                ?>
                                <div class="conteudo-img">
                                    <img src="../assets/style/imagens/menu/<?php echo $rowP['IMG'] ?>" alt="img">
                                </div>
                                <div class="conteudo-text">
                                    <div class="text-nome">
                                        <p><?php echo $rowP['NOME_PROD'] ?></p>
                                    </div>
                                    <div class="text-desc">
                                        <p><?php echo $rowP['DESCRICAO'] ?></p>
                                    </div>
                                    <div class="text-preco">
                                        <p>R$<?php echo $rowP['PRECO'] ?></p>
                                    </div>
                                </div>
                                <div class="conteudo-buy">
                                    <?php
                                        if(isset($_SESSION['user']) && $_SESSION['acesso'] < 2):
                                    ?>
                                        <a href="carrinho.php?acao=add&id=<?php echo $rowP['ID'] ?>">COMPRAR</a>
                                    <?php
                                        elseif(isset($_SESSION['acesso']) && $_SESSION['acesso'] >= 2):
                                    ?>
                                        <a href="" class="adminBuy">COMPRAR</a>
                                    <?php
                                        else:
                                    ?>
                                        <a href="../login-cadastro/tela-login.php">COMPRAR</a>
                                    <?php
                                        endif;
                                    ?>
                                </div>
                            </section>
                        
                        <?php
                            endwhile;
                        ?>
                        <!--Exclusivo para ADD-->
                        <?php
                            if(isset($_SESSION['user']) && $_SESSION['acesso'] >= 2):
                        ?>
                            <section class="card-content add-card">
                                <a href="../add-up/adicionar-menu.php" class="btn-add">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <div class="opacity-bg"></div>
                                <div class="conteudo-img">
                                    <img src="#" alt="">
                                </div>
                                <div class="conteudo-text">
                                    <div class="text-nome">
                                        <p>Lorem Ipsum Dolor, sit</p>
                                    </div>
                                    <div class="text-desc">
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui.</p>
                                    </div>
                                    <div class="text-preco">
                                        <p>R$0.00</p>
                                    </div>
                                </div>
                                <div class="conteudo-buy">
                                    <a href="#">COMPRAR</a>
                                </div>
                            </section>
                        <?php
                            endif;
                        ?>
                    </div>
                
                </div>
            </div>
        <?php endwhile; ?>
        
        <div class="return-container">
            <i class="fas fa-angle-up fa-2x" id="back-to-top"></i>
        </div>

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
    <script>
        var button = $("#back-to-top");

        //Função para ocultar ou não o botão de retornar ao topo MENU
        $('.return-container').css('display', 'none');
        $(window).on('scroll', function() {
            if($(window).scrollTop() > 0) {
                $('.return-container').css('display', 'block');

            } else {
                $('.return-container').css('display', 'none');  
            }
  
        })

        //Retorna no topo da tela
        button.click(function() {
            $('html, body').animate({scrollTop:0}, 'fast');
        })

    </script>

</body>
</html>