<?php
  require_once "../../../vendor/autoload.php";
  session_start();
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>LicitaTudo - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="../../Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="../../scripts/utils/style.css">
        <!-- Lista de icones -->
        <link  rel="stylesheet" href="../../scripts/utils/fontawesome/css/all.css">
        <!-- skin -->
        <link rel="stylesheet" href="../../scripts/utils/default.css">
        <!-- jQuery e Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
        <script type="text/javascript" src="../../scripts/utils/scriptsBasicos.js"></script>
    </head>

    <body>
        <br>
        <a class="home" href="../">
            <i class="fa fa-arrow-circle-left"> Voltar</i>
        </a>
        <div class="container col-lg-6" id="container-corpoindex">
            <div class="img centro">
                <img src="../../Imagens/logo-LT.png" alt="alternative" width=80 height=80>
            </div><br>
            <h3><b>CRIAR LOGIN</b></h3><hr><br>

            <!-- Formulário com as informações carregadas -->
                <form action="registrarCadastro.php" method="post"> 

                    <?php
                        echo '<p><b>Email: </b><input class="form-control-input" name="txtEmail" readonly value=' . $_SESSION["cadEmail"] . '></p>';
                    ?>     

                <p><b>Senha: </b><input oninput="validarSenha('txtSenha', 'txtSenhaConfirmar')" name="txtSenha" type="password" id="txtSenha" class="form-control-input" required></p>
                <p><b>Confirmar Senha: </b><input oninput="validarSenha('txtSenha', 'txtSenhaConfirmar')" name="txtSenhaConfirmar" id="txtSenhaConfirmar" type="password" class="form-control-input" required></p>
                <p id="txtConfirmacao"></p><br>
                <p><input class="btn btn-md btn-primary" type='submit' value="Prosseguir" id="btnSubmit" disabled/></p>
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
