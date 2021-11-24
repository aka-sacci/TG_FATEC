<?php
  session_start();
  require_once "../../../vendor/autoload.php";
  require_once '../../scripts/utils/converterPontuacaoCNPJ.php';
  require_once '../../scripts/utils/converterPontuacaoCEP.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
      <meta charset="utf-8">
      <title>Cadastro - Público</title>
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
      <script type="text/javascript" src="../../scripts/utils/scriptsBasicos.js"></script>
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </head>
  <body>
      </br>
          <a class="home" href="#" onclick="goBack()">
              <i class="fa fa-arrow-circle-left"> Voltar</i>
          </a>
        
    <!-- Container Corpo da Pagina -->   
    <div class="container py-4" id="container-corpoindex">
        <div class="container">
            <div class="img centro">
                <img src="../../Imagens/logo-LT.png" alt="alternative" width=80 height=80>
            </div><br>
                <h3><b>CONFIRME OS DADOS - INFORMAÇÕES GERAIS</b></h3><hr><br>
      <!-- Formulário com as informações carregadas -->
      <form action="../config/confirmarCadastroAction.php" method="post"> 
    
          <?php
              echo '<p><b>CNPJ: </b>' .  converterCNPJ($_SESSION['cadCNPJ']) . '</p>';
              echo '<p><b>Razão Social: </b>' . $_SESSION['cadRazaoSocial'] . '</p>';
              echo '<p><b>Nome Fantasia: </b>' . $_SESSION['cadNomeFantasia'] . '</p>';
              echo '<p><b>Ente Federativo Responsável (EFR): </b>' . $_SESSION['cadEFR'] . '</p>';
              echo '<p><b>Natureza Jurídica: </b>' . $_SESSION['cadNatureza'] . '</p>';
              echo '<p><b>Endereço: </b>' . $_SESSION['cadLog'] . ', ' . $_SESSION['cadNumero'] . ' - ' . $_SESSION['cadBairro'] . ' (' . converterCEP($_SESSION['cadCEP']) . ') - ' . $_SESSION['cadCidade'] . ', ' . $_SESSION['cadUF'] . '</p>';
            ?>

          <hr>
          <H5><b>INFORMAÇÕES PARA CONTATO</b></H5>
             <?php
                echo '<p><b>Telefone(s): </b><input class="form-control-input" type="text" name="txtTelefone" required value="' . $_SESSION['cadTelefone'] . '"></p>';
                echo '<p><b>Email: </b><input class="form-control-input" type="email" name="txtEmail" required value="' . $_SESSION['cadEmail'] . '"></p>';
                ?>
            </br>
            <p><input class="btn btn-md btn-primary" type='submit' value="Prosseguir"/></p>
            </form> 
          </div>
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
