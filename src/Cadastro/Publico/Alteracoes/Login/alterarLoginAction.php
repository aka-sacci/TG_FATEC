<?php

include_once "../../../../scripts/validaLogin.php";
validarLogin("PUB");
$connection  = require '../../../../scripts/connectionClass.php';
$novoEmail = $_POST['txtEmail'];
$emailAntigo = $_SESSION['login'];
if ($emailAntigo == $novoEmail) {
//emails iguais! erro;
    echo "Emails Iguais!!!";
} else {
    $validationEmail = false;
    $sql = "select * from login_instituicao_publica where login = '" . $novoEmail . "' limit 1";
    foreach ($connection->query($sql) as $key => $value) {
        $validationEmail = true;
    }

    if (!$validationEmail) {
        $_SESSION['novoLogin'] = $novoEmail;
        $_SESSION['thisAlteracao'] = "LOG";
        header("location:confirmarSenha.php");
    } else {
        echo "Email já existente!!!";
    }
}
