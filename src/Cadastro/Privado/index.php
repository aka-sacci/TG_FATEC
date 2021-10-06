<?php

require_once "../../../vendor/autoload.php";
session_start();
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
    if (isset($_SESSION['login'])) {
        echo "<p>Logado como " . $_SESSION['login'] . ". <a href='../config/logout.php'>Logout</a></p>";
    } else {
        header('location:../../../index.php');
    }


    ?>
        
    </body>


</html>
