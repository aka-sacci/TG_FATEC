<?php

session_start();
$connection  = require '../../../../scripts/connectionClass.php';
$validate = false;
$codEndereco = $_POST["txtCod"];

$sql = "select * from login_instituicao_publica where login = '" . $_SESSION['login'] . "' and senha = '" . $_POST['txtSenha'] . "' limit 1";
foreach ($connection->query($sql) as $key => $value) {
    $validate = true;
}

if (!$validate) {
    echo "Senha incorreta!";
} else {
    $sql = "delete from endereco_instituicao_publica where cod = $codEndereco";
    $prepare = $connection->prepare($sql);
    $prepare->execute();
    echo "O endereço foi excluído com sucesso! Clique <a href='../'> aqui </a> para voltar.";
}
