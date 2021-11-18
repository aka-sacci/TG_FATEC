<?php

require_once "../../vendor/autoload.php";
include_once "../scripts/validaLogin.php";
validarLogin("PUB");
$connection  = require '../scripts/connectionClass.php';
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
$cnpj = $_SESSION["cnpj"];
$sql = "select pedido.cod, titulo, data_abertura, data_fechamento,
modo_pedido.modo, status_pedido.status
from pedido
INNER JOIN modo_pedido ON pedido.modo = modo_pedido.cod
INNER JOIN status_pedido ON pedido.status = status_pedido.cod
where cnpj = '$cnpj' order by data_abertura DESC";
$dados = $connection->query($sql);


?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Meus Pedidos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

    <body>
        <h1>Meus pedidos</h1>

    <?php
    foreach ($dados as $key => $value) {
    $dataAberturaToTime = strtotime( $value['data_abertura'] );
    $dataAbertura = strftime( '%d/%m/%Y', $dataAberturaToTime );
    $horaAbertura = strftime( '%H:%M', $dataAberturaToTime );

       echo '<div>
        <a href="visualisarMeuPedido.php?cod=' . $value['cod'] . '"><h4>' . $value['titulo'] . '</h4></a>
        <p>Pedido aberto no dia ' . $dataAbertura . ' às ' . $horaAbertura .'</p>
       </div><br>';
        
    }

    ?>
    
    </body>


</html>
