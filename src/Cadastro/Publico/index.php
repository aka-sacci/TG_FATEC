<?php
    require_once "../../../vendor/autoload.php";
    include_once "../../scripts/validaLogin.php";
    include_once "indexBody.php";
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
                <li class="nav-item dropdown"><!-- dropdown Cadastro -->
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Ferramentas</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="Alteracoes">Consultar Dados</a>
                        <a class="dropdown-item" href="../../Pedido/criarPedido.php">Criar Pedido</a>
                        <a class="dropdown-item" href="../../Pedido/meusPedidos.php">Ver Pedidos</a>
                        <a class="dropdown-item" href="../../Perfis/Pedidos/buscarPedido.php">Banco de Preços</a>
                    </div>    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../sobrenos.php">Sobre Nós</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../contato.php">Contato</a>
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
                    } else {
                    }
                    ?>                   
                </p>
            </div>

        <!-- Container Corpo do Index -->
        <?php
        if (isset($descStatus)) {
        } else {
            echo returnBody();
        }
        ?>
            
            <hr class="featurette-divider">
            <!-- Brand -->
            <div class="row mar-bot5">
                <div class="col-md-offset-3 col-md-12">                     
                    <div class="centro">                    
                        <h2>Nossos Parceiros Públicos</h2>
                        <p class="pprincipal">Estes são outros Órgãos Públicos, que assim como você, utilizam o Portal Licitatudo.</p>                      
                    </div>                      
                </div>
            </div></br></br>
            <section id="publi-brand">
                <div class="container">                   
                    <div class="row mar-bot40">
                        <div class="col-md-2 col-sm-4 col-xs-6"><a target="_blank" href="https://www.nazarepaulista.sp.gov.br/"><img src="../../Imagens/pref-nazare-pta.png" alt="nazare-pta">Nazaré Paulista</a></div>
                        <div class="col-md-2 col-sm-4 col-xs-6"><a target="_blank" href="https://www.bjperdoes.sp.gov.br/"><img src="../../Imagens/pref-bjp.png" alt="bjp">BJ Perdões</a></div>
                        <div class="col-md-2 col-sm-4 col-xs-6"><a target="_blank" href="https://www.capital.sp.gov.br/"><img src="../../Imagens/pref-sp.png" alt="sp"><br>São Paulo</a></div>
                        <div class="col-md-2 col-sm-4 col-xs-6"><a target="_blank" href="http://www.prefeituradeatibaia.com.br/"><img src="../../Imagens/pref-atibaia.png" alt="atibaia">Atibaia</a></div>
                        <div class="col-md-2 col-sm-4 col-xs-6"><a target="_blank" href="https://santaisabel.sp.gov.br/portal/"><img src="../../Imagens/pref-sta-isabel.png" alt="sta-isabel">Santa Isabel</a></div>
                        <div class="col-md-2 col-sm-4 col-xs-6"><a target="_blank" href="https://prefeitura.rio/"><img src="../../Imagens/pref-rio.png" alt="rio"><br>Rio de Janeiro</a></div>
                    </div>
                </div>
            </section><!--/#publi-brand -->

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
