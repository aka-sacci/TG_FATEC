<?php

require_once "../../../../../vendor/autoload.php";
include_once "../../../../scripts/validaLogin.php";
validarLogin("PUB");
$connection  = require "../../../../scripts/connectionClass.php";
use AkaSacci\GetcnpjPhp\Search;
$mySearch = new Search();
//pega os dados da receita federal referentes ao CNPJ informado
$data = $mySearch->getDataFromCNPJ($_SESSION["cnpj"]);


//pega os dados do BD referentes ao CNPJ informado
$sql = "select * from endereco_instituicao_publica where cnpj = '" . $_SESSION["cnpj"] . "' order by cod ASC limit 1";
foreach ($connection->query($sql) as $key => $value) {
    $cod = $value["cod"];
    $logradouroBD = $value["logradouro"];
    $numeroBD = $value["numero"];
    $bairroBD = $value["bairro"];
    $cepBD = $value["cep"];
    $cidadeBD = $value["cidade"];
    $ufBD = $value["uf"];
}


$statusConsulta = $data['status'];
//confere se a requisição à API retornou normal
if ($statusConsulta == "OK") {
    $CEPCorigido = preg_replace('/[^0-9]/im', '', $data['cep']);

    //Substitui os campos que retornam com NULL por NA
    $dataReplaceble = $data;
    foreach ($dataReplaceble as $k1 => $row) {
        if ($row == "") {
            if ($k1 == "telefone" || $k1 == "email") {
            } else {
                $data[$k1] = "NA";
            }
        }
    }

    //compara todos os dados
    if (
        $data['logradouro'] == $logradouroBD &&
        $data['numero'] == $numeroBD &&
        $data['bairro'] == $bairroBD &&
        $CEPCorigido == $cepBD &&
        $data['municipio'] == $cidadeBD &&
        $data['uf'] == $ufBD
    ) {
        //se todos os dados forem iguais, não há necessidade de fazer alterações
        $_SESSION["message"] = "Não foi necessário atualizar, todos os dados permanecem os mesmos!";
        $_SESSION["href"] = "../Cadastro/Publico/Alteracoes";
        header("Location:../../../../scripts/redirectTo.php");
    } else {
        //se tiver algum dado diferente, atualiza
        $sql = "update endereco_instituicao_publica set
logradouro = '" . $data['logradouro'] . "', 
numero = '" . $data['numero'] . "', 
bairro =  '" . $data['bairro'] . "', 
cep = '" . $CEPCorigido . "', 
cidade = '" . $data['municipio'] . "', 
uf = '" . $data['uf'] . "'
where cod = " . $cod . "";
        $prepare = $connection->prepare($sql);
        $prepare->execute();
        $_SESSION["message"] = "O cadastro foi atualizado com sucesso!";
        $_SESSION["href"] = "../Cadastro/Publico/Alteracoes";
        header("Location:../../../../scripts/redirectTo.php");
    }
} else {
    $_SESSION["message"] = $data['message'];
    $_SESSION["href"] = "../Cadastro/Publico/Alteracoes";
    header("Location:../../../../scripts/redirectToError.php");
}
