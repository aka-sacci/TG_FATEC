<?php

session_start();
$myCnpj = $_SESSION['cnpj'];
$connection  = require '../scripts/connectionClass.php';
$validate = false;
$codDoc = $_POST["txtCod"];
$status = $_POST["txtStatus"];

$sql = "select * from login_instituicao_publica where login = '" . $_SESSION['login'] . "' and senha = '" . $_POST['txtSenha'] . "' limit 1";
foreach ($connection->query($sql) as $key => $value) {
    $validate = true;
}

if (!$validate) {
    $_SESSION["message"] = "Senha incorreta!";
    $_SESSION["href"] = "../Pedido/alterarStatusPedido.php?cod=$codDoc&alteracao=$status";
    header("Location:../scripts/redirectToError.php");
} else {
    $sql = "update pedido set status=$status, data_fechamento = now() where cod = $codDoc and cnpj=$myCnpj";
    $prepare = $connection->prepare($sql);
    $prepare->execute();
    $_SESSION["message"] = "O pedido foi alterado com sucesso!";
    $_SESSION["href"] = "../Pedido/visualisarMeuPedido.php?cod=$codDoc";
    header("Location:../scripts/redirectTo.php");
}
