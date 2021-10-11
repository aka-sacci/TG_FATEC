<?php
require_once "../../../vendor/autoload.php";
session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['type'] == "PUB") {
        header("location:index.php");
    } else {
        $_SESSION['erroReportado'] = "Não é possível logar numa conta pública estando logado em uma conta de empresa privada!";
        header("location:../config/erroReportado.php");
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Login Instituição Pública</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="../../Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="../../scripts/utils/style.css">
        <!-- Lista de Icones Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- jQuery e Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>

    <body class="login">
        </br>
        <a class="home" href="../../../index.php">
        <i class="fa fa-home"> Home</i>
        </a>
        <div class="text-center loginphp">
            <main class="form-signin">
                <form action="../config/loginAction.php" method="post"> 
                    <a href="../../../index.php"><img class="mb-4" src="../../Imagens/Logo-Licita.png" alt="" width="72" height="71"></a>
                    <h4 class="mb-3 fw-normal">Login - Instituição Pública</h4>
                    <div class="form-floating">
                        <input type="email" name="txtEmail" class="form-control" placeholder="nome01@exemplo.com" required>
                    </div></br>
                    <div class="form-floating">
                        <input type="password" name="txtSenha" class="form-control" id="txtSenha" placeholder="senha" required>          
                    </div>
                    <div class="form-floating">
                        <input type="hidden" name="typeCNPJ" value="PUB">
                    <div></br>
                    <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Lembrar de mim
                    </label>
                    </div>
                    <div class="form-floating">
                        <input name="typeCNPJ" type="hidden" value="PRI">
                            <?php
                            if (isset($_SESSION['statusLogin'])) {
                                echo($_SESSION['statusLogin']);
                                unset($_SESSION['statusLogin']);
                            }
                            ?>
                    </div></br>
                    <p><input type="submit" class="w-100 btn btn-lg btn-primary" value="Prosseguir" id="btnSubmit"/></p>
                    <p class="mt-5 mb-3 text-muted">&copy;Licitatudo  2020 – 2021</p>
                </form> 
            </main>
        </div>    
    </body>
</html>
