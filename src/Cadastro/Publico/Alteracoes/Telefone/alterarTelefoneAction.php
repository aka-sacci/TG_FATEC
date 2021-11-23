<?php

include_once "../../../../scripts/validaLogin.php";
validarLogin("PUB");
$connection  = require "../../../../scripts/connectionClass.php";
$novoTelefone = $_POST['txtTelefone'];
$connection  = require '../../../../scripts/connectionClass.php';
$sql = "update instituicao_publica set telefone = '" . $novoTelefone . "' where cnpj = " . $_SESSION['cnpj'] . "";
$prepare = $connection->prepare($sql);
$prepare->execute();
$_SESSION["message"] = "Seu telefone foi alterado com sucesso!";
$_SESSION["href"] = "../Cadastro/Publico/Alteracoes";
header("Location:../../../../scripts/redirectTo.php");
