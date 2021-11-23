<?php

session_start();
$connection  = require '../../../../scripts/connectionClass.php';
$validate = false;
$codEndereco = $_POST["txtCod"];
$myCnpj = $_SESSION['cnpj'];

$sql = "select * from login_empresa_privada where login = '" . $_SESSION['login'] . "' and senha = '" . $_POST['txtSenha'] . "' limit 1";
foreach ($connection->query($sql) as $key => $value) {
    $validate = true;
}

if (!$validate) {
$_SESSION["message"] = "Senha incorreta!";
$_SESSION["href"] = "../Cadastro/Privado/Alteracoes/Endereco/excluirEndereco.php?cod=$codEndereco";
header("Location:../../../../scripts/redirectToError.php");
} else {
    $sql = "delete from endereco_empresa_privada where cod = $codEndereco and cnpj = $myCnpj";
    $prepare = $connection->prepare($sql);
    $prepare->execute();
    $_SESSION["message"] = "O endereço foi excluído com sucesso!";
    $_SESSION["href"] = "../Cadastro/Privado/Alteracoes";
    header("Location:../../../../scripts/redirectTo.php");
}
