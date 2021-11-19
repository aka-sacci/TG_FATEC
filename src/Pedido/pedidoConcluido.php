<?php

require_once "../../vendor/autoload.php";
include_once "../scripts/validaLogin.php";
validarLogin("PUB");
$pedidoId = $_SESSION['idPedido']

?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Pedido criado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

    <body>
    <?php
    echo "<p>Pedido número #$pedidoId gerado com sucesso!</p>";
    ?>
    <p>Clique <?php echo "<a href='visualisarMeuPedido.php?cod=$pedidoId'> aqui</a>"; ?> para visualizar o pedido completo.</p>
    <a href="../../">Voltar pro menu</a>
    </body>


</html>
