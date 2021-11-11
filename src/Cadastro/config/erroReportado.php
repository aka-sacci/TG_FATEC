<?php
    require_once "../../../vendor/autoload.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>LicitaTudo - Erro</title>
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
    </head>

    <script>
        function goBack() {
        window.history.back()
        }
    </script>

    <body>
        <!-- Container Corpo do Index / Alert Login -->
        <div class="container py-4" id="container-corpoindex">
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></br>
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="alert-heading">Essa ação não pode ser concluída!</h4>
                <p>                   
                    <?php
                        echo "<p>ERRO: " . $_SESSION['erroReportado'] . "</p>";
                    ?>                   
                </p>
            </div></br>          
            <button class="btn btn-md buttoncad" onclick="goBack()">Voltar</button>
        </div>
    </br>      
        <!-- footer da página -->
        <div class="container center col-md-3 footer">
            <p class="text-muted">&copy; Licitatudo  2020 – 2021</p>
        </div>
    </body>
</html>
