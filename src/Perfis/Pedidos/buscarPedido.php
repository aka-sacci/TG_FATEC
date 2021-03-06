<?php

require_once "../../../vendor/autoload.php";
include_once "../../scripts/validaLogin.php";
validarLogin("PUB");


?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Banco de preços</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="../../Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="../../scripts/utils/style.css">
        <!-- Lista de Icones Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- jQuery e Bootstrap JS -->
        <script type="text/javascript" src="../../scripts/utils/scriptsBasicos.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>

    <body class="login"><br>
        <a class="home" href="#" onclick="goBack()">
            <i class="fa fa-arrow-circle-left"> Voltar</i>
        </a>
        <div class="text-center loginphp"><br><br>
            <main class="form-signin">
                <form action="buscarPedidoAction.php" method="get"> 
                    <a href="../../../index.php"><img class="mb-4" src="../../Imagens/Logo-Licita.png" alt="" width="72" height="71"></a>
                    <h4 class="mb-3 fw-normal">Banco de preços</h4>
                    <p>Busque por produtos, instituições, pedidos, etc.</p>
                    <div class="form-floating">
                        <input type="text" name="buscaTXT" class="form-control" placeholder="Pesquisar por..." required>
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
