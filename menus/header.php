<header>
    <div class="logo">
        <a href="../index.php">
            <img src="../assets/style/imagens/icones/logo-monamour-1.png" alt="logo">
        </a>
    </div>
    <div class="nav-login">             
        <ul>
            <li><a href="../index.php">Inicío</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="../index.php#href-about">Sobre nós</a></li>
            <li class="dp-li">
                <a href="#">Conta</a>
                <ul>
                    <?php
                        if(!isset($_SESSION['user'])):
                    ?>
                        <li><a href="../login-cadastro/tela-login.php">Entrar</a></li>
                        <hr>
                        <li><a href="../login-cadastro/tela-cadastro.php">Cadastrar-se</a></li>    
                    <?php
                        endif;
                    ?>
                    <?php 
                        if(isset($_SESSION['user'])):
                    ?>
                        <li><a href="conta.php">Minha conta</a></li>
                        <hr>
                        <li><a href="#"><?php echo $_SESSION['user'] ?></a></li>
                        <hr>
                        <?php
                            if($_SESSION['acesso'] >= 2):
                        ?>
                        <li><a href="pedidos.php">Pedidos</a></li>
                            <?php
                                if($_SESSION['acesso'] >= 3):
                            ?>
                                <hr>
                                <li><a href="gerAdmin.php">Ger. Admins</a></li>   
                            <?php
                                endif;
                            ?>
                        <hr>   
                        <?php
                            endif;
                        ?>
                        <li><a href="../assets/php/logout.php">Sair</a></li>
                    <?php
                        endif;
                    ?>
                </ul>
            </li>
            <li class="inpage"><a href="#href-contact">Contato</a></li>
            <?php
                if(!isset($_SESSION['user'])):
            ?>
                <li><a href="../login-cadastro/tela-login.php"><i class="fas fa-shopping-cart"></i></a></li>
            <?php
                elseif(isset($_SESSION['acesso']) && $_SESSION['acesso'] >= 2):  
            ?>
                <li><a href="" class="adminBuy"><i class="fas fa-shopping-cart"></i></a></li>
            <?php
                endif;
            ?>
            <?php
                if(isset($_SESSION['user']) && $_SESSION['acesso'] < 2):
            ?>
                <li class="Cart-li">
                    <?php
                        if(isset($_SESSION['carrinho']) && $_SESSION['carrinho'] != array()):
                            $count_cart = count($_SESSION['carrinho']);
                    ?>
                        <p class="count-Cart"><?php echo $count_cart ?></p>
                    <?php
                        endif;
                    ?>
                    <a href="carrinho.php"><i class="fas fa-shopping-cart"></i></a>
                </li>
            <?php
                endif;
            ?> 
        </ul>

    </div>
    <div class="menu-icon">
        <i class="fas fa-bars"></i>
    </div>
</header>