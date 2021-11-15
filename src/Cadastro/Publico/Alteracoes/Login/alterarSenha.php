<?php

require_once "../../../../../vendor/autoload.php";
include_once "../../../../scripts/validaLogin.php";
validarLogin("PUB");

?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Alterar senha</title>
    <script type="text/javascript" src="../../../../scripts/utils/scriptsBasicos.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
    <form action="alterarSenhaAction.php" method="post"> 
      <p><b>Alteração de senha</b></p>
         <p><b>Nova Senha</b></p><input oninput="validarSenha('txtSenha', 'txtSenhaConfirmar')" name="txtSenha" type="password" id="txtSenha" required>
         <p><b>Confirmar nova senha</b></p><input oninput="validarSenha('txtSenha', 'txtSenhaConfirmar')" name="txtSenhaConfirmar" id="txtSenhaConfirmar" type="password" required>
         <p id="txtConfirmacao"></p>
        <p><input type='submit' value="Prosseguir" id="btnSubmit" disabled/></p>
        </form> 
    </body>


</html>
