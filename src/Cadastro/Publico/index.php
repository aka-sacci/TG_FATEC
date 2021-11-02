<?php

require_once "../../../vendor/autoload.php";
include_once "../../scripts/validaLogin.php";
$cnpj = $_SESSION['cnpj'];

        $sql = "select status_cadastro from instituicao_publica where cnpj = '" . $cnpj . "' limit 1";
foreach ($connection->query($sql) as $key => $value) {
    $statusConta = $value['status_cadastro'];
}
if ($statusConta == "1") {
    $descStatus = "Seu cadastro foi solicitado com sucesso! Em breve, a equipe da Licitatudo entrará em contato!";
}
if ($statusConta == "2") {
    $descStatus = "Seu cadastro está sendo analisado! Em breve, a equipe da Licitatudo entrará em contato para confirmar seu cadastro!";
}


?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Meu cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
    <?php
          echo "<p>Logado como " . $_SESSION['login'] . ". <a href='../config/logout.php'>Logout</a></p>";
    if (isset($descStatus)) {
        echo $descStatus;
    } else {
        echo "<p>alterar dados</p>";
        echo "<a href='../../Pedido/criarPedido.php'>Criar novo pedido</a>";
        echo "<p>Meus pedidos</p>";
        echo "<p>Consultar pedidos de outros órgãos públicos</p>";
    }

    ?>
    </body>


</html>
