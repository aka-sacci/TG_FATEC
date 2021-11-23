<?php
session_start();
//checka se ta logado
$status = false;
if(isset($_SESSION['login'])) {
    $status=true;
    $connection  = require "src/scripts/connectionClass.php";
    $cnpj = $_SESSION['cnpj'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Sobre Nós - LicitaTudo</title>
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
                            $sql = "select status_cadastro from instituicao_publica where cnpj = '" . $cnpj . "' limit 1";
                            foreach ($connection->query($sql) as $key => $value) {
                            $statusConta = $value['status_cadastro'];
                            }
                            if ($statusConta != 3) $statusConta = 'disabled';
                            else $statusConta = "";
                            echo '<li class="nav-item dropdown"><!-- dropdown Cadastro -->
                            <a class="nav-link dropdown-toggle '.$statusConta.'" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Ferramentas</a>
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

                <li class="nav-item active">
                    <a class="nav-link" href="#">Sobre Nós</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contato.php">Contato</a>
                </li>

                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>


                <?php 
                        if(!$status){
                            //se não tiver logado, retorna o menu genérico
                        }else{
                        //senão, retorna os menus pub e pri
                        if($_SESSION['type'] == "PUB"){
                            //retorna o menu pub
                            $sql = "select status_cadastro from instituicao_publica where cnpj = '" . $cnpj . "' limit 1";
                            foreach ($connection->query($sql) as $key => $value) {
                            $statusConta = $value['status_cadastro'];
                            }
                            if ($statusConta != 3) $statusConta = 'disabled';
                            else $statusConta = "";
                            echo '<li class="nav-item dropdown active"> <!-- adicionei isso: navbar-nav ml-aut -->
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Conta</a>
                            <div class="dropdown-menu">   
                            <a class="dropdown-item">
                            Usuário: ' . $_SESSION['login'] . '  
                                </a>
                                <a class="dropdown-item '.$statusConta.'" href="src/Cadastro/Publico/Alteracoes">Consultar Dados</a>
                                <a class="dropdown-item" href="src/Cadastro/config/logout.php">Logout</a>
                                </div>
                            </li>';
                        }else{
                            //retorna o menu priv
                            echo '<li class="nav-item dropdown active"> <!-- adicionei isso: navbar-nav ml-aut -->
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Conta</a>
                            <div class="dropdown-menu">   
                            <a class="dropdown-item">
                            Usuário: ' . $_SESSION['login'] . '  
                                </a>
                                <a class="dropdown-item" href="src/Cadastro/Privado/Alteracoes">Consultar Dados</a>
                                <a class="dropdown-item" href="src/Cadastro/config/logout.php">Logout</a>
                                </div>
                            </li>';
                        }
                        }   
                    ?>

                </ul>
            </div>
            </div>
        </nav>
        <!-- Container Corpo do Index -->
        <div class="container py-4" id="container-corpoindex">
            <div class="container marketing">
                <div class="row featurette back-claro">
                    <div class="col-md-4 img">
                        <img src="src/Imagens/2-homens-conversando.svg" alt="alternative" width=300 height=280>
                    </div>
                    <div class="col-md-8">
                        <h2 class="featurette-heading">História do <span class="text-primary">LicitaTudo.</span></h2>
                        <p class="pprincipal">Para facilitar o processo de localização e registro de fornecedores, obtenção de orçamentos e cotações de qualidade, dois amigos, funcionários da Prefeitura Municipal de Bom Jesus dos Perdões, tiveram a ideia de desenvolver um portal para mediar a comunicação entre órgãos públicos que desejam comprar produtos ou contratar serviços de diversas categorias, e fornecedores que desejam atender essa demanda.</p>
                    </div>
                </div></br>
            </div> 
            <hr class="featurette-divider">

            <!-- Nossas Premissas -->
            <div id="services" class="cards-1">
                <div class="container">
                    <div class="row mar-bot5">
                        <div class="col-md-offset-3 col-md-12">						
                            <div class="centro">					
                                <h2>NOSSAS PREMISSAS</h2>
                                <p class="pprincipal">O portal Licitatudo foi criado com a finalidade de trazer uma maneira mais fácil, rápida e eficiente para se trabalhar com compras Públicas beneficiando ambas as partes. Fazemos isso com a finalidade de:</p>						
                            </div>						
                        </div>
                    </div></br> 
                    <div class="container">   
                        <div class="row mar-bot40">
                            <!-- Card -->
                            <div class="card col-lg-4">
                                <div class="align-center service-col">
                                <img class="card-image" src="src/Imagens/services-icon-1.svg" alt="alternative">
                                <div class="card-body">
                                    <h4 class="card-title">Facilitar o diálogo</h4>
                                    <p>Nosso portal se baseia no princípio de facilitar o diálogo entre empresas privadas e órgãos públicos, facilitando a troca de informações entre as partes.</p>
                                </div>
                            </div>
                            </div>
                            <div class="card col-lg-4">
                                <div class="align-center service-col">
                                <img class="card-image" src="src/Imagens/services-icon-2.svg" alt="alternative">
                                <div class="card-body">
                                    <h4 class="card-title">Mostrar as oportunidades</h4>
                                    <p>A notificação dos pedidos em aberto para os fornecedores de uma forma eficiente para agiliza as cotações solicitadas pelos órgãos públicos.</p>
                                </div>
                            </div>
                            </div>
                            <div class="card col-lg-4">
                                <div class="align-center service-col">
                                <img class="card-image" src="src/Imagens/services-icon-3.svg" alt="alternative">
                                <div class="card-body">
                                    <h4 class="card-title">Auxiliar nos processos</h4>
                                    <p>Sabemos o quão demorado e burocrático os processos públicos podem ser, nossa finalidade é justamente prestar auxílio nessas etapas.</p>
                                </div>
                            </div>
                            </div>                            
                        </div> 
                    </div> 
                </div> 
            </div> <hr class="featurette-divider">
            
            <!-- Video -->
            <div class="video-corp">
                <div class="col-md-2"></div>
                <div class="container col-md-8">
                    <div class="row centro">
                        <div class="col-lg-12">
                            <h2>VEJA NOSSO VIDEO INSTITUCIONAL</h2>
                        </div> 
                    </div><br> 
                    <div class="row">
                        <div class="col-lg-12">                           
                            <!-- Video Preview -->
                            <div class="image-container">
                                <div class="video-wrapper">
                                    <a class="popup-youtube" target="_blank" href="https://www.youtube.com/watch?v=_XlFvLGbly4" data-effect="fadeIn">
                                        <img class="img-fluid" src="src/Imagens/video-frame.svg" alt="alternative">
                                        <span class="video-play-button">
                                            <span></span>
                                        </span>
                                    </a>
                                </div> 
                            </div> 
                            <p>Este vídeo mostrará um pouco da hitória do portal <strong> Licitatudo </strong> e ajudará você a entender por que sua instituição deve contar com a gente.</p>
                        </div>
                    </div> 
                </div>
                <div class="col-md-2"></div>
            </div> <hr class="featurette-divider">

            <!-- Nosso Time -->
            <div class="Time">
                <div class="container">
                    <div class="row mar-bot5">
                        <div class="col-md-offset-3 col-md-12 centro">
                            <h2>SOBRE NOSSO TIME</h2>
                            <p>Conheça nossa equipe de profissionais de T.I. especializados em desenvolvimento Full Stack que ajudarão vocês Empresas Privadas, a alavancar e auxiliar em suas vendas, e aos funcionários de Órgãos Públicos, facilitando suas rotinas de trabalho de forma a agilizar os processos de cotação.</p>
                        </div> 
                    </div></br></br>
                    <div class="container">   
                        <div class="row mar-bot40">                       
                            <!-- Membro do Time 1 -->
                            <div class="team-member col-lg-3">
                                <div class="image-wrapper">
                                    <img class="img-fluid" src="src/Imagens/team-member-1.svg" alt="alternative">
                                </div> 
                                <p class="p-large"><strong>Lucas Gabriel</strong></p>
                                <p class="job-title">CEO & Desenvolvedor Back-End</p>
                                <span class="social-icons">
                                    <span class="fa-stack">
                                        <a target="_blank" href="https://www.facebook.com/saccizinhow">
                                            <i class="fas fa-circle fa-stack-2x facebook"></i>
                                            <i class="fab fa-facebook-f fa-stack-1x"></i>
                                        </a>
                                    </span>
                                    <span class="fa-stack">
                                        <a target="_blank" href="https://www.instagram.com/sascci/">
                                            <i class="fas fa-circle fa-stack-2x instagram"></i>
                                            <i class="fab fa-instagram fa-stack-1x"></i>
                                        </a>
                                    </span>
                                </span>
                            </div>
                            <!-- Fim Membro do Time 1 -->

                            <!-- Membro do Time 2 -->
                            <div class="team-member col-lg-3">
                                <div class="image-wrapper">
                                    <img class="img-fluid" src="src/Imagens/team-member-2.svg" alt="alternative">
                                </div>
                                <p class="p-large"><strong>Vitor Matos</strong></p>
                                <p class="job-title">CTO & Desenvolvedor <br> Front-End</p>
                                <span class="social-icons">
                                    <span class="fa-stack">
                                        <a target="_blank" href="https://www.facebook.com/vitor.am.reis">
                                            <i class="fas fa-circle fa-stack-2x facebook"></i>
                                            <i class="fab fa-facebook-f fa-stack-1x"></i>
                                        </a>
                                    </span>
                                    <span class="fa-stack">
                                        <a target="_blank" href="https://www.instagram.com/vittorr_mattoss/">
                                            <i class="fas fa-circle fa-stack-2x instagram"></i>
                                            <i class="fab fa-instagram fa-stack-1x"></i>
                                        </a>
                                    </span>
                                </span> 
                            </div> 
                            <!-- Fim Membro do Time 1 -->

                            <!-- Membro do Time 3 -->
                            <div class="team-member col-lg-3">
                                <div class="image-wrapper">
                                    <img class="img-fluid" src="src/Imagens/team-member-3.svg" alt="alternative">
                                </div>
                                <p class="p-large"><strong>João Paulo</strong></p>
                                <p class="job-title">Engenheiro de Software</p><br>
                                <span class="social-icons">
                                    <span class="fa-stack">
                                        <a target="_blank" href="https://www.facebook.com/profile.php?id=100039134743288">
                                            <i class="fas fa-circle fa-stack-2x facebook"></i>
                                            <i class="fab fa-facebook-f fa-stack-1x"></i>
                                        </a>
                                    </span>
                                    <span class="fa-stack">
                                        <a target="_blank" href="#your-link">
                                            <i class="fas fa-circle fa-stack-2x instagram"></i>
                                            <i class="fab fa-instagram fa-stack-1x"></i>
                                        </a>
                                    </span>
                                </span> 
                            </div> 
                            <!-- Fim Membro do Time 1 -->

                            <!-- Membro do Time 4 -->
                            <div class="team-member col-lg-3">
                                <div class="image-wrapper">
                                    <img class="img-fluid" src="src/Imagens/team-member-4.svg" alt="alternative">
                                </div>
                                <p class="p-large"><strong>Leonardo Akira</strong></p>
                                <p class="job-title">Auxiliar Técnico</p><br>
                                <span class="social-icons">
                                    <span class="fa-stack">
                                        <a target="_blank" href="https://www.facebook.com/leonardo.almeida.54540">
                                            <i class="fas fa-circle fa-stack-2x facebook"></i>
                                            <i class="fab fa-facebook-f fa-stack-1x"></i>
                                        </a>
                                    </span>
                                    <span class="fa-stack">
                                        <a target="_blank" href="#your-link">
                                            <i class="fas fa-circle fa-stack-2x instagram"></i>
                                            <i class="fab fa-instagram fa-stack-1x"></i>
                                        </a>
                                    </span>
                                </span> 
                            </div> 
                            <!-- Fim Membro do Time 1 -->  
                        </div> 
                    </div>
                </div> 
            </div> <hr class="featurette-divider">
            <!-- Fim Time -->

            <!-- footer da página -->
            <footer>
                <div class="container centro col-md-12">
                    <p class="text-muted">Copyright &copy; Licitatudo 2021 - Todos os direitos reservados</p>
                </div> 
            </footer>     
        </div> 
    </body>
</html>