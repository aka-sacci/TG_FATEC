<?php
    require_once "../../../../../vendor/autoload.php";
    include_once "../../../../scripts/validaLogin.php";
    validarLogin("PRI");
    $connection  = require "../../../../scripts/connectionClass.php";
    $codEndereco = $_GET["cod"];
    $cnpj = $_SESSION["cnpj"];
    $validate = false;

    $sql = "select * from endereco_empresa_privada where cod = $codEndereco and cnpj = $cnpj";
foreach ($connection->query($sql) as $key => $value) {
    $validate = true;
    $logradouro = $value["logradouro"];
    $numero = $value["numero"];
    $bairro = $value["bairro"];
    $cidade = $value["cidade"];
    $uf = $value["uf"];
    $descricao = $value["descricao"];
}

if (!$validate) {
    header("location:../");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Excluir Endereço</title>
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
        <!-- jQuery, JS e Bootstrap JS -->
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
            </div><br>
                <h3><b>EXCLUIR O ENDEREÇO</b></h3><hr><br>
                <form action="excluirEnderecoAction.php" method="post">

                        <?php
                            echo "<p>" . $logradouro . ", " . $numero . ", " . $bairro . " - " .  $cidade . " (" . $uf . ") </p>";
                            echo "<p>Descrição: " . $descricao . ". </p>";
                            echo "<input class='form-control-input' name='txtCod' hidden value='$codEndereco' required>";
                        ?>

                    <p><b>Para confirmar a exclusão do endereço acima, digite sua senha.</b></p><input class='form-control-input' name="txtSenha" type="password" required>
                    </br></br><button type='submit' value="Confirmar" id="btnSubmit" class="btn btn-md buttoncad" >Confirmar Exclusão</button></br>             
                </form></br></br> 
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
