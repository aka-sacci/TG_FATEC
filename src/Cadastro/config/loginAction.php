<?php

require_once "../../../vendor/autoload.php";
require_once '../../scripts/utils/converterPontuacaoCNPJ.php';
session_start();
$connection  = require '../../scripts/connectionClass.php';
$type = $_POST['typeCNPJ'];
$email = $_POST['txtEmail'];
$senha = $_POST['txtSenha'];
if ($type == "PUB") {
//check se já não há cadastro (de novo)
    $sql = "select * from login_instituicao_publica where login = '" . $email . "' and senha = '" . $senha . "'";
    foreach ($connection->query($sql) as $key => $value) {
        $_SESSION['login'] = $email;
        $_SESSION['pwd'] = $senha;
        $_SESSION['type'] = $type;
        $_SESSION['cnpj'] = $value['cnpj'];
        header("location:../Publico");
    }
    $_SESSION['statusLogin'] = "Login ou senha incorretos!";
    header("location:../Publico/login.php");
} else {
    $sql = "select * from login_empresa_privada where login = '" . $email . "' and senha = '" . $senha . "'";
    foreach ($connection->query($sql) as $key => $value) {
        $_SESSION['login'] = $email;
        $_SESSION['pwd'] = $senha;
        $_SESSION['type'] = $type;
        $_SESSION['cnpj'] = $value['cnpj'];
        header("location:../Privado");
    }
    $_SESSION['statusLogin'] = "Login ou senha incorretos!";
    header("location:../Privado/login.php");
}
