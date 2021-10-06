<?php

session_start();
require_once "../../../vendor/autoload.php";
require_once '../../scripts/utils/converterPontuacaoCNPJ.php';
require_once '../../scripts/utils/converterPontuacaoCEP.php';
$connection  = require '../../scripts/connectionClass.php';
$arrayCategoria = array();
$x = "teste";
$sql = "select * from categoria order by categoria ASC";
foreach ($connection->query($sql) as $key => $value) {
    $thisCategoria = array("cod" => $value["cod"], "categoria" => $value["categoria"]);
    array_push($arrayCategoria, $thisCategoria);
    //echo "<script>sessionStorage.setItem('" . $value["cod"] . "', '" . $value["categoria"] . "');</script>";
}

//var_dump($arrayCategorias);
echo "<script>sessionStorage.setItem('categorias', '" . json_encode($arrayCategoria) . "');</script>";
echo "<script>sessionStorage.setItem('counterCategorias', 1);</script>";
?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Cadastro de empresa privada</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../../scripts/utils/scriptsBasicos.js"></script>

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

        <br><p><b>A empresa trabalha com vendas/aluguel de:</b></p>
        <div id="divSelects" class="divSelects">
        <select name="selectCategorias1" id="selectCategorias1">
        <?php
        foreach ($arrayCategoria as $key => $registro) {
            echo "<option value='" . $registro['cod'] . "'>" . $registro['categoria']  . "</option> ";
        }
        ?>
        </select>
        </div>
        <p>*limite de 5 categorias por empresa privada</p>
        <p><button onclick="adicionarCategoria()" type="button">Adicionar categoria</button>
        <button onclick="deleteCategoria()" type="button">Remover</button></p>
       

        <br><p><b>Informações para contato</b></p>
        <?php
        echo '<p><b>Telefone</b></p><input name="txtTelefone" required value="' . $_SESSION['cadTelefone'] . '">';
        echo '<p><b>Email</b></p><input name="txtEmail" required value="' . $_SESSION['cadEmail'] . '">';
        ?>

        <p><input type='submit' value="Prosseguir" onclick="enableCategoria()"/></p>
        </form> 
    </body>


</html>
