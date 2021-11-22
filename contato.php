<?php
session_start();
//checka se ta logado
$status = false;
if(isset($_SESSION['login'])) $status=true;

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Contato - LicitaTudo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="src/Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600,700,700i&amp;subset=latin-ext" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="src/scripts/utils/style.css">
        <!-- Lista de icones -->
        <link  rel="stylesheet" href="src/scripts/utils/fontawesome/css/all.css">
		<!-- skin -->
		<link rel="stylesheet" href="src/scripts/utils/default.css">
        <!-- jQuery e Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>

    <body>
        <!-- Barra de navegação -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top">
            <div class="container">
            <a class="navbar-brand" href="index.php" id="nav-img">
                <img src="src/Imagens/Logo-Licita.png" alt="" width="30" height="30" class="d-inline-block align-text-center"> LicitaTudo            
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav me-auto mb-2 mb-md-0"><!-- nav-item active -->
                    <?php 
                        if(!$status){
                            //se não tiver logado, retorna o menu genérico
                            echo ' <li class="nav-item dropdown"><!-- dropdown Login -->
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Login</a>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="src/Cadastro/Privado/login.php">Conta Privada</a>
                                <a class="dropdown-item" href="src/Cadastro/Publico/login.php">Conta Pública</a>
                                </div>    
                            </li>
                            <li class="nav-item dropdown"><!-- dropdown Cadastro -->
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Cadastro</a>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="src/Cadastro/Privado/novoCadastro.php">Conta Privada</a>
                                <a class="dropdown-item" href="src/Cadastro/Publico/novoCadastro.php">Conta Pública</a>
                                </div>    
                            </li>';
                        }else{
                        //senão, retorna os menus pub e pri
                        if($_SESSION['type'] == "PUB"){
                            //retorna o menu pub
                            echo '<li class="nav-item dropdown"><!-- dropdown Cadastro -->
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Ferramentas</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="src/Cadastro/Publico/Alteracoes">Consultar Dados</a>
                                    <a class="dropdown-item" href="src/Pedido/criarPedido.php">Criar Pedido</a>
                                    <a class="dropdown-item" href="src/Pedido/meusPedidos.php">Ver Pedidos</a>
                                    <a class="dropdown-item" href="src/Perfis/Pedidos/buscarPedido.php">Banco de Preços</a>
                                </div>    
                            </li>';
                        }else{
                            //retorna o menu priv
                            echo '<li class="nav-item dropdown"><!-- dropdown Ferramentas -->
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Ferramentas</a>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="src/Pedido/meusOrcamentos.php">Meus Orçamentos</a>
                                <a class="dropdown-item" href="src/Pedido/buscarPedido.php">Buscar por Pedidos</a>
                                </div>    
                            </li>';
                        }
                        }   
                    ?>

                <li class="nav-item">
                    <a class="nav-link" href="sobrenos.php">Sobre Nós</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="">Contato</a>
                </li>
                </ul>
            </div>
            </div>
        </nav>

        <!-- Container Corpo do Index -->
        <div class="container py-3" id="container-corpoindex">  
            <!-- Contact -->
            <div class="Contato-mapa">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>INFORMAÇÕES DE CONTATO</h2><hr><br>
                            <div class="list-unstyled li-space-lg">
                                <p class="pprincipal">Não hesite em nos ligar ou enviar uma mensagem através do formulário de contato.</p>
                                <p><i class="fas fa-map-marker-alt"></i>R. Dom Duarte Leopoldo, 83 - Centro, Bom Jesus dos Perdões - SP, 12955-000</p>
                                <p><i class="fas fa-phone"></i><a class="turquoise" href="tel:11968449267">+55 11 968449267</a><a>    |    </a>
                                <i class="fas fa-envelope"></i><a class="turquoise" href="mailto:contato@licitatudo.com.br">contato@licitatudo.com.br</a></p>
                            </div>
                        </div> <!-- end of col -->
                    </div> <!-- end of row -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="map-responsive">
                               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3668.927825418183!2d-46.46726508439366!3d-23.136313251919294!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cebe3b1b8413ed%3A0xe2412e96b3e5009f!2sPrefeitura%20de%20Bom%20Jesus%20dos%20Perd%C3%B5es!5e0!3m2!1spt-BR!2sbr!4v1637529266252!5m2!1spt-BR!2sbr" allowfullscreen></iframe>
                            </div>
                        </div> <!-- end of col -->
                        <div class="col-lg-6">
                            
                            <!-- Contact Form -->
                            <form id="contactForm" data-toggle="validator" data-focus="false" action="src/scripts/insertMessage.php" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control-input" id="cname" name="cname" required>
                                    <label class="label-control" for="cname">Nome</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control-input" id="cemail" name="cemail" required>
                                    <label class="label-control" for="cemail">Email</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control-textarea" id="cmessage" name="cmessage" required></textarea>
                                    <label class="label-control" for="cmessage">Sua Mensagem</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-md buttoncad">Enviar Mensagem</button>
                                </div>
                                <div class="form-message">
                                    <div id="cmsgSubmit" class="h3 text-center hidden"></div>
                                </div>
                            </form>
                            <!-- end of contact form -->

                        </div> <!-- end of col -->
                    </div> <!-- end of row -->
                </div> <!-- end of container -->
            </div> <!-- end of Contato-mapa -->
            <!-- end of contact -->
            <hr class="featurette-divider">

            <!-- footer da página -->
            <footer>
                <div class="container centro col-md-12">
                    <p class="text-muted">Copyright &copy; Licitatudo 2021 - Todos os direitos reservados</p>
                </div> 
            </footer> 
            
        </div> 
    </body>
</html>