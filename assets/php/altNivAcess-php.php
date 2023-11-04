<?php

    session_start();
    include('conexao.php');

    if(isset($_GET['acao'])) {
        if($_GET['acao'] == 'acsEdt') {
            $id = intval($_GET['id']);

            $sqlUser = "SELECT * FROM TB_USER
                        WHERE ID = $id";
            $resultUser = mysqli_query($conn, $sqlUser);

            if($resultUser) {
                $rowUser = mysqli_fetch_assoc($resultUser);
                $idUser = $rowUser['ID'];

                $sqlEdtAcss = "UPDATE TB_USER
                               SET ACESSO = 1,
                                   MODIFIED = NOW()
                               WHERE ID = $idUser";
                $resultEdtAcss = mysqli_query($conn, $sqlEdtAcss);
                
                if($resultEdtAcss) {
                    $_SESSION['sucesso_edtAcss'] = TRUE;
                    header('Location: ../../menus/gerAdmin.php');

                } else {
                    $_SESSION['erro_edtAcss'] = TRUE;
                    header('Location: ../../menus/gerAdmin.php');

                }

            } else {
                $_SESSION['erro_edtAcss'] = TRUE;
                header('Location: ../../menus/gerAdmin.php');
            }

        } else {
            header('Location: ../../menus/gerAdmin.php');

        }
    }
?>