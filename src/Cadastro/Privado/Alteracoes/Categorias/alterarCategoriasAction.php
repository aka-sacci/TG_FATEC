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
echo "<link rel='shortcut icon' type='image/x-icon' href='../../../../Imagens/Logo-Licita.ico'>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
        <link rel='stylesheet' href='../../../../scripts/utils/style.css'>
        <script type='text/javascript' src='../../../../scripts/utils/scriptsBasicos.js'></script>
        <div class='container py-4 col-lg-4' id='container-corpoindex'>
            <div class='alert alert-info' role='alert'>
            <h4 class='alert-heading'>Categorias alteradas com sucesso!</h4>
            </div></br>          
            <button class='btn btn-md buttoncad' onclick='goBack()'>Voltar</button>
        </div>";
