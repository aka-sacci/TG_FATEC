<?php

session_start();
include_once "../../../../scripts/validaLogin.php";
$connection  = require "../../../../scripts/connectionClass.php";
$txtCEP = preg_replace('/[^0-9]/im', '', $_POST["txtCEP"]);
$sql = "insert into endereco_instituicao_publica (logradouro, numero, bairro, cep, cidade, uf, cnpj, descricao) VALUES 
('" . $_POST["txtLogradouro"] . "', '" . $_POST["txtNumero"] . "', '" . $_POST["txtBairro"] . "', '" . $txtCEP . "', '" . $_POST["txtCidade"] . "', 
'" . $_POST["txtUF"] . "', '" . $_SESSION["cnpj"] . "', '" . $_POST["txtDescricao"] . "');";
$prepare = $connection->prepare($sql);
$prepare->execute();
$_SESSION["message"] = "O novo endereço foi cadastrado com sucesso!";
        $_SESSION["href"] = "../Cadastro/Publico/Alteracoes";
        header("Location:../../../../scripts/redirectTo.php");
