<?php

    require_once "../../../vendor/autoload.php";
    include_once "../../scripts/validaLogin.php";
    $connection  = require "../../scripts/connectionClass.php";
    validarLogin("PRI");
    $login = $_SESSION['login'];
    $cnpj = $_SESSION['cnpj'];

    //faz o select do número de notificações
    $sqlPedidos = "SELECT COUNT(notificacao_pedido.cod) FROM notificacao_pedido 
    WHERE notificacao_pedido.empresa = $cnpj AND
    notificacao_pedido.status = 1";
    $nroNotificacoes = 0;
foreach ($connection->query($sqlPedidos) as $key => $value) {
    $nroNotificacoes = $value['COUNT(notificacao_pedido.cod)'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>LicitaTudo - Privado</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="../../Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="../../scripts/utils/style.css">
        <!-- Lista de icones -->
        <link  rel="stylesheet" href="../../scripts/utils/fontawesome/css/all.css">
        <!-- skin -->
        <link rel="stylesheet" href="../../scripts/utils/default.css">
        <!-- jQuery e Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>

    <body> 
        <!-- Barra de navegação -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top">
            <div class="container">
            <a class="navbar-brand" href="index.php" id="nav-img">
                <img src="../../Imagens/Logo-Licita.png" alt="" width="30" height="30" class="d-inline-block align-text-center"> LicitaTudo            
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav me-auto mb-2 mb-md-0"><!-- nav-item active -->
                <li class="nav-item dropdown"><!-- Dropdown Ferramentas -->
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Ferramentas</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../../Pedido/meusOrcamentos.php">Meus Orçamentos</a>
                        <a class="dropdown-item" href="../../Pedido/buscarPedido.php">Buscar por Pedidos</a>
                    </div>    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../sobrenos.php">Sobre Nós</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../contato.php">Contato</a>
                </li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                
                <li class="nav-item dropdown nav-item active"> <!-- adicionei isso: navbar-nav ml-aut -->
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Conta</a>
                <div class="dropdown-menu">   
                    <a class="dropdown-item">
                        <?php
                            echo "Usuário: <b><cite> " . $login . "</cite></b>";
                        ?>  
                    </a>
                    <a class="dropdown-item" href="Alteracoes">Consultar Dados</a>
                    <a class="dropdown-item" href="../../Cadastro/config/logout.php">Logout</a>
                </div>
                </li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item dropdown nav-item active">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i></a>
                        <div class="dropdown-menu">   
                            <?php
                            echo '<a class="dropdown-item" href="notificacoes.php">Notificações (' . $nroNotificacoes . ')</a>';
                            ?>
                        </div>
                </li>  
                </ul>
            </div>
            </div>
        </nav>  
        
        <!-- Container Corpo do Index / Alert Login -->
        <div class="container py-4" id="container-corpoindex">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Bem vindo!</h4>
                <p>                   
                    <?php
                        echo "<p>Logado como <b><cite>" . $_SESSION['login'] . "</cite></b>.</p>";
                    ?>                   
                </p>
            </div>

            <!-- ESPAÇO EMPRESA PRIVADA -->
            <hr class="featurette-divider">
            <div class="container">
            <div class="row mar-bot5">
                <div class="col-md-offset-3 col-md-12">
                    <div class="centro">
                            <h2>ESPAÇO EMPRESA PRIVADA</h2>
                            <p class="pprincipal">Aqui você pode Consultar e Alterar seus dados cadastrais, além de consultar seus orçamentos já encaminhados no portal e ainda buscar de forma fácil por pedidos em aberto.</p>
                        </div>
                    </div>
                </div></br>
                <div class="row mar-bot40">
                <div class="col-lg-1"></div>
                    <div class="col-lg-3" >
                        <a href="Alteracoes">
                        <div class="align-center service-col centro">
                            <div class="service-icon centro">
                                <figure><i class="fa fa-database"></i></figure>
                            </div></a>
                                <h3>Consultar seus dados</h3></br></br>
                            <a class="btn btn-md buttoncad" type="button" href="Alteracoes">Clique aqui</a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                    <a href="../../Pedido/meusOrcamentos.php">
                    <div class="align-center service-col centro">
                            <div class="service-icon centro">
                            <figure><i class="fa fa-folder-open"></i></figure>
                            </div></a>
                            <h3>Ver meus orçamentos</h3></br></br>
                            <a class="btn btn-md buttoncad" type="button" href="../../Pedido/meusOrcamentos.php">Clique aqui</a>
                        </div>
                    </div>  
                    <div class="col-lg-3">
                        <a href="../../Pedido/buscarPedido.php">
                        <div class="align-center service-col centro">
                            <div class="service-icon centro">
                                <figure><i class="fa fa-search-plus"></i></figure>
                            </div></a>
                                <h3>Buscar por pedidos</h3></br></br>
                                <a class="btn btn-md buttoncad" type="button" href="../../Pedido/buscarPedido.php">Clique aqui</a>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>  
            
            <hr class="featurette-divider">
            <!-- Container Corpo do Index -->
            <div class="container marketing">
                <div class="row featurette back-claro">
                    <div class="col-md-7">
                        <h2 class="featurette-heading">O portal <span class="text-primary">LicitaTudo </span> facilita as coisas para a sua empresa.</h2>
                        <p class="pprincipal">Facilite o processo de localização e registro de fornecedores, obtenção de orçamentos e cotações de qualidade com o portal LicitaTudo. Transações B2G de um jeito que você nunca viu e com a facilidade que só a gente pode te oferecer.</p>
                    </div>
                    
                    <div class="col-md-5 img">
                        <img src="../../Imagens/equipe-sem-fundo.png" alt="abacate" width=460 height=270>
                    </div>
                </div></br>
            </div> 

            <hr class="featurette-divider">
            <!-- Brand Privada -->
            <div class="row mar-bot5">
                <div class="col-md-offset-3 col-md-12">                     
                    <div class="centro">                    
                        <h2>EMPRESAS PRIVADAS PARCEIRAS</h2>
                        <p class="pprincipal">Estas são outras Empresas Privadas, que assim como você, utilizam o Portal Licitatudo.</p>                      
                    </div>                      
                </div>
            </div></br></br>
            <section id="publi-brand">
                <div class="container">                   
                    <div class="row mar-bot40">
                        <div class="col-md-2 col-sm-4 col-xs-6"><a target="_blank" href="#"><img src="../../Imagens/logotipos/customer-logo-1.png" alt="emp-1"></a></div>
                        <div class="col-md-2 col-sm-4 col-xs-6"><a target="_blank" href="#"><img src="../../Imagens/logotipos/customer-logo-2.png" alt="emp-2"></a></div>
                        <div class="col-md-2 col-sm-4 col-xs-6"><a target="_blank" href="#"><img src="../../Imagens/logotipos/customer-logo-3.png" alt="emp-3"></a></div>
                        <div class="col-md-2 col-sm-4 col-xs-6"><a target="_blank" href="#"><img src="../../Imagens/logotipos/customer-logo-4.png" alt="emp-4"></a></div>
                        <div class="col-md-2 col-sm-4 col-xs-6"><a target="_blank" href="#"><img src="../../Imagens/logotipos/customer-logo-5.png" alt="emp-5"></a></div>
                        <div class="col-md-2 col-sm-4 col-xs-6"><a target="_blank" href="#"><img src="../../Imagens/logotipos/customer-logo-6.png" alt="emp-6"></a></div>
                    </div>
                </div>
            </section>

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
