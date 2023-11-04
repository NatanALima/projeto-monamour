<?php
    //session_start();

    if(!$_SESSION['acesso']) {
        header('Location:../login-cadastro/tela-login.php');
        exit();

    }

?>