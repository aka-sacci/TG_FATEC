<?php

require_once "../../../../../vendor/autoload.php";
include_once "../../../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require "../../../../scripts/connectionClass.php";
$codDoc = $_GET["cod"];
$myCnpj = $_SESSION["cnpj"];
$validate = false;

$sql = "select data_upload, descricao, descricao_doc from documento_empresa_privada
INNER JOIN documento_tipo ON 
documento_empresa_privada.tipo = documento_tipo.cod
WHERE cnpj = $myCnpj AND documento_empresa_privada.cod = $codDoc";
foreach ($connection->query($sql) as $key => $value) {
    $validate = true;
    $dataUpload = $value["data_upload"];
    $descricao = $value["descricao"];
    $descDoc = $value['descricao_doc'];
}

if (!$validate) {
    header("location:../");
}


?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Atualizar documentos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
    <h1>Atualizar documento: <?php echo  $descricao;?></h1>
    <form action="alterarDocumentoAction.php" method="post" enctype="multipart/form-data"> 
        <?php
        echo "<p><a href='../../../../scripts/abrirArquivoPDF.php?filename=" . $codDoc .  ".pdf&dir=Documentos/&titulo=" . $descricao . " - $myCnpj'  target='_blank'>Ver documento ($descDoc)
        </a></p>";
        echo "<p><input type='text' value='$codDoc' name='codDoc' required hidden/></p>"
        ?>
        <p><input type="file" name="file" accept=".pdf" required></p>
        <p><input type='submit' value="Atualizar" id="btnSubmit" /></p>
        </form> 
    </body>


</html>
