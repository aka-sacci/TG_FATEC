<?php

require_once "../../vendor/autoload.php";
include_once "../scripts/validaLogin.php";
$connection  = require '../scripts/connectionClass.php';
$arrayCategoria = array();
$arrayModo = array();

//dados das caixas de seleção
//categoria
$sql = "select * from categoria order by categoria";
foreach ($connection->query($sql) as $key => $value) {
    $thisCategoria = array("cod" => $value["cod"], "categoria" => $value["categoria"]);
    array_push($arrayCategoria, $thisCategoria);
}
//modo
$sql = "select * from modo_pedido order by modo";
foreach ($connection->query($sql) as $key => $value) {
    $thisModo = array("cod" => $value["cod"], "modo" => $value["modo"]);
    array_push($arrayModo, $thisModo);
}

echo "<script>sessionStorage.setItem('categorias', '" . json_encode($arrayCategoria) . "');</script>";

?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Criar Pedido</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="scripts/itensActions.js"></script>
</head>

    <body onload="loadCriarPedido()">
        <h1>Abertura de novo pedido</h1>

    <form action="criarPedidoAction.php" method="post" onsubmit="avancar()">
        <!--    início informações básicas do pedido -->
        <p>Título do pedido</p>
        <input type="text" placeholder="Título" maxlength="50" id="txtTituloPedido" name="txtTituloPedido" required>
        <p>Descrição do pedido</p>
        <textarea placeholder="Descrição" maxlength="250" id="txtDescricaoPedido" name="txtDescricaoPedido" required></textarea>
        <!--    fim informações básicas do pedido -->
        
    <!--    início selecionar categoria -->
    <h3>Categorias </h3>
    <div class="divSelects" id="divSelects">
    <select name="selectCategorias1" id="selectCategorias1">
        <?php
        foreach ($arrayCategoria as $key => $registro) {
            echo "<option value='" . $registro['cod'] . "'>" . $registro['categoria']  . "</option> ";
        }
        ?>
    </select>
    </div>
    <p><button onclick="adicionarCategoria()" type="button" id="btnAdicionarCategoria">Adicionar mais uma categoria</button>
        <button onclick="deleteCategoria()" type="button" id="btnRemoverCategoria" disabled>Remover última categoria</button></p>
    <!--    fim selecionar categoria -->


    <!--    início itens -->
    <h3>Itens</h3>
    <div class="divItens">

    <p class="p1" id="p1">
    <input type="text" placeholder="Título do Item #1" maxlength="50" id="txtItem1" name="txtItem1" required>
    <textarea placeholder="Descrição detalhada do item #1" maxlength="400" id="txtDesc1" name="txtDesc1" required ></textarea>
    <input type="number" placeholder="Quantidade" id="txtQtde1" name="txtQtde1" value="1" required>
    <select id="selectQtde1" name="selectQtde1">
        <option value="un">Unidade</option>
        <option value="mt">Metro</option>
        <option value="lt">Litro</option>
    </select>
    </p>

    </div>

    <p><button onclick="adicionarItem()" type="button" id="addItem">Adicionar mais um item</button>
        <button onclick="deletarItem()" type="button" id="removeItem" disabled>Remover último item</button></p>
    <br>
    <!--    fim itens -->

    <!--    início modo -->
    <p>Modo do pedido:
    <select name="selectModoPedido">
        <?php
        foreach ($arrayModo as $key => $registro) {
            echo "<option value='" . $registro['cod'] . "'>" . $registro['modo']  . "</option> ";
        }
        ?>
    </select></p>
    <!--    fim modo -->

    <!--    início distância -->
    <p>Limitar distância máxima das empresas? <input type="checkbox" onclick="enableDistancia()" name="cbDistancia" class="cbDistancia"></p>
    <p><input type="number" name="txtDistancia" placeholder="Distância (KM)" class="txtDistancia" required></p>
    <!--    fim distância -->

    <button type="submit" >Avançar</button>
    </form>
    </body>


</html>
