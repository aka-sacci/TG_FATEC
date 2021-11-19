<?php

require_once "../../vendor/autoload.php";
include_once "../scripts/validaLogin.php";
validarLogin("PUB");
$connection  = require '../scripts/connectionClass.php';
$codDoc = $_GET["cod"];
$cnpj = $_SESSION["cnpj"];
$validate = false;

$sql = "select anexos_pedido.descricao from anexos_pedido
INNER JOIN pedido ON anexos_pedido.pedido = pedido.cod
INNER JOIN instituicao_publica ON pedido.cnpj = instituicao_publica.cnpj
where anexos_pedido.cod = $codDoc and instituicao_publica.cnpj = $cnpj";
foreach ($connection->query($sql) as $key => $value) {
    $validate = true;
    $descricaoDoc = $value['descricao'];
}

if (!$validate) {
    header("location:visualisarMeuPedido.php?cod=$codDoc");
}


?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Confirmar exclusão</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

    <body>
    <form action="deletarAnexoAction.php" method="post"> 
      <p><b>Exclusão de anexo - </b></p>
      <?php
        echo "<p>Documento: " . $descricaoDoc . ". </p>";
        echo "<p><a href='../scripts/abrirArquivoPDF.php?filename=ANEXO" . $codDoc .  ".pdf&dir=Pedidos/Anexos/&titulo=Anexo" . $codDoc . "'  target='_blank'>
        Ver Documento</a></p>";
        echo "<input name='txtCod' hidden value='$codDoc' required>";
        ?>
         <p><b>Para confirmar a exclusão do anexo acima, digite sua senha</b></p><input name="txtSenha" type="password" required>
        <p><input type='submit' value="Confirmar" id="btnSubmit"/></p>
        </form> 
    </body>


</html>
