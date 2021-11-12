<?php

include_once "../../../../scripts/validaLogin.php";
$novoTelefone = $_POST['txtTelefone'];
$connection  = require '../../../../scripts/connectionClass.php';
$sql = "update instituicao_publica set telefone = '" . $novoTelefone . "' where cnpj = " . $_SESSION['cnpj'] . "";
$prepare = $connection->prepare($sql);
$prepare->execute();
echo "Seu telefone foi alterado com sucesso! Clique <a href='../'> aqui </a> para retornar ou menu.";
