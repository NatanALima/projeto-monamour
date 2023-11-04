<?php
    include('conexao.php');
    session_start();

    //Ação de Concluir Pedido
    if(isset($_GET['acao'])) {
        if($_GET['acao'] == 'cPed') {
            $idPed = intval($_GET['id']);
            $sqlUpP = "UPDATE TB_COMPRA
                        SET STATUS_PEDIDO = 'A CAMINHO'
                        WHERE ID = '$idPed'";
            $resultUpP = mysqli_query($conn, $sqlUpP) or die(mysqli_error($conn));
            if(mysqli_affected_rows($conn)) {
                $_SESSION['sucesso_pedido'] = true;
                //Editar depois aqui!!!!!!!!!!!!!!
                header('Location: ../../menus/pedidos.php');

            } else {
                $_SESSION['erro_pedido'] = true;
                header('Location: ../../menus/pedidos.php');

            }

        }
    }

?>