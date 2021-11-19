<?php
require_once "../../../vendor/autoload.php";
include_once "../../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require '../../scripts/connectionClass.php';
require_once "checarDisponibilidade.php";

//variáveis globais
$cod = $_GET['cod'];
$cnpj = $_SESSION['cnpj'];
$arrayItens = array();

$sqlConsulta = "select endereco_entrega, distancia from pedido where cod=$cod";
foreach ($connection->query($sqlConsulta) as $key => $value) {
        $enderecoEntrega = $value["endereco_entrega"];
        $distancia = $value["distancia"];
}

$codDisponibilidade = checkaDisponibilidade($cnpj, $enderecoEntrega, $distancia, $cod);
switch ($codDisponibilidade) {
    case 0:
        header("Location: /TG_FATEC");
        break;
    case 1:
        unset($_SESSION["raio"]);
        header("Location: /TG_FATEC");
        break;
};


$sqlConsulta = "select item_pedido.cod, item_pedido.item, titulo from pedido 
inner JOIN item_pedido ON pedido.cod = item_pedido.pedido_cod
WHERE pedido.cod = $cod";
foreach ($connection->query($sqlConsulta) as $key => $value) {
    $titulo = $value['titulo'];
    $thisArrayItens = array("cod" => $value["cod"], "item" => $value["item"]);
    array_push($arrayItens, $thisArrayItens);
}
echo "<script>sessionStorage.setItem('qtdeItens', '" . count($arrayItens) . "');</script>";
echo "<script>sessionStorage.setItem('itens', '" . json_encode($arrayItens) . "');</script>";



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
        <script type="text/javascript" src="itensActions.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>
    
    <body onload="loadCriarOrcamento()">
        <!-- Botao de Retorno -->
        </br>
        <a class="home" href="#" onclick="goBack()">
            <i class="fa fa-arrow-circle-left">Voltar</i>
        </a>

        <!-- Corpo da Página -->
        <div class="container" id="container-corpoindex">
        <div style="width:50%; display: inline-block;"><H3><b>INFORMAÇÕES DO PEDIDO</b></H3></div>
            <hr>
        
                <p><b>PEDIDO N°: </b>#<?php echo $cod; ?></p>
                <!-- TÍTULOS & ETC -->
                <h3><b><?php echo $titulo; ?></b></h3><br>
                <form action="adicionarCotacaoAction.php" method="post" onsubmit="avancar()" enctype="multipart/form-data">
                <h3>Itens</h3>

                <table class="table table-bordered divItens" id="divItens">
                  <tbody>
                  <tr class="p1" id="p1">
                <td><select id="selectItem1" name="selectItem1">
                <?php
                foreach ($arrayItens as $key => $value) {
            echo "<option value='" . $value["cod"] . "'>" . $value["item"] . "</option>";
                }
                ?>
                </select></td>
                <td align="center"><textarea placeholder="MODELO & DESCRIÇÃO" id="txtDesc1" name="txtDesc1" rows="7" cols="60" required ></textarea></td>
                <td align="right"><input type="text" placeholder="Valor (R$)" maxlength="50" id="txtValue1" name="txtValue1" required></td>
                    </tr>
                  </tbody>
                </table>

    <p><button onclick="adicionarItem()" type="button" id="addItem">Adicionar mais um item</button>
        <button onclick="deleteRow()" type="button" id="removeItem" disabled>Remover último item</button></p>
    <br>
    <input type="text" id="txtQtdeItens" name="txtQtdeItens" value="1" required hidden>
    <input type="text" id="txtCodPedido" name="txtCodPedido" <?php echo "value=$cod" ?> required hidden>
    <div style="width:50%; display: inline-block;">
    <p>Adicionar arquivo (Catálogos, Atas, etc) (Não-obrigatório):
        <br><input type="file" name="file" accept=".pdf" ></p>

        <p>Descrição do arquivo:
        <br><input type="text" name="txtDesc" ></p>
    </div>
    <div style="width: 50%; text-align: left; float:right;">
    <p>Observações (Não-obrigatório)</p>
        <p><textarea placeholder="" id="txtObservacoes" name="txtObservacoes" rows="4" cols="50" ></textarea></p>
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
