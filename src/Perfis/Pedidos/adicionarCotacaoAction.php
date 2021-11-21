<?php

include_once "../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require '../../scripts/connectionClass.php';
include_once "gerarPDF.php";
setlocale(LC_MONETARY, 'pt_BR');

$descDoc = $_POST["txtDesc"];
$desObservacoes = $_POST["txtObservacoes"];
$cod = $_POST['txtCodPedido'];
$cnpj = $_SESSION['cnpj'];
$qtdeItens = $_POST['txtQtdeItens'];
//adiciona a cotacao
$sql = 'INSERT INTO cotacoes (pedido, empresa, observacao, last_update) VALUES ("' . $cod . '", "' . $cnpj . '", "' . $desObservacoes .  '", now());';
$prepare = $connection->prepare($sql);
$prepare->execute();
$idCotacao = $connection->lastInsertId();



//adiciona os itens
for ($i = $qtdeItens; $i > 0; $i--) {
    $thisItem = $_POST['selectItem' . $i];
    $thisDesc = $_POST['txtDesc' . $i];
    $thisValue = $_POST['txtValue' . $i];
    $thisValue = str_replace(",", ".", $thisValue);
    $sql = 'INSERT INTO cotacoes_itens (item_ref, valor_un, descricao_modelo, cotacao) VALUES (' . $thisItem . ', "' . $thisValue . '", "' . $thisDesc .  '", "' . $idCotacao . '");';
    $prepare = $connection->prepare($sql);
    $prepare->execute();
}

//insere caso haja algum arquivo
if ($_FILES['file']['name']) {
    $sql = "INSERT INTO anexos_cotacoes (descricao, cotacao) VALUES ('$descDoc', '$idCotacao');";
    $prepare = $connection->prepare($sql);
    $prepare->execute();
    $idDoc = $connection->lastInsertId();
//insere o doc
    $targetfolder = "../../../files/Pedidos/Anexos/AnexosCotacoes/";
    $fileName = basename($_FILES['file']['name']);
    $targetfolder = $targetfolder . basename($_FILES['file']['name']) ;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {
        rename($targetfolder, "../../../files/Pedidos/Anexos/AnexosCotacoes/ANEXO$idDoc.pdf");
    }
}

//DIRETÓRIO DO PDF
$DIR = "../../../files/Pedidos/Cotacoes/";
$ARQ = "COTACAO$idCotacao.pdf";
$FINAL = $DIR . $ARQ;
$tabelaItens = '
<table width="100%" border="1" style="border-collapse: collapse; margin-bottom: 10px;">
<tr>
<th>ITEM</th>
<th>MODELO PROPOSTO</th>
<th>VALOR UN.</th>
<th>TOTAL</th>
</tr>';
//COLETA OS DADOS PARA GERAR O DOCUMENTO
$sql = "SELECT empresa_privada.razao_social, NOW(), cotacoes.observacao, pedido.titulo
FROM cotacoes
INNER JOIN empresa_privada ON cotacoes.empresa = empresa_privada.cnpj
INNER JOIN pedido ON cotacoes.pedido = pedido.cod
where cotacoes.cod = $idCotacao";
foreach ($connection->query($sql) as $key => $value) {
    $razaoSocial = $value['razao_social'];
    $data_abertura = strtotime($value["NOW()"]);
    $titulo_pedido = $value['titulo'];
    $observacaoPedido = $value['observacao'];
}
$dataAB = date("d/m/Y", $data_abertura);
$horaAB = strftime('%H:%M', $data_abertura);
$conteudo = "<p>ÓRGÃO EMISSOR: <b>$razaoSocial</b><br>";
$conteudo .= "ORÇAMENTO N° <b>#$idCotacao</b>, REFERENTE AO PEDIDO N° <b>#$cod</b><br>";
$conteudo .= "DATA DE EMISSÃO: <b>$dataAB</b> às <b>$horaAB</b><br>";
$conteudo .= "<h2 ALIGN='LEFT'>COTAÇÃO - " . $titulo_pedido . "</h2>";
$conteudo .= "<p align='justify'>OBSERVAÇÃO: " . $observacaoPedido . "</p><BR>";
$conteudo .= "<h2 ALIGN='CENTER'>LISTA DOS ITENS COTADOS</h2>";
//
$sql = "SELECT descricao_modelo, valor_un, item_pedido.item, quantidade FROM cotacoes_itens
INNER JOIN item_pedido
ON cotacoes_itens.item_ref = item_pedido.cod
WHERE cotacoes_itens.cotacao = $idCotacao ";
foreach ($connection->query($sql) as $key => $value) {
    $valUn = $value['valor_un'];
    $qtde = $value['quantidade'];
    $valtotal = $valUn * $qtde;
    $valUn = number_format($valUn, 2, ',', '.');
    $valtotal = number_format($valtotal, 2, ',', '.');
    $tabelaItens .= '
    <tr>
    <td style="padding: 1%;"> ' . $value['item'] . '</td>
    <td style="padding: 1%;" align="justify"> ' . $value['descricao_modelo'] . ' </td>
    <td align="CENTER">R$ ' . $valUn . '</td>
    <td align="CENTER">R$ ' . $valtotal . '</td>
    </tr>';
}
$tabelaItens .= "</table>";
$conteudo .= $tabelaItens;

generatePDF($conteudo, $FINAL);
echo "<p>Seu orçamento foi enviado com sucesso! Clique <a href=visualizarPedido.php?cod=$cod>aqui</a> para retornar</p>";
