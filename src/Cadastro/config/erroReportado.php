<?php

require_once "../../../vendor/autoload.php";
session_start();
?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
     <?php
        echo "<p>ERRO: " . $_SESSION['erroReportado'] . "</p>";
        ?>
    </body>


</html>
