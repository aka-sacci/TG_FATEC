<?php

session_start();
$connection  = require '../../../../scripts/connectionClass.php';
$validate = false;
$alteracao = $_SESSION['thisAlteracao'];

$sql = "select * from login_instituicao_publica where login = '" . $_SESSION['login'] . "' and senha = '" . $_POST['txtSenha'] . "' limit 1";
foreach ($connection->query($sql) as $key => $value) {
    $validate = true;
    $thisCnpj = $value['cnpj'];
}

if (!$validate) {
    echo "Senha incorreta!";
} else {
    switch ($alteracao) {
        case "PWD":
            $sql = "update login_instituicao_publica set senha = '" . $_SESSION['novaSenha'] . "' where cnpj = " . $thisCnpj . "";
            break;
        case "LOG":
            $sql = "update login_instituicao_publica set login = '" . $_SESSION['novoLogin'] . "' where cnpj = " . $thisCnpj . "";
            $prepare = $connection->prepare($sql);
            $prepare->execute();
            $sql = "update instituicao_publica set email = '" . $_SESSION['novoLogin'] . "' where cnpj = " . $thisCnpj . "";
            break;
    }

    $prepare = $connection->prepare($sql);
    $prepare->execute();
    session_unset();
    echo "Seu cadastro foi alterado com sucesso! Clique <a href='/TG_FATEC/src/Cadastro/Publico/login.php'> aqui </a> para se relogar.";
}
