<?php

session_start();
$connection  = require '../scripts/connectionClass.php';
$cod = $_POST["txtCod"];
$desc = $_POST["txtDesc"];
//insere no bd
$sql = "INSERT INTO anexos_pedido (descricao, pedido) VALUES ('$desc', '$cod');";
$prepare = $connection->prepare($sql);
$prepare->execute();
$idPedido = $connection->lastInsertId();

//insere o doc
$targetfolder = "../../files/Pedidos/Anexos/";
$fileName = basename($_FILES['file']['name']);
$targetfolder = $targetfolder . basename($_FILES['file']['name']) ;
if (move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {
    rename($targetfolder, "../../files/Pedidos/Anexos/ANEXO$idPedido.pdf");
    $_SESSION["message"] = "O anexo foi inserido com sucesso!";
    $_SESSION["href"] = "../Pedido/visualisarMeuPedido.php?cod=$cod";
    header("Location:../scripts/redirectTo.php");
} else {
    $_SESSION["message"] = "Não foi possível anexar o documento!";
    $_SESSION["href"] = "../Pedido/visualisarMeuPedido.php?cod=$cod";
    header("Location:../scripts/redirectToError.php");
}
