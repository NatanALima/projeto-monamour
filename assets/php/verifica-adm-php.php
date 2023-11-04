<?php
    //session_start();

    if(!$_SESSION['user']) {
        header('Location:../login-cadastro/tela-login.php');
        exit();

    } else {
        if($_SESSION['acesso'] < 2) {
            header('Location:../index.php');
            exit();
    
        }
    }
    

?>