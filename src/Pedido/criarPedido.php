<?php

    require_once "../../vendor/autoload.php";
    include_once "../scripts/validaLogin.php";

    validarLogin("PUB");
    $connection  = require '../scripts/connectionClass.php';
    $arrayCategoria = array();
    $arrayModo = array();
    $arrayEnderecos = array();
    $cnpj = $_SESSION["cnpj"];
    //dados das caixas de seleção
    //categoria
    $sql = "select * from categoria order by categoria";
foreach ($connection->query($sql) as $key => $value) {
    $thisCategoria = array("cod" => $value["cod"], "categoria" => $value["categoria"]);
    array_push($arrayCategoria, $thisCategoria);
}
    //modo
    $sql = "select * from modo_pedido order by modo";
foreach ($connection->query($sql) as $key => $value) {
    $thisModo = array("cod" => $value["cod"], "modo" => $value["modo"]);
    array_push($arrayModo, $thisModo);
}
    //enderecos
    $sql = "select * from endereco_instituicao_publica where cnpj=$cnpj order by cod ASC";
foreach ($connection->query($sql) as $key => $value) {
    if (!$value["descricao"]) {
        $value["descricao"] = "MATRIZ";
    }
    $thisEndereco = array("cod" => $value["cod"], "descricao" => $value["descricao"]);
    array_push($arrayEnderecos, $thisEndereco);
}
    echo "<script>sessionStorage.setItem('categorias', '" . json_encode($arrayCategoria) . "');</script>";

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Novo Pedido</title>
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
        <!-- jQuery, JS e Bootstrap JS -->
        <script type="text/javascript" src="../scripts/utils/scriptsBasicos.js"></script>
        <script type="text/javascript" src="scripts/itensActions.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>

    <body onload="loadCriarPedido()">
        </br>
        <a class="home" href="#" onclick="goBack()">
            <i class="fa fa-arrow-circle-left"> Voltar</i>
        </a>
        <div class="container col-lg-6" id="container-corpoindex">
                <H4><b>INFORMAÇÕES BÁSICAS</b></H4><hr>
                <form action="criarPedidoAction.php" method="post" onsubmit="avancar()">
                    <!--    início informações básicas do pedido -->
                    <input type="text" placeholder="Título" maxlength="50" id="txtTituloPedido" name="txtTituloPedido" class="form-control-input" required><br>
                    <textarea placeholder="Descrição" maxlength="250" id="txtDescricaoPedido" name="txtDescricaoPedido" class="form-control-textarea" required></textarea>
                    <br>
                    <!--    fim informações básicas do pedido -->
                    
                    <!--    início selecionar categoria -->
                    <br><H4><b>CATEGORIAS</b></H4><hr>
                    <div class="divSelects" id="divSelects">
                        <select name="selectCategorias1" id="selectCategorias1" style="margin-right: 0.45rem; margin-bottom: 0.45rem">
                            <?php
                            foreach ($arrayCategoria as $key => $registro) {
                                echo "<option value='" . $registro['cod'] . "'>" . $registro['categoria']  . "</option> ";
                            }
                            ?>
                        </select>
                    </div><br>
                        <p><button onclick="adicionarCategoria()" type="button" id="btnAdicionarCategoria" class="btn btn-outline-success">Adicionar categoria</button>
                        <button onclick="deleteCategoria()" type="button" id="btnRemoverCategoria" class="btn btn-outline-danger" disabled>Remover categoria</button></p>
                        <br>                    
                    <!--    fim selecionar categoria -->

                    <!--    início itens -->
                    <br><H4><b>ITENS</b></H4><hr>
                    <div class="divItens">
                        <p class="p1" id="p1">
                        <input type="text" placeholder="Título do Item #1" maxlength="100" id="txtItem1" name="txtItem1" class="form-control-input" required><br>
                        <textarea placeholder="Descrição detalhada do item #1" id="txtDesc1" name="txtDesc1" class="form-control-textarea" required></textarea><br>
                        <input type="number" placeholder="Quantidade" id="txtQtde1" name="txtQtde1" value="1"  required>
                        <select id="selectQtde1" name="selectQtde1">
                            <option value="un">Unidade</option>
                            <option value="mt">Metro</option>
                            <option value="lt">Litro</option>
                        </select>
                        </p>
                    </div><br>
                        <p><button onclick="adicionarItem()" type="button" id="addItem" class="btn btn-outline-success">Adicionar item</button>
                        <button onclick="deletarItem()" type="button" id="removeItem" class="btn btn-outline-danger" disabled>Remover item</button></p>
                        <br>
                    <!--    fim itens -->

                    <!-- início endereco -->
                    <div>
                        <br><H4><b>ENDEREÇO DE ENTREGA</b></H4><hr>
                        <select name="selectEndereco" >
                            <?php
                            foreach ($arrayEnderecos as $key => $registro) {
                                echo "<option value='" . $registro['cod'] . "'>" . $registro['descricao']  . "</option> ";
                            }
                            ?>
                        </select>
                    </div>
                    <br><br><br>
                    <!-- fim endereco -->

                    <!--    início modo -->
                    <H4><b>DADOS COMPLEMENTÁRES</b></H4><hr>
                    <p>Modo do pedido:
                    <select name="selectModoPedido">
                        <?php
                        foreach ($arrayModo as $key => $registro) {
                            echo "<option value='" . $registro['cod'] . "'>" . $registro['modo']  . "</option> ";
                        }
                        ?>
                    </select></p>
                    <!--    fim modo -->

                    <!--    início distância -->
                    <p>Limitar distância máxima das empresas? <input type="checkbox" onclick="enableDistancia()" name="cbDistancia" class="cbDistancia" ></p>
                    <p><input type="number" name="txtDistancia" placeholder="Distância (KM)" class="txtDistancia" required></p>
                    <!--    fim distância -->

                    <br><button type="submit" class="btn btn-md buttoncad">Criar Pedido</button>
                </form>
                           
            <hr class="featurette-divider">
            <!-- footer da página -->
            <footer>
                <div class="container centro col-md-12">
                    <p class="text-muted">Copyright &copy; Licitatudo 2021 - Todos os direitos reservados</p>
                </div> 
            </footer>
        </div>
    </body>
</html>
