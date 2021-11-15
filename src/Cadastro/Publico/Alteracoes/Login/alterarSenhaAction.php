<?php

include_once "../../../../scripts/validaLogin.php";
validarLogin("PUB");
$novaSenha = $_POST['txtSenha'];
$senhaAntiga = $_SESSION['pwd'];
if ($novaSenha == $senhaAntiga) {
//emails iguais! erro;
    echo "A nova senha é idêntica à senha atual! Por favor, tente outra senha!";
} else {
    $_SESSION['novaSenha'] = $novaSenha;
    $_SESSION['thisAlteracao'] = "PWD";
    header("location:confirmarSenha.php");
}
