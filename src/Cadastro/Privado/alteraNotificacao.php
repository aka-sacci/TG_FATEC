<?php

include_once "../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require "../../scripts/connectionClass.php";
$myCnpj = $_SESSION['cnpj'];
$validate = false;
$codNotificacao = $_GET["codNotificacao"];
$codPedido = $_GET["codPedido"];

$sql = "update notificacao_pedido set status=2 where cod=$codNotificacao and empresa=$myCnpj";
    $prepare = $connection->prepare($sql);
    $prepare->execute();
    header("Location:../../Perfis/Pedidos/visualizarPedido.php?cod=$codPedido");
