<?php

include_once "../scripts/validaLogin.php";
$connection  = require '../scripts/connectionClass.php';
$distancia = null;
//var_dump($_POST);
if (isset($_POST['cbDistancia'])) {
    $distancia = $_POST['txtDistancia'];
}

//insere o pedido
$sql = 'INSERT INTO pedido (titulo, descricao, data_abertura, status, modo, cnpj, distancia) VALUES ("' . $_POST['txtTituloPedido'] . '", "' . $_POST['txtDescricaoPedido'] . '",
now(), 1, "' . $_POST['selectModoPedido'] . '", "' . $_SESSION['cnpj'] . '", "' . $distancia . '");';
$prepare = $connection->prepare($sql);
$prepare->execute();
$idPedido = $connection->lastInsertId();

//insere as categorias
$qtdeCategorias = $_POST["qtdeCategorias"];
for ($i = $qtdeCategorias; $i > 0; $i--) {
    $thisCategoria = $_POST['selectCategorias' . $i];
    $sql = 'INSERT INTO categoria_pedido (pedido, categoria) VALUES (' . $idPedido . ', "' . $thisCategoria . '");';
    $prepare = $connection->prepare($sql);
    $prepare->execute();
}

//insere as categorias
$qtdeItems = $_POST["qtdeItems"];
for ($i = $qtdeItems; $i > 0; $i--) {
    $thisItemTitulo = $_POST['txtItem' . $i];
    $thisItemDescricao = $_POST['txtDesc' . $i];
    $thisItemQtde = $_POST['txtQtde' . $i];
    $thisItemSelectQtde = $_POST['selectQtde' . $i];
    $sql = 'INSERT INTO item_pedido (item, descricao, quantidade, unidade, pedido_cod) VALUES ("' . $thisItemTitulo . '", "' . $thisItemDescricao . '", 
    "' . $thisItemQtde . '", "' . $thisItemSelectQtde . '", "' . $idPedido . '");';
    $prepare = $connection->prepare($sql);
    $prepare->execute();
}

$_SESSION['idPedido'] = $idPedido;
header("location:pedidoConcluido.php");
