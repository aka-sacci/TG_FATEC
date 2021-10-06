<?php

require_once "../../../vendor/autoload.php";
session_start();
?>
<!DOCTYPE html>

<html lang="pt">
 <head>
    
    <meta charset="utf-8">
    <title>LicitaTudo - Cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../../scripts/utils/scriptsBasicos.js"></script>
</head>

    <body>
    <form action="registrarCadastro.php" method="post"> 
      <p><b>Criação de Login</b></p>
       
      <?php
        echo '<p><b>Email</b></p><input name="txtEmail" required value=' . $_SESSION["cadEmail"] . '>';
        ?>
         
         <p><b>Senha</b></p><input oninput="validarSenha('txtSenha', 'txtSenhaConfirmar')" name="txtSenha" type="password" id="txtSenha" required>
         <p><b>Confirmar Senha</b></p><input oninput="validarSenha('txtSenha', 'txtSenhaConfirmar')" name="txtSenhaConfirmar" id="txtSenhaConfirmar" type="password" required>
         <p id="txtConfirmacao"></p>
       

        <p><input type='submit' value="Prosseguir" id="btnSubmit" disabled/></p>
        </form> 
    </body>


</html>
