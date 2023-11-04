<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padaria - Home</title>
    <link rel="shortcut icon" href="assets/style/imagens/icones/icon-monamour-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/style/css/style-index.css">
    <link rel="stylesheet" href="assets/style/css/style-menu-footer.css">
    <link rel="stylesheet" href="assets/style/css/style-scroll.css">
    <!--Estilo Slides - Bootstrap-->
    <link rel="stylesheet" href="assets/style/css/style-carousel.css">
    <script src="https://kit.fontawesome.com/ca14b9e588.js" crossorigin="anonymous"></script>
    <!--Alerta-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
 
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="assets/style/imagens/icones/logo-monamour-1.png" alt="">
            </a>
        </div>
        <div class="nav-login">             
            <ul>
                <li><a href="index.php">Inicío</a></li>
                <li><a href="menus/menu.php">Menu</a></li>
                <li class="inpage"><a href="#href-about">Sobre nós</a></li>
                <li class="dp-li">
                    <a href="#">Conta</a>
                    <ul>
                        <?php
                            if(!isset($_SESSION['user'])):
                        ?>
                            <li><a href="login-cadastro/tela-login.php">Entrar</a></li>
                            <hr>
                            <li><a href="login-cadastro/tela-cadastro.php">Cadastrar-se</a></li>
                        <?php
                            endif;
                        ?>
                        <?php 
                            if(isset($_SESSION['user'])):
                        ?>
                            <li><a href="menus/conta.php">Minha conta</a></li>
                            <hr>
                            <li><a href="#"><?php echo $_SESSION['user'] ?></a></li>
                            <hr>
                            <?php
                                if($_SESSION['acesso'] >= 2):
                            ?>
                            <li><a href="menus/pedidos.php">Pedidos</a></li>
                                <?php
                                    if($_SESSION['acesso'] >= 3):
                                ?>
                                    <hr>
                                    <li><a href="menus/gerAdmin.php">Ger. Admins</a></li>   
                                <?php
                                    endif;
                                ?>
                            <hr>   
                            <?php
                                endif;
                            ?>
                            <li><a href="assets/php/logout.php">Sair</a></li>
                        <?php
                            endif;
                        ?>
                    </ul>
                </li>
                <li class="inpage"><a href="#href-contact">Contato</a></li>
                <?php
                    if(!isset($_SESSION['user'])):
                ?>
                    <li><a href="login-cadastro/tela-login.php"><i class="fas fa-shopping-cart"></i></a></li>
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
                        <a href="menus/carrinho.php"><i class="fas fa-shopping-cart"></i></a>
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
    

    <main>
        <!--Slides-->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="overlay-image" style="background-image: url(assets/style/imagens/bread-gc66a5c47d_1920.jpg);"></div>
                    <div class="container">
                        <h1>A Padaria sempre <strong>+</strong></h1>
                        <p>
                            <strong>+</strong> Amor <br>
                            <strong>+</strong> Qualidade <br>
                            <strong>+</strong> Compromisso <br>
                            <strong>+</strong> Segurança <br>
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="overlay-image" style="background-image: url(assets/style/imagens/img2.jpg);"></div>
                    <div class="container" id="container-pt2">
                        <h1>Melhores Produtos</h1>
                        <p>Os Melhores Produtos Você Encontrará Somente Aqui na Padaria <strong>Monamour</strong>.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="overlay-image" style="background-image: url(assets/style/imagens/img4.jpg);"></div>
                    <div class="container" id="container-pt3">
                        <h1>Qualidade Impecável</h1>
                        <p>Todos os Produtos São Feitos pelas mãos dos Melhores Profissionais, Trazendo Para Todos os Nossos Clientes a Melhor Qualidade e um Sabor <strong>INESQUECÍVEL</strong>.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="overlay-image" style="background-image: url(assets/style/imagens/img5.jpg);"></div>
                    <div class="container" id="container-pt4">
                        <h1>Faça Já a sua Compra</h1>
                        <p>Está Esperando o quê? <strong>Faça já a sua Compra</strong> Aqui em Nosso Site. Acesse Agora Mesmo Nosso Cardápio na Aba <strong>Menu</strong> e Desfrute de um Sabor <strong>incomparável</strong>!</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!--Fim dos Slides-->
        <hr>
        
        <div class="info-padaria">
            <h1>Um pouco de Nossa Especialidade</h1>

            <section>
                <!--Content 1-->
                <div class="content">
                    <div class="content-text anime anime-left">
                        <h2>Produtos de Extrema Qualidade</h2>
                        <p>Aqui nossos produtos são feitos com a maior qualidade possível, possuindo os melhores ingredientes e as melhores ferramentas, com o intuito de trazer a maior qualidade para os <strong>Nossos Clientes</strong>.</p>
                    </div>

                    <div class="content-media">
                        <video autoplay muted loop width="100%" height="100%">
                            <source src="assets/style/media/video2-product2.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>

                <!--Content 2-->
                <!--Posição Contrária-->
                <div class="content reverse-content">
                    <div class="content-text anime anime-right">
                        <h2>Amor e Carinho</h2>
                        <p>Todos os Alimentos são feitos com <strong>Amor</strong> e <strong>Carinho</strong>. Aqui todos os profissionais priorizam esses dois tópicos, trazendo assim, uma qualidade jamais vista. Sinta-se Abraçado e venha conhecer nossos Produtos!</p>
                    </div>

                    <div class="content-media">
                        <video autoplay muted loop width="100%" height="100%">
                            <source src="assets/style/media/video3-product3.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
                <!--Fim-->

                <!--Content 3-->
                <div class="content">
                    <div class="content-text anime anime-left">
                        <h2>Feito para toda Família</h2>
                        <p>Em nossa Paradaria temos Produtos para <strong>Toda Família</strong>, desde os produtos mais simples até os mais Complexos, ambos Feitos com os <strong>melhores ingredientes</strong> e pelas mãos dos <strong>melhores profissionais</strong>.</p>
                    </div>

                    <div class="content-media">
                        <video autoplay muted loop width="100%" height="100%">
                            <source src="assets/style/media/video4-product4.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
            </section>
        </div>

        <section class="fundo-bg" style="background-image: url(assets/style/imagens/fundo-bg-teste4.jpg);">
            <div></div>
            <h1>A pitada de Amor, você encontra somente aqui</h1>
        </section>

        <div class="bg-avalCli">
            <div class="avalCli">
                <h1>Avaliações de Nossos Clientes</h1>
                <section class="avalLeft">
                    <p>A melhor Padaria da cidade. Os produtos são de Extrema qualidade. Agora com o site ficou muito mais fácil efetuar as compras do produto, além disso a entrega foi excelente!!! Sem dúvidas comprarei mais vezes. Recomendo!</p>
                    <p class="nomeCli">Marcus Vinicius A.</p>
                </section>
                <section class="avalRight">
                    <p>Comprei um Bolo de Chocolate na Monamour e meu deus. O bolo é maravilhoso!!! Adorei. Um gosto incrivelmente Fabuloso. A entrega do Bolo foi super rápido. Adorei muito o novo ambiente de compra.</p>
                    <p class="nomeCli">Carina L.</p>
                </section>
                <section class="avalLeft">
                    <p>Comprei recentemente Alguns Croissant's e também alguns pães rústicos, e honestamente foi os melhores sabores que eu senti em toda minha vida. O gosto e qualidade são impecáveis. Quanto a entrega, embora tenha demorado um pouco chegou tudo certinho. Por isso sem dúvidas recomendo a Padaria Monamour. Com certeza comprarei mais vezes.</p>
                    <p class="nomeCli">Bruna C.</p>
                </section>
                <section class="avalRight">
                    <p>Todo o Cardápio é extratamente fabuloso. Quanto ao gosto? Definiria com uma palavra. "Impecável". Comprando agora pelo novo site da padaria ficou muito mais fácil e organizado se comparado a antes, então a compra foi bem tranquila. Quanto a entrega foi super rápida. Recomendo muito comprarem aqui!!!</p>
                    <p class="nomeCli">Emerson I.</p>
                </section>
                <section class="avalLeft">
                    <p>Os melhores pães da região. Comprei recentemente alguns Pães Doces e me surpreendi. A princípio não esperava que o gosto fosse tão incrível, porém ao provar pela primeira vez fiquei extramente encantada. Após essa minha primeira experiência, decidi comprar novamente e não me arrependo. Sem dúvidas Recomendo a todos comprarem na Monamour.</p>
                    <p class="nomeCli">Daniele E.</p>
                </section>
                <section class="avalRight">
                    <p>Há um tempo comprei uma Torta Gelada na Monamour e sinceramente fiquei abismado com o quão incrível era o sabor dela. Sem dúvidas ela possuí um sabor único, exclusivo da Monamour. Confesso que não esparava que fosse tão boa, mas fico feliz que eu estava errado. Comprarei mais vezes!!!</p>
                    <p class="nomeCli">Kaillainy T.</p>
                </section>
            </div>
        </div>

        <section class="fundo-bg" style="background-image: url(assets/style/imagens/fundo-bg2-teste3.jpg);">
            <div></div>
            <h1>Uma vida boa, é uma vida doce. Aproveite e venha os conhecer nossos doces.</h1>
        </section>

        <div class="about" id="href-about">            
            <div class="about-content">             
                <section id="about-img" style="background-image: url(assets/style/imagens/paes-about.jpg);"></section>  
                <section id="about-text">
                    <h1 class="anime anime-top">Quem Somos?</h1>
                    <p class="anime anime-top">A Monamour Padaria abriu suas portas pela primeira em 2018, em Itaí. Na época, ela era uma padaria extremamente pequena, com poucos produtos disponíveis para venda. Porém, na medida que os anos foram se passando a Monamour foi crescendo e hoje ela conta com a produção e venda de diversos produtos, como tortas, salgados, bolos e bebidas. E é claro que não poderia faltar os Pães. Vale lembrar que as Vendas desses produtos são realizadas unicamente em nosso site.</p>
                </section>
            </div>
        </div>

        <hr>

        <div class="aviso-cardapio" id="inCardapio">
            <h1>Ficou interessado em comprar nossos produtos?</h1>
            <h2>Acesse agora mesmo Nosso Cardápio na aba <strong>MENU</strong></h2>

            <i class="fas fa-angle-up fa-2x" id="back-to-top"></i>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="assets/js/navBar-responsive.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="assets/js/sessionAnimInpage-jquery.js"></script>
    <script src="assets/js/scrollAnim.js"></script>
    <script src="assets/js/alertAdmin.js"></script>
    <script>
        var button = $("#back-to-top");

        button.click(function() {
            $('html, body').animate({scrollTop:0}, 'fast');
        })

    </script>

    
    

</body>
</html>