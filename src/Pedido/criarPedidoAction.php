<?php

require_once "../../vendor/autoload.php";
include_once "../scripts/validaLogin.php";
validarLogin("PUB");
$curl = new Curl\Curl();
$connection  = require '../scripts/connectionClass.php';
$useKey = require '../Pedido/scripts/config.php';
include_once "../scripts/generatePDF.php";
$url = "https://maps.googleapis.com/maps/api/distancematrix/xml";
$categoriasSelecionadas = array();
$dadosEnderecosPrivados = array();
$empresasNotificadas = array();
$distancia = null;

//var_dump($_POST);
if (isset($_POST['cbDistancia'])) {
    $distancia = $_POST['txtDistancia'];
}

//insere o pedido
$sql = 'INSERT INTO pedido (titulo, descricao, data_abertura, status, modo, cnpj, distancia) VALUES ("' . $_POST['txtTituloPedido'] . '", "' . $_POST['txtDescricaoPedido'] . '",
now(), 1, "' . $_POST['selectModoPedido'] . '", "' . $_SESSION['cnpj'] . '", "' . $distancia . '");';
$prepare = $connection->prepare($sql);
$prepare->execute();
$idPedido = $connection->lastInsertId();

//DIRETÓRIO DO PDF
$DIR = "../../files/Pedidos/";
$ARQ = "PEDIDO$idPedido.pdf";
$FINAL = $DIR . $ARQ;


//insere as categorias
$qtdeCategorias = $_POST["qtdeCategorias"];
for ($i = $qtdeCategorias; $i > 0; $i--) {
    $thisCategoria = $_POST['selectCategorias' . $i];
    array_push($categoriasSelecionadas, $thisCategoria);
    $sql = 'INSERT INTO categoria_pedido (pedido, categoria) VALUES (' . $idPedido . ', "' . $thisCategoria . '");';
    $prepare = $connection->prepare($sql);
    $prepare->execute();
}

//declara o header da tabela de itens
$tabelaItens = '
<table width="100%" border="1" style="border-collapse: collapse; margin-bottom: 10px;">
<tr>
<th>ITEM</th>
<th>DESCRIÇÃO COMPLETA</th>
<th>QTDE</th>
<th>UNIDADE</th>
</tr>';

//insere os itens
$qtdeItems = $_POST["qtdeItems"];
for ($i = $qtdeItems; $i > 0; $i--) {
    $thisItemTitulo = $_POST['txtItem' . $i];
    $thisItemDescricao = $_POST['txtDesc' . $i];
    $thisItemQtde = $_POST['txtQtde' . $i];
    $thisItemSelectQtde = $_POST['selectQtde' . $i];
    $sql = 'INSERT INTO item_pedido (item, descricao, quantidade, unidade, pedido_cod) VALUES ("' . $thisItemTitulo . '", "' . $thisItemDescricao . '",
    "' . $thisItemQtde . '", "' . $thisItemSelectQtde . '", "' . $idPedido . '");';
    $prepare = $connection->prepare($sql);
    $prepare->execute();
    $tabelaItens .= '
    <tr>
    <td style="padding: 1%;"> ' . $thisItemTitulo . '</td>
    <td style="padding: 1%;" align="justify"> ' . $thisItemDescricao . ' </td>
    <td align="CENTER">' . $thisItemQtde . '</td>
    <td align="CENTER">' . $thisItemSelectQtde . '</td>
    </tr>';
}
$tabelaItens .= "</table>";



//prepara e executa o  SQL para filtrar as empresas
$baseSQL = "SELECT cnpj FROM categoria_empresa_privada WHERE cnpj!=NULL ";
foreach ($categoriasSelecionadas as $key) {
    $baseSQL = $baseSQL . "or categoria=$key ";
}
$baseSQL =  $baseSQL . "GROUP BY cnpj";
$cnpjEmpresasFiltradas = $connection->query($baseSQL);
//coloca as empresas filtradas dentro do array empresasNotificadas, pois estas serão notificadas (caso não haja alterador de distância)
foreach ($cnpjEmpresasFiltradas as $key => $empresa) {
    array_push($empresasNotificadas, $empresa["cnpj"]);
}


//limitador de distância ativado
if (isset($_POST['cbDistancia'])) {
    array_splice($empresasNotificadas, 0);
//prepara e executa o SQL para selecionar os endereços dos órgãos públicos
    $sql = "select * from endereco_instituicao_publica where cnpj='" . $_SESSION['cnpj'] . "'";
    $dadosEnderecosPublicos = $connection->query($sql);
    $cnpjEmpresasFiltradasEnderecos = $connection->query($baseSQL);
//prepara e executa o SQL para selecionar os endereços das empresas filtradas
    foreach ($cnpjEmpresasFiltradasEnderecos as $key => $empresa) {
        $sql = "select * from endereco_empresa_privada where cnpj='" . $empresa['cnpj'] . "'";
        $thisEnderecoPrivado = $connection->query($sql);
        array_push($dadosEnderecosPrivados, $thisEnderecoPrivado);
    }

//consulta à API
    foreach ($dadosEnderecosPublicos as $key => $endPub) {
        foreach ($dadosEnderecosPrivados as $endPri) {
            foreach ($endPri as $query => $regPri) {
                $curl->get($url, array(
                'origins' => $endPub["logradouro"] . ", " .  $endPub["numero"] . ", "  .  $endPub["bairro"] . ". " . $endPub["cidade"] . " - " . $endPub["uf"] . ", " . $endPub["cep"],
                'destinations' => $regPri["logradouro"] . ", " .  $regPri["numero"] . ", "  .  $regPri["bairro"] . ". " . $regPri["cidade"] . " - " . $regPri["uf"] . ", " . $regPri["cep"],
                'units' => 'kilometers',
                'key' => $useKey
                ));
                $dadosResponseAPI = $curl->response;
                $responseAPIXML = simplexml_load_string($dadosResponseAPI);
                $distanciaEndPriv = $responseAPIXML -> row -> element -> distance -> value;
                $distanciaEndPriv = $distanciaEndPriv / 1000;

                if ($distanciaEndPriv <= $distancia) {
                    array_push($empresasNotificadas, $regPri["cnpj"]);
                }
            }
        }
    }
    $empresasNotificadas = array_unique($empresasNotificadas);
    $curl->close();
}

//var_dump($empresasNotificadas);
//notifica as empresas
foreach ($empresasNotificadas as $key => $thisEmpresaNotificada) {
    $sql = 'INSERT INTO notificacao_pedido (pedido, empresa, status) VALUES (' . $idPedido . ', "' . $thisEmpresaNotificada . '", 1);';
    $prepare = $connection->prepare($sql);
    $prepare->execute();
}

//seleciona os dados do pedido
$selectIntelTitle = "SELECT razao_social, data_abertura, modo_pedido.modo FROM instituicao_publica 
INNER join pedido ON instituicao_publica.cnpj = pedido.cnpj 
INNER JOIN modo_pedido ON pedido.modo = modo_pedido.cod
WHERE pedido.cod = $idPedido";

foreach ($connection->query($selectIntelTitle) as $key => $value) {
    $razaoSocial = $value["razao_social"];
    $data_abertura = strtotime($value["data_abertura"]);
    $modoPedido = $value["modo"];
}

$dataAB = date("d/m/Y", $data_abertura);
$horaAB = strftime('%H:%M', $data_abertura);
//prepara o conteúdo para ser salvo
$conteudo = "<p>ÓRGÃO EMISSOR: <b>$razaoSocial</b><br>";
$conteudo .= "PEDIDO N° <b>#$idPedido</b><br>";
$conteudo .= "MODO: <b>$modoPedido</b><br>";
$conteudo .= "DATA DE EMISSÃO: <b>$dataAB</b> às <b>$horaAB</b></p><br>";
$conteudo .= "<h2 ALIGN='LEFT'>" . $_POST['txtTituloPedido'] . "</h2>";
$conteudo .= "<p align='justify'>" . $_POST['txtDescricaoPedido'] . "</p><BR>";
$conteudo .= "<h2 ALIGN='CENTER'>LISTA DOS ITENS DESCRITOS</h2>";
$conteudo .= $tabelaItens;

generatePDF($conteudo, $FINAL);
$_SESSION['idPedido'] = $idPedido;
header("location:pedidoConcluido.php");
