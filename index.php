<?php
    require_once "vendor/autoload.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>LicitaTudo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="src/Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="src\scripts\utils\style.css">
        <!-- jQuery e Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>

    <body">
        <?php
            if(isset($_SESSION['login'])) {
            $login = $_SESSION['login'];
            }
        ?>    
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
            <a class="navbar-brand" href="index.php" id="nav-img">
                <img src="src/Imagens/Logo-Licita.png" alt="" width="30" height="30" class="d-inline-block align-text-center">
                    LicitaTudo            
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto"><!-- nav-item active -->
                <li class="nav-item">
                    <a class="nav-link"><!-- Logado como -->
                        <?php
                        if(isset($login)){
                            echo $login;
                        }
                        ?>
                    </a>
                </li>
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
                    <a class="nav-link" href="#">Sobre Nós</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contato</a>
                </li>
                </ul>
            </div>
            </div>
        </nav>  
          
            <!-- Container Corpo do Index -->
            <div class="container py-4" id="container-corpoindex">
                <div class="p-5 mb-4 back-claro">
                <div class="container-fluid py-3">
                    <h1 class="display-5 fw-bold col-md-8">Licitações é com o LicitaTudo</h1>
                    <p class="col-md-8">Facilite o processo de localização e registro de fornecedores, obtenção de orçamentos e cotações de qualidade com o portal LicitaTudo. Transações B2G de um jeito que você nunca viu e com a facilidade que só a gente pode te oferecer.</p>
                    <!--<button class="btn btn-lg buttoncad" type="button">Saiba mais aqui</button>-->
                </div>
                </div>

                <div class="row align-items-md-stretch">
                <div class="col-md-6">
                    <div class="h-90 p-5 text-white bg-dark">
                    <h2>Para você Fornecedor</h2>
                    <p>Faça como muitas outras empresas e simplifique a forma de oferecer orçamentos produtos e serviços para órgãos públicos, além de ficar por dentro das licitações em aberto.</p>
                    <a class="btn btn-outline-light" type="button" href="src/Cadastro/Privado/novoCadastro.php">Cadastrar agora</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="h-90 p-5 bg-light border">
                    <h2>Para sua Instituição Pública</h2>
                    <p>Obtenha os orçamentos necessários para sua compra pública em menor tempo e com maior qualidade. Agilize os processos de compra direta e licitações de forma fácil. </p>
                    <a class="btn btn-outline-secondary" type="button" href="src/Cadastro/Publico/novoCadastro.php">Cadastrar agora</a>
                    </div>
                </div>
                </div>
            </div>
    </body>
</html>
