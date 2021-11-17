<?php

require_once "../../../../../vendor/autoload.php";
include_once "../../../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require "../../../../scripts/connectionClass.php";
$sqlTipos = "SELECT * FROM documento_tipo ORDER BY descricao asc";

?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Inserir documento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
    <h1>Adicionar novo documento</h1>

    <form action="inserirDocumentoAction.php" method="post" enctype="multipart/form-data"> 
        <p>Categoria do documento:<br>
    <select name="selectTipos">
        <?php
        foreach ($connection->query($sqlTipos) as $key => $value) {
            echo "<option value='" . $value['cod'] . "'>" . $value['descricao']  . "</option> ";
        }
        ?>
    </select></p>

        <p>Arquivo:
        <br><input type="file" name="file" accept=".pdf" required></p>

        <p>Descrição:
        <br><input type="text" name="txtDesc" required></p>
        <p><input type='submit' value="Inserir" id="btnSubmit" /></p>

        </form> 
    </body>


</html>
