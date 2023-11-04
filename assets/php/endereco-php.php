<?php

    session_start();
    include('conexao.php');

    $cep = mysqli_real_escape_string($conn, trim($_POST['cep']));
    $cidade = mysqli_real_escape_string($conn, trim($_POST['cidade']));
    $estado = mysqli_real_escape_string($conn, trim($_POST['uf']));
    $bairro = mysqli_real_escape_string($conn, trim($_POST['bairro']));
    $rua = mysqli_real_escape_string($conn, trim($_POST['rua']));
    $numCasa = mysqli_real_escape_string($conn, trim($_POST['num']));
    $complemento = mysqli_real_escape_string($conn, trim($_POST['Cplement']));
    $nivAcess = intval(1);


    $nome = $_SESSION['userinfo'][0];
    $sobrenome = $_SESSION['userinfo'][1];
    $email = $_SESSION['userinfo'][2];
    $dataNasc = $_SESSION['userinfo'][3];
    $senha = $_SESSION['userinfo'][4];

    //INSERE CLIENTE
    $sqlcli = "INSERT INTO TB_USER
                (ACESSO, NOME, SOBRENOME, EMAIL, DATANASC, SENHA, CREATED)
            VALUES
                ('$nivAcess', '$nome', '$sobrenome', '$email', '$dataNasc', '$senha', NOW())";
    mysqli_query($conn, $sqlcli);


    /*Fazendo uma consulta a TB_user*/
    /*Qual o Intuito? -> Basicamente com esta consulta será possível pegar a identificação (ID) do último usuário Cadastrado, ou seja, o Usuário que desejamos vincular com o Endereço*/
    $sqlU = "SELECT MAX(ID) AS ID_USER
             FROM TB_USER";
    $resultU = mysqli_query($conn, $sqlU);
    $rowU = mysqli_fetch_assoc($resultU);
    $id_User = $rowU['ID_USER'];

    /*Agora, tendo o ID do usuário, podemos inserir o Endereço*/
    $sql = "INSERT INTO TB_ENDERECO
                (ID_USER, CEP, CIDADE, ESTADO, BAIRRO, RUA, NUMERO, COMPLEMENTO, CREATED)
            VALUES
                ('$id_User', '$cep', '$cidade', '$estado', '$bairro', '$rua', '$numCasa', '$complemento', NOW())";

    $teste = mysqli_query($conn, $sql);
    
    if($conn -> query($sql) == true) {
        $_SESSION['status_endereco'] = true;
        header('Location: ../../login-cadastro/tela-login.php');
        exit();

    } else {
        $_SESSION['erro_endereco'] = true;
        header('Location: ../../login-cadastro/tela-infoextra.php');
        exit();

    }

?>