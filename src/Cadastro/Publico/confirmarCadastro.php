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
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </head>
  <body>
    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
          <div class="container">
          <a class="navbar-brand" href="../../../index.php" id="nav-img">
              <img src="../../Imagens/Logo-Licita.png" alt="" width="30" height="30" class="d-inline-block align-text-center"> LicitaTudo            
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav me-auto mb-2 mb-md-0"><!-- nav-item active -->
              <li class="nav-item dropdown"><!-- dropdown Login -->
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Login</a>
                  <div class="dropdown-menu">
                  <a class="dropdown-item" href="../../Cadastro/Privado/login.php">Conta Privada</a>
                  <a class="dropdown-item" href="../../Cadastro/Publico/login.php">Conta Pública</a>
                  </div>    
              </li>
              <li class="nav-item dropdown"><!-- dropdown Cadastro -->
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Cadastro</a>
                  <div class="dropdown-menu">
                  <a class="dropdown-item" href="../../Cadastro/Privado/novoCadastro.php">Conta Privada</a>
                  <a class="dropdown-item" href="../../Cadastro/Publico/novoCadastro.php">Conta Pública</a>
                  </div>    
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">Sobre Nós</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">Contato</a>
              </li>
              </ul>
          </div>
          </div>
      </nav>    

    <!-- Container Corpo da Pagina -->   
    <div class="container py-4" id="container-corpoindex">
      <!-- Formulário com as informações carregadas -->
      <form action="../config/confirmarCadastroAction.php" method="post"> 
      <p><b>Confirme os dados - Informações Gerais</b></p>
      <hr>
          <?php
            echo '<p><b>CNPJ: </b>' .  converterCNPJ($_SESSION['cadCNPJ']) . '</p>';
            echo '<p><b>Razão Social: </b>' . $_SESSION['cadRazaoSocial'] . '</p>';
            echo '<p><b>Nome Fantasia: </b>' . $_SESSION['cadNomeFantasia'] . '</p>';
            echo '<p><b>Ente Federativo Responsável (EFR): </b>' . $_SESSION['cadEFR'] . '</p>';
            echo '<p><b>Natureza Jurídica: </b>' . $_SESSION['cadNatureza'] . '</p>';
            echo '<p><b>Endereço: </b>' . $_SESSION['cadLog'] . ', ' . $_SESSION['cadNumero'] . ' - ' . $_SESSION['cadBairro'] . ' (' . converterCEP($_SESSION['cadCEP']) . ') - ' . $_SESSION['cadCidade'] . ', ' . $_SESSION['cadUF'] . '</p>';
          ?>
      <hr>
      <p><b>Informações para contato</b></p>
          <?php
              echo '<p><b>Telefone(s): </b><input type="text" name="txtTelefone" required value="' . $_SESSION['cadTelefone'] . '"></p>';
              echo '<p><b>Email: </b><input type="email" name="txtEmail" required value="' . $_SESSION['cadEmail'] . '"></p>';
          ?>
      </br>
      <p><input class="btn btn-md btn-primary" type='submit' value="Prosseguir"/></p>
      </form> 
    </div>

    <!-- footer da página -->
    <div class="container center col-md-2">
    <p class="text-muted">&copy; Licitatudo  2020 – 2021</p>
    </div>
  </body>
</html>
