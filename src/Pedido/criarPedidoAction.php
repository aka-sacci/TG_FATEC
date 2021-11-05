<?php

require_once "../../vendor/autoload.php";
$curl = new Curl\Curl();
include_once "../scripts/validaLogin.php";
$connection  = require '../scripts/connectionClass.php';
$useKey = require '../Pedido/scripts/config.php';
$url = "https://maps.googleapis.com/maps/api/distancematrix/xml";
$categoriasSelecionadas = array();
$dadosEnderecosPrivados = array();
$empresasNotificadas = array();
/*
$distancia = null;
//var_dump($_POST);
if (isset($_POST['cbDistancia'])) {
    $distancia = $_POST['txtDistancia'];
}
*/
/*
//insere o pedido
$sql = 'INSERT INTO pedido (titulo, descricao, data_abertura, status, modo, cnpj, distancia) VALUES ("' . $_POST['txtTituloPedido'] . '", "' . $_POST['txtDescricaoPedido'] . '",
now(), 1, "' . $_POST['selectModoPedido'] . '", "' . $_SESSION['cnpj'] . '", "' . $distancia . '");';
$prepare = $connection->prepare($sql);
$prepare->execute();
$idPedido = $connection->lastInsertId();
*/

//insere as categorias
$qtdeCategorias = $_POST["qtdeCategorias"];
for ($i = $qtdeCategorias; $i > 0; $i--) {
    $thisCategoria = $_POST['selectCategorias' . $i];
    array_push($categoriasSelecionadas, $thisCategoria);
    //$sql = 'INSERT INTO categoria_pedido (pedido, categoria) VALUES (' . $idPedido . ', "' . $thisCategoria . '");';
    //$prepare = $connection->prepare($sql);
    //$prepare->execute();
}

//insere os itens
/*
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
}

$_SESSION['idPedido'] = $idPedido;
header("location:pedidoConcluido.php");
*/

//prepara e executa o SQL para selecionar os endereços dos órgãos públicos
$sql = "select * from endereco_instituicao_publica where cnpj='" . $_SESSION['cnpj'] . "'";
$dadosEnderecosPublicos = $connection->query($sql);

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

//prepara e executa o SQL para selecionar os endereços das empresas filtradas
foreach ($cnpjEmpresasFiltradas as $key => $empresa) {
    $sql = "select * from endereco_empresa_privada where cnpj='" . $empresa['cnpj'] . "'";
    $thisEnderecoPrivado = $connection->query($sql);
    array_push($dadosEnderecosPrivados, $thisEnderecoPrivado);
}


//consulta à API
foreach ($dadosEnderecosPublicos as $key => $endPub) {

    foreach ($dadosEnderecosPrivados as $endPri) {
        
        foreach ($endPri as $query => $regPri){

            $curl->get($url, array(
                'origins' => $endPub["logradouro"] . ", " .  $endPub["numero"] . ", "  .  $endPub["bairro"] . ". " . $endPub["cidade"] . " - " . $endPub["uf"] . ", " . $endPub["cep"],
                'destinations' => $regPri["logradouro"] . ", " .  $regPri["numero"] . ", "  .  $regPri["bairro"] . ". " . $regPri["cidade"] . " - " . $regPri["uf"] . ", " . $regPri["cep"],
                'units' => 'kilometers',
                'key' => $useKey
            ));
            $dadosResponseAPI = $curl->response;
            $responseAPIXML = simplexml_load_string($dadosResponseAPI);
            $distanciaEndPriv = $responseAPIXML -> row -> element -> distance -> value;
            $distanciaEndPriv = $distanciaEndPriv/1000;

            var_dump($responseAPIXML);
            echo "<br>";
            echo "Distância: " . $distanciaEndPriv . " km";
            echo "<br><br>";

        }
       
    }

    
}

$curl->close();




