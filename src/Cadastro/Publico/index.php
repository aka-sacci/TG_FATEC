<?php
    require_once "../../../vendor/autoload.php";
    include_once "../../scripts/validaLogin.php";
    $connection  = require "../../scripts/connectionClass.php";
    validarLogin("PUB");
    $login = $_SESSION['login'];
    $cnpj = $_SESSION['cnpj'];

            $sql = "select status_cadastro from instituicao_publica where cnpj = '" . $cnpj . "' limit 1";
foreach ($connection->query($sql) as $key => $value) {
    $statusConta = $value['status_cadastro'];
}
if ($statusConta == "1") {
    $descStatus = "Seu cadastro foi solicitado com sucesso! Em breve, a equipe da Licitatudo entrará em contato!";
}
if ($statusConta == "2") {
    $descStatus = "Seu cadastro está sendo analisado! Em breve, a equipe da Licitatudo entrará em contato para confirmar seu cadastro!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>LicitaTudo - Público</title>
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
                <li class="nav-item dropdown"><!-- dropdown Login -->
                <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Login</a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="../../Cadastro/Privado/login.php">Conta Privada</a>
                    <a class="dropdown-item" href="../../Cadastro/Publico/login.php">Conta Pública</a>
                    </div>    
                </li>
                <li class="nav-item dropdown"><!-- dropdown Cadastro -->
                <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Cadastro</a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="../../Cadastro/Privado/novoCadastro.php">Conta Privada</a>
                    <a class="dropdown-item" href="../../Cadastro/Publico/novoCadastro.php">Conta Pública</a>
                    </div>    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sobre Nós</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contato</a>
                </li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                                
                <li class="nav-item dropdown active"> <!-- adicionei isso: navbar-nav ml-aut -->
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Conta</a>
                <div class="dropdown-menu">   
                <a class="dropdown-item">
                        <?php
                            echo "Usuário: " . $login;
                        ?>  
                    </a>
                    <a class="dropdown-item" href="../../Cadastro/config/logout.php">Logout</a>
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
                        echo "<p>Logado como " . $_SESSION['login'] . "</p>";
                        if (isset($descStatus)) {
                            echo $descStatus;
                        } else {}
                    ?>                   
                </p>
            </div>

        <!-- Container Corpo do Index -->
        <hr class="featurette-divider">
        <div class="container"> 
            <div class="row mar-bot5">
                <div class="col-md-offset-3 col-md-12">                     
                    <div class="centro">                    
                        <h2>Nossas ferramentas para você</h2>
                        <p class="pprincipal">Aqui você pode Consultar e alterar seus dados cadastrais, além de criar e consultar seus pedidos e ainda ficar por dentro dos pedidos abertos de outras Instituições públicas.</p>                       
                    </div>                      
                </div>
            </div></br>

            <div class="row mar-bot40">
                <div class="col-lg-3" >
                    <a href='Alteracoes'>
                    <div class="align-center service-col centro">                  
                        <div class="service-icon centro">
                            <figure><i class="fa fa-database"></i></figure>
                        </div></a>
                            <h3>Consultar seus dados</h3></br></br>
                            <a class="btn btn-md buttoncad" type="button" href='Alteracoes'>Clique aqui</a>     
                    </div>
                </div>
                    
                <div class="col-lg-3">
                    <a href='../../Pedido/criarPedido.php'>
                    <div class="align-center service-col centro">                  
                        <div class="service-icon centro">
                            <figure><i class="fa fa-folder-plus"></i></figure>
                        </div></a>
                            <h3>Criar novo pedido</h3></br></br>
                            <a class="btn btn-md buttoncad" type="button" href='../../Pedido/criarPedido.php'>Clique aqui</a>
                    </div>
                </div>  

                <div class="col-lg-3" >
                    <a href='../../Pedido/meusPedidos.php'>
                    <div class="align-center service-col centro">                  
                        <div class="service-icon centro">
                            <figure><i class="fa fa-list-alt"></i></figure>
                        </div></a>
                            <h3>Ver meus pedidos</h3></br></br>
                            <a class="btn btn-md buttoncad" type="button" href='../../Pedido/meusPedidos.php'>Clique aqui</a>
                    </div>
                </div>  
                
                <div class="col-lg-3" >
                    <a href='../../Pedido/meusPedidos.php'>
                    <div class="align-center service-col centro">                  
                        <div class="service-icon centro">
                            <figure><i class="fa fa-building"></i></figure>
                        </div></a>
                            <h3>Ver outros pedidos</h3></br></br>
                            <a class="btn btn-md buttoncad" type="button" href='../../Pedido/meusPedidos.php'>Clique aqui</a>
                    </div>
                </div> 
            </div>
        </div>  
        <hr class="featurette-divider">
            <div class="row align-items-md-stretch">
                <div class="col-md-6">
                    <div class="back-medio h-90 p-5 text-white">
                    <h2>Para você Fornecedor</h2>
                    <p>Faça como muitas outras empresas e simplifique a forma de oferecer orçamentos produtos e serviços para órgãos públicos, além de ficar por dentro das licitações em aberto.</p>
                    <a class="btn btn-outline-light" type="button" href="../../Cadastro/Privado/novoCadastro.php">Cadastrar agora</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="h-90 p-5 bg-light border">
                    <h2>Para sua Instituição Pública</h2>
                    <p>Obtenha os orçamentos necessários para sua compra pública em menor tempo e com maior qualidade. Agilize os processos de compra direta e licitações de forma fácil. </p>
                    <a class="btn btn-outline-secondary" type="button" href="../../Cadastro/Publico/novoCadastro.php">Cadastrar agora</a>
                    </div>
                </div>
            </div>
            <hr class="featurette-divider">

            <!-- footer da página -->
            <div class="container center col-md-3">
             <p class="text-muted">&copy; Licitatudo  2020 – 2021</p>
            </div>
        </div>       
    </body>
</html>
