<?php

    session_start();
    include('conexao.php');

    $pasta = "../style/imagens/menu/";
    $imgType = array(".jpg", ".jpeg", ".gif", ".png", ".bmp");

    if(isset($_POST['enviar'])) {
        $nome_prod = mysqli_real_escape_string($conn, trim($_POST['nome-prod']));
        $descricao = mysqli_real_escape_string($conn, trim($_POST['descricao']));
        $preco = floatval(mysqli_real_escape_string($conn, trim($_POST['preco-prod'])));
        $idCateg = intval(mysqli_real_escape_string($conn, trim($_POST['opCateg'])));

        //Definindo o Nome e Tamanho da Imagem
        $nome_img = $_FILES['imagem']['name'];
        $tam_img = $_FILES['imagem']['size'];

        //Extensão do arquivo
        $ext = strtolower(strrchr($nome_img, "."));

        if(in_array($ext, $imgType)) {
            $tamanho = round($tam_img / 1024);
            if($tamanho < 1024) {
                $nomeimgAt = md5(uniqid(time())).$ext;
                $tmp_img = $_FILES['imagem']['tmp_name'];

                //Consulta para verificar se o Nome já existe
                $sqlSelect = "SELECT * FROM TB_PRODUTOS
                              WHERE NOME_PROD = '$nome_prod'";
                $resultSelect = mysqli_query($conn, $sqlSelect);
                $rowSelect = mysqli_fetch_assoc($resultSelect);

                //Caso não exista, prossegue
                if($nome_prod != isset($rowSelect['NOME_PROD'])) {
                    if(move_uploaded_file($tmp_img, $pasta.$nomeimgAt)) {
                        $sql = "INSERT INTO TB_PRODUTOS
                                    (IMG, CATEG, NOME_PROD, DESCRICAO, PRECO, CREATED)
                                VALUES
                                    ('$nomeimgAt', '$idCateg', '$nome_prod', '$descricao', '$preco', NOW())";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_insert_id($conn)) {
                            $_SESSION['sucesso_add'] = true;
                            header('Location: ../../menus/menu.php');

                        } else {
                            $_SESSION['erro_add'] = true;
                            header('Location: ../../add-up/adicionar-menu.php');

                        }

                    }

                } else {
                    $_SESSION['erro_nome_add'] = true;
                    header('Location: ../../add-up/adicionar-menu.php');
                    
                }

            } else {
                $_SESSION['erro_add'] = true;
                header('Location: ../../add-up/adicionar-menu.php');

            }

        } else {
            $_SESSION['erro_add'] = true;
            header('Location: ../../add-up/adicionar-menu.php');

        }
    }

?>