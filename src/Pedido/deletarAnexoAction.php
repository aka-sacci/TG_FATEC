<?php

session_start();
$myCnpj = $_SESSION['cnpj'];
$connection  = require '../scripts/connectionClass.php';
$validate = false;
$codDoc = $_POST["txtCod"];

$sql = "select * from login_instituicao_publica where login = '" . $_SESSION['login'] . "' and senha = '" . $_POST['txtSenha'] . "' limit 1";
foreach ($connection->query($sql) as $key => $value) {
    $validate = true;
}

if (!$validate) {
    $_SESSION["message"] = "Senha incorreta!";
    $_SESSION["href"] = "../Pedido/deletarAnexo.php?cod=$codDoc";
    header("Location:../scripts/redirectToError.php");
} else {
    $sql = "select pedido.cod from anexos_pedido
    INNER JOIN pedido ON
    anexos_pedido.pedido = pedido.cod
    WHERE anexos_pedido.cod = $codDoc";
    foreach ($connection->query($sql) as $key => $value) {
        $pedidoCod = $value['cod'];
    }
    $sql = "delete from anexos_pedido where cod = $codDoc";
    $prepare = $connection->prepare($sql);
    $prepare->execute();
    unlink("../../files/Pedidos/Anexos/ANEXO$codDoc.pdf");
    $_SESSION["message"] = "O anexo foi excluído com sucesso!";
    $_SESSION["href"] = "../Pedido/visualisarMeuPedido.php?cod=$pedidoCod";
    header("Location:../scripts/redirectTo.php");
}
