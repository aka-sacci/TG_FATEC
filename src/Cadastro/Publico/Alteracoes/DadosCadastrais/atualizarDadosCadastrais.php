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
    $sql = "select * from instituicao_publica where cnpj = '" . $_SESSION["cnpj"] . "'";
    foreach ($connection->query($sql) as $key => $value) {
        $razaoSocialBD = $value["razao_social"];
        $nomeFantasiaBD = $value["nome_fantasia"];
        $efrBD = $value["efr"];
        $naturezaBD = $value["natureza"];
    }

    $statusConsulta = $data['status'];
    //confere se a requisição à API retornou normal
    if ($statusConsulta == "OK") {
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
        $data['nome'] == $razaoSocialBD &&
        $data['fantasia'] == $nomeFantasiaBD &&
        $data['efr'] == $efrBD &&
        $data['natureza_juridica'] == $naturezaBD
    ) {
        //se todos os dados forem iguais, não há necessidade de fazer alterações
        echo "Não foi necessário atualizar, todos os dados permanecem os mesmos! Clique <a href='../'>aqui</a> para voltar.";
    } else {
        //se tiver algum dado diferente, atualiza
        $sql = "update instituicao_publica set
        razao_social = '" . $data['nome'] . "', 
        nome_fantasia = '" . $data['fantasia'] . "', 
        efr =  '" . $data['efr'] . "', 
        natureza = '" . $data['natureza_juridica'] . "'
        where cnpj = " .  $_SESSION["cnpj"] . "";
        $prepare = $connection->prepare($sql);
        $prepare->execute();
        echo "O cadastro foi atualizado com sucesso! Clique <a href='../'> aqui </a> para voltar.";
    }
    } else {
        echo $data['message'];
    }
    
?>