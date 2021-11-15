<?php

require_once "../../vendor/autoload.php";
include_once "../scripts/validaLogin.php";
validarLogin("PUB");
$connection  = require '../scripts/connectionClass.php';
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
$cnpj = $_SESSION["cnpj"];
$sql = "select * from pedido where cnpj = '$cnpj' order by data_abertura DESC";
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
     /*$dataAberturaToTime = strtotime( $value['data_abertura'] );
    $dataAbertura = strftime( '%A, %d/%m/%Y', $dataAberturaToTime );
    $horaAbertura = strftime( '%H:%M', $dataAberturaToTime );

       echo '<div id="' . $value['cod'] . '" onclick="redirecionarPedido()">
       <h4>' . $value['titulo'] . '</h4>
        <p> ' . $value['descricao'] . ' </p>
        <p> Pedido aberto em ' . $dataAbertura . ' às ' . $horaAbertura .'</p>
       </div>';
        */
    }

    ?>
    
    </body>


</html>
