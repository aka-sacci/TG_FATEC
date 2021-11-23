<?php

include_once "../../../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require "../../../../scripts/connectionClass.php";
$sql = "update endereco_empresa_privada set
logradouro = '" . $_POST["txtLogradouro"] . "', 
numero = '" . $_POST["txtNumero"] . "', 
bairro =  '" . $_POST["txtBairro"] . "', 
cep = '" . $_POST["txtCEP"] . "', 
cidade = '" . $_POST["txtCidade"] . "', 
uf = '" . $_POST["txtUF"] . "', 
descricao = '" . $_POST["txtDescricao"] . "' 
where cod = " . $_POST["txtCod"] . "";
$prepare = $connection->prepare($sql);
$prepare->execute();
$_SESSION["message"] = "O endereço foi atualizado com sucesso!";
$_SESSION["href"] = "../Cadastro/Privado/Alteracoes";
header("Location:../../../../scripts/redirectTo.php");
