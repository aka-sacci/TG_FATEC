<?php

include_once "../../../../scripts/validaLogin.php";
validarLogin("PRI");
$novaSenha = $_POST['txtSenha'];
$senhaAntiga = $_SESSION['pwd'];
if ($novaSenha == $senhaAntiga) {
//emails iguais! erro;
$_SESSION["message"] = "A senha fornecida é identica à salva no banco de dados! Por favor, insira outra senha!";
$_SESSION["href"] = "../Cadastro/Privado/Alteracoes/Login/alterarSenha.php";
header("Location:../../../../scripts/redirectToError.php");
} else {
    $_SESSION['novaSenha'] = $novaSenha;
    $_SESSION['thisAlteracao'] = "PWD";
    header("location:confirmarSenha.php");
}
