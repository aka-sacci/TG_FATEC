<?php

require_once "../../vendor/autoload.php";
include_once "../scripts/validaLogin.php";
validarLogin("PRI");
$connection  = require "../scripts/connectionClass.php";
$cnpj = $_SESSION['cnpj'];
$arrayCategoria = array();

$dadosSelectSQL = "SELECT categoria.cod, categoria.categoria FROM categoria_empresa_privada
INNER JOIN categoria
ON categoria_empresa_privada.categoria = categoria.cod
WHERE cnpj=$cnpj";
foreach ($connection->query($dadosSelectSQL) as $key => $value) {
    $thisCategoria = array("cod" => $value["cod"], "categoria" => $value["categoria"]);
    array_push($arrayCategoria, $thisCategoria);
}
echo "<script>sessionStorage.setItem('categorias', '" . json_encode($arrayCategoria) . "');</script>";
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Buscar pedidos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="../Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="../scripts/utils/style.css">
        <!-- Lista de Icones Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- jQuery e Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script type="text/javascript" src="scripts/buscarPedidosActions.js" ></script>

    </head>

    <body class="login">
        </br>
        <a class="home" href="/TG_FATEC">
            <i class="fa fa-home"> Início</i>
        </a>
        <div class="text-center loginphp"><br><br>
            <main class="form-signin">
                <form action="buscarPedidoAction.php" method="get" onsubmit="cleanStorage()"> 
                    <a href="../../index.php"><img class="mb-4" src="../Imagens/Logo-Licita.png" alt="" width="72" height="71"></a>
                    <h4 class="mb-3 fw-normal">Buscar pedidos</h4>
                    <div class="custom-control custom-switch">
                    <p>Busque por termos relacionados a um pedido <b>ou</b> ... 
                    <input type="checkbox" class="custom-control-input" id="swCategoria"  onchange="onchangeListener(this.checked)">
                    <label class="custom-control-label" for="swCategoria">Por categoria do pedido.</label>
                    </p>
                    </div>
                    <div class="form-floating">
                        <input type="text" name="buscaTXT" id="buscaTXT" class="form-control" placeholder="Pesquisar por..." required>
                    </div></br>
                    <p><input type="submit" class="w-100 btn btn-lg btn-primary" value="Prosseguir" id="btnSubmit"/></p>
                </form> 
            </main> 
        </div>
        <hr class="featurette-divider">
        <!-- footer da página -->
        <footer>
            <div class="container centro col-md-12">
                <p class="text-muted">Copyright &copy; Licitatudo 2021 - Todos os direitos reservados</p>
            </div> 
        </footer>    
    </body>
</html>
