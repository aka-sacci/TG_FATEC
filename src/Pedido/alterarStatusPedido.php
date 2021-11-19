<?php

require_once "../../vendor/autoload.php";
include_once "../scripts/validaLogin.php";
validarLogin("PUB");
$connection  = require '../scripts/connectionClass.php';
$codDoc = $_GET["cod"];
$alteracao = $_GET["alteracao"];
$cnpj = $_SESSION["cnpj"];
$validate = false;
$action = "";

$sql = "SELECT * FROM pedido
WHERE cnpj = $cnpj AND cod = $codDoc";
foreach ($connection->query($sql) as $key => $value) {
    $validate = true;
}

if (!$validate) {
    header("location:visualisarMeuPedido.php?cod=$codDoc");
}

if ($alteracao == "2") {
    $validate = "Finalizar Pedido n°#" . $codDoc;
}
if ($alteracao == "3") {
    $validate = "Cancelar Pedido n°#" . $codDoc;
}

?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Confirmar Alteração</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

    <body>
    <form action="alterarStatusPedidoAction.php" method="post"> 
      <p><b><?php echo $validate ?></b></p>
      <?php
        echo "<input name='txtCod' hidden value='$codDoc' required>";
        echo "<input name='txtStatus' hidden value='$alteracao' required>";
        ?>
         <p><b>Para confirmar a alteração no pedido, digite sua senha</b></p><input name="txtSenha" type="password" required>
        <p><input type='submit' value="Confirmar" id="btnSubmit"/></p>
        </form> 
    </body>


</html>
