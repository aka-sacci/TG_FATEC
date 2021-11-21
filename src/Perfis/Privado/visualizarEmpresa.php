<?php
   session_start();
   require_once "../../../vendor/autoload.php";
   $connection  = require '../../scripts/connectionClass.php';
   require_once '../../scripts/utils/converterPontuacaoCNPJ.php';
   setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

if (isset($_GET['cnpj'])) {
    $myCnpj = $_GET['cnpj'];
} else {
    header("Location: /TG_FATEC");
}


//DADOS DO CADASTRO & CONTATO
$sqlDadosCadastro = "select * from empresa_privada where cnpj = $myCnpj";

//DADOS DO ENDEREÇO
//checka a quantidade de endereços
$sql = "SELECT COUNT(cod) FROM endereco_empresa_privada WHERE cnpj = " . $myCnpj . "";
foreach ($connection->query($sql) as $key => $value) {
    $nroEnderecos = $value["COUNT(cod)"];
}
//pega o endereco principal (sempre o primeiro a ser inserido)
$sql = "select * from endereco_empresa_privada where cnpj = '" . $myCnpj . "' order by cod ASC limit 1";
$enderecoPrincipal = $connection->query($sql);


?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
    <meta charset="utf-8">
        <title>LicitaTudo - Criar Pedido</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="../Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="../../scripts/utils/style.css">
        <!-- Lista de icones -->
        <link  rel="stylesheet" href="../../scripts/utils/fontawesome/css/all.css">
        <!-- skin -->
        <link rel="stylesheet" href="../../scripts/utils/default.css">
        <!-- jQuery e Bootstrap JS -->
        <script type="text/javascript" src="../../scripts/utils/scriptsBasicos.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>

    <body>
        </br>
        <a class="home" href="#" onclick="goBack()">
            <i class="fa fa-arrow-circle-left"> Voltar</i>
        </a>
        <div class="container" id="container-corpoindex">
            <hr><H4><b>INFORMAÇÕES GERAIS</b></H4>
                    <?php
                    foreach ($connection->query($sqlDadosCadastro) as $key => $value) {
                        echo '<p><b>CNPJ: </b>' .  converterCNPJ($value['cnpj']) . '</p>';
                        echo '<p><b>Razão Social: </b>' . $value['razao_social'] . '</p>';
                        echo '<p><b>Nome Fantasia: </b>' . $value['nome_fantasia'] . '</p>';
                        echo '<p><b>Ente Federativo Responsável (EFR): </b>' . $value['efr'] . '</p>';
                        echo '<p><b>Natureza Jurídica: </b>' . $value['natureza'] . '</p>';
                        $telefone = $value['telefone'];
                        $email = $value['email'];
                    }
                    ?>

            <hr><H4><b>INFORMAÇÕES PARA CONTATO/LOGIN</b></H4>

                    <?php
                        echo '<p><b>Telefone: </b>' . $telefone;
                        echo '<p><b>Email: </b>' . $email;
                    ?>

            <hr><H4><b>ENDEREÇOS</b></H4>
            <h5>Endereço principal</h5>
                    <?php
                    foreach ($enderecoPrincipal as $key => $value) {
                        echo "<p>" . $value['logradouro'] . ", " . $value['numero'] . ", " . $value['bairro'] . " - " .  $value['cidade'] . " (" . $value['uf'] . ") </p>";
                    }
                    ?>

            <h4>Outros endereços</h4>

                    <?php
                    if ($nroEnderecos == 1) {
                        //caso a empresa só tenha um endereço cadastrado
                        echo "<p>Não há outros endereços!</p>";
                    } else {
                        $limit = $nroEnderecos - 1;
                        $sql = "select * from endereco_empresa_privada where cnpj = '" . $myCnpj . "' order by cod DESC LIMIT $limit";
                        //caso tenha mais que um, é retornado todos os endereços EXCETO o primeiro a ser inserido (o principal);
                        foreach ($connection->query($sql) as $key => $value) {
                            echo "<p>" . $value['logradouro'] . ", " . $value['numero'] . ", " . $value['bairro'] . " - " .  $value['cidade'] . " (" . $value['uf'] . ") </p>";
                            echo "<p><b>Descrição: </b>" . $value['descricao'] . "";
                        }
                    }
                    ?>

            <hr><H4><b>Documentos</b></H4>
            <?php
    //seleciona os documentos cadastrados
            $validateDocs = false;
            $conteudoDocsNull = "<p>Não há documentos registrados!</p>";
            $sql = "select data_upload, descricao, descricao_doc, documento_empresa_privada.cod from documento_empresa_privada
    INNER JOIN documento_tipo ON 
    documento_empresa_privada.tipo = documento_tipo.cod
    WHERE cnpj = $myCnpj";
            $conteudoDocs = "";

            foreach ($connection->query($sql) as $key => $value) {
                $validateDocs = true;
                $conteudoDocs .= "<p><a href='../../scripts/abrirArquivoPDF.php?filename=" . $value['cod'] .  ".pdf&";
                $conteudoDocs .= "dir=Documentos/&titulo=" . $value['descricao'] . " - $myCnpj' target='_blank'>" . $value['descricao_doc'] ;
                $conteudoDocs .= "</a>";
            }
            if (!$validateDocs) {
                //se não houverem documentos cadastrados...
                echo $conteudoDocsNull;
            } else {
                //se houverem documentos cadastrados...
                echo $conteudoDocs;
            }

            ?>
            <hr></br>
                <!-- footer da página -->
                <div class="container center col-md-3">
                <p class="text-muted">&copy; Licitatudo  2020 – 2021</p>
                </div>
        </div>
    </body>
</html>
