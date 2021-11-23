<?php

require_once "../../../../../vendor/autoload.php";
include_once "../../../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require "../../../../scripts/connectionClass.php";
use AkaSacci\GetcnpjPhp\Search;
$mySearch = new Search();
//pega os dados da receita federal referentes ao CNPJ informado
$data = $mySearch->getDataFromCNPJ($_SESSION["cnpj"]);


//pega os dados do BD referentes ao CNPJ informado
$sql = "select * from endereco_empresa_privada where cnpj = '" . $_SESSION["cnpj"] . "' order by cod ASC limit 1";
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
        echo "<link rel='shortcut icon' type='image/x-icon' href='../../../../Imagens/Logo-Licita.ico'>
                <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
                <link rel='stylesheet' href='../../../../scripts/utils/style.css'>
                <script type='text/javascript' src='../../../../scripts/utils/scriptsBasicos.js'></script>
                <div class='container py-4 col-lg-4' id='container-corpoindex'>
                    <div class='alert alert-info' role='alert'>
                    <h4 class='alert-heading'>Não foi necessário atualizar!</h4>
                    </div></br>          
                    <button class='btn btn-md buttoncad' onclick='goBack()'>Voltar</button>
                </div>";
    } else {
        //se tiver algum dado diferente, atualiza
        $sql = "update endereco_empresa_privada set
logradouro = '" . $data['logradouro'] . "', 
numero = '" . $data['numero'] . "', 
bairro =  '" . $data['bairro'] . "', 
cep = '" . $CEPCorigido . "', 
cidade = '" . $data['municipio'] . "', 
uf = '" . $data['uf'] . "'
where cod = " . $cod . "";
        $prepare = $connection->prepare($sql);
        $prepare->execute();
        echo "<link rel='shortcut icon' type='image/x-icon' href='../../../../Imagens/Logo-Licita.ico'>
                <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
                <link rel='stylesheet' href='../../../../scripts/utils/style.css'>
                <script type='text/javascript' src='../../../../scripts/utils/scriptsBasicos.js'></script>
                <div class='container py-4 col-lg-4' id='container-corpoindex'>
                    <div class='alert alert-info' role='alert'>
                    <h4 class='alert-heading'>O endereço foi atualizado com sucesso!</h4>
                    </div></br>          
                    <button class='btn btn-md buttoncad' onclick='goBack()'>Voltar</button>
                </div>";
    }
} else {
    echo $data['message'];
}
