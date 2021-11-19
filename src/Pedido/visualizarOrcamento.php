<?php

require_once "../../vendor/autoload.php";
include_once "../scripts/validaLogin.php";
validarLogin("PUB");
$connection  = require '../scripts/connectionClass.php';
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

//variáveis globais
$cnpj = $_SESSION["cnpj"];
$codCotacao = $_GET['cod'];
$validation = false;
$tabelaItens = "";

//checka se o pedido pertence ao órgão público logado
$sqlConfirmaDados = "select pedido.cod from pedido
INNER JOIN cotacoes ON pedido.cod = cotacoes.pedido
where cotacoes.cod = $codCotacao and cnpj = $cnpj";
foreach ($connection->query($sqlConfirmaDados) as $key => $value) {
    $validation = true;
}
if (!$validation) {
    header("Location:meusPedidos.php");
}

//executa a consulta de dados básicos do pedido
$sql = "SELECT empresa_privada.razao_social, cotacoes.last_update, cotacoes.observacao, pedido.titulo, pedido.cod
FROM cotacoes
INNER JOIN empresa_privada ON cotacoes.empresa = empresa_privada.cnpj
INNER JOIN pedido ON cotacoes.pedido = pedido.cod
where cotacoes.cod = $codCotacao";
foreach($connection->query($sql) as $key => $value){
$razaoSocial = $value['razao_social'];
$data_abertura = strtotime($value["last_update"]);
$titulo_pedido = $value['titulo'];
$observacaoPedido = $value['observacao'];
$codPedido = $value['cod'];
}

$dataAB = date("d/m/Y", $data_abertura);
$horaAB = strftime('%H:%M', $data_abertura);



//executa consulta dos itens do pedido
$sqlItens = "SELECT descricao_modelo, valor_un, item_pedido.item FROM cotacoes_itens
INNER JOIN item_pedido
ON cotacoes_itens.item_ref = item_pedido.cod
WHERE cotacoes_itens.cotacao = $codCotacao";
foreach ($connection->query($sqlItens) as $key => $value) {
    $tabelaItens .= '
    <tr>
    <th scope="row">' . $value["item"] . '</th>
    <td align="justify">' . $value["descricao_modelo"] . '</td>
    <td>' . $value["valor_un"] . '</td>
    <td>' . $value["valor_un"] . '</td>
    </tr>';
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>LicitaTudo - Meus Pedidos</title>
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
        <div style="width:50%; display: inline-block;"><H3><b>INFORMAÇÕES DO PEDIDO</b></H3></div>
            <hr>
        
                <p><b>EMPRESSA EMISSORA: </b><?php echo $razaoSocial; ?></p>
                <p>ORÇAMENTO <b>N°# <?php echo $codCotacao; ?></b>, REFERENTE AO PEDIDO <b>N° #<?php echo $codPedido; ?></b></p>
                <p><b>DATA DE EMISSÃO: </b> <?php echo $dataAB . ' às ' . $horaAB ?></p></br>
                <!-- TÍTULOS & ETC -->
                <h3><b><?php echo "COTAÇÃO - " . $titulo_pedido ?></b></h3>
                <p><?php echo "OBSERVAÇÃO: " . $observacaoPedido; ?></p></br>

                 
            <h4>LISTA DOS ITENS COTADOS</h4>
            <div class="bd-example">
                <table class="table table-bordered">
                  <thead>
                  <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Modelo Proposto</th>
                    <th scope="col">Valor Un.</th>
                    <th scope="col">Total</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php echo $tabelaItens; ?>
                  </tbody>
                </table>
            </div>
            <br>

            <h4>ANEXOS</h4><hr>
            <?php
            $sqlAnexos = "select * from anexos_cotacoes where cotacao = $codCotacao";
            echo "<p><a href='../scripts/abrirArquivoPDF.php?filename=COTACAO" . $codCotacao .  ".pdf&dir=Pedidos/Cotacoes/&titulo=COTACAO-" . $titulo_pedido . " - $cnpj'  target='_blank'>
            ORÇAMENTO.PDF </a></p>";
            foreach ($connection->query($sqlAnexos) as $key => $value) {
                echo "<p><a href='../scripts/abrirArquivoPDF.php?filename=ANEXO" . $value["cod"] .  ".pdf&dir=Pedidos/Anexos/AnexosCotacoes/&titulo=Anexo" . $value["cod"] . " - $codCotacao'  target='_blank'>
            " . $value["descricao"] . "</a>";
            }

            ?>

            <br>
            <!-- footer da página --></br></br></br>
            <footer>
                <div class="container center col-md-3">
                <p class="text-muted">&copy; Licitatudo  2020 – 2021</p>
                </div>
            </footer>
        </div>
    </body>
</html>
