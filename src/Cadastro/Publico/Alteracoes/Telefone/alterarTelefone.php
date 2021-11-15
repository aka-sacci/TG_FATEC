<?php

require_once "../../../../../vendor/autoload.php";
include_once "../../../../scripts/validaLogin.php";
validarLogin("PUB");

?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Alterar telefone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
    <form action="alterarTelefoneAction.php" method="post"> 
      <p><b>Alteração de telefone</b></p>
        <p><b> telefone</b></p><input name="txtTelefone" required>
        <p><input type='submit' value="Prosseguir" id="btnSubmit" /></p>
        </form> 
    </body>


</html>
