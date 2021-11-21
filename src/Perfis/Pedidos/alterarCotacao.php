<?php
require_once "../../../vendor/autoload.php";
include_once "../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require '../../scripts/connectionClass.php';

//variáveis globais
$cod = $_GET['cod'];
$cnpj = $_SESSION['cnpj'];
$arrayItens = array();
$validate = false;
$counItens = 1;
$temAnexos = false;
$descAnexo = "";

$sqlValidaCotacao = "SELECT * FROM cotacoes WHERE empresa = $cnpj AND cod = $cod";
foreach ($connection->query($sqlValidaCotacao) as $key => $value) {
        $pedido = $value["pedido"];
        $validate = true;
        $observacao = $value["observacao"];
}

if (!$validate) {
    header("Location: /TG_FATEC");
}


$sqlConsulta = "select item_pedido.cod, item_pedido.item, titulo from pedido 
inner JOIN item_pedido ON pedido.cod = item_pedido.pedido_cod
WHERE pedido.cod = $pedido";
foreach ($connection->query($sqlConsulta) as $key => $value) {
    $titulo = $value['titulo'];
    $thisArrayItens = array("cod" => $value["cod"], "item" => $value["item"]);
    array_push($arrayItens, $thisArrayItens);
}
echo "<script>sessionStorage.setItem('qtdeItens', '" . count($arrayItens) . "');</script>";
echo "<script>sessionStorage.setItem('itens', '" . json_encode($arrayItens) . "');</script>";


$sqlItemsAlteraveis = "select item_pedido.cod, item_pedido.item, cotacoes_itens.descricao_modelo, valor_un 
from item_pedido
INNER JOIN cotacoes_itens ON item_pedido.cod = cotacoes_itens.item_ref
WHERE cotacoes_itens.cotacao = $cod order by cotacoes_itens.cod DESC";
$meusItensOrcamento = "";
foreach ($connection->query($sqlItemsAlteraveis) as $key => $value) {
    $meusItensOrcamento .= "<tr class='r$counItens' id='r$counItens'>";
    $meusItensOrcamento .= "<td><select id='selectItem$counItens' name='selectItem$counItens' disabled>";
    $meusItensOrcamento .= "<option value='" . $value["cod"] . "'>" . $value["item"] . "</option>";
    $meusItensOrcamento .= "</select></td>";
    $meusItensOrcamento .= "<td align='center'><textarea placeholder='MODELO & DESCRIÇÃO' id='txtDesc$counItens' name='txtDesc$counItens' rows='7' cols='60' required >";
    $meusItensOrcamento .= $value["descricao_modelo"] . "</textarea></td>";
    $meusItensOrcamento .= "<td align='right'><input type='text' placeholder='Valor (R$)' maxlength='50' id='txtValue$counItens' name='txtValue$counItens' ";
    $meusItensOrcamento .= "value='" . $value["valor_un"] . "' required></td>";
    $meusItensOrcamento .= " </tr>";
    $counItens++;
}
$counItens--;


$sqlAnexos = "Select cod, descricao from anexos_cotacoes where cotacao = $cod";
foreach ($connection->query($sqlAnexos) as $key => $value) {
    $temAnexos = true;
    $codAnexo = $value["cod"];
    $descAnexo = $value["descricao"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>LicitaTudo - Alterar minha cotação</title>
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
        <script type="text/javascript" src="itensActions.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>
    
    <body onload="loadCriarOrcamento(<?php echo $counItens ?>)">
        <!-- Botao de Retorno -->
        </br>
        <a class="home" href="#" onclick="goBack()">
            <i class="fa fa-arrow-circle-left">Voltar</i>
        </a>

        <!-- Corpo da Página -->
        <div class="container" id="container-corpoindex">
        <div style="width:50%; display: inline-block;"><H3><b>INFORMAÇÕES DA COTAÇÃO</b></H3></div>
            <hr>
        
                <p>PEDIDO <b>N° #<?php echo $pedido; ?></b>, COTAÇÃO <b>N°#<?php echo $cod; ?> </b></p>
                <!-- TÍTULOS & ETC -->
                <h3><b><?php echo $titulo; ?></b></h3><br>
                <form action="alterarCotacaoAction.php" method="post" onsubmit="avancar()" enctype="multipart/form-data">
                <h3>Itens</h3>

                <table class="table table-bordered divItens" id="divItens">
                  <tbody>

                  <?php
                    echo $meusItensOrcamento;
                    ?>
                  </tbody>
                </table>

    <p><button onclick="adicionarItem()" type="button" id="addItem">Adicionar mais um item</button>
        <button onclick="deleteRow()" type="button" id="removeItem">Remover último item</button></p>
    <br>
    <input type="text" id="txtQtdeItens" name="txtQtdeItens" value="<?php echo $counItens?>" required hidden>
    <input type="text" id="txtCodPedido" name="txtCodCot" <?php echo "value=$cod" ?> required hidden>

    <div style="width:50%; display: inline-block;">
    <?php
    if ($temAnexos) {
        echo '<p><a href="../../scripts/abrirArquivoPDF.php?filename=ANEXO' . $codAnexo .  '.pdf&dir=Pedidos/Anexos/AnexosCotacoes/&titulo=Anexo' . $descAnexo . '" target="_blank">ANEXO ATUAL</a></p>';
        echo "<input type='text' id='txtTemArquivo' name='txtTemArquivo' value='$codAnexo' required hidden>";
    } else {
        echo "<input type='text' id='txtTemArquivo' name='txtTemArquivo' value='naoexiste' required hidden>        ";
    }
    ?>
    <p>Alterar anexo:
        <br><input type="file" name="file" accept=".pdf" ></p>

        <p>Descrição do arquivo: 
        <br><input type="text" name="txtDesc" <?php echo "value='" . $descAnexo . "'" ?></p>
    </div>
    <div style="width: 50%; text-align: left; float:right;">
    <p>Observações (Não-obrigatório)</p>
        <p><textarea placeholder="" id="txtObservacoes" name="txtObservacoes" rows="4" cols="50" ><?php echo $observacao ?></textarea></p>
    </div>
    <br><br>
    <input type="submit" value="Continuar">
                </form>

            <!-- footer da página --></br></br></br>
            <footer>
                <div class="container center col-md-3">
                <p class="text-muted">&copy; Licitatudo  2020 – 2021</p>
                </div>
            </footer>
        </div>
    </body>
</html>
