<?php

session_start();
$myCnpj = $_SESSION['cnpj'];
$connection  = require '../../../../scripts/connectionClass.php';
$validate = false;
$codDoc = $_POST["txtCod"];

$sql = "select * from login_empresa_privada where login = '" . $_SESSION['login'] . "' and senha = '" . $_POST['txtSenha'] . "' limit 1";
foreach ($connection->query($sql) as $key => $value) {
    $validate = true;
}

if (!$validate) {
    echo "Senha incorreta!";
} else {
    $sql = "delete from documento_empresa_privada where cod = $codDoc and cnpj = $myCnpj";
    $prepare = $connection->prepare($sql);
    $prepare->execute();
    unlink("../../../../../files/Documentos/$codDoc.pdf");
    echo "O documento foi excluído com sucesso! Clique <a href='../'> aqui </a> para voltar.";
}
