<?php
session_start();
require_once "../../../vendor/autoload.php";
$connection  = require '../../scripts/connectionClass.php';
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
require_once "checarDisponibilidade.php";

//variáveis globais
$cod = $_GET['cod'];
$tabelaItens = "";
$isLogged = false;
$cnpj = "";
$validate = false;

if (isset($_SESSION["type"])) {
    if ($_SESSION["type"] == "PRI") {
        $isLogged = true;
        $cnpj = $_SESSION["cnpj"];
    }
}



//executa a consulta de dados básicos do pedido
$sqlConsulta = "select titulo, data_abertura, data_fechamento, descricao, pedido.status AS cod_status,
modo_pedido.modo, status_pedido.status, instituicao_publica.razao_social, endereco_entrega,
instituicao_publica.cnpj as pub_cnpj, distancia
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
    $cnpjPublico = $value['pub_cnpj'];
    $statusCod = $value['cod_status'];
    $enderecoEntrega = $value['endereco_entrega'];
    $distancia = $value['distancia'];
    $validate = true;
}

if (!$validate) {
    header("Location:../../../");
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
        <!-- Botao de Retorno -->
        </br>
        <a class="home" href="#" onclick="goBack()">
            <i class="fa fa-arrow-circle-left">Voltar</i>
        </a>

        <!-- Corpo da Página -->
        <div class="container" id="container-corpoindex">
        <div style="width:50%; display: inline-block;"><H3><b>INFORMAÇÕES DO PEDIDO</b></H3></div>
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

            <h4>ANEXOS DO PEDIDO</h4><hr>
            <?php
            echo "<p><a href='../../scripts/abrirArquivoPDF.php?filename=PEDIDO" . $cod .  ".pdf&dir=Pedidos/&titulo=" . $titulo . "'  target='_blank'>
            SOLICITAÇÃO DO PEDIDO</a></p>";

            foreach ($connection->query($sqlAnexos) as $key => $value) {
                echo "<p><a href='../../scripts/abrirArquivoPDF.php?filename=ANEXO" . $value["cod"] .  ".pdf&dir=Pedidos/Anexos/&titulo=Anexo" . $value["cod"] . " - $cod'  target='_blank'>
            " . $value["descricao"] . "</a>";
            }
            ?>
            <br>

            <?php

            if ($statusCod == "1") {
                echo "<h4>DISPONIBILIZAR ORÇAMENTO</h4><hr>";
                if (!$isLogged) {
                    echo "<h5>Faça login em uma conta privada para poder disponibilizar o seu orçamento!</h5>";
                } else {
                    $codDisponibilidade = checkaDisponibilidade($cnpj, $enderecoEntrega, $distancia, $cod);
                    switch ($codDisponibilidade) {
                        case 0:
                            echo "<h5>Sua empresa não atende a nenhum segmento de produto especificado nesse pedido!</h5>";
                            break;
                        case 1:
                            echo "<h5>Sua empresa está muito distante do endereço!</h5>";
                            echo "<p>O raio de distância máximo definido para disponibilização desses orçamentos foi de $distancia km. Sua empresa está à " . $_SESSION['raio'] . "
                            de distância, exarcebando tal medida.</p>";
                            unset($_SESSION["raio"]);
                            break;
                        case 2:
                            //vê se já tem orçamento dessa empresa
                            $codOrcamento = checaOrcamento($cnpj, $cod);
                            switch ($codOrcamento) {
                                case 0:
                                    echo "<p><a href='adicionarCotacao.php?cod=$cod'>Clique aqui para inserir o seu orçamento</a></p>";
                                    break;
                                case 1:
                                    echo "<p><a href='alterarCotacao.php?cod=" . $_SESSION['codCotacao'] . "'>Cique aqui para alterar o orçamento já enviado</a></p>";
                                    break;
                            }

                            break;
                    }
                }
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
