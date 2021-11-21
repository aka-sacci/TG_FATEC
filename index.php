<?php
use function PHPSTORM_META\type;
require_once "vendor/autoload.php";
    session_start();
    $connection  = require 'src/scripts/connectionClass.php';

    if (isset($_SESSION['login'])){
        $type = $_SESSION['type'];
        if($type == "PUB") header("location: src/Cadastro/Publico");
        if($type == "PRI") header("location: src/Cadastro/Privado");
        
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>LicitaTudo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Vitor Matos & Lucas Sacci">
        <link rel="shortcut icon" type="image/x-icon" href="src/Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="src/scripts/utils/style.css">
        <!-- Lista de icones -->
        <link  rel="stylesheet" href="src/scripts/utils/fontawesome/css/all.css">
		<!-- skin -->
		<link rel="stylesheet" href="src/scripts/utils/default.css">
        <!-- jQuery e Bootstrap JS -->
        <script type="text/javascript" src="src/scripts/utils/scriptsBasicos.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php
            if(isset($_SESSION['login'])) {
            $login = $_SESSION['login'];
            }
        ?>    
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
                <li class="nav-item dropdown"><!-- dropdown Login -->
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
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sobrenos.html">Sobre Nós</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contato.html">Contato</a>
                </li>
                </ul>
            </div>
            </div>
        </nav>  

        <!-- Container Corpo do Index -->
        <div class="container py-4" id="container-corpoindex">
            <div class="container marketing">
                <div class="row featurette back-claro">
                    <div class="col-md-8">
                        <h2 class="featurette-heading">Licitações é com o <span class="text-primary">LicitaTudo.</span></h2>
                        <p class="pprincipal">Facilite o processo de localização e registro de fornecedores, obtenção de orçamentos e cotações de qualidade com o portal LicitaTudo. Transações B2G, </br> entre governo-fornecedores, facilitadas de um jeito que você nunca viu e com a praticidade que só a gente pode te oferecer.</p>
                        <a class="btn btn-lg buttoncad" href="sobrenos.html" type="button">Saiba mais aqui</a>
                    </div>
                    <div class="col-md-4 img"><br>
                    <img src="src/Imagens/header-teamwork.png" alt="alternative" width=310 height=270>
                    </div>
                </div></br>
            </div> 
            <hr class="featurette-divider">

            <!-- Nossos diferenciais -->
            <div class="container"> 
                <div class="row mar-bot5">
                    <div class="col-md-offset-3 col-md-12">						
                        <div class="centro">					
                            <h2>Nossos serviços</h2>
                            <p class="pprincipal">O portal do Licitatudo está aqui para agilizar o processo de licitação, oferecendo:</p>						
                        </div>						
                    </div>
                </div></br>

                <div class="row mar-bot40">
                    <div class="col-lg-4" >
                        <div class="align-center service-col">					
                            <div class="service-icon centro">
                                <figure><i class="fa fa-chart-line"></i></figure>
                            </div><br>
                                <h2>Facilidade</h2>
                                <p>Forneça, colete, Solicite e consulte diversos orçamentos de uma forma fácil e prática em um só lugar.</p>		
                        </div>
                    </div>
                        
                    <div class="col-lg-4" >
                        <div class="align-center service-col">					
                            <div class="service-icon centro">
                                <figure><i class="fa fa-business-time"></i></figure>
                            </div><br>
                                <h2>Agilidade</h2>
                                <p>Otimize seu tempo e reduza o período gasto no processo de coleta de orçamentos para Licitações.</p>
                        </div>
                    </div>	

                    <div class="col-lg-4" >
                        <div class="align-center service-col">					
                            <div class="service-icon centro">
                                <figure><i class="fa fa-search-location"></i></figure>
                            </div><br>
                                <h2>Eficiência</h2>
                                <p>Disponha de ferramentas como o delimitador de distância para definir uma área de atuação.</p>
                        </div>
                    </div>			
                </div>
            </div>	
            <hr class="featurette-divider">

            <!-- Para fornecedores -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="text-container"></br></br>
                            <h2>Para você Fornecedor</h2>
                            <p class="pprincipal">Faça como muitas outras empresas e simplifique a forma de oferecer orçamentos dos seus produtos e serviços para os órgãos públicos, além de ser notificado pelos pedidos que forem sendo abertos.</p>
                            <a class="btn btn-outline-dark" type="button" href="src/Cadastro/Privado/novoCadastro.php">Cadastrar agora</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="image-container">
                            <img class="img-fluid" src="src/Imagens/detalhes-1.svg" alt="alternative" width=420 height=420>
                        </div>
                    </div>
                </div>
            </div> <hr class="featurette-divider">

            <!-- Para Orgaos Publicos -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="image-container">
                            <img class="img-fluid" src="src/Imagens/detalhes-2.svg" alt="alternative" width=420 height=420>
                        </div>
                    </div>
                    <div class="col-lg-6"></br></br>
                        <div class="text-container">
                            <h2>Para sua Instituição Pública</h2>
                            <p class="pprincipal">Obtenha os orçamentos necessários para sua compra pública em menor tempo e com maior qualidade. Agilize os processos de compra direta e licitação de forma simples e fácil e ainda veja os processos em aberto de outros Órgãos Públicos.</p>
                            <a class="btn btn-outline-dark" type="button" href="src/Cadastro/Publico/novoCadastro.php">Cadastrar agora</a>
                        </div>
                    </div>
                </div>
            </div> <hr class="featurette-divider">
        
            <!-- footer da página -->
            <footer>
                <div class="container centro col-md-12">
                    <p class="text-muted">Copyright &copy; Licitatudo 2021 - Todos os direitos reservados</p>
                </div> 
            </footer> 
            
        </div>     
    </body>
</html>