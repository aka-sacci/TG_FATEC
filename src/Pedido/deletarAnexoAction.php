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
    echo "Senha incorreta!";
} else {
    $sql = "delete from anexos_pedido where cod = $codDoc";
    $prepare = $connection->prepare($sql);
    $prepare->execute();
    unlink("../../files/Pedidos/Anexos/ANEXO$codDoc.pdf");
    echo "O anexo foi excluído com sucesso! Clique <a href='visualisarMeuPedido.php?cod=$codDoc'> aqui </a> para voltar.";
}
