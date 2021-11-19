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
if (!$validation) {
    header("Location:meusPedidos.php");
}

//executa a consulta de dados básicos do pedido
$sqlConsulta = "select titulo, data_abertura, data_fechamento, descricao, pedido.status AS cod_status,
modo_pedido.modo, status_pedido.status, instituicao_publica.razao_social, endereco_entrega
from pedido
INNER JOIN modo_pedido ON pedido.modo = modo_pedido.cod
INNER JOIN status_pedido ON pedido.status = status_pedido.cod
INNER JOIN instituicao_publica ON pedido.cnpj = instituicao_publica.cnpj
where pedido.cod = $cod";
foreach ($connection->query($sqlConsulta) as $key => $value) {
    $titulo = $value['titulo'];
    $abertura = strtotime($value['data_abertura']);
    $fechamento = strtotime($value['data_fechamento']);
    $descricao = $value['descricao'];
    $modo = $value['modo'];
    $status = $value['status'];
    $razaoSocial = $value['razao_social'];
    $statusCod = $value['cod_status'];
    $enderecoEntrega = $value["endereco_entrega"];
}

$dataAbertura = strftime('%d/%m/%Y', $abertura);
$horaAbertura = strftime('%H:%M', $abertura);
$dataFechamento = strftime('%d/%m/%Y', $fechamento);
$horaFechamento = strftime('%H:%M', $fechamento);

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

//executa consulta dos anexos do pedido
$sqlAnexos = "select * from anexos_pedido where pedido = $cod";



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

        <!-- Botões -->
        <div style="width: 50%; text-align: Right; float:right;">
        <?php
        if ($statusCod == "1") {
            echo "<a href='alterarStatusPedido.php?cod=$cod&alteracao=2'><button style='background-color: #41d92e;'><b>FINALIZAR PEDIDO</b></button></a> ";
            echo "<a href='alterarStatusPedido.php?cod=$cod&alteracao=3'><button style='background-color: #e32738;'><b>CANCELAR PEDIDO</b></button></a>";
        }
        ?>
        </div>
            <hr>
        
                <p><b>ÓRGÃO EMISSOR: </b><?php echo $razaoSocial; ?></p>
                <p><b>PEDIDO N°: </b>#<?php echo $cod; ?></p>
                <p><b>MODO: </b><?php echo $modo; ?></p>
                <p><b>DATA DE EMISSÃO: </b> <?php echo $dataAbertura . ' às ' . $horaAbertura ?></p>
                <?php
                if ($fechamento && $statusCod != "1") {
                    echo "<p><b>DATA DE FECHAMENTO: </b> $dataFechamento  às $horaFechamento </p>";
                }

                $sqlEndereco = "select * from endereco_instituicao_publica where cod=$enderecoEntrega";
                foreach ($connection->query($sqlEndereco) as $key => $value) {
                    echo  "<p><b>ENDEREÇO DE ENTREGA: </b>" . $value['logradouro'] . ", " . $value['numero'] . ", " . $value['bairro'] . " - " .  $value['cidade'] . " (" . $value['uf'] . ")";
                }

                ?>
                <p><b>STATUS: </b> <?php echo $status ?></p></br>

                
                <!-- TÍTULOS & ETC -->
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
            <br>

            <h4>ANEXOS</h4><hr>
            <?php
            echo "<p><a href='../scripts/abrirArquivoPDF.php?filename=PEDIDO" . $cod .  ".pdf&dir=Pedidos/&titulo=" . $titulo . " - $cnpj'  target='_blank'>
            SOLICITAÇÃO DO PEDIDO (Indeletável) </a></p>";

            foreach ($connection->query($sqlAnexos) as $key => $value) {
                echo "<p><a href='../scripts/abrirArquivoPDF.php?filename=ANEXO" . $value["cod"] .  ".pdf&dir=Pedidos/Anexos/&titulo=Anexo" . $value["cod"] . " - $cod'  target='_blank'>
            " . $value["descricao"] . "</a>";

                if ($statusCod == "1") {
                    echo " <a href='deletarAnexo.php?cod=" . $value['cod'] .  "'><img src='../Imagens/icons/delete-icon.png' width='15' height='15'></a></p>";
                }
            }
            ?>
            <?php
            if ($statusCod == "1") {
                echo "<p align='right'><a href='adicionarAnexo.php?cod=$cod'><button>Adicionar</button></a></p>";
            } ?>

            <br>
            <h4>COTAÇÕES</h4><hr>
            <?php
             $sqlCotacoes = "SELECT empresa_privada.razao_social, cotacoes.cod, COUNT(cotacoes_itens.cod) FROM cotacoes
             INNER JOIN empresa_privada ON cotacoes.empresa = empresa_privada.cnpj
             INNER JOIN cotacoes_itens ON cotacoes.cod = cotacoes_itens.cotacao
             INNER JOIN pedido ON cotacoes.pedido = pedido.cod
             WHERE pedido.cod=$cod
             GROUP BY empresa_privada.cnpj";
             foreach ($connection->query($sqlCotacoes) as $key => $value) {
                 echo  "<p><a href='visualizarOrcamento.php?cod=" . $value['cod'].  "'>" . $value['razao_social'] . " (" . $value['COUNT(cotacoes_itens.cod)'] . " Itens)</a></p>";
             }
            ?>
            <!-- footer da página --></br></br></br>
            <footer>
                <div class="container center col-md-3">
                <p class="text-muted">&copy; Licitatudo  2020 – 2021</p>
                </div>
            </footer>
        </div>
    </body>
</html>
