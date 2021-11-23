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
    echo "<link rel='shortcut icon' type='image/x-icon' href='../../../../Imagens/Logo-Licita.ico'>
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
            <link rel='stylesheet' href='../../../../scripts/utils/style.css'>
            <script type='text/javascript' src='../../../../scripts/utils/scriptsBasicos.js'></script>
            <div class='container py-4 col-lg-4' id='container-corpoindex'>
                <div class='alert alert-info' role='alert'>
                <h4 class='alert-heading'>O documento foi inserido com sucesso!</h4>
                </div></br>          
                <button class='btn btn-md buttoncad' onclick='goBack()'>Voltar</button>
            </div>";
} else {
    echo "<link rel='shortcut icon' type='image/x-icon' href='../../../../Imagens/Logo-Licita.ico'>
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
            <link rel='stylesheet' href='../../../../scripts/utils/style.css'>
            <script type='text/javascript' src='../../../../scripts/utils/scriptsBasicos.js'></script>
            <div class='container py-4 col-lg-4' id='container-corpoindex'>
                <div class='alert alert-warning' role='alert'>
                <h4 class='alert-heading'>Não foi possível alterar o documento!</h4>
                </div></br>          
                <button class='btn btn-md buttoncad' onclick='goBack()'>Voltar</button>
            </div>";
}
