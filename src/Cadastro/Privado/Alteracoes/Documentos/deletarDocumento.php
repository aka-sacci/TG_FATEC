<?php

require_once "../../../../../vendor/autoload.php";
include_once "../../../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require "../../../../scripts/connectionClass.php";
$codDoc = $_GET["cod"];
$cnpj = $_SESSION["cnpj"];
$validate = false;

$sql = "select * from documento_empresa_privada
INNER JOIN documento_tipo
on documento_empresa_privada.tipo = documento_tipo.cod 
where documento_empresa_privada.cod = $codDoc and cnpj = $cnpj";
foreach ($connection->query($sql) as $key => $value) {
    $validate = true;
    $descricaoDoc = $value['descricao_doc'];
    $doc = $value['descricao'];
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
    <form action="deletarDocumentoAction.php" method="post"> 
      <p><b>Exclusão de Documento - </b></p>
      <?php
        echo "<p>Documento: " . $doc . " </p>";
        echo "<p>Descrição: " . $descricaoDoc . ". </p>";
        echo "<p><a href='../../../../scripts/abrirArquivoPDF.php?filename=" . $codDoc .  ".pdf&dir=Documentos/&titulo=" . $doc . " - $cnpj'  target='_blank'>Ver documento</a></p>";
        echo "<input name='txtCod' hidden value='$codDoc' required>";
        ?>
         <p><b>Para confirmar a exclusão do documento acima, digite sua senha</b></p><input name="txtSenha" type="password" required>
        <p><input type='submit' value="Confirmar" id="btnSubmit"/></p>
        </form> 
    </body>


</html>
