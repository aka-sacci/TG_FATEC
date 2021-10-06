<?php

require_once "../../../vendor/autoload.php";
use AkaSacci\GetcnpjPhp\Search;
require_once '../../scripts/utils/converterPontuacaoCNPJ.php';



session_start();
$connection  = require '../../scripts/connectionClass.php';
$CNPJ = $_GET['txtCNPJ'];
$type = $_GET['typeCNPJ'];
$_SESSION['cadType'] = $type;
$CNPJ = preg_replace('/[^0-9]/im', '', $CNPJ);

//checa se os registros já existem
if ($type == "PUB") {
    $sql = "select * from instituicao_publica where cnpj = '" . $CNPJ . "'";
    foreach ($connection->query($sql) as $key => $value) {
        $_SESSION["erroReportado"] = "O órgão público com o CNPJ " . converterCNPJ($CNPJ) . " já foi cadastrado!";
        header("location:erroReportado.php");
        exit;
    }
} else {
    $sql = "select * from empresa_privada where cnpj = '" . $CNPJ . "'";
    foreach ($connection->query($sql) as $key => $value) {
        $_SESSION["erroReportado"] = "A empresa com o CNPJ " . converterCNPJ($CNPJ) . " já foi cadastrada! Caso você não tenha feito esse cadastro,
         entre em contato com a nossa empresa!";
        header("location:erroReportado.php");
        exit;
    }
}

//faz a procura na API
$mySearch = new Search();
$data = $mySearch->getDataFromCNPJ($CNPJ);
$dataReplaceble = $data;
foreach ($dataReplaceble as $k1 => $row) {
    if ($row == "") {
        if ($k1 == "telefone" || $k1 == "email") {
        } else {
            $data[$k1] = "NA";
        }
    }
}


$statusConsulta = $data['status'];
if ($statusConsulta == "OK") {
    //coleta os dados para a session
    $_SESSION['cadCNPJ'] = $CNPJ;
    $_SESSION['cadRazaoSocial'] = $data['nome'];
    $_SESSION['cadNomeFantasia'] = $data['fantasia'];
    $_SESSION['cadEFR'] = $data['efr'];
    $_SESSION['cadEmail'] = $data['email'];
    $_SESSION['cadNatureza'] = $data['natureza_juridica'];
    $_SESSION['cadTelefone'] = $data['telefone'];
    $_SESSION['cadLog'] = $data['logradouro'];
    $_SESSION['cadNumero'] = $data['numero'];
    $_SESSION['cadBairro'] = $data['bairro'];
    $CEPCorigido = preg_replace('/[^0-9]/im', '', $data['cep']);
    $_SESSION['cadCEP'] = $CEPCorigido;
    $_SESSION['cadCidade'] = $data['municipio'];
    $_SESSION['cadUF'] = $data['uf'];
    $atividade = $data['atividade_principal'];
    if ($type == "PUB") {
        //checka se o CNPJ é de uma instituição pública
        $atv = substr($atividade[0]->code, 0, 2);
        if ($atv != "84") {
            $_SESSION["erroReportado"] = "O CNPJ " . converterCNPJ($CNPJ) . " não pertence a uma empresa pública!";
            header("location:erroReportado.php");
        } else {
            header("location:../Publico/confirmarCadastro.php");
        }
    } else {
        $atv = substr($atividade[0]->code, 0, 2);
        if ($atv == "84") {
            $_SESSION["erroReportado"] = "O CNPJ " . converterCNPJ($CNPJ) . " pertence a uma empresa pública!";
            header("location:erroReportado.php");
        } else {
            header("location:../Privado/confirmarCadastro.php");
        }
    }
} else {
    //acusa erro
    $_SESSION["erroReportado"] = $data['message'];
    header("location:erroReportado.php");
}
