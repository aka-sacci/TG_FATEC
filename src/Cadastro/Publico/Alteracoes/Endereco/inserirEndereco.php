<?php

require_once "../../../../../vendor/autoload.php";
include_once "../../../../scripts/validaLogin.php";



?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Inserir novo endereço</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
    <h1>Novo endereço</h1>
    <form action="inserirEnderecoAction.php" method="post"> 
        <p><b>Logradouro</b></p><input name="txtLogradouro" required>
        <p><b>Número</b></p><input name="txtNumero" required>
        <p><b>Bairro</b></p><input name="txtBairro" required>
        <p><b>CEP</b></p><input name="txtCEP" required>
        <p><b>Cidade</b></p><input name="txtCidade" required>
        <p><b>UF</b></p><input name="txtUF" required>
        <p><b>Descrição do endereço</b></p><textarea placeholder="Descrição do endereço" name="txtDescricao" required></textarea>

        <p><input type='submit' value="Inserir" id="btnSubmit" /></p>
        </form> 
    
    </body>


</html>
