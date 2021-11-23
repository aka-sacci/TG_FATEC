<?php

session_start();
$connection  = require "../../../../scripts/connectionClass.php";
$myCnpj = $_SESSION["cnpj"];
//insere no bd
$sql = 'INSERT INTO documento_empresa_privada (tipo, cnpj, data_upload, descricao_doc) VALUES ("' . $_POST['selectTipos'] . '",
"' . $myCnpj . '", now(), "' . $_POST['txtDesc'] . '");';
$prepare = $connection->prepare($sql);
$prepare->execute();
$idPedido = $connection->lastInsertId();
//insere o doc
$targetfolder = "../../../../../files/Documentos/";
$fileName = basename($_FILES['file']['name']);
$targetfolder = $targetfolder . basename($_FILES['file']['name']) ;
if (move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {
    rename($targetfolder, "../../../../../files/Documentos/$idPedido.pdf");
    $_SESSION["message"] = "O documento foi inserido com sucesso!";
    $_SESSION["href"] = "../Cadastro/Privado/Alteracoes";
    header("Location:../../../../scripts/redirectTo.php");
} else {
    $_SESSION["message"] = "Não foi possível inserir o documento!";
    $_SESSION["href"] = "../Cadastro/Privado/Alteracoes";
    header("Location:../../../../scripts/redirectToError.php");
}
