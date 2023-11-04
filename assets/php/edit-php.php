<?php

    session_start();
    include('conexao.php');  

    $pasta = "../style/imagens/menu/";
    $imgType = array(".jpg", ".jpeg", ".gif", ".png", ".bmp");

    if(isset($_POST['editar'])) {
        $id = intval(mysqli_real_escape_string($conn, trim($_POST['id'])));
        $nome_prod = mysqli_real_escape_string($conn, trim($_POST['nome-prod']));
        $descricao = mysqli_real_escape_string($conn, trim($_POST['descricao']));
        $preco = floatval(mysqli_real_escape_string($conn, trim($_POST['preco-prod'])));
        $idCateg = intval(mysqli_real_escape_string($conn, trim($_POST['opCateg'])));
        $imgB = mysqli_real_escape_string($conn, trim($_POST['imgB']));

        //Definindo o Nome e Tamanho da Imagem
        $nome_img = $_FILES['imagem']['name'];
        $tam_img = $_FILES['imagem']['size'];

        //Extensão do arquivo
        $ext = strtolower(strrchr($nome_img, "."));

        //Verifica se existe o mesmo nome em algum lugar da tabela
        $sqlConsult = "SELECT * FROM TB_PRODUTOS
                       WHERE NOME_PROD = '$nome_prod' AND
                             ID != '$id'";
        $resultConsult = mysqli_query($conn, $sqlConsult);
        

        if(!empty($nome_img)) {
            if(in_array($ext, $imgType)) {
                $tamanho = round($tam_img / 1024);
                if($tamanho < 1024) {
                    $nomeimgAt = md5(uniqid(time())).$ext;
                    $tmp_img = $_FILES['imagem']['tmp_name'];


                    if(move_uploaded_file($tmp_img, $pasta.$nomeimgAt)) {
                        if(mysqli_num_rows($resultConsult) == 0) {
                            $sql = "UPDATE TB_PRODUTOS
                                    SET IMG = '$nomeimgAt',
                                        CATEG = '$idCateg',
                                        NOME_PROD = '$nome_prod',
                                        DESCRICAO = '$descricao',
                                        PRECO = '$preco',
                                        MODIFIED = NOW()
                                    WHERE ID = '$id'";
                            $result = mysqli_query($conn, $sql);
                            if(!unlink($pasta.$imgB)) {
                                $_SESSION['erro_edit'] = true;
                                header("Location: ../../add-up/update-menu.php?acao=visu&id=$id");

                            } else {
                                if(mysqli_affected_rows($conn)) {
                                    $_SESSION['sucesso_edit'] = true;
                                    header('Location: ../../menus/menu.php');
    
                                } else {
                                    $_SESSION['erro_edit'] = true;
                                    header("Location: ../../add-up/update-menu.php?acao=visu&id=$id");
    
                                }
                            }

                        } else {
                            $_SESSION['existe_edit'] = true;
                            header("Location: ../../add-up/update-menu.php?acao=visu&id=$id");
                            
                        }       
                    }
                }
            }

        } else {
            
            if(mysqli_num_rows($resultConsult) == 0) {
                $sql = "UPDATE TB_PRODUTOS
                        SET IMG = '$imgB',
                            CATEG = '$idCateg',
                            NOME_PROD = '$nome_prod',
                            DESCRICAO = '$descricao',
                            PRECO = '$preco',
                            MODIFIED = NOW()
                        WHERE ID = '$id'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_affected_rows($conn)) {
                    $_SESSION['sucesso_edit'] = true;
                    header('Location: ../../menus/menu.php');

                } else {
                    $_SESSION['erro_edit'] = true;
                    header("Location: ../../add-up/update-menu.php?acao=visu&id=$id");

                }

            } else {
                $_SESSION['existe_edit'] = true;
                header("Location: ../../add-up/update-menu.php?acao=visu&id=$id");
                
            }     
        }
    }


?>