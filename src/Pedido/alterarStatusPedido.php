<?php

    require_once "../../vendor/autoload.php";
    include_once "../scripts/validaLogin.php";
    validarLogin("PUB");
    $connection  = require '../scripts/connectionClass.php';
    $codDoc = $_GET["cod"];
    $alteracao = $_GET["alteracao"];
    $cnpj = $_SESSION["cnpj"];
    $validate = false;
    $action = "";

    $sql = "SELECT * FROM pedido
    WHERE cnpj = $cnpj AND cod = $codDoc";
    foreach ($connection->query($sql) as $key => $value) {
        $validate = true;
    }

    if (!$validate) {
        header("location:visualisarMeuPedido.php?cod=$codDoc");
    }

    if ($alteracao == "2") {
        $validate = "Finalizar Pedido n°#" . $codDoc;
    }
    if ($alteracao == "3") {
        $validate = "Cancelar Pedido n°#" . $codDoc;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Confirmar Alteração</title>
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

    <body>
        </br>
        <a class="home" href="#" onclick="goBack()">
            <i class="fa fa-arrow-circle-left"> Voltar</i>
        </a>
        <div class="container col-lg-6" id="container-corpoindex">
            <div class="img centro">
                <img src="../Imagens/logo-LT.png" alt="alternative" width=80 height=80>
            </div>
            <br> 
            <h3>CANCELAR PEDIDO</h3><hr><br>    
                <form action="alterarStatusPedidoAction.php" method="post"> 
                    <p><b><?php echo $validate ?></b></p>
                        <?php
                            echo "<input class='form-control-input' name='txtCod' hidden value='$codDoc' required>";
                            echo "<input class='form-control-input' name='txtStatus' hidden value='$alteracao' required>";
                        ?>
                    <p><b>Para confirmar a alteração no pedido, digite sua senha</b></p><input class='form-control-input' name="txtSenha" type="password" required>
                    <br><br><p><input class="btn btn-md buttoncad" type='submit' value="Confirmar" id="btnSubmit"/></p>
                </form>
            <br><br><br>
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
