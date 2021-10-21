<?php

require_once "../../vendor/autoload.php";
session_start();
if (isset($_SESSION['login'])) {
    $email = $_SESSION['login'];
    $senha = $_SESSION['pwd'];
    $log = false;

    $connection  = require '../scripts/connectionClass.php';
    $sql = "select * from login_instituicao_publica where login = '" . $email . "' and senha = '" . $senha . "' limit 1";
    foreach ($connection->query($sql) as $key => $value) {
        $log = true;
        $cnpj = $value['cnpj'];
    }
    if (!$log) {
        header('location:../Cadastro/Publico/login.php');
    }
} else {
    header('location:../Cadastro/Publico/login.php');
}

?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Meu cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
    <p>Selecionar categoria</p>
    <select>
        <?php
        $sql = "select * from categoria order by categoria";
        foreach ($connection->query($sql) as $key => $value) {
            $val = $value['cod'];
            $text = $value['categoria'];
            echo "<option value='$val'>$text</option>";
        }
        ?>
    </select>
    <p>Adicionar itens</p>
    <p>Modo do pedido</p>
    <select>
        <?php
        $sql = "select * from modo_pedido order by modo";
        foreach ($connection->query($sql) as $key => $value) {
            $val = $value['cod'];
            $text = $value['modo'];
            echo "<option value='$val'>$text</option>";
        }
        ?>
    </select>
    <p>Distância (KM)</p>
    </body>


</html>
