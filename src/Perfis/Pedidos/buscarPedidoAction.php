<?php

session_start();
if (isset($_GET['buscaTXT'])) {
    $busca = $_GET['buscaTXT'];
} else {
    header("Location:buscarPedido.php");
}
$connection  = require '../../scripts/connectionClass.php';
$arrayPedidosCod = array();
//seleciona por titulo do item
$sql = "SELECT pedido.cod FROM pedido
INNER JOIN item_pedido
ON pedido.cod = item_pedido.pedido_cod
WHERE item_pedido.item LIKE '%$busca%'";
foreach ($connection->query($sql) as $key => $value) {
    array_push($arrayPedidosCod, $value['cod']);
}

//seleciona por titulo do pedido
$sql = "SELECT pedido.cod FROM pedido
WHERE titulo LIKE '%$busca%'";
foreach ($connection->query($sql) as $key => $value) {
    array_push($arrayPedidosCod, $value['cod']);
}

//seleciona por cod do pedido
$sql = "SELECT pedido.cod FROM pedido
WHERE cod='$busca'";
foreach ($connection->query($sql) as $key => $value) {
    array_push($arrayPedidosCod, $value['cod']);
}

//seleciona por cnpj da pub
$sql = "SELECT pedido.cod FROM pedido
WHERE cnpj='$busca'";
foreach ($connection->query($sql) as $key => $value) {
    array_push($arrayPedidosCod, $value['cod']);
}

//seleciona por cnpj da priv
$sql = "SELECT pedido.cod FROM pedido
INNER JOIN cotacoes ON
pedido.cod = cotacoes.pedido
WHERE cotacoes.empresa='$busca'";
foreach ($connection->query($sql) as $key => $value) {
    array_push($arrayPedidosCod, $value['cod']);
}

$filter = array_unique($arrayPedidosCod);
$_SESSION['pedidos']  = $filter;
$_SESSION['termoPesquisa'] = $busca;
header("Location:mostrarPedidos.php");
//var_dump($arrayPedidosCod);
