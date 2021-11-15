<?php

require_once "../../../../../vendor/autoload.php";
include_once "../../../../scripts/validaLogin.php";
validarLogin("PRI");

?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Confirmar alteração</title>
    <script type="text/javascript" src="../../../../scripts/utils/scriptsBasicos.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

    <body>
    <form action="confirmarSenhaAction.php" method="post"> 
      <p><b>Alteração de dados de Login</b></p>
         <p><b>Para confirmar as alterações, digite sua senha</b></p><input name="txtSenha" type="password" required>
        <p><input type='submit' value="Alterar dados" id="btnSubmit"/></p>
        </form> 
    </body>


</html>
