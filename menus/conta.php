<?php
    session_start();
    include('../assets/php/conexao.php');
    include('../assets/php/verifica-login-php.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/style/imagens/icones/icon-monamour-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/css/style-menu-footer.css">
    <link rel="stylesheet" href="../assets/style/css/style-conta.css">
    <script src="https://kit.fontawesome.com/ca14b9e588.js" crossorigin="anonymous"></script>
    <!--Alerta-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <title>Minha Conta</title>
</head>
<body>
    
    <?php

        if(isset($_SESSION['user'])) {
            //Efetuando os Devidos Selects
            $sql = "SELECT * FROM TB_USER
                    WHERE EMAIL = '{$_SESSION['email']}'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $row = mysqli_fetch_assoc($result);
            $idUser = $row['ID'];

            //Consulta para pegar as informações da TB_USER
            $sqlU = "SELECT NOME,
                            SOBRENOME,
                            EMAIL,
                            DATE_FORMAT(DATANASC, '%d-%m-%Y') AS DATANASC
                            FROM TB_USER
                    WHERE ID = '$idUser'";
            $resultU = mysqli_query($conn, $sqlU);
            $rowU = mysqli_fetch_assoc($resultU);

            //Consulta TB_ENDERECO
            $sqlE = "SELECT * FROM TB_ENDERECO
                    WHERE ID_USER = '$idUser'";
            $resultE = mysqli_query($conn, $sqlE);
            $rowE = mysqli_fetch_assoc($resultE);


            //Testes para novo formato
            /*O que tem de Novo? -> ao invés de efetuar uma consulta pegando a TB_COMPRA e a TB_PRODUTOS
              eu estou pegando primeiramente a TB_COMPRA e depois os PRODUTOS respectivamente
              Semelhante a forma utilizada na Tela de PEDIDOS*/
            $sqlComp = "SELECT TB_COMPRA.ID,
                               TB_COMPRA.ID_ENDERECO,
                               TB_COMPRA.TIPO_PAG,
                               TB_COMPRA.TOTAL,
                               TB_COMPRA.STATUS_PEDIDO,
                               DATE_FORMAT(TB_COMPRA.DATA_COMPRA, '%d-%m-%Y %H:%i') AS DATA_COMPRA 
                        FROM TB_COMPRA
                        INNER JOIN TB_ENDERECO ON TB_ENDERECO.ID = TB_COMPRA.ID_ENDERECO
                        INNER JOIN TB_USER ON TB_USER.ID = TB_ENDERECO.ID_USER
                        WHERE TB_USER.ID = '$idUser'
                        ORDER BY TB_COMPRA.DATA_COMPRA DESC";
            $resultComp = mysqli_query($conn, $sqlComp);
            

            //Consulta TB_COMPRA
            //É necessário priorizar o INNER JOIN de TB_COMPRA E TB_ITENS_COMPRA caso contrário apresentará erro
            //Quando digo priorizar me refiro colocar em primeiro;
            $sqlC = "SELECT TB_PRODUTOS.IMG,
                            TB_PRODUTOS.NOME_PROD,
                            TB_PRODUTOS.PRECO,
                            TB_ITENS_COMPRA.QTD,
                            TB_ITENS_COMPRA.SUBTOTAL,
                            TB_COMPRA.STATUS_PEDIDO,
                            DATE_FORMAT(TB_COMPRA.DATA_COMPRA, '%d-%m-%Y %H:%i') AS DATA_COMPRA
                    FROM TB_ITENS_COMPRA
                    INNER JOIN TB_COMPRA ON TB_COMPRA.ID = TB_ITENS_COMPRA.ID_COMPRA
                    INNER JOIN TB_PRODUTOS ON TB_PRODUTOS.ID = TB_ITENS_COMPRA.ID_PRODUTO
                    INNER JOIN TB_ENDERECO ON TB_ENDERECO.ID = TB_COMPRA.ID_ENDERECO
                    INNER JOIN TB_USER ON TB_USER.ID = TB_ENDERECO.ID_USER
                    WHERE TB_USER.ID = '$idUser'
                    ORDER BY TB_COMPRA.DATA_COMPRA DESC";
            $resultC = mysqli_query($conn, $sqlC) or die (mysqli_error());
            $rowNumC = mysqli_num_rows($resultC);


            
        }

        //Edição de Conta
        if(isset($_SESSION['sucesso_editConta'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        text: 'Informações de Conta Editadas com Sucesso!'
                    })
                </script>";
            unset($_SESSION['sucesso_editConta']);

        } else if(isset($_SESSION['erro_editConta'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'Não foi possível Editar as informações da Conta!'
                    })
                </script>";
            unset($_SESSION['erro_editConta']); 
        }

        //Edição Senha;
        if(isset($_SESSION['sucesso_editSenha'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'STATUS DE EDIÇÃO',
                        text: 'Senha alterado com sucesso! No próximo login, será utilizado a nova senha'
                    })
                </script>";
            unset($_SESSION['sucesso_editSenha']);

        } else if(isset($_SESSION['erro_editSenha'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'STATUS DE EDIÇÃO',
                        text: 'Não foi possível alterar sua Senha'
                    })
                </script>";
            unset($_SESSION['erro_editSenha']); 
        }

        //STATUS de ADIÇÃO DE ADMIN
        if(isset($_SESSION['erro_email'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'EMAIL INVÁLIDO!'
                    })
                  </script>";
            unset($_SESSION['erro_email']);
        }

        if(isset($_SESSION['data_invalida'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'DATA INVÁLIDA'
                    })
                  </script>";
            unset($_SESSION['data_invalida']);

        } else if (isset($_SESSION['idade_invalida'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'MENOR DE IDADE!'
                    })
                  </script>";
            unset($_SESSION['idade_invalida']);

        } 

        if(isset($_SESSION['confirma_senha'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        text: 'Senhas diferentes! Tente Novamente'
                    })
                  </script>";
            unset($_SESSION['confirma_senha']);
        }
        
        if(isset($_SESSION['sucesso_cadastro'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'STATUS DE CADASTRO',
                        text: 'Novo Admin adicionado com Sucesso!'
                    })
                </script>";
            unset($_SESSION['sucesso_cadastro']);

        } else if(isset($_SESSION['erro_cadastro'])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'STATUS DE CADASTRO',
                        text: 'Não foi possível cadastrar Admin'
                    })
                </script>";
            unset($_SESSION['erro_cadastro']); 
        }
        

    ?>

    <?php
        //Estou pegando a aba de Navegação 
        include('header.php');
    ?>


    <main>
        <div class="container">
            <div class="nav-content">
                <article class="infoUser">
                    <p>Olá, Bem Vindo(a) <strong><?php echo $_SESSION['user'] ?></strong></p>
                </article>

                <article class="action-btn">
                    <button class="acDadosUser">Dados Pessoais</button>
                    <button class="acEndUser">Endereço(s)</button>
                    <?php
                        if(isset($_SESSION['acesso']) && $_SESSION['acesso'] < 2):
                    ?>
                    <button class="acPedUser">Meus Pedidos</button>
                    <?php
                        endif;
                    ?>
                    <button class="acAltSenha">Alterar Senha</button>
                    <?php
                        if(isset($_SESSION['acesso']) && $_SESSION['acesso'] >= 3):
                    ?>
                        <button class="acAddAdmin">Adicionar Admin</button>
                    <?php 
                        endif;
                    ?>
                </article>
            </div>
            <article class="content">
                <section class="content-dadosUser acDadosUser">
                    <h1>Dados Pessoais</h1>
                    <form method="POST" action="../assets/php/edit-conta-php.php?acao=upD&id=<?php echo $idUser ?>">
                        
                        <!--Nome e Sobrenome-->
                        <fieldset  class="row-content2">
                            <div class="containerInput">
                                <label for="nome">Nome</label>
                                <input type="text" disabled="true" required name="nome" id="nome" value="<?php echo $rowU['NOME']?>">
                                
                            </div>
                            <div class="containerInput">
                                <label for="sobreN">Sobrenome</label>
                                <input type="text" disabled="true" required name="sobreN" id="sobreN" value="<?php echo $rowU['SOBRENOME']?>">    
                            </div>
                        </fieldset>
                        <!--Email-->
                        <fieldset>
                            <div class="containerInput">
                                <label for="email">Email</label>
                                <input type="text" disabled="true" required name="email" id="email" value="<?php echo $rowU['EMAIL']?>">
                            </div>
                        </fieldset>
                        <!--Date-->
                        <fieldset>
                            <div class="containerInput">
                                <label for="dataNasc">Data de Nasc.</label>
                                <input type="text" disabled="true" required name="dataNasc" id="dataNasc" value="<?php echo $rowU['DATANASC']?>">
                            </div>
                        </fieldset>
                        <fieldset class="btn-edit">
                            <input type="submit" value="Confirmar" name="editarD">
                            
                        </fieldset>
                    </form>
                    <div class="divOpEdit">
                        <button class="opEdit">Editar</button>
                    </div>
                </section>
                <section class="content-endUser acEndUser">
                    <h1>Endereço</h1>
                    <form method="POST" action="../assets/php/edit-conta-php.php?acao=upE&id=<?php echo $idUser ?>">
                        <!--CEP E ESTADO-->
                        <fieldset>
                            <div class="containerInput">
                                <label for="cep">CEP</label>
                                <input type="text" disabled="true" required name="cep" class="cep" onblur="pesquisacep(this.value);" value="<?php echo $rowE['CEP']?>">
                            </div>
                        </fieldset>
                        <!--ESTADO E CIDADE-->
                        <fieldset  class="row-content2">
                            <div class="containerInput">
                                <label for="cidade">Cidade</label>
                                <input type="text" disabled="true" required name="cidade" class="cidade" value="<?php echo $rowE['CIDADE']?>">
                            </div>
                            <div class="containerInput">
                                <label for="uf">Estado</label> 
                                <input type="text" disabled="true" required name="uf" class="uf" value="<?php echo $rowE['ESTADO']?>">
                            </div>
                        </fieldset>
                        <!--Bairro-->
                        <fieldset>
                            <div class="containerInput">
                                <label for="bairro">Bairro</label>
                                <input type="text" disabled="true" required name="bairro" class="bairro" value="<?php echo $rowE['BAIRRO']?>">
                            </div>
                        </fieldset>
                        <!--Rua-->
                        <fieldset>
                            <div class="containerInput">
                                <label for="rua">Rua</label>
                                <input type="text" disabled="true" required name="rua" class="rua" value="<?php echo $rowE['RUA']?>">
                            </div>
                        </fieldset>
                        <!--NUMERO E COMPLEMENTO-->
                        <fieldset  class="row-content2">
                            <div class="containerInput">
                                <label for="num">Número</label>
                                <input type="text" disabled="true" required name="num" class="num" value="<?php echo $rowE['NUMERO']?>">
                            </div>
                            <div class="containerInput">
                                <label for="Cplement">Complemento</label> 
                                <input type="text" disabled="true" required name="Cplement" class="Cplement" value="<?php echo $rowE['COMPLEMENTO']?>">
                            </div>
                        </fieldset>
                        <fieldset class="btn-edit">
                            <input type="submit" value="Editar Dados" name="editarD">
                        </fieldset>
                    </form>
                    <div class="divOpEdit">
                        <button class="opEdit">Editar</button>
                    </div>
                </section>
                <section class="content-pedUser acPedUser">
                    <h1>Informações de Pedidos</h1>
                    <?php 
                        if(mysqli_num_rows($resultComp) != 0): 
                            while ($rowComp = mysqli_fetch_assoc($resultComp)):
                                $idCompra = $rowComp['ID'];
                                $sqlProdCons = "SELECT TB_PRODUTOS.IMG,
                                                       TB_PRODUTOS.NOME_PROD,
                                                       TB_PRODUTOS.PRECO,
                                                       TB_ITENS_COMPRA.QTD,
                                                       TB_ITENS_COMPRA.SUBTOTAL
                                                FROM TB_ITENS_COMPRA
                                                INNER JOIN TB_COMPRA ON TB_COMPRA.ID = TB_ITENS_COMPRA.ID_COMPRA
                                                INNER JOIN TB_PRODUTOS ON TB_PRODUTOS.ID = TB_ITENS_COMPRA.ID_PRODUTO
                                                WHERE TB_ITENS_COMPRA.ID_COMPRA = '$idCompra'
                                                ORDER BY TB_COMPRA.DATA_COMPRA DESC";
                                $resultProdCons = mysqli_query($conn, $sqlProdCons);
                                
                    ?>
                                <div class="pedUser-container">
                                    <div class="pedUser-info">
                                        <div class="pedUser-info-top">
                                            <div>
                                                <span>
                                                    <h2>Data do Pedido</h2>
                                                    <p><?php echo $rowComp['DATA_COMPRA'] ?></p>
                                                </span>
                                                <span class="tipo_pag">
                                                    <?php if($rowComp['TIPO_PAG'] == 'PIX'): ?>
                                                        <img src="../assets/style/imagens/icones/pix-conta.png" alt="pix">
                                                    <?php else: ?>
                                                        <img src="../assets/style/imagens/icones/credit-conta.png" alt="credit">
                                                    <?php endif; ?>
                                                </span>
                                                <span>
                                                    <h2>Total</h2>
                                                    <p>R$<?php echo $rowComp['TOTAL']?></p>
                                                </span>
                                            </div>
                                            <?php if($rowComp['STATUS_PEDIDO'] == 'ABERTO'): ?>
                                                <p class="pedUser-info-status status-pend"><?php echo $rowComp['STATUS_PEDIDO']?></p>
                                            <?php elseif($rowComp['STATUS_PEDIDO'] == 'A CAMINHO'): ?>
                                                <p class="pedUser-info-status status-camin"><?php echo $rowComp['STATUS_PEDIDO']?></p>
                                            <?php endif; ?>
                                        </div>
                                        <?php while($rowProdCons = mysqli_fetch_assoc($resultProdCons)):?>
                                            <div class="pedUser-content">
                                                <div class="img-prod">
                                                    <img src="../assets/style/imagens/menu/<?php echo $rowProdCons['IMG']?>" alt="imagem">
                                                </div>
                                                <div class="pedUser-text">
                                                    <p class="pedUser-name"><?php echo $rowProdCons['NOME_PROD']?></p>
                                                    <p>R$<span><?php echo $rowProdCons['PRECO']?></span> X <span><?php echo $rowProdCons['QTD']?></span></p>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                    <?php
                            endwhile; 
                        else: 
                    ?>
                        <p>Não há produtos disponíveis.</p>
                    <?php endif; ?>
                </section>
                <section class="content-altSenha acAltSenha">
                    <h1>Alterar Senha</h1>
                    <form method="POST" action="../assets/php/edit-conta-php.php?acao=upS&id=<?php echo $idUser ?>">
                        <!--SENHA ATUAL-->
                        <fieldset>
                            <div class="containerInput">
                                <label for="senhaAt">Senha Atual</label>
                                <input type="password" disabled="true" required name="senhaAt" id="senhaAt">
                            </div>
                        </fieldset>
                        <!--NOVA SENHA-->
                        <fieldset>
                            <div class="containerInput">
                                <label for="senhaN">Nova Senha</label>
                                <input type="password" disabled="true" required name="senhaN" id="senhaN">
                            </div>
                        </fieldset>
                        <fieldset class="btn-edit">
                            <input type="submit" value="Alterar Senha" name="editarD">
                        </fieldset>
                    </form>
                    <div class="divOpEdit">
                        <button class="opEdit">Editar</button>
                    </div>
                </section>
                <section class="content-addAdmin acAddAdmin">
                    <h1>Adicionar ADMIN</h1>
                    <form method="POST" action="../assets/php/cadastro-php.php?acao=addA">
                        <!--NOME E SOBRENOME-->
                        <fieldset class="row-content2">
                            <div class="containerInput">
                                <label for="nome">Nome</label>
                                <input type="text" disabled="true" required name="nome" id="nomeAdmin">
                            </div>
                            <div class="containerInput">
                                <label for="sobreN">Sobrenome</label>
                                <input type="text" disabled="true" required name="sobreN" id="sobreNAdmin"">    
                            </div>
                        </fieldset>
                        <!--Email-->
                        <fieldset>
                            <div class="containerInput">
                                <label for="email">Email</label>
                                <input type="text" disabled="true" required name="email" id="emailAdmin">
                            </div>
                        </fieldset>
                        <!--Nascimento-->
                        <fieldset class="row-content3">
                            <div class="containerInput">
                                <label for="diaNasc">Dia</label>
                                <input type="text" disabled="true" required name="diaNasc" id="diaAdmin">
                            </div>
                            <div class="containerInput">
                                <label for="mesNasc">Mês</label>
                                <input type="text" disabled="true" required name="mesNasc" id="mesAdmin">    
                            </div>
                            <div class="containerInput">
                                <label for="anoNasc">Ano</label>
                                <input type="text" disabled="true" required name="anoNasc" id="anoAdmin">    
                            </div>
                        </fieldset>
                        <!--SENHA-->
                        <fieldset class="row-content2">
                            <div class="containerInput">
                                <label for="senha">Senha</label>
                                <input type="password" disabled="true" required name="senha" class="senha">
                            </div>
                            <div class="containerInput">
                                <i class="fas fa-eye olho-pass"></i>
                                <label for="confirmS">Confirmar Senha</label>
                                <input type="password" disabled="true" required name="confirmS" class="confirmS">
                            </div>
                        </fieldset>
                        <fieldset class="btn-edit">
                            <input type="submit" value="Adicionar" name="editarD">
                        </fieldset>
                    </form>
                    <div class="divOpEdit">
                        <button class="opEdit">Editar</button>
                    </div>
                </section>
            </article>
        </div>
    </main>


    <footer>
        <div class="footer-info" id="href-contact">
            
            <div class="footer-info-contact">
                <h2>Contate-nos em caso de Dúvidas</h2>
                <p id="phone">
                    <i class="fas fa-phone-alt"></i>
                    (14)996047286
                </p>
                <p id="footer-socialmedia">
                    <a href="">
                        <i class="fab fa-facebook"></i> 
                    </a>
                    <a href="">
                        <i class="fab fa-instagram"></i> 
                    </a>
                    <a href="">
                        <i class="fab fa-twitter"></i> 
                    </a>
                </p>
            </div>
        </div>
 
        <hr>

        <div class="final-info">
            <p>Todos os Direitos reservados à padaria Monamour</p>
            <p>Desenvolvido por: <span id="color-name">NT</span>erprise</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../assets/js/navBar-responsive.js"></script>
    <script src="../assets/js/altDiv-jquery.js"></script>
    <script src="../assets/js/btnEdit-jquery.js"></script>
    <script src="../assets/js/viewPass.js"></script>
    <script src="../assets/js/sessionAnimInpage-jquery.js"></script>
    <script src="../assets/js/jquery.mask.js"></script>
    <script src="../assets/js/cepComplet.js"></script>
    <script src="../assets/js/alertAdmin.js"></script>
    <script>
        $(document).ready(function() {
            $('#diaAdmin').mask('00');           
            $('#mesAdmin').mask('00');
            $('#anoAdmin').mask('0000');
            $('.cep').mask('00000-000')
            
        });

    </script>


</body>
</html>