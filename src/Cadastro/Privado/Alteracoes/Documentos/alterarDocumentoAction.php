<?php

$targetfolder = "../../../../../files/Documentos/";
$codDoc = $_POST['codDoc'];
$fileName = basename($_FILES['file']['name']);
$targetfolder = $targetfolder . basename($_FILES['file']['name']) ;
if (move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {
    rename($targetfolder, "../../../../../files/Documentos/$codDoc.pdf");
    $_SESSION["message"] = "O documento foi alterado com sucesso!";
    $_SESSION["href"] = "../Cadastro/Privado/Alteracoes";
    header("Location:../../../../scripts/redirectTo.php");
} else {
    $_SESSION["message"] = "Não foi possível alterar o documento!";
    $_SESSION["href"] = "../Cadastro/Privado/Alteracoes";
    header("Location:../../../../scripts/redirectToError.php");
}
