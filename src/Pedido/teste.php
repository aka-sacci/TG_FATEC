<?php

include_once "../scripts/generatePDF.php";
include_once "../../vendor/autoload.php";
$DIR = "../../files/Pedidos/";
$ARQ = "teste1.pdf";
$FINAL = $DIR . $ARQ;
$conteudo = "<p>ÓRGÃO EMISSOR: <b>PREFEITURA DE BOM JESUS DOS PERDÕES</b><br>";
$conteudo .= "PEDIDO N° <b>#12</B><br>";
$conteudo .= "DATA DE EMISSÃO: <b>19/02/2021</b> às <b>19:30</b></p><br>";
$conteudo .= "<h2 ALIGN='LEFT'>" . $_POST['txtTituloPedido'] . "</h2>";
$conteudo .= "<p align='justify'>" . $_POST['txtDescricaoPedido'] . "</p><BR>";
$conteudo .= "<h2 ALIGN='CENTER'>LISTA DOS ITENS DESCRITOS</h2>";
$conteudo .= '
<table width="100%" border="1" style="border-collapse: collapse; margin-bottom: 10px;">
<tr>
<th>ITEM</th>
<th>DESCRIÇÃO COMPLETA</th>
<th>QTDE</th>
<th>UNIDADE</th>
</tr>';

$qtdeItems = $_POST["qtdeItems"];
for ($i = $qtdeItems; $i > 0; $i--) {
    $thisItemTitulo = $_POST['txtItem' . $i];
    $thisItemDescricao = $_POST['txtDesc' . $i];
    $thisItemQtde = $_POST['txtQtde' . $i];
    $thisItemSelectQtde = $_POST['selectQtde' . $i];
    $conteudo .= '
    <tr>
    <td style="padding: 1%;"> ' . $thisItemTitulo . '</td>
    <td style="padding: 1%;" align="justify"> ' . $thisItemDescricao . ' </td>
    <td align="CENTER">' . $thisItemQtde . '</td>
    <td align="CENTER">' . $thisItemSelectQtde . '</td>
    </tr>';
}

$conteudo .= "</table>";
generatePDF($conteudo, $FINAL);
