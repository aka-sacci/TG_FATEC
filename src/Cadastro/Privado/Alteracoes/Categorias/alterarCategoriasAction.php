<?php

include_once "../../../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require "../../../../scripts/connectionClass.php";
$myCnpj = $_SESSION["cnpj"];
$quantidateCategorias = $_POST['qtdeCategorias'];
$arrayCategorias = array();
for ($i = 1; $i <= $_POST['qtdeCategorias']; $i++) {
    $thisCategoria = $_POST["selectCategorias" . $i];
    array_push($arrayCategorias, $thisCategoria);
}
    $arrayCategorias = array_unique($arrayCategorias);
//deleta todas as categorias
    $sqlDelete = "delete from categoria_empresa_privada where cnpj=$myCnpj";
$prepare = $connection->prepare($sqlDelete);
$prepare->execute();
foreach ($arrayCategorias as $key => $register) {
    $sql = "insert into categoria_empresa_privada(categoria, cnpj)  values($register ,$myCnpj)";
    $prepare = $connection->prepare($sql);
    $prepare->execute();
}

    echo "<p>Categorias alteradas com sucesso! Clique <a href='../'>aqui</a> para retornar</p>";
