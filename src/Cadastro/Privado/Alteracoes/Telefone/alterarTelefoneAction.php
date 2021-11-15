<?php

include_once "../../../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require "../../../../scripts/connectionClass.php";
$novoTelefone = $_POST['txtTelefone'];
$connection  = require '../../../../scripts/connectionClass.php';
$sql = "update empresa_privada set telefone = '" . $novoTelefone . "' where cnpj = " . $_SESSION['cnpj'] . "";
$prepare = $connection->prepare($sql);
$prepare->execute();
echo "Seu telefone foi alterado com sucesso! Clique <a href='../'> aqui </a> para retornar ou menu.";
