<?php

    include_once "../../../../scripts/validaLogin.php";
    validarLogin("PUB");
    $txtCEP = preg_replace('/[^0-9]/im', '', $_POST["txtCEP"]);
    $connection  = require "../../../../scripts/connectionClass.php";
    $sql = "update endereco_instituicao_publica set
    logradouro = '" . $_POST["txtLogradouro"] . "', 
    numero = '" . $_POST["txtNumero"] . "', 
    bairro =  '" . $_POST["txtBairro"] . "', 
    cep = '" . $txtCEP . "', 
    cidade = '" . $_POST["txtCidade"] . "', 
    uf = '" . $_POST["txtUF"] . "', 
    descricao = '" . $_POST["txtDescricao"] . "' 
    where cod = " . $_POST["txtCod"] . "";
    $prepare = $connection->prepare($sql);
    $prepare->execute();
    $_SESSION["message"] = "O endereço foi atualizado com sucesso";
        $_SESSION["href"] = "../Cadastro/Publico/Alteracoes";
        header("Location:../../../../scripts/redirectTo.php");
