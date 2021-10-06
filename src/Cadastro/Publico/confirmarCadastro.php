<?php

session_start();
require_once "../../../vendor/autoload.php";
require_once '../../scripts/utils/converterPontuacaoCNPJ.php';
require_once '../../scripts/utils/converterPontuacaoCEP.php';


?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Cadastro de órgão público</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
      <form action="../config/confirmarCadastroAction.php" method="post"> 
      <p><b>Confirme os dados</b></p>
      <p><b>Informações Gerais</b></p>

      <?php

        echo '<p><b>CNPJ</b></p> <p>' .  converterCNPJ($_SESSION['cadCNPJ']) . '</p>';
        echo '<p><b>Razão Social</b></p><p>' . $_SESSION['cadRazaoSocial'] . '</p>';
        echo '<p><b>Nome Fantasia</b></p><p>' . $_SESSION['cadNomeFantasia'] . '</p>';
        echo '<p><b>Ente Federativo Responsável (EFR)</b></p><p>' . $_SESSION['cadEFR'] . '</p>';
        echo '<p><b>Natureza Jurídica</b></p><p>' . $_SESSION['cadNatureza'] . '</p>';
        echo '<p><b>Endereço</b></p><p>' . $_SESSION['cadLog'] . ', ' . $_SESSION['cadNumero'] . ' - ' . $_SESSION['cadBairro'] . ' (' . converterCEP($_SESSION['cadCEP']) . ')</p>';
        echo '<p>' . $_SESSION['cadCidade'] . ', ' . $_SESSION['cadUF'] . '</p>';
        ?>

        <br><p><b>Informações para contato</b></p>

        <?php
        echo '<p><b>Telefone</b></p><input name="txtTelefone" required value="' . $_SESSION['cadTelefone'] . '">';
        echo '<p><b>Email</b></p><input name="txtEmail" required value="' . $_SESSION['cadEmail'] . '">';
        ?>

        <p><input type='submit' value="Prosseguir" /></p>
        </form> 
    </body>


</html>
