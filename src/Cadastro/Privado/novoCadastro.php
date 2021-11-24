<?php

  require_once "../../../vendor/autoload.php";
session_start();
if (isset($_SESSION['login'])) {
    $_SESSION['erroReportado'] = "Não é possível criar uma conta já estando logado!";
    header("location:../config/erroReportado.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Cadastro Privado</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="../../Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="../../scripts/utils/style.css">
        <!-- Lista de Icones Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- jQuery e Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>

    <body class="login">
        </br>
        <a class="home" href="../../../index.php">
            <i class="fa fa-home"> Início</i>
        </a>
        <div class="text-center loginphp cadastrophp">
            <main class="form-signin">
                <form action="../config/novoCadastroAction.php" method="get"> 
                    <a href="../../../index.php"><img class="mb-4" src="../../Imagens/Logo-Licita.png" alt="" width="72" height="71"></a>
                    <h4 class="mb-3 fw-normal">Para começar, digite seu CNPJ aqui!</h4>
                    <div class="form-floating">
                        <input type="text" name="txtCNPJ" class="form-control" placeholder="Seu CNPJ" onkeypress="$(this).mask('00.000.000/0000-00')" required>
                    </div></br>
                    <div class="form-floating">
                        <input name="typeCNPJ" type="hidden" value="PRI">
                    </div>
                    <p><input type="submit" class="w-100 btn btn-lg btn-primary" value="Buscar" id="btnSubmit"/></p>
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
