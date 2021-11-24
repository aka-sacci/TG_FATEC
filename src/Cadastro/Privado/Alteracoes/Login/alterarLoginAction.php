<?php

include_once "../../../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require '../../../../scripts/connectionClass.php';
$novoEmail = $_POST['txtEmail'];
$emailAntigo = $_SESSION['login'];
if ($emailAntigo == $novoEmail) {
//emails iguais! erro;
    $_SESSION["message"] = "O Email fornecido é identico ao email cadastrado!";
    $_SESSION["href"] = "../Cadastro/Privado/Alteracoes/Login/AlterarLogin.php";
    header("Location:../../../../scripts/redirectToError.php");
} else {
    $validationEmail = false;
    $sql = "select * from login_empresa_privada where login = '" . $novoEmail . "' limit 1";
    foreach ($connection->query($sql) as $key => $value) {
        $validationEmail = true;
    }

    if (!$validationEmail) {
        $_SESSION['novoLogin'] = $novoEmail;
        $_SESSION['thisAlteracao'] = "LOG";
        header("location:confirmarSenha.php");
    } else {
        $_SESSION["message"] = "O email já foi cadastrado e vinculado à outra empresa!";
        $_SESSION["href"] = "../Cadastro/Privado/Alteracoes/Login/AlterarLogin.php";
        header("Location:../../../../scripts/redirectToError.php");
    }
}
