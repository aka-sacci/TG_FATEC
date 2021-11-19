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
    echo "Senha incorreta!";
} else {
    $sql = "update pedido set status=$status, data_fechamento = now() where cod = $codDoc and cnpj=$myCnpj";
    $prepare = $connection->prepare($sql);
    $prepare->execute();
    echo "O pedido foi alterado com sucesso! Clique <a href='visualisarMeuPedido.php?cod=$codDoc'> aqui </a> para voltar.";
}
