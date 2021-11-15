<?php

require_once "../../../../../vendor/autoload.php";
include_once "../../../../scripts/validaLogin.php";
validarLogin("PUB");
$connection  = require "../../../../scripts/connectionClass.php";
$codEndereco = $_GET["cod"];
$cnpj = $_SESSION["cnpj"];
$validate = false;

$sql = "select * from endereco_instituicao_publica where cod = $codEndereco and cnpj = $cnpj";
foreach ($connection->query($sql) as $key => $value) {
    $validate = true;
    $logradouro = $value["logradouro"];
    $numero = $value["numero"];
    $bairro = $value["bairro"];
    $cep = $value["cep"];
    $cidade = $value["cidade"];
    $uf = $value["uf"];
    $descricao = $value["descricao"];
}

if (!$validate) {
    header("location:../");
}


?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Atualizar endereço</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
    <h1>Atualizar endereço</h1>
    <form action="alterarEnderecoAction.php" method="post"> 
        <?php
        echo "<input name='txtCod' value='$codEndereco' hidden>";
        echo "<p><b>Logradouro</b></p><input name='txtLogradouro' value='$logradouro' required>";
        echo "<p><b>Número</b></p><input name='txtNumero' value='$numero' required>";
        echo "<p><b>Bairro</b></p><input name='txtBairro' value='$bairro' required>";
        echo "<p><b>CEP</b></p><input name='txtCEP' value='$cep' required>";
        echo "<p><b>Cidade</b></p><input name='txtCidade' value='$cidade' required>";
        echo "<p><b>UF</b></p><input name='txtUF' value='$uf' required>";
        echo "<p><b>Descrição do endereço</b></p><textarea placeholder='Descrição do endereço' name='txtDescricao' required>$descricao</textarea>";
        ?>
        <p><input type='submit' value="Atualizar" id="btnSubmit" /></p>
        </form> 
    </body>


</html>
