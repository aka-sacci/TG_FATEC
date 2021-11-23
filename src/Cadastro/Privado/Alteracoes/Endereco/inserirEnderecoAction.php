<?php

session_start();
include_once "../../../../scripts/validaLogin.php";
$connection  = require "../../../../scripts/connectionClass.php";
$sql = "insert into endereco_empresa_privada (logradouro, numero, bairro, cep, cidade, uf, cnpj, descricao) VALUES 
('" . $_POST["txtLogradouro"] . "', '" . $_POST["txtNumero"] . "', '" . $_POST["txtBairro"] . "', '" . $_POST["txtCEP"] . "', '" . $_POST["txtCidade"] . "', 
'" . $_POST["txtUF"] . "', '" . $_SESSION["cnpj"] . "', '" . $_POST["txtDescricao"] . "');";
$prepare = $connection->prepare($sql);
$prepare->execute();
$_SESSION["message"] = "O novo endereço foi cadastrado com sucesso!";
$_SESSION["href"] = "../Cadastro/Privado/Alteracoes";
header("Location:../../../../scripts/redirectTo.php");

