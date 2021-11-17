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
    echo "O documento foi inserido com sucesso! Clique <a href='../'> aqui </a> para voltar.";
} else {
    echo "Não foi possível alterar o documento!";
}
