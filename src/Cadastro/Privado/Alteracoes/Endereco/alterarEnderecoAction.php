<?php

include_once "../../../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require "../../../../scripts/connectionClass.php";
$sql = "update endereco_empresa_privada set
logradouro = '" . $_POST["txtLogradouro"] . "', 
numero = '" . $_POST["txtNumero"] . "', 
bairro =  '" . $_POST["txtBairro"] . "', 
cep = '" . $_POST["txtCEP"] . "', 
cidade = '" . $_POST["txtCidade"] . "', 
uf = '" . $_POST["txtUF"] . "', 
descricao = '" . $_POST["txtDescricao"] . "' 
where cod = " . $_POST["txtCod"] . "";
$prepare = $connection->prepare($sql);
$prepare->execute();
echo "<link rel='shortcut icon' type='image/x-icon' href='../../../../Imagens/Logo-Licita.ico'>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
        <link rel='stylesheet' href='../../../../scripts/utils/style.css'>
        <script type='text/javascript' src='../../../../scripts/utils/scriptsBasicos.js'></script>
        <div class='container py-4 col-lg-4' id='container-corpoindex'>
            <div class='alert alert-info' role='alert'>
            <h4 class='alert-heading'>O endereço foi atualizado com sucesso!</h4>
            </div></br>          
            <button class='btn btn-md buttoncad' onclick='goBack()'>Voltar</button>
        </div>";