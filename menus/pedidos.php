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
    <title>Pedidos</title>
    <link rel="shortcut icon" href="../assets/style/imagens/icones/icon-monamour-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/css/style-menu-footer.css">
    <link rel="stylesheet" href="../assets/style/css/style-pedidos.css">
    <script src="https://kit.fontawesome.com/ca14b9e588.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--Alerta-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <?php
        /*Consulta para Pedidos Pendentes*/
        $sqlPend = "SELECT TB_COMPRA.ID,
                           TB_USER.NOME,
                           TB_USER.SOBRENOME,
                           TB_ENDERECO.BAIRRO,
                           TB_ENDERECO.RUA,
                           TB_ENDERECO.NUMERO,
                           TB_ENDERECO.COMPLEMENTO,
                           DATE_FORMAT(TB_COMPRA.DATA_COMPRA, '%d-%m-%Y %H:%i:%s') AS DATA_COMPRA
                    FROM TB_COMPRA
                    INNER JOIN TB_ENDERECO ON TB_ENDERECO.ID = TB_COMPRA.ID_ENDERECO
                    INNER JOIN TB_USER ON TB_USER.ID = TB_ENDERECO.ID_USER
                    WHERE STATUS_PEDIDO = 'ABERTO'
                    ORDER BY TB_COMPRA.DATA_COMPRA DESC";
        $resultPend = mysqli_query($conn, $sqlPend) or die (mysqli_error($conn)); 


        /*Consulta para Pedidos Concluidos*/
        $sqlConcl = "SELECT TB_COMPRA.ID,
                            TB_USER.NOME,
                            TB_USER.SOBRENOME,
                            TB_ENDERECO.BAIRRO,
                            TB_ENDERECO.RUA,
                            TB_ENDERECO.NUMERO,
                            TB_ENDERECO.COMPLEMENTO,
                            DATE_FORMAT(TB_COMPRA.DATA_COMPRA, '%d-%m-%Y %H:%i:%s') AS DATA_COMPRA
                    FROM TB_COMPRA
                    INNER JOIN TB_ENDERECO ON TB_ENDERECO.ID = TB_COMPRA.ID_ENDERECO
                    INNER JOIN TB_USER ON TB_USER.ID = TB_ENDERECO.ID_USER
                    WHERE STATUS_PEDIDO != 'ABERTO'
                    ORDER BY TB_COMPRA.DATA_COMPRA DESC";
        $resultConcl = mysqli_query($conn, $sqlConcl) or die (mysqli_error($conn));

    ?>

    <?php
        //Alerta para Alteração de Pedido
        if(isset($_SESSION['sucesso_pedido'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'STATUS DO PEDIDO',
                        text: 'Pedido alterado com sucesso',
                    })
                    
                  </script>";
            unset($_SESSION['sucesso_pedido']);

        } else if (isset($_SESSION['erro_pedido'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'STATUS DO PEDIDO',
                        text: 'Não foi possível alterar o Status do Pedido',
                    })
                  </script>";
            unset($_SESSION['erro_pedido']);

        }

    ?>
 
    <?php
        //Estou pegando a aba de Navegação 
        include('header.php');
    ?>

    <main>
        <h1>Pedidos Pendentes</h1>
        <div class="pendPedidos">
            <?php
                while($row = mysqli_fetch_assoc($resultPend)):
                    $id_compra = $row['ID'];
                    $sqlIC = "SELECT TB_PRODUTOS.NOME_PROD,
                                     TB_PRODUTOS.PRECO,
                                     TB_ITENS_COMPRA.QTD,
                                     TB_ITENS_COMPRA.SUBTOTAL
                            FROM TB_ITENS_COMPRA
                            INNER JOIN TB_PRODUTOS ON TB_PRODUTOS.ID = TB_ITENS_COMPRA.ID_PRODUTO
                            INNER JOIN TB_COMPRA ON TB_COMPRA.ID = TB_ITENS_COMPRA.ID_COMPRA
                            WHERE TB_COMPRA.ID = '$id_compra'";
                    $resultIC = mysqli_query($conn, $sqlIC);
            ?>
                <section>
                    <h2>Nome do Cliente</h2>
                    <hr>
                        <p><?php echo $row['NOME'].' '.$row['SOBRENOME']?></p>
                    <hr>
                    <h2>Endereço</h2>
                    <hr>
                        <p><strong>BAIRRO: </strong><?php echo $row['BAIRRO']?></p>
                        <p><strong>RUA: </strong><?php echo $row['RUA']?></p>  
                        <p><strong>NUMERO: </strong><?php echo $row['NUMERO']?></p>
                        <p><strong>COMPLEMENTO: </strong><?php echo $row['COMPLEMENTO']?></p>
                    <hr>
                    <h2>Produto e Quantidade</h2>
                    <hr>
                        <?php while($rowIC = mysqli_fetch_assoc($resultIC)): ?>
                            <p><?php echo $rowIC['NOME_PROD'].' '.$rowIC['QTD']?>X</p>
                        <?php endwhile; ?>
                    <hr>
                    <h2>DATA DE PEDIDO</h2>
                    <hr>
                        <p><?php echo $row['DATA_COMPRA']?></p>
                    <hr>

                    <div class="check-pedidos">
                        <a href="../assets/php/pedidos-php.php?acao=cPed&id=<?php echo $row['ID'] ?>"><i class="fas fa-check"></i></a>
                    </div>
                    
                </section>
            <?php
                endwhile;
            ?>
        </div>

        <hr class="hr-main">

        <h1>Pedidos Concluidos <span id="expand-pedidos">&#9662;</span></h1>
        <div class="concluPedidos" style="display: none;">
            <?php
                while($row = mysqli_fetch_assoc($resultConcl)):
                    $id_compra = $row['ID'];
                    $sqlIC = "SELECT TB_PRODUTOS.NOME_PROD,
                                     TB_PRODUTOS.PRECO,
                                     TB_ITENS_COMPRA.QTD,
                                     TB_ITENS_COMPRA.SUBTOTAL
                            FROM TB_ITENS_COMPRA
                            INNER JOIN TB_PRODUTOS ON TB_PRODUTOS.ID = TB_ITENS_COMPRA.ID_PRODUTO
                            INNER JOIN TB_COMPRA ON TB_COMPRA.ID = TB_ITENS_COMPRA.ID_COMPRA
                            WHERE TB_ITENS_COMPRA.ID_COMPRA = '$id_compra'";
                    $resultIC = mysqli_query($conn, $sqlIC);
            ?>
                <section>
                    <h2>Nome do Cliente</h2>
                    <hr>
                        <p><?php echo $row['NOME'].' '.$row['SOBRENOME']?></p>
                    <hr>
                    <h2>Endereço</h2>
                    <hr>
                        <p><strong>BAIRRO: </strong><?php echo $row['BAIRRO']?></p>
                        <p><strong>RUA: </strong><?php echo $row['RUA']?></p>  
                        <p><strong>NUMERO: </strong><?php echo $row['NUMERO']?></p>
                        <p><strong>COMPLEMENTO: </strong><?php echo $row['COMPLEMENTO']?></p>
                    <hr>
                    <h2>Produto e Quantidade</h2>
                    <hr>
                        <?php while($rowIC = mysqli_fetch_assoc($resultIC)): ?>
                            <p><?php echo $rowIC['NOME_PROD'].' '.$rowIC['QTD']?>X</p>
                        <?php endwhile; ?>
                    <hr>
                    <h2>DATA DE PEDIDO</h2>
                    <hr>
                        <p><?php echo $row['DATA_COMPRA']?></p>
                    <hr>
                    
                </section>
            <?php
                endwhile;
            ?>
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
    <script src="../assets/js/alertAdmin.js"></script>
    <script>

        //Mostrar Pedidos que já foram concluidos
        var expandir = document.getElementById('expand-pedidos');
        var content = document.querySelector('.concluPedidos');
        expandir.addEventListener('click', click);

        function click() {
            if(content.style.display == 'none') {
                content.style.display = 'flex';    

            } else {
                content.style.display = 'none';
    
            }        
        }
    </script>

</body>
</html>