<?php

    
    if(!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();

    }

    //Verificar se existe a ação
    if(isset($_GET['acao'])) {
        //Tipo de Ação
        //Adicionar Produto
        if($_GET['acao'] == 'add') {
            $id = $_GET['id'];
            //Se produto não existe
            if(!isset($_SESSION['carrinho'][$id])) {
                $_SESSION['carrinho'][$id] = 1;

            } else {
                //Se já existir
                $_SESSION['carrinho'][$id] += 1;

            }

            //Impede que a ação seja feita ao Atualizar a página
            header('Location: carrinho.php');

        }

        //Excluir Produto
        if($_GET['acao'] == 'del') {
            $id = $_GET['id'];
            if(isset($_SESSION['carrinho'][$id])) {
                $_SESSION['carrinho'][$id]--;
                if($_SESSION['carrinho'][$id] == 0) {
                    unset($_SESSION['carrinho'][$id]);

                }

            }

            //Impede que a ação seja feita ao Atualizar a página
            header('Location: carrinho.php');
        }

        if($_GET['acao'] == 'rmvall') {
            unset($_SESSION['carrinho']);
            header('Location: menu.php');
        }
    }

?>