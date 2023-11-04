<?php

    session_start();
    include('conexao.php');

    if(isset($_GET['acao'])) {
        if($_GET['acao'] == 'ctgE') {
            $id = intval($_GET['id']);

            $categ = mysqli_real_escape_string($conn, trim($_POST['categ']));
            echo $categ;

            $sqlConsCateg = "SELECT * FROM TB_CATEGORIA
                             WHERE ID != '$id' AND
                                   CATEGORIA LIKE '$categ'";
            $resultConsCateg = mysqli_query($conn, $sqlConsCateg) or die (mysqli_error($conn));

            if(mysqli_num_rows($resultConsCateg) == 0) {
                $sqlUpCateg = "UPDATE TB_CATEGORIA
                               SET CATEGORIA = '$categ',
                                   MODIFIED = NOW()
                               WHERE ID = '$id'";
                $resultUpCateg = mysqli_query($conn, $sqlUpCateg) or die (mysqli_error($conn));
                if($resultUpCateg) {
                    $_SESSION['sucesso_editCateg'] = TRUE;
                    header('Location: ../../menus/categoria.php');

                } else {
                    $_SESSION['erro_editCateg'] = TRUE;
                    header('Location: ../../menus/categoria.php');
                }

            } else {
                $_SESSION['erro_editCateg'] = TRUE;
                header('Location: ../../menus/categoria.php');
            }

        } else if($_GET['acao'] == 'ctgAdd') {
            $categNew = mysqli_real_escape_string($conn, trim($_POST['addCateg']));
           
            $sqlConsCateg = "SELECT * FROM TB_CATEGORIA
                             WHERE CATEGORIA LIKE '$categNew'";
            $resultConsCateg = mysqli_query($conn, $sqlConsCateg) or die (mysqli_error($conn));
            
            if(mysqli_num_rows($resultConsCateg) == 0) {
                $sqlInsCateg = "INSERT INTO TB_CATEGORIA
                                    (CATEGORIA, CREATED)
                                VALUES
                                    ('$categNew', NOW())";
                $resultInstCateg = mysqli_query($conn, $sqlInsCateg);
                if(mysqli_insert_id($conn)) {
                    $_SESSION['sucesso_addCateg'] = TRUE;
                    header('Location: ../../menus/categoria.php');

                } else {
                    $_SESSION['erro_addCateg'] = TRUE;
                    header('Location: ../../menus/categoria.php');

                }
            }

        } else if($_GET['acao'] == 'ctgDel') {
            $id = intval($_GET['id']);
            $pasta = "../style/imagens/menu/";

            $sqlConsProd = "SELECT * FROM TB_PRODUTOS
                            WHERE CATEG = '$id'";
            $resultConsProd = mysqli_query($conn, $sqlConsProd) or die (mysqli_error($conn));


            if(mysqli_num_rows($resultConsProd) != 0) {
                while($rowConsProd = mysqli_fetch_assoc($resultConsProd)) {
                    $imgName = $rowConsProd['IMG'];
                    unlink($pasta.$imgName);
    
                }
                $sqlDelProd = "DELETE FROM TB_PRODUTOS
                               WHERE CATEG = '$id'";
                $resultDelProd = mysqli_query($conn, $sqlDelProd);

                if($resultDelProd) {
                    $sqlDelCateg = "DELETE FROM TB_CATEGORIA
                                    WHERE ID = '$id'";
                    $resultDelCateg = mysqli_query($conn, $sqlDelCateg);
                    
                    if($resultDelCateg) {
                        $_SESSION['sucesso_delCateg'] = TRUE;
                        header('Location: ../../menus/categoria.php');

                    } else {
                        $_SESSION['erro_delCateg'] = TRUE;
                        header('Location: ../../menus/categoria.php'); 
                    }

                } else {
                    $_SESSION['erro_delCateg'] = TRUE;
                    header('Location: ../../menus/categoria.php');
                }


            } else {
                $sqlDelCateg = "DELETE FROM TB_CATEGORIA
                                WHERE ID = '$id'";
                $resultDelCateg = mysqli_query($conn, $sqlDelCateg);
                
                if($resultDelCateg) {
                    $_SESSION['sucesso_delCateg'] = TRUE;
                    header('Location: ../../menus/categoria.php');

                } else {
                    $_SESSION['erro_delCateg'] = TRUE;
                    header('Location: ../../menus/categoria.php'); 
                }
                
            }


        }



    }
    



?>