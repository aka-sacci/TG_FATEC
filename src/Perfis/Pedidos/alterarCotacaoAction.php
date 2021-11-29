<?php

include_once "../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require '../../scripts/connectionClass.php';
include_once "gerarPDF.php";
setlocale(LC_MONETARY, 'pt_BR');

$descDoc = $_POST["txtDesc"];
$desObservacoes = $_POST["txtObservacoes"];
$cod = $_POST['txtCodCot'];
$cnpj = $_SESSION['cnpj'];
$qtdeItens = $_POST['txtQtdeItens'];
$existeAnexoBD = $_POST['txtTemArquivo'];


$sql = "update cotacoes set observacao='$desObservacoes', last_update=now()";
$prepare = $connection->prepare($sql);
$prepare->execute();

//exclui os itens antigos
$sql = "delete from cotacoes_itens where cotacao=$cod";
$prepare = $connection->prepare($sql);
$prepare->execute();


//adiciona os itens novos
for ($i = $qtdeItens; $i > 0; $i--) {
    $thisItem = $_POST['selectItem' . $i];
    $thisDesc = $_POST['txtDesc' . $i];
    $thisValue = $_POST['txtValue' . $i];
    $thisValue = str_replace(",", ".", $thisValue);
    $sql = 'INSERT INTO cotacoes_itens (item_ref, valor_un, descricao_modelo, cotacao) VALUES (' . $thisItem . ', "' . $thisValue . '", "' . $thisDesc .  '", "' . $cod . '");';
    $prepare = $connection->prepare($sql);
    $prepare->execute();
}

//checka se há arquivos upados
if ($_FILES['file']['name']) {
    if ($existeAnexoBD == "naoexiste") {
        $sql = "INSERT INTO anexos_cotacoes (descricao, cotacao) VALUES ('$descDoc', '$cod')";
        $prepare = $connection->prepare($sql);
        $prepare->execute();
        $idDoc = $connection->lastInsertId();
    } else {
        $idDoc = $existeAnexoBD;
        $sql = "update anexos_cotacoes set descricao = '$descDoc' where cod = $idDoc";
        $prepare = $connection->prepare($sql);
        $prepare->execute();
    }
    //insere o doc
    $targetfolder = "../../../files/Pedidos/Anexos/AnexosCotacoes/";
    $fileName = basename($_FILES['file']['name']);
    $targetfolder = $targetfolder . basename($_FILES['file']['name']) ;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {
        rename($targetfolder, "../../../files/Pedidos/Anexos/AnexosCotacoes/ANEXO$idDoc.pdf");
    }
}

//REGERA O PDF

//DIRETÓRIO DO PDF
$DIR = "../../../files/Pedidos/Cotacoes/";
$ARQ = "COTACAO$cod.pdf";
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
$sql = "SELECT empresa_privada.razao_social, NOW(), cotacoes.observacao, pedido.titulo, pedido.cod as codPed
FROM cotacoes
INNER JOIN empresa_privada ON cotacoes.empresa = empresa_privada.cnpj
INNER JOIN pedido ON cotacoes.pedido = pedido.cod
where cotacoes.cod = $cod";
foreach ($connection->query($sql) as $key => $value) {
    $razaoSocial = $value['razao_social'];
    $data_abertura = strtotime($value["NOW()"]);
    $titulo_pedido = $value['titulo'];
    $observacaoPedido = $value['observacao'];
    $codPed = $value['codPed'];
}
$dataAB = date("d/m/Y", $data_abertura);
$horaAB = strftime('%H:%M', $data_abertura);
$conteudo = "<p>ÓRGÃO EMISSOR: <b>$razaoSocial</b><br>";
$conteudo .= "ORÇAMENTO N° <b>#$cod</b>, REFERENTE AO PEDIDO N° <b>#$codPed</b><br>";
$conteudo .= "DATA DE EMISSÃO: <b>$dataAB</b> às <b>$horaAB</b><br>";
$conteudo .= "<h2 ALIGN='LEFT'>COTAÇÃO - " . $titulo_pedido . "</h2>";
$conteudo .= "<p align='justify'>OBSERVAÇÃO: " . $observacaoPedido . "</p><BR>";
$conteudo .= "<h2 ALIGN='CENTER'>LISTA DOS ITENS COTADOS</h2>";
//
$sql = "SELECT descricao_modelo, valor_un, item_pedido.item, quantidade FROM cotacoes_itens
INNER JOIN item_pedido
ON cotacoes_itens.item_ref = item_pedido.cod
WHERE cotacoes_itens.cotacao = $cod order by cotacoes_itens.cod DESC";
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
$_SESSION["message"] = "Seu orçamento foi atualizado com sucesso!";
$_SESSION["href"] = "../Cadastro/Privado";
header("Location:../../scripts/redirectTo.php");
