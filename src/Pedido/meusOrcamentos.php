<?php

    require_once "../../vendor/autoload.php";
    include_once "../scripts/validaLogin.php";
    validarLogin("PRI");
    $connection  = require '../scripts/connectionClass.php';
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    $cnpj = $_SESSION["cnpj"];
    $sql = "select pedido.cod, titulo, data_abertura, data_fechamento,
    modo_pedido.modo, status_pedido.status, last_update
    from pedido
    INNER JOIN modo_pedido ON pedido.modo = modo_pedido.cod
    INNER JOIN status_pedido ON pedido.status = status_pedido.cod
    INNER JOIN cotacoes ON pedido.cod = cotacoes.pedido
    where empresa = '$cnpj' order by last_update DESC";
    $dados = $connection->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Meus Orçamentos</title>
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
        <div class="container col-lg-7" id="container-corpoindex">
            <H3><b>MEUS ORÇAMENTOS</b></H3><hr>
            <p>Veja aqui os últimos pedidos que sua empresa forneceu orçamentos.<br>
            <b>* Para ver informações detalhas de um pedido clique em cima do seu nome.</b></p><br>
                <?php
                foreach ($dados as $key => $value) {
                    $dataAberturaToTime = strtotime($value['data_abertura']);
                    $dataCotacaoToTime = strtotime($value['last_update']);
                    $dataAbertura = strftime('%d/%m/%Y', $dataAberturaToTime);
                    $horaAbertura = strftime('%H:%M', $dataAberturaToTime);
                    $dataCotacao = strftime('%d/%m/%Y', $dataCotacaoToTime);
                    $horaCotacao = strftime('%H:%M', $dataCotacaoToTime);

                    echo'<div>
                        <a href="../Perfis/Pedidos/visualizarPedido.php?cod=' . $value['cod'] . '"><h4>' . $value['titulo'] . '</h4></a>
                        <p>Pedido aberto no dia ' . $dataAbertura . ' às ' . $horaAbertura . '.</p>
                        <p>Cotação disponibilizada no dia ' . $dataCotacao . ' às ' . $horaCotacao . '.</p>
                        </div><br>';
                }

                ?>

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
