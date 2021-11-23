<?php

include_once "../../../../scripts/validaLogin.php";
validarLogin("PUB");
$connection  = require "../../../../scripts/connectionClass.php";
$novoTelefone = $_POST['txtTelefone'];
$connection  = require '../../../../scripts/connectionClass.php';
$sql = "update instituicao_publica set telefone = '" . $novoTelefone . "' where cnpj = " . $_SESSION['cnpj'] . "";
$prepare = $connection->prepare($sql);
$prepare->execute();
echo "<link rel='shortcut icon' type='image/x-icon' href='../../../../Imagens/Logo-Licita.ico'>
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
<link rel='stylesheet' href='../../../../scripts/utils/style.css'>
<script type='text/javascript' src='../../../../scripts/utils/scriptsBasicos.js'></script>
<div class='container py-4 col-lg-4' id='container-corpoindex'>
    <div class='alert alert-info' role='alert'>
    <h4 class='alert-heading'>Seu telefone foi alterado com sucesso!</h4>
    </div></br>          
    <button class='btn btn-md buttoncad' onclick='goBack()'>Voltar</button>
</div>";