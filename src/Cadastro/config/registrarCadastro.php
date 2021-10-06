<?php

$connection  = require '../../scripts/connectionClass.php';
require_once '../../scripts/utils/converterPontuacaoCNPJ.php';
session_start();
$login = $_POST['txtEmail'];
$pwd = $_POST['txtSenha'];


if ($_SESSION['cadType'] == "PUB") {
    //check se já não há cadastro (de novo)
    $sql = "select * from instituicao_publica where cnpj = '" . $_SESSION['cadCNPJ'] . "'";
    foreach ($connection->query($sql) as $key => $value) {
        $_SESSION["erroReportado"] = "O órgão público com o CNPJ " . converterCNPJ($_SESSION['cadCNPJ']) . " já foi cadastrado!";
        header("location:erroReportado.php");
        exit;
    }
    //check disponibilidade de email
    $sql = "select * from login_instituicao_publica where login = '" . $_SESSION['cadEmail'] . "'";
    foreach ($connection->query($sql) as $key => $value) {
        $_SESSION["erroReportado"] = "Já há um cadastro vinculado ao email informado! Tente novamente!";
        header("location:erroReportado.php");
        exit;
    }

    $sql = 'INSERT INTO instituicao_publica (cnpj, razao_social, nome_fantasia, efr, email, natureza, telefone, status_cadastro) VALUES ("' . $_SESSION['cadCNPJ'] . '", "' . $_SESSION['cadRazaoSocial'] . '", "'
    . $_SESSION['cadNomeFantasia'] . '", "' . $_SESSION['cadEFR'] . '", "' . $_SESSION['cadEmail'] . '", "' . $_SESSION['cadNatureza'] . '", "' . $_SESSION['cadTelefone'] . '", 1);';
    $prepare = $connection->prepare($sql);
    $prepare->execute();

    $sql = 'INSERT INTO endereco_instituicao_publica (logradouro, numero, bairro, cep, cidade, uf, cnpj) VALUES ("' . $_SESSION['cadLog'] . '", "' . $_SESSION['cadNumero'] . '", "'
    . $_SESSION['cadBairro'] . '", "' . $_SESSION['cadCEP'] . '", "' . $_SESSION['cadCidade'] . '", "' . $_SESSION['cadUF'] . '", "' . $_SESSION['cadCNPJ'] . '");';
    $prepare = $connection->prepare($sql);
    $prepare->execute();

    $sql = 'INSERT INTO login_instituicao_publica (login, cnpj, senha) VALUES ("' . $login . '", "' . $_SESSION['cadCNPJ'] . '", "'
    . $pwd . '");';
    $prepare = $connection->prepare($sql);
    $prepare->execute();

    $sql = 'INSERT INTO status_cadastro_hist (cnpj, status, data) VALUES ("' . $_SESSION['cadCNPJ'] . '", 1, now());';
    $prepare = $connection->prepare($sql);
    $prepare->execute();

    session_unset();
    $_SESSION['login'] = $login;
    $_SESSION['pwd'] = $pwd;
    $_SESSION['type'] = "PUB";
    //var_dump($_SESSION);
    header("location:cadastroConcluido.php");
} else {
    $sql = "select * from instituicao_publica where cnpj = '" . $_SESSION['cadCNPJ'] . "'";
    foreach ($connection->query($sql) as $key => $value) {
        $_SESSION["erroReportado"] = "A empresa com o CNPJ " . converterCNPJ($_SESSION['cadCNPJ']) . " já foi cadastrado!";
        header("location:erroReportado.php");
        exit;
    }
    //check disponibilidade de email
    $sql = "select * from login_empresa_privada where login = '" . $_SESSION['cadEmail'] . "'";
    foreach ($connection->query($sql) as $key => $value) {
        $_SESSION["erroReportado"] = "Já há um cadastro vinculado ao email informado! Tente novamente!";
        header("location:erroReportado.php");
        exit;
    }

    $sql = 'INSERT INTO empresa_privada (cnpj, razao_social, nome_fantasia, efr, email, natureza, telefone) VALUES ("' . $_SESSION['cadCNPJ'] . '", "' . $_SESSION['cadRazaoSocial'] . '", "'
    . $_SESSION['cadNomeFantasia'] . '", "' . $_SESSION['cadEFR'] . '", "' . $_SESSION['cadEmail'] . '", "' . $_SESSION['cadNatureza'] . '", "' . $_SESSION['cadTelefone'] . '");';
    $prepare = $connection->prepare($sql);
    $prepare->execute();

    $sql = 'INSERT INTO endereco_empresa_privada (logradouro, numero, bairro, cep, cidade, uf, cnpj) VALUES ("' . $_SESSION['cadLog'] . '", "' . $_SESSION['cadNumero'] . '", "'
    . $_SESSION['cadBairro'] . '", "' . $_SESSION['cadCEP'] . '", "' . $_SESSION['cadCidade'] . '", "' . $_SESSION['cadUF'] . '", "' . $_SESSION['cadCNPJ'] . '");';
    $prepare = $connection->prepare($sql);
    $prepare->execute();

    $sql = 'INSERT INTO login_empresa_privada (login, cnpj, senha) VALUES ("' . $login . '", "' . $_SESSION['cadCNPJ'] . '", "'
    . $pwd . '");';
    $prepare = $connection->prepare($sql);
    $prepare->execute();

    $categorias = $_SESSION['cadCategorias'];
    $values = count($categorias);
    $values--;
    for ($i = $values; $i >= 0; $i--) {
        $sql = 'INSERT INTO categoria_empresa_privada (categoria, cnpj) VALUES ("' . $categorias[$i] . '", "' . $_SESSION['cadCNPJ'] . '");';
        $prepare = $connection->prepare($sql);
        $prepare->execute();
    }


    session_unset();
    $_SESSION['login'] = $login;
    $_SESSION['pwd'] = $pwd;
    $_SESSION['type'] = "PRI";


    //var_dump($values);
    //var_dump($_SESSION);
    header("location:cadastroConcluido.php");
}
