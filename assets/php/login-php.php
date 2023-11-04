<?php

    session_start();
    include('conexao.php');

    if(empty($_POST['email']) || empty($_POST['senha'])) {
        header('Location: ../../login-cadastro/tela-login.php');
        exit();

    }

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $sql = "SELECT * FROM TB_USER
            WHERE EMAIL = '{$email}' AND
                  SENHA = MD5('{$senha}')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);

    $consult = mysqli_fetch_assoc($result);
    $nome = strtoupper($consult['NOME']);
    $emailU = $consult['EMAIL'];
    $nivAcess = $consult['ACESSO'];


    if($row == 1) {
        $_SESSION['acesso'] = $nivAcess;
        $_SESSION['email'] = $emailU;
        $_SESSION['user'] = $nome;    
        header('Location: ../../index.php');
        exit();

    } else {
        $_SESSION['nao_autenticado'] = true;
        header('Location: ../../login-cadastro/tela-login.php');
        exit();
        
    }

?>