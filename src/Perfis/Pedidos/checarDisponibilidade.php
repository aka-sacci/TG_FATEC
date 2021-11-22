<?php

function checkaDisponibilidade($empresaPrivada, $enderecoPublico, $distancia, $pedido)
{

    $connection  = require '../../scripts/connectionClass.php';
    require_once "../../../vendor/autoload.php";
    $curl = new Curl\Curl();
    $url = "https://maps.googleapis.com/maps/api/distancematrix/xml";
    $useKey = require '../../Pedido/scripts/config.php';
    $arrayTiposPedido = array();
    $arrayTiposEmpresa = array();
    $validaDistancia = false;

    //checkar se os tipos batem
    $sqlTiposPedido = "SELECT categoria FROM categoria_pedido WHERE pedido = $pedido ";
    $sqlTiposEmpresa = "SELECT categoria FROM categoria_empresa_privada WHERE cnpj = $empresaPrivada";

    foreach ($connection->query($sqlTiposPedido) as $key => $value) {
        array_push($arrayTiposPedido, $value["categoria"]);
    }

    foreach ($connection->query($sqlTiposEmpresa) as $key => $value) {
        array_push($arrayTiposEmpresa, $value["categoria"]);
    }
    $qtdeTipos = count($arrayTiposPedido);
    $resultado = count(array_diff($arrayTiposPedido, $arrayTiposEmpresa));
    if ($resultado == $qtdeTipos) {
        return 0;
    }

    //checkar se a distância bate
    if ($distancia == 0) {
        return 2;
    }
    $sqlEnderecosEmpresas = "select * from endereco_empresa_privada where cnpj=$empresaPrivada";
    $enderecosEmpresas = array();
    foreach ($connection->query($sqlEnderecosEmpresas) as $key => $value) {
        array_push($enderecosEmpresas, $value["logradouro"] . ", " .  $value["numero"] . ", "  .  $value["bairro"] . ". " . $value["cidade"] . " - " . $value["uf"] . ", " . $value["cep"]);
    }

    $sqlEnderecoEntrega = "select * from endereco_instituicao_publica where cod=$enderecoPublico";
    $enderecoEntrega = "";
    foreach ($connection->query($sqlEnderecoEntrega) as $key => $value) {
        $enderecoEntrega = $value["logradouro"] . ", " .  $value["numero"] . ", "  .  $value["bairro"] . ". " . $value["cidade"] . " - " . $value["uf"] . ", " . $value["cep"];
    }

    foreach ($enderecosEmpresas as $register => $endPri) {
        $curl->get($url, array(
        'origins' => $endPri,
        'destinations' => $enderecoEntrega,
        'units' => 'kilometers',
        'key' => $useKey
        ));
        $dadosResponseAPI = $curl->response;
        $responseAPIXML = simplexml_load_string($dadosResponseAPI);
        $distanciaEndPrivTXT = (string)$responseAPIXML -> row -> element -> distance -> text;
        $distanciaEndPriv = $responseAPIXML -> row -> element -> distance -> value;
        $distanciaEndPriv = $distanciaEndPriv / 1000;

        if ($distanciaEndPriv <= $distancia) {
            $validaDistancia = true;
            break;
        } else {
            if(isset($_SESSION['raio'])){
            if($_SESSION['raio'] > $distanciaEndPriv){
            $_SESSION['raio'] = $distanciaEndPrivTXT;
            }
        }else{
            $_SESSION['raio'] = $distanciaEndPrivTXT;
        }
        }
    }

    if ($validaDistancia) {
        return 2;
    } else {
        return 1;
    }
}

function checaOrcamento($cnpj, $pedido)
{
    $connection  = require '../../scripts/connectionClass.php';
    $sqlCheckaPedido = "select * from cotacoes where empresa = $cnpj and pedido = $pedido";
    foreach ($connection->query($sqlCheckaPedido) as $key => $value) {
        $_SESSION['codCotacao'] = $value['cod'];
        return 1;
        break;
    }
    return 0;
}
