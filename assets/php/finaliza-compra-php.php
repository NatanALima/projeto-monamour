<?php

    session_start();
    include('conexao.php');

    if(isset($_GET['tPag'])) {
        $tPag = $_GET['tPag'];
        $tPag = strtoupper($tPag);

        if($tPag == 'CREDT') {
            $tPag = 'CREDITO';
            
        }

        //Consulta a TB_USER para verificar quem efetuou a Compra
        $sqlId = "SELECT * FROM TB_USER
                  WHERE NOME = '{$_SESSION['user']}' AND
                        EMAIL = '{$_SESSION['email']}'";
        $resultId = mysqli_query($conn, $sqlId) or die (mysqli_error());
        $rowId = mysqli_fetch_assoc($resultId);
        $rowId = $rowId['ID'];

        //Consulta a TB_ENDERECO para verificar o Endereço de quem efetuou a compra
        $sqlE = "SELECT * FROM TB_ENDERECO
        WHERE ID_USER = '$rowId'";
        $resultE = mysqli_query($conn, $sqlE);
        $rowE = mysqli_fetch_assoc($resultE);
        $rowE = $rowE['ID'];


        //Adicionado recentemente
        //Insere o número do pedido na TB_COMPRA
        $sqlCp = "INSERT INTO TB_COMPRA
                    (ID_ENDERECO, TIPO_PAG, STATUS_PEDIDO, DATA_COMPRA)
                  VALUES
                    ('$rowE', '$tPag', 'ABERTO', NOW())";
        $resultCp = mysqli_query($conn, $sqlCp) or die (mysqli_error());

        //Consulta o número do último pedido
        $sqlConsCp = "SELECT MAX(ID) AS ID_COMPRA
                      FROM TB_COMPRA";
        $resultConsCP = mysqli_query($conn, $sqlConsCp) or die (mysqli_error());
        $rowConsCP = mysqli_fetch_assoc($resultConsCP);
        $id_compra = $rowConsCP['ID_COMPRA'];


        $total = 0;
        foreach ($_SESSION['carrinho'] as $id => $qtd) {
            $sql = "SELECT * FROM TB_PRODUTOS
                    WHERE ID = '$id'";
            $result = mysqli_query($conn, $sql) or die (mysqli_error());
            $row = mysqli_fetch_assoc($result);

            $imagem = $row['IMG'];
            $nome = $row['NOME_PROD'];
            $preco = number_format($row['PRECO'], 2, ',', '.');
            $subtotal = $row['PRECO'] * $qtd;

            //Resolver este problema
            $sqlC = "INSERT INTO TB_ITENS_COMPRA
                        (ID_COMPRA, ID_PRODUTO, QTD, SUBTOTAL)
                     VALUES
                        ('$id_compra', '$id', '$qtd', '$subtotal')";
            $resultC = mysqli_query($conn, $sqlC) or die (mysqli_error());

        }

        //Pegando o total dos Produtos
        $sqlTotProd = "SELECT SUM(SUBTOTAL) AS TOTAL
                       FROM TB_ITENS_COMPRA
                       WHERE ID_COMPRA = '$id_compra'";
        $resultTotProd = mysqli_query($conn, $sqlTotProd) or die (mysqli_error());
        $rowTotProd = mysqli_fetch_assoc($resultTotProd);
        $totalProd = $rowTotProd['TOTAL'];

        if($tPag == 'PIX') {
            $totalProdDesc = $totalProd - ($totalProd * 0.05);
            $sqlUpTot = "UPDATE TB_COMPRA
                         SET TOTAL = '$totalProdDesc'
                         WHERE ID = '$id_compra'";
            $resultUpTot = mysqli_query($conn, $sqlUpTot) or die (mysqli_error());

            
        } else {
            $sqlUpTot = "UPDATE TB_COMPRA
                         SET TOTAL = '$totalProd'
                         WHERE ID = '$id_compra'";
            $resultUpTot = mysqli_query($conn, $sqlUpTot) or die (mysqli_error());

        }

        if($resultUpTot) {
            $_SESSION['sucesso_compra'] = TRUE;
            unset($_SESSION['carrinho']);
            header('Location: ../../menus/menu.php');   

        } else {
            $_SESSION['erro_compra'] = TRUE;
            header('Location: ../../menus/menu.php');

        }

    }

    


    
    
?>