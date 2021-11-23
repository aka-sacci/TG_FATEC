<?php

    require_once "../../../../../vendor/autoload.php";
    include_once "../../../../scripts/validaLogin.php";
    validarLogin("PRI");
    $connection  = require "../../../../scripts/connectionClass.php";
    $codDoc = $_GET["cod"];
    $myCnpj = $_SESSION["cnpj"];
    $validate = false;

    $sql = "select data_upload, descricao, descricao_doc from documento_empresa_privada
    INNER JOIN documento_tipo ON 
    documento_empresa_privada.tipo = documento_tipo.cod
    WHERE cnpj = $myCnpj AND documento_empresa_privada.cod = $codDoc";
    foreach ($connection->query($sql) as $key => $value) {
        $validate = true;
        $dataUpload = $value["data_upload"];
        $descricao = $value["descricao"];
        $descDoc = $value['descricao_doc'];
    }

    if (!$validate) {
        header("location:../");
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Atualizar Documentos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="../../../../Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="../../../../scripts/utils/style.css">
        <!-- Lista de icones -->
        <link  rel="stylesheet" href="../../../../scripts/utils/fontawesome/css/all.css">
        <!-- skin -->
        <link rel="stylesheet" href="../../../../scripts/utils/default.css">
        <!-- jQuery e Bootstrap JS -->
        <script type="text/javascript" src="../../../../scripts/utils/scriptsBasicos.js"></script>
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
                <img src="../../../../Imagens/logo-LT.png" alt="alternative" width=80 height=80>
            </div>
            <br> 
            <h3><B>ATUALIZAR DOCUMENTO: <?php echo  $descricao;?></B></h3><hr>
                <form action="alterarDocumentoAction.php" method="post" enctype="multipart/form-data"> 
                    <?php
                        echo "<p><a href='../../../../scripts/abrirArquivoPDF.php?filename=" . $codDoc .  ".pdf&dir=Documentos/&titulo=" . $descricao . " - $myCnpj'  target='_blank'>Ver documento ($descDoc)
                        </a></p>";
                        echo "<p><input type='text' value='$codDoc' name='codDoc' required hidden/></p>"
                    ?>
                    <p><input class="form-control-input anexo" type="file" name="file" accept=".pdf" required></p>
                    <br><p><input type='submit' value="Atualizar" id="btnSubmit" class="btn btn-md buttoncad"/></p>
                </form> 
            <br><br><br><br><br>
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
