<?php

    include('conexao.php');
    session_start();

    if(isset($_GET['acao'])) {
        if($_GET['acao'] == 'del') {

            $id = intval($_GET['id']);

            $sqlConsult = "SELECT * FROM TB_PRODUTOS 
                            WHERE ID = $id";
            $resultConsult = mysqli_query($conn, $sqlConsult) or die (mysqli_error($conn));
            $rowConsult = mysqli_fetch_assoc($resultConsult);
            $imgName = $rowConsult['IMG'];
            $pasta = "../style/imagens/menu/";

            $sql = "DELETE FROM TB_PRODUTOS
                    WHERE ID = '$id'";

            try {
                if($conn -> query($sql) === TRUE) {
                    if(unlink($pasta.$imgName)) {
                        $_SESSION['delete_aviso'] = true;
                        header('Location: ../../menus/menu.php');

                    } else {
                        $_SESSION['erro_del_menu'] = true;
                        header('Location: ../../menus/menu.php');
                    }    
                }

            } catch (Exception $e) {
                $_SESSION['erro_del_menu'] = true;
                header('Location: ../../menus/menu.php');
            }

            
        }
    }
?>