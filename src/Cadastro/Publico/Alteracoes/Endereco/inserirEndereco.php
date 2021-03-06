<?php

    require_once "../../../../../vendor/autoload.php";
    include_once "../../../../scripts/validaLogin.php";
    validarLogin("PUB");
    $connection  = require "../../../../scripts/connectionClass.php";

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Inserir novo Endereço</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="../../../../Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="../../../../scripts/utils/style.css">
        <link rel="stylesheet" href="../../../../scripts/utils/formataNumber.css">
        <!-- Lista de icones -->
        <link  rel="stylesheet" href="../../../../scripts/utils/fontawesome/css/all.css">
        <!-- skin -->
        <link rel="stylesheet" href="../../../../scripts/utils/default.css">
        <!-- jQuery, JS e Bootstrap JS -->
        <script type="text/javascript" src="../../../../scripts/utils/scriptsBasicos.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>

    <body>
    </br>
        <a class="home" href="#" onclick="goBack()">
            <i class="fa fa-arrow-circle-left"> Voltar</i>
        </a>
        <div class="container col-lg-6" id="container-corpoindex">
            <div class="img centro">
                <img src="../../../../Imagens/logo-LT.png" alt="alternative" width=80 height=80>
            </div><br>
                <h3><b>INSERIR NOVO ENDEREÇO</b></h3><hr><br>
                <form action="inserirEnderecoAction.php" method="post" onsubmit=''> 
                    <p><input placeholder="Logradouro" class='form-control-input' name="txtLogradouro" required></p><br>
                    <p><input placeholder="Número" class='form-control-input' name="txtNumero" required></p><br>
                    <p><input placeholder="Bairro" class='form-control-input' name="txtBairro" required></p><br>
                    <p><input placeholder="CEP" class='form-control-input' name="txtCEP" id="txtCEP" onkeypress="$(this).mask('00.000-000')" required></p><br>
                    <p><input placeholder="Cidade" class='form-control-input' name="txtCidade" required></p><br>
                    <p><input placeholder="UF" class='form-control-input' name="txtUF" maxlength='2' required></p><br>
                    <p><textarea class='form-control-textarea' placeholder="Descrição do endereço" name="txtDescricao" required></textarea></p><br>
                    <p><input type='submit' value="Prosseguir" id="btnSubmit" class="btn btn-md buttoncad" onclick=""/></p>
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
