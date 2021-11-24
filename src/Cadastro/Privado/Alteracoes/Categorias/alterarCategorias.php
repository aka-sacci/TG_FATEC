<?php

    require_once "../../../../../vendor/autoload.php";
    include_once "../../../../scripts/validaLogin.php";
    validarLogin("PRI");
    $connection  = require "../../../../scripts/connectionClass.php";
    $myCnpj = $_SESSION["cnpj"];
    $arrayCategoria = array();
    $arrayMinhasCategorias = array();

    $sql = "select * from categoria order by categoria ASC";
foreach ($connection->query($sql) as $key => $value) {
    $thisCategoria = array("cod" => $value["cod"], "categoria" => $value["categoria"]);
    array_push($arrayCategoria, $thisCategoria);
}

    $sql = "SELECT categoria.cod, categoria.categoria FROM categoria 
    INNER JOIN categoria_empresa_privada ON
    categoria.cod = categoria_empresa_privada.categoria
    WHERE cnpj = $myCnpj";
    $qtdeCats = 0;
foreach ($connection->query($sql) as $key => $value) {
    $thisCategoria = array("cod" => $value["cod"], "categoria" => $value["categoria"]);
    array_push($arrayMinhasCategorias, $thisCategoria);
    $qtdeCats++;
}

    //var_dump($arrayCategorias);
    echo "<script>sessionStorage.setItem('categorias', '" . json_encode($arrayCategoria) . "');</script>";
    echo "<script>sessionStorage.setItem('counterCategorias', $qtdeCats);</script>";

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
      <meta charset="utf-8">
      <title>Atualizar Categorias</title>
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
      <script type="text/javascript" src="alterarCategoriasActions.js"></script>
    <script type="text/javascript" src="../../../../scripts/utils/scriptsBasicos.js"></script>
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </head>

    <body onload="bodyLoadCategorias()">
        </br>
          <a class="home" href="../">
              <i class="fa fa-arrow-circle-left"> Voltar</i>
          </a>

          <!-- Container Corpo da Pagina -->   
        <div class="container py-4" id="container-corpoindex">
            <div class="img centro">
                <img src="../../../../Imagens/logo-LT.png" alt="alternative" width=80 height=80>
            </div><br>
                <h3><b>ALTERAR CATEGORIAS</b></h3><hr><br>
    
            <form action="alterarCategoriasAction.php" method="post" onsubmit="enableCategoria()">                
                <div id="divSelects" class="divSelects">
                    <?php
                        $i = 1;
                    foreach ($arrayMinhasCategorias as $key => $registroMinhaCat) {
                        echo '<select name="selectCategorias' . $i . '" id="selectCategorias' . $i . '" style="margin-right: 0.45rem; margin-bottom: 0.45rem">';
                        foreach ($arrayCategoria as $key => $registro) {
                            if ($registro['cod'] != $registroMinhaCat['cod']) {
                                echo "<option value='" . $registro['cod'] . "'>" . $registro['categoria']  . "</option> ";
                            } else {
                                echo "<option value='" . $registro['cod'] . "' selected>" . $registro['categoria']  . "</option> ";
                                $prevValues = $key;
                            }
                        }
                        echo '</select>';
                        unset($arrayCategoria[$prevValues]);
                        $i++;
                    }

                    ?>
                </div>
                    <p>*limite de 5 categorias por empresa privada</p>
                    <p><button class="btn btn-outline-success" onclick="adicionarCategoria()" type="button">Adicionar categoria</button>
                    <button class="btn btn-outline-danger" onclick="deleteCategoria()" type="button">Remover</button></p>
                
                    <br><p><input class="btn btn-md btn-primary" type='submit' value="Alterar"/></p>
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
