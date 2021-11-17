<?php

$targetfolder = "../../../../../files/Documentos/";
$codDoc = $_POST['codDoc'];
$fileName = basename($_FILES['file']['name']);
$targetfolder = $targetfolder . basename($_FILES['file']['name']) ;
if (move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {
    rename($targetfolder, "../../../../../files/Documentos/$codDoc.pdf");
    echo "O documento foi alterado com sucesso! Clique <a href='../'> aqui </a> para voltar.";
} else {
    echo "Não foi possível alterar o documento!";
}
