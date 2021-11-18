<?php

require_once "../../vendor/autoload.php";
include_once "../scripts/validaLogin.php";
validarLogin("PUB");
$connection  = require '../scripts/connectionClass.php';
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

//variáveis globais
$cnpj = $_SESSION["cnpj"];
$cod = $_GET['cod'];
$validation = false;
$tabelaItens = "";

//checka se o pedido pertence ao órgão público logado
$sqlConfirmaDados = "select cod from pedido where cod = $cod and cnpj=$cnpj";
foreach ($connection->query($sqlConfirmaDados) as $key => $value) {
$validation = true;
}
if(!$validation) header("Location:meusPedidos.php");

//executa a consulta de dados básicos do pedido
$sqlConsulta = "select titulo, data_abertura, data_fechamento, descricao,
modo_pedido.modo, status_pedido.status, instituicao_publica.razao_social
from pedido
INNER JOIN modo_pedido ON pedido.modo = modo_pedido.cod
INNER JOIN status_pedido ON pedido.status = status_pedido.cod
INNER JOIN instituicao_publica ON pedido.cnpj = instituicao_publica.cnpj
where pedido.cod = $cod";
foreach ($connection->query($sqlConsulta) as $key => $value) {
$titulo = $value['titulo'];
$abertura = strtotime($value['data_abertura']);
$fechamento = $value['data_fechamento'];
$descricao = $value['descricao'];
$modo = $value['modo'];
$status = $value['status'];
$razaoSocial = $value['razao_social'];
}

$dataAbertura = strftime( '%d/%m/%Y', $abertura );
$horaAbertura = strftime( '%H:%M', $abertura );

//executa consulta dos itens do pedido
$sqlItens = "select * from item_pedido where pedido_cod = $cod";
foreach ($connection->query($sqlItens) as $key => $value) {
    $tabelaItens .= '
    <tr>
    <th scope="row">' . $value["item"] . '</th>
    <td align="justify">' . $value["descricao"] . '</td>
    <td>' . $value["quantidade"] . '</td>
    <td>' . $value["unidade"] . '</td>
    </tr>';

}


?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>LicitaTudo - Privado</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="../Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="../scripts/utils/style.css">
        <!-- Lista de icones -->
        <link  rel="stylesheet" href="../scripts/utils/fontawesome/css/all.css">
        <!-- skin -->
        <link rel="stylesheet" href="../scripts/utils/default.css">
        <!-- jQuery e Bootstrap JS -->
        <script type="text/javascript" src="../scripts/utils/scriptsBasicos.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <!-- Botao de Retorno -->
        </br>
        <a class="home" href="#" onclick="goBack()">
            <i class="fa fa-arrow-circle-left"> Voltar</i>
        </a>

        <!-- Corpo da Página -->
        <div class="container" id="container-corpoindex">
            <H3><b>INFORMAÇÕES DO PEDIDO</b></H3><hr>
                <p><b>ÓRGÃO EMISSOR: </b><?php echo $razaoSocial; ?></p>
                <p><b>PEDIDO N°: </b>#<?php echo $cod; ?></p>
                <p><b>MODO: </b><?php echo $modo; ?></p>
                <p><b>DATA DE EMISSÃO: </b> <?php echo $dataAbertura . ' às ' . $horaAbertura ?></p></br>
                <h3><b><?php echo $titulo; ?></b></h3>
                <p><?php echo $descricao; ?></p></br>

                 
            <h4>LISTA DOS ITENS DESCRITOS</h4>
            <div class="bd-example">
                <table class="table table-bordered">
                  <thead>
                  <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Descrição do Item</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Unidade</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php echo $tabelaItens; ?>
                  </tbody>
                </table>
            </div>
            <!-- footer da página --></br></br></br>
            <footer>
                <div class="container center col-md-3">
                <p class="text-muted">&copy; Licitatudo  2020 – 2021</p>
                </div>
            </footer>
        </div>
    </body>
</html>