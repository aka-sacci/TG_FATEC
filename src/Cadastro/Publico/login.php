<?php

require_once "../../../vendor/autoload.php";
session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['type'] == "PUB") {
        header("location:index.php");
    } else {
        $_SESSION['erroReportado'] = "Não é possível logar numa conta pública estando logado em uma conta de empresa privada!";
        header("location:../config/erroReportado.php");
    }
}

?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Login empresa pública</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
    <form action="../config/loginAction.php" method="post"> 
      <p><b>Fazer Login - Instituição pública</b></p>
       
      <p><b>Email</b></p><input name="txtEmail" required>   
      <p><b>Senha</b></p><input name="txtSenha" type="password" id="txtSenha" required>
      <input name="typeCNPJ" type="hidden" value="PUB">

        <p><input type='submit' value="Prosseguir" id="btnSubmit"/></p>
        </form> 

        <?php
        if (isset($_SESSION['statusLogin'])) {
            echo $_SESSION['statusLogin'];
            unset($_SESSION['statusLogin']);
        }
        ?>
    </body>


</html>
