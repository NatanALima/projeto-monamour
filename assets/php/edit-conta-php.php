<?php
    include('conexao.php');
    session_start();

    if(isset($_GET['acao'])) {
        //Verifica de quem será o UPDATE (info de User ou Endereco)
        if($_GET['acao'] == 'upD') {
            $idUser = intval($_GET['id']);

            //Pegando as informações o input
            $nome = mysqli_real_escape_string($conn, trim($_POST['nome']));
            $sobreN = mysqli_real_escape_string($conn, trim($_POST['sobreN']));
            
            
            $sql = "UPDATE TB_USER
                    SET NOME = '$nome',
                        SOBRENOME = '$sobreN',
                        MODIFIED = NOW()
                    WHERE ID = '$idUser'";
            $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
            if(mysqli_affected_rows($conn)) {
                $_SESSION['sucesso_editConta'] = TRUE;
                header('Location: ../../menus/conta.php');

            } else {
                $_SESSION['erro_editConta'] = TRUE;
                header('Location: ../../menus/conta.php');

            }



        }

        if($_GET['acao'] == 'upE') {
            $idUser = intval($_GET['id']);

            $cep = mysqli_real_escape_string($conn, trim($_POST['cep']));
            $cidade = mysqli_real_escape_string($conn, trim($_POST['cidade']));
            $estado = mysqli_real_escape_string($conn, trim($_POST['uf']));
            $bairro = mysqli_real_escape_string($conn, trim($_POST['bairro']));
            $rua = mysqli_real_escape_string($conn, trim($_POST['rua']));
            $numCasa = mysqli_real_escape_string($conn, trim($_POST['num']));
            $complemento = mysqli_real_escape_string($conn, trim($_POST['Cplement']));

            $sql = "UPDATE TB_ENDERECO
                    SET CEP = '$cep',
                        CIDADE = '$cidade',
                        ESTADO = '$estado',
                        BAIRRO = '$bairro',
                        RUA = '$rua',
                        NUMERO = '$numCasa',
                        COMPLEMENTO = '$complemento',
                        MODIFIED = NOW()
                    WHERE ID_USER = '$idUser'";
            $result = mysqli_query($conn, $sql) or die (mysqli_error());
                if(mysqli_affected_rows($conn)) {
                    $_SESSION['sucesso_editConta'] = TRUE;
                    header('Location: ../../menus/conta.php');

                } else {
                    $_SESSION['erro_editConta'] = TRUE;
                    header('Location: ../../menus/conta.php');

                }
            
        }

        if($_GET['acao'] == 'upS') {
            $idUser = intval($_GET['id']);
            $senhaAt = mysqli_real_escape_string($conn, trim(md5($_POST['senhaAt'])));
            $senhaN = mysqli_real_escape_string($conn, trim(md5($_POST['senhaN'])));

            $sqlConsult = "SELECT * FROM TB_USER
                           WHERE ID = $idUser";
            $resultConsult = mysqli_query($conn, $sqlConsult) or die (mysqli_error());
            $rowConsult = mysqli_fetch_assoc($resultConsult);

            if($senhaAt == $rowConsult['SENHA']) {
                $sqlUpPass = "UPDATE TB_USER
                              SET SENHA = '$senhaN',
                                  MODIFIED = NOW()
                              WHERE ID = $idUser";
                $resultUpPass = mysqli_query($conn, $sqlUpPass);
                if($resultUpPass) {
                    $_SESSION['sucesso_editSenha'] = true;
                    header('Location: ../../menus/conta.php');

                } else {
                    $_SESSION['erro_editSenha'] = true;
                    header('Location: ../../menus/conta.php');

                }

            } else {
                $_SESSION['erro_editSenha'] = true;
                header('Location: ../../menus/conta.php');

            }
            

        }
    }

?>