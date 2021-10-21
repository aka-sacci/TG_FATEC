<?php

require_once "../../../vendor/autoload.php";
session_start();
if (isset($_SESSION['login'])) {
    $_SESSION['erroReportado'] = "Não é possível criar uma conta já estando logado!";
    header("location:../config/erroReportado.php");
}
?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Cadastro de empresa pública</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
      <form action="../config/novoCadastroAction.php" method="get"> 
      <p>Para começar, digite seu CNPJ aqui.</p>
        <input name="txtCNPJ" required>
        <input name="typeCNPJ" type="hidden" value="PUB">
        <p><input type='submit' value="Buscar" /></p>
        </form> 
    </body>


</html>
