<?php

require_once "../../../../../vendor/autoload.php";
include_once "../../../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require "../../../../scripts/connectionClass.php";
$myCnpj = $_SESSION["cnpj"];
$arrayCategoria = array();
$arrayMinhasCategorias = array();


$sql = "select * from categoria order by categoria ASC";
foreach ($connection->query($sql) as $key => $value) {
    $thisCategoria = array("cod" => $value["cod"], "categoria" => $value["categoria"]);
    array_push($arrayCategoria, $thisCategoria);
}


$sql = "SELECT categoria.cod, categoria.categoria FROM categoria 
INNER JOIN categoria_empresa_privada ON
categoria.cod = categoria_empresa_privada.categoria
WHERE cnpj = $myCnpj";
$qtdeCats = 0;
foreach ($connection->query($sql) as $key => $value) {
    $thisCategoria = array("cod" => $value["cod"], "categoria" => $value["categoria"]);
    array_push($arrayMinhasCategorias, $thisCategoria);
    $qtdeCats++;
}

//var_dump($arrayCategorias);
echo "<script>sessionStorage.setItem('categorias', '" . json_encode($arrayCategoria) . "');</script>";
echo "<script>sessionStorage.setItem('counterCategorias', $qtdeCats);</script>";

?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Atualizar categorias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="alterarCategoriasActions.js"></script>
    <script type="text/javascript" src="../../../../scripts/utils/scriptsBasicos.js"></script>

</head>

    <body onload="bodyLoadCategorias()">
    <h1>Alterar categorias</h1>
    <form action="alterarCategoriasAction.php" method="post" onsubmit="enableCategoria()"> 
      
    <div id="divSelects" class="divSelects">
    <?php
    $i = 1;
    foreach ($arrayMinhasCategorias as $key => $registroMinhaCat) {
        echo '<select name="selectCategorias' . $i . '" id="selectCategorias' . $i . '" style="margin-right: 0.45rem; margin-bottom: 0.45rem">';
        foreach ($arrayCategoria as $key => $registro) {
            if ($registro['cod'] != $registroMinhaCat['cod']) {
                echo "<option value='" . $registro['cod'] . "'>" . $registro['categoria']  . "</option> ";
            } else {
                echo "<option value='" . $registro['cod'] . "' selected>" . $registro['categoria']  . "</option> ";
                $prevValues = $key;
            }
        }
        echo '</select>';
        unset($arrayCategoria[$prevValues]);
        $i++;
    }

    ?>
        </div>
        <p>*limite de 5 categorias por empresa privada</p>
        <p><button onclick="adicionarCategoria()" type="button">Adicionar categoria</button>
        <button onclick="deleteCategoria()" type="button">Remover</button></p>
       
        <p><input type='submit' value="Alterar"/></p>
        </form> 
    </body>


</html>
