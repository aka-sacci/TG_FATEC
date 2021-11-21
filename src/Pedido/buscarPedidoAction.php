<?php

$connection  = require '../scripts/connectionClass.php';
session_start();
$arrayPedidosCod = array();
if (isset($_GET['buscaTXT'])) {
    //se for por termo, ele faz a pesquisa normal
    $busca = $_GET['buscaTXT'];

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
//var_dump($arrayPedidosCod);
} else {
    if (isset($_GET['selectCat'])) {
        //se for por select, ele pesquisa os pedidos que batem com aquele select
        $busca = $_GET['selectCat'];
        $sql = "SELECT pedido, categoria.categoria FROM pedido
        INNER JOIN categoria_pedido ON
        pedido.cod = categoria_pedido.pedido
        INNER JOIN categoria ON 
        categoria_pedido.categoria = categoria.cod
        WHERE categoria_pedido.categoria = $busca";
        foreach ($connection->query($sql) as $key => $value) {
            array_push($arrayPedidosCod, $value['pedido']);
            $descCategoria = $value['categoria'];
        }
        $busca = $descCategoria;
    } else {
        header("Location:buscarPedido.php");
    }
}

$filter = array_unique($arrayPedidosCod);
$_SESSION['pedidos']  = $filter;
$_SESSION['termoPesquisa'] = $busca;
header("Location:mostrarPedidos.php");
