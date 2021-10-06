<?php

require_once "../../../vendor/autoload.php";
session_start();
if (isset($_SESSION['login'])) {
    $email = $_SESSION['login'];
    $senha = $_SESSION['pwd'];
    $log = false;

    $connection  = require '../../scripts/connectionClass.php';
    $sql = "select * from login_instituicao_publica where login = '" . $email . "' and senha = '" . $senha . "' limit 1";
    foreach ($connection->query($sql) as $key => $value) {
        $log = true;
        $cnpj = $value['cnpj'];
    }

    if ($log) {
        $sql = "select status_cadastro from instituicao_publica where cnpj = '" . $cnpj . "' limit 1";
        foreach ($connection->query($sql) as $key => $value) {
            $statusConta = $value['status_cadastro'];
        }
        if ($statusConta == "1") {
            $descStatus = "Seu cadastro foi solicitado com sucesso! Em breve, a equipe da Licitatudo entrará em contato!";
        }
        if ($statusConta == "2") {
            $descStatus = "Seu cadastro está sendo analisado! Em breve, a equipe da Licitatudo entrará em contato para confirmar seu cadastro!";
        }
    } else {
        header("location:../config/logout.php");
    }
} else {
    header('location:../../../index.php');
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
    <?php
          echo "<p>Logado como " . $_SESSION['login'] . ". <a href='../config/logout.php'>Logout</a></p>";
    if (isset($descStatus)) {
        echo $descStatus;
    }else{
        //echo menu
    }

    ?>
    </body>


</html>
