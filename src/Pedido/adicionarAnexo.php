<?php

require_once "../../vendor/autoload.php";
include_once "../scripts/validaLogin.php";
validarLogin("PUB");
$connection  = require '../scripts/connectionClass.php';
$cnpj = $_SESSION["cnpj"];
$cod = $_GET['cod'];



?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Inserir documento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
    <h1>Adicionar novo anexo</h1>

    <form action="adicionarAnexoAction.php" method="post" enctype="multipart/form-data"> 
        <?php echo '<input type="text" value="' . $cod .  '" name="txtCod" hidden required>' ?>
        <p>Descrição do documento:<br>
        <input type="text" name="txtDesc" required>
        </p>

        <p>Arquivo:
        <br><input type="file" name="file" accept=".pdf" required></p>
        <p><input type='submit' value="Inserir" id="btnSubmit" /></p>

        </form> 
    </body>


</html>
