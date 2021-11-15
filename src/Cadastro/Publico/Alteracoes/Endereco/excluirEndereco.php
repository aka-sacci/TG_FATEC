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
    <title>LicitaTudo - Confirmar exclusão</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

    <body>
    <form action="excluirEnderecoAction.php" method="post"> 
      <p><b>Exclusão de endereço - </b></p>
      <?php
        echo "<p>" . $logradouro . ", " . $numero . ", " . $bairro . " - " .  $cidade . " (" . $uf . ") </p>";
        echo "<p>Descrição: " . $descricao . ". </p>";
        echo "<input name='txtCod' hidden value='$codEndereco' required>";
        ?>
         <p><b>Para confirmar a exclusão do endereço acima, digite sua senha</b></p><input name="txtSenha" type="password" required>
        <p><input type='submit' value="Confirmar" id="btnSubmit"/></p>
        </form> 
    </body>


</html>
