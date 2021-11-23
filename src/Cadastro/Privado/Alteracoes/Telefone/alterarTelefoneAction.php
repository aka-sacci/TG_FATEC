<?php

include_once "../../../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require "../../../../scripts/connectionClass.php";
$novoTelefone = $_POST['txtTelefone'];
$connection  = require '../../../../scripts/connectionClass.php';
$sql = "update empresa_privada set telefone = '" . $novoTelefone . "' where cnpj = " . $_SESSION['cnpj'] . "";
$prepare = $connection->prepare($sql);
$prepare->execute();
$_SESSION["message"] = "Seu telefone foi alterado com sucesso!";
$_SESSION["href"] = "../Cadastro/Privado/Alteracoes";
header("Location:../../../../scripts/redirectTo.php");
