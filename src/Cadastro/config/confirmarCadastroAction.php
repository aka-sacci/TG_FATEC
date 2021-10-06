<?php

session_start();
$loginInformado = $_POST['txtEmail'];
$telefoneInformado = $_POST['txtTelefone'];
$_SESSION['cadEmail'] = $loginInformado;
$_SESSION['cadTelefone'] = $telefoneInformado;

if ($_SESSION['cadType'] == "PRI") {
    $quantidateCategorias = $_POST['qtdeCategorias'];
    $arrayCategorias = array();
    for ($i = 1; $i <= $_POST['qtdeCategorias']; $i++) {
        $thisCategoria = $_POST["selectCategorias" . $i];
        array_push($arrayCategorias, $thisCategoria);
    }
    $arrayCategorias = array_unique($arrayCategorias);
    $_SESSION['cadCategorias'] = $arrayCategorias;
}

//var_dump($_SESSION);
header("location:novoLogin.php");
