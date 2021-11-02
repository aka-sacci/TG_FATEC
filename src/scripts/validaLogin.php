<?php

session_start();

if (isset($_SESSION['login'])) {
    $email = $_SESSION['login'];
    $senha = $_SESSION['pwd'];
    $validate = false;

    $connection  = require 'connectionClass.php';

    if ($_SESSION['type'] == "PUB") {
        $sql = "select * from login_instituicao_publica where login = '" . $email . "' and senha = '" . $senha . "' limit 1";
        foreach ($connection->query($sql) as $key => $value) {
            $_SESSION['cnpj'] = $value['cnpj'];
            $validate = true;
        }

        if (!$validate) {
            session_unset();
            header('Location: /TG_FATEC/src/Cadastro/Publico/login.php');
        }
    } else {
        $sql = "select * from login_empresa_privada where login = '" . $email . "' and senha = '" . $senha . "' limit 1";
        foreach ($connection->query($sql) as $key => $value) {
            $_SESSION['cnpj'] = $value['cnpj'];
            $validate = true;
        }
        if (!$validate) {
            session_unset();
            header('Location: /TG_FATEC/src/Cadastro/Privado/login.php');
        }
    }
} else {
    session_unset();
    header('Location: /TG_FATEC');
}
