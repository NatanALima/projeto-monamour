<?php
    session_start();
    include('conexao.php');

    $nome = mysqli_real_escape_string($conn, trim($_POST['nome']));
    $sobrenome = mysqli_real_escape_string($conn, trim($_POST['sobreN']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $diaNasc = intval(mysqli_real_escape_string($conn, trim($_POST['diaNasc'])));
    $mesNasc = intval(mysqli_real_escape_string($conn, trim($_POST['mesNasc'])));
    $anoNasc = intval(mysqli_real_escape_string($conn, trim($_POST['anoNasc'])));
    $senha = mysqli_real_escape_string($conn, trim(md5($_POST['senha'])));
    $confirmS = mysqli_real_escape_string($conn, trim(md5($_POST['confirmS'])));   

    $sqlV = "SELECT COUNT(*) AS TOTAL
            FROM TB_USER
            WHERE NOME = '$nome' AND
                  EMAIL = '$email'";
    $resultV = mysqli_query($conn, $sqlV);
    $rowV = mysqli_fetch_assoc($resultV);

    if($rowV['TOTAL'] == 1) {
        $_SESSION['usuario_existe'] = true;
        if($_GET['acao'] == 'addU') {
            header('Location: ../../login-cadastro/tela-cadastro.php');

        } else if($_GET['acao'] == 'addA') {
            header('Location: ../../menus/conta.php');

        }
        exit();
        
        
        
    }

    /*Verificando se o formato do Email é válido*/
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['erro_email'] = true;
        if($_GET['acao'] == 'addU') {
            header('Location: ../../login-cadastro/tela-cadastro.php');

        } else if($_GET['acao'] == 'addA') {
            header('Location: ../../menus/conta.php');
            
        }
        exit();
    }

    /*Verificando se a senha é igual ao Confirmar senha */
    if($confirmS != $senha) {
        $_SESSION['confirma_senha'] = true;
        if($_GET['acao'] == 'addU') {
            header('Location: ../../login-cadastro/tela-cadastro.php');

        } else if($_GET['acao'] == 'addA') {
            header('Location: ../../menus/conta.php');
            
        }
        exit();

    }

    if ($diaNasc <= 0 ||
        $diaNasc > 31 && ($mesNasc == 01 || 
                          $mesNasc == 03 || 
                          $mesNasc == 05 ||
                          $mesNasc == 07 ||
                          $mesNasc == 8  ||
                          $mesNasc == 10 ||
                          $mesNasc == 12)||
        $diaNasc > 30 && ($mesNasc == 04 ||
                          $mesNasc == 06 ||
                          $mesNasc == 9  ||
                          $mesNasc == 10)||
        $diaNasc > 28 && ($mesNasc == 02)||
        $anoNasc < 1900 || $anoNasc > date('Y')) {
        $_SESSION['data_invalida'] = true;
        if($_GET['acao'] == 'addU') {
            header('Location: ../../login-cadastro/tela-cadastro.php'); 

        } else if($_GET['acao'] == 'addA') {
            header('Location: ../../menus/conta.php');

        }
        exit();
        

    }

    if (date('Y') - $anoNasc < 18) {
        $_SESSION['idade_invalida'] = true;
        if($_GET['acao'] == 'addU') {
            header('Location: ../../login-cadastro/tela-cadastro.php');

        } else if($_GET['acao'] == 'addA') {
            header('Location: ../../menus/conta.php');
            
        }
        exit();
        

    }

    $dataNasc = $anoNasc.'-'.$mesNasc.'-'.$diaNasc;

    if($_GET['acao'] == 'addU') {
        $_SESSION['userinfo'] = [$nome, $sobrenome, $email, $dataNasc, $senha];
        header('Location: ../../login-cadastro/tela-infoextra.php');

    } else if($_GET['acao'] == 'addA') {
        $sqlConsultU = "SELECT * FROM TB_USER
                        WHERE ACESSO >= 2";
        $resultConsultU = mysqli_query($conn, $sqlConsultU);
        $rowConsultU = mysqli_fetch_assoc($resultConsultU);
        $idAdmin = $rowConsultU['ID'];

        $sqlConsultE = "SELECT * FROM TB_ENDERECO
                        WHERE ID_USER = $idAdmin";
        $resultConsultE = mysqli_query($conn, $sqlConsultE);
        $rowConsultE = mysqli_fetch_assoc($resultConsultE);

        $cep = $rowConsultE['CEP'];
        $cidade = $rowConsultE['CIDADE'];
        $estado = $rowConsultE['ESTADO'];
        $bairro = $rowConsultE['BAIRRO'];
        $rua = $rowConsultE['RUA'];
        $numCasa = $rowConsultE['NUMERO'];
        $complemento = $rowConsultE['COMPLEMENTO'];

        if($rowConsultE) {
            $sqlAdm = "INSERT INTO TB_USER
                        (ACESSO, NOME, SOBRENOME, EMAIL, DATANASC, SENHA, CREATED)
                       VALUES 
                        (2, '$nome', '$sobrenome', '$email', '$dataNasc', '$senha', NOW())";
            $resultAdm = mysqli_query($conn, $sqlAdm);
        
            if($resultAdm) {
                $sqlMaxAdm = "SELECT MAX(ID) AS ID_USER FROM TB_USER";
                $resultMaxAdm = mysqli_query($conn, $sqlMaxAdm);
                $rowMaxId = mysqli_fetch_assoc($resultMaxAdm);
                $id_user = $rowMaxId['ID_USER'];

                $sqlInsAdmE = "INSERT INTO TB_ENDERECO
                                (ID_USER, CEP, CIDADE, ESTADO, BAIRRO, RUA, NUMERO, COMPLEMENTO, CREATED)
                               VALUES
                                ('$id_user', '$cep', '$cidade', '$estado', '$bairro', '$rua', '$numCasa', '$complemento', NOW())";
                $resultInsAdmE = mysqli_query($conn, $sqlInsAdmE);

                if($resultInsAdmE) {
                    $_SESSION['sucesso_cadastro'] = true;
                    header('Location: ../../menus/conta.php');

                } else {
                    $_SESSION['erro_cadastro'] = true;
                    header('Location: ../../menus/conta.php');

                }


            } else {
                $_SESSION['erro_cadastro'] = true;
                header('Location: ../../menus/conta.php');

            }

        } else {
            $_SESSION['erro_cadastro'] = true;
            header('Location: ../../menus/conta.php');

        }
        
        
    }
    
    
?>