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

$sqlNovasNotificacoes = "SELECT pedido,
notificacao_pedido.cod,
pedido.data_abertura,
instituicao_publica.razao_social,
pedido.titulo
FROM notificacao_pedido
INNER JOIN pedido ON notificacao_pedido.pedido = pedido.cod
INNER JOIN instituicao_publica ON pedido.cnpj = instituicao_publica.cnpj
WHERE notificacao_pedido.empresa = $cnpj AND
notificacao_pedido.status = 1
";

$sqlVelhasNotificacoes = "SELECT pedido,
notificacao_pedido.cod,
pedido.data_abertura,
instituicao_publica.razao_social,
pedido.titulo
FROM notificacao_pedido
INNER JOIN pedido ON notificacao_pedido.pedido = pedido.cod
INNER JOIN instituicao_publica ON pedido.cnpj = instituicao_publica.cnpj
WHERE notificacao_pedido.empresa = $cnpj AND
notificacao_pedido.status = 2
";

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>LicitaTudo - Notificações</title>
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
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li><li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                
                <li class="nav-item dropdown nav-item active"> <!-- adicionei isso: navbar-nav ml-aut -->
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Conta</a>
                <div class="dropdown-menu">   
                    <a class="dropdown-item">
                        <?php
                            echo "Usuário: <b><cite> " . $login . "</cite></b>";

                        ?>  
                    </a>
                    <a class="dropdown-item" href="../../Cadastro/config/logout.php">Logout</a>
                </div>
                </li>
                <li class="nav-item"><a class="nav-link disable" href="#"></a></li>
                <li class="nav-item dropdown nav-item active">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i></a>
                        <div class="dropdown-menu">   
                            <?php
                            echo '<a class="dropdown-item" href="">Notificações (' . $nroNotificacoes . ')</a>';
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
                <h4 class="alert-heading">Notificações</h4>
                <p>                   
                    <?php

                    if ($nroNotificacoes == 0) {
                    } else {
                        //exibe as novas notificações
                        echo "<BR><h5 class='alert-heading'>Notificações Novas</h5><hr>";
                        foreach ($connection->query($sqlNovasNotificacoes) as $key => $value) {
                            $tituloPedido = $value['titulo'];
                            $valorData = strtotime($value['data_abertura']);
                            $data = strftime('%d/%m/%Y', $valorData);
                            $hora = strftime('%H:%M', $valorData);
                            echo  "<p> " . $value["razao_social"] .  " emitiu um novo Pedido de Cotação para a sua área de atuação! - $tituloPedido no dia $data às $hora";
                            echo "<br><a href='alteraNotificacao.php?codNotificacao=" . $value["cod"] . "&codPedido=" . $value["pedido"] . "'>CONFERIR AGORA</a></p><hr>";
                        }
                    }

                    echo "<BR><h5 class='alert-heading'>Notificações Antigas</h5>";
                    $nullNotificacoesAntigas = "<p>NÃO HÁ NOTIFICAÇÕES!</p>";
                    foreach ($connection->query($sqlVelhasNotificacoes) as $key => $value) {
                        $nullNotificacoesAntigas = "";
                        $tituloPedido = $value['titulo'];
                        $valorData = strtotime($value['data_abertura']);
                        $data = strftime('%d/%m/%Y', $valorData);
                        $hora = strftime('%H:%M', $valorData);
                        echo  "<p> " . $value["razao_social"] .  " emitiu um novo Pedido de Cotação para a sua área de atuação! - $tituloPedido no dia $data às $hora";
                        echo "<br><a href='../../Perfis/Pedidos/visualizarPedido.php?cod=" . $value["pedido"] . "'>CONFERIR AGORA</a></p><hr>";
                    }

                    echo $nullNotificacoesAntigas;

                    ?>                   
                </p>
            </div>

            <hr class="featurette-divider">

            <!-- footer da página -->
            <div class="container center col-md-3">
             <p class="text-muted">&copy; Licitatudo  2020 – 2021</p>
            </div>
        </div>       
    </body>
</html>
