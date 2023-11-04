<?php
    session_start();
    include('../assets/php/conexao.php');
    include('../assets/php/carrinho-php.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="shortcut icon" href="../assets/style/imagens/icones/icon-monamour-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/css/style-carrinho.css">
    <script src="https://kit.fontawesome.com/ca14b9e588.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php

    ?>

    <a href="menu.php" class="return-menu">
        <i class="fas fa-arrow-left"></i>
    </a>
 
    <main>
        <div class="container-compras">
            <section>
                <h1>Produtos</h1>
                <hr>
                <?php
                    if(count($_SESSION['carrinho']) == 0 || !isset($_SESSION['carrinho'])):
                ?>
                    <p>Não há Produtos no Carrinho...</p>
                <?php
                    else:
                ?>
                    <table>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                        </tr>
                <?php
                    endif;
                ?>
                <?php
                    $total = 0;

                    foreach ($_SESSION['carrinho'] as $id => $qtd):
                        $sql = "SELECT * FROM TB_PRODUTOS
                                WHERE ID = '$id'";
                        $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                        $row = mysqli_fetch_assoc($result);

                        $imagem = $row['IMG'];
                        $nome = $row['NOME_PROD'];
                        $preco = number_format($row['PRECO'], 2, ',', '.');
                        $subtotal = number_format(($row['PRECO'] * $qtd), 2, ',', '.');
                        $total += $row['PRECO'] * $qtd;
                ?>
                        <tr>
                            <td>
                                <img src="../assets/style/imagens/menu/<?php echo $imagem ?>" alt="">
                                <p><?php echo $nome ?></p>
                            </td>
                            <td><p><?php echo $preco ?></p></td>
                            <td>       
                                <p>
                                    <a href="?acao=del&id=<?php echo $id ?>">
                                        <i class="fas fa-minus"></i>
                                    </a>
                                    <?php echo $qtd ?>
                                    <a href="?acao=add&id=<?php echo $id ?>">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </p>           
                            </td>
                            <td><p><?php echo $subtotal ?></p></td>
                        </tr>
                        <tr>
                <?php
                    endforeach;

                    $total = number_format($total, 2, ',', '.');
                ?>
                    </table>
                    
                    <hr>
                    <h2>TOTAL: R$<?php echo $total ?></h2>
                
                    <div class="opcao-btn">
                        <a href="menu.php">Continuar Comprando</a>
                        <a href="?acao=rmvall">Remover Tudo</a>
                    </div>
                    <?php
                        if(count($_SESSION['carrinho']) > 0):
                    ?>
                        <div class="next-pay">
                            <a href="../pagamento/tipo_pagamento.php">Próxima Etapa</a>
                        </div>
                    <?php
                        endif;
                    ?>
                    
            </section>
        </div>
    </main>

</body>
</html>