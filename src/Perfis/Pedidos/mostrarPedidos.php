<?php
require_once "../../../vendor/autoload.php";
include_once "../../scripts/validaLogin.php";
validarLogin("PUB");
$connection  = require '../../scripts/connectionClass.php';
$pedidosCodArray = $_SESSION["pedidos"];
$retornoPedidos = "";

if (!$pedidosCodArray) {
    $retornoPedidos = "<p>A pesquisa não gerou nenhum resultado...</p>";
}

foreach ($pedidosCodArray as $key => $nroPedido) {
    $sql = "select pedido.cod, titulo, data_abertura, data_fechamento,
    modo_pedido.modo, status_pedido.status
    from pedido
    INNER JOIN modo_pedido ON pedido.modo = modo_pedido.cod
    INNER JOIN status_pedido ON pedido.status = status_pedido.cod
    where pedido.cod=$nroPedido order by data_abertura DESC";

    $dados = $connection->query($sql);
    foreach ($dados as $key => $value) {
        $dataAberturaToTime = strtotime($value['data_abertura']);
        $dataAbertura = strftime('%d/%m/%Y', $dataAberturaToTime);
        $horaAbertura = strftime('%H:%M', $dataAberturaToTime);

        $retornoPedidos .= '<div>
        <a href="visualizarPedidoComCotacoes.php?cod=' . $value['cod'] . '"><h4>' . $value['titulo'] . '</h4></a>
        <p>Pedido aberto no dia ' . $dataAbertura . ' às ' . $horaAbertura . '</p>
       </div><br>';
    }
}


?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta charset="utf-8">
        <title>Banco de preços</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="../../Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="../../scripts/utils/style.css">
        <!-- Lista de Icones Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- jQuery e Bootstrap JS -->
        <script type="text/javascript" src="../../scripts/utils/scriptsBasicos.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <body>
        </br>
        <a class="home" href="#" onclick="goBack()">
            <i class="fa fa-arrow-circle-left"> Voltar</i>
        </a>
        <div class="container col-lg-7" id="container-corpoindex">
            <H5><b>Resultados para '<?php echo $_SESSION["termoPesquisa"]?>'</b></H5><hr>
            <p><b></b></p><br>
                <?php

                echo $retornoPedidos;

                ?>

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
