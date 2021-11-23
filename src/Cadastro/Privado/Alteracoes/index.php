<?php
    require_once "../../../../vendor/autoload.php";
    include_once "../../../scripts/validaLogin.php";
    validarLogin("PRI");
    $connection  = require "../../../scripts/connectionClass.php";
    require_once '../../../scripts/utils/converterPontuacaoCNPJ.php';
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

    $myCnpj = $_SESSION['cnpj'];

    //DADOS DO CADASTRO & CONTATO
    $sqlDadosCadastro = "select * from empresa_privada where cnpj = $myCnpj";

    //DADOS DO ENDEREÇO
    //checka a quantidade de endereços
    $sql = "SELECT COUNT(cod) FROM endereco_empresa_privada WHERE cnpj = " . $myCnpj . "";
foreach ($connection->query($sql) as $key => $value) {
    $nroEnderecos = $value["COUNT(cod)"];
}
    //pega o endereco principal (sempre o primeiro a ser inserido)
    $sql = "select * from endereco_empresa_privada where cnpj = '" . $myCnpj . "' order by cod ASC limit 1";
    $enderecoPrincipal = $connection->query($sql);

    //pega as categorias cadastradas
    $sql = "SELECT categoria.categoria from categoria_empresa_privada
    INNER JOIN categoria ON
    categoria_empresa_privada.categoria = categoria.cod
    WHERE cnpj = $myCnpj";
    $categorias = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Dados Cadastrais</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="../../../Imagens/Logo-Licita.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Lista de Estilos CSS -->
        <link rel="stylesheet" href="../../../scripts/utils/style.css">
        <!-- Lista de icones -->
        <link  rel="stylesheet" href="../../../scripts/utils/fontawesome/css/all.css">
        <!-- skin -->
        <link rel="stylesheet" href="../../../scripts/utils/default.css">
        <!-- jQuery, JS e Bootstrap JS -->
        <script type="text/javascript" src="../../../scripts/utils/scriptsBasicos.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>

    <body>
        </br>
        <a class="home" href="../index.php">
            <i class="fa fa-arrow-circle-left"> Voltar</i>
        </a>
        <div class="container" id="container-corpoindex">
            <hr><H4><b>INFORMAÇÕES GERAIS</b></H4>
            <p>*Para alterar as informações gerais (exceto categorias), é necessário realizar tais alterações diretamente com a Receita Federal. Se este processo já foi feito, 
            <a href="DadosCadastrais/atualizarDadosCadastrais.php">clique aqui para atualizar os dados cadastrais</a></p>

                <?php
                foreach ($connection->query($sqlDadosCadastro) as $key => $value) {
                        echo '<p><b>CNPJ: </b>' .  converterCNPJ($value['cnpj']) . '</p>';
                        echo '<p><b>Razão Social: </b>' . $value['razao_social'] . '</p>';
                        echo '<p><b>Nome Fantasia: </b>' . $value['nome_fantasia'] . '</p>';
                        echo '<p><b>Ente Federativo Responsável (EFR): </b>' . $value['efr'] . '</p>';
                        echo '<p><b>Natureza Jurídica: </b>' . $value['natureza'] . '</p>';
                        $telefone = $value['telefone'];
                        $email = $value['email'];
                }
                ?>
                <!-- Alterar categorias cadastradas -->                   
                <?php
                    echo '<p><b>Categorias cadastradas: </b>';
                    $countCat = 1;
                foreach ($categorias as $key => $value) {
                    if ($countCat == 1) {
                        echo $value['categoria'];
                    } else {
                        echo ", " . $value['categoria'];
                    }
                    $countCat++;
                }
                    echo ". <a><b> | </b></a><a href='Categorias/alterarCategorias.php'>Alterar</a></p>"
                ?>

                <hr><H4><b>INFORMAÇÕES PARA CONTATO/LOGIN</b></H4>

                <?php
                    echo '<p><b>Telefone: </b>' . $telefone . ' <a><b> | </b></a><a href="Telefone/alterarTelefone.php">Alterar</a></p>';
                    echo '<p><b>Email: </b>' . $email . ' <a><b> | </b></a><a href="Login/alterarLogin.php">Alterar</a></p>';
                ?>

                <p><b>Senha: </b><a href="Login/alterarSenha.php">Alterar Senha</a></p>

                <hr><H4><b>MEUS ENDEREÇOS</b></H4>
                <h4>Endereço principal</h4>
                <p>*Para alterar o endereço principal, é necessário realizar tal alteração diretamente com a Receita Federal. Se tal processo já foi feito, 
                <a href="Endereco/atualizarEnderecoPrincipal.php">clique aqui para atualizar o endereço</a></p>
                
                <?php
                foreach ($enderecoPrincipal as $key => $value) {
                    echo "<p>" . $value['logradouro'] . ", " . $value['numero'] . ", " . $value['bairro'] . " - " .  $value['cidade'] . " (" . $value['uf'] . ") </p>";
                }
                ?>

                <h4>Outros endereços</h4>

                <?php
                if ($nroEnderecos == 1) {
                    //caso a empresa só tenha um endereço cadastrado
                    echo "<p>Não há outros endereços!</p>";
                } else {
                    $limit = $nroEnderecos - 1;
                    $sql = "select * from endereco_empresa_privada where cnpj = '" . $myCnpj . "' order by cod DESC LIMIT $limit";
                    //caso tenha mais que um, é retornado todos os endereços EXCETO o primeiro a ser inserido (o principal);
                    foreach ($connection->query($sql) as $key => $value) {
                        echo "<p>" . $value['logradouro'] . ", " . $value['numero'] . ", " . $value['bairro'] . " - " .  $value['cidade'] . " (" . $value['uf'] . ") </p>";
                        echo "<p>Descrição: " . $value['descricao'] . ". <a href='Endereco/alterarEndereco.php?cod=" . $value["cod"] . "'>Alterar endereço</a>
                            <a><b> | </b></a><a href='Endereco/excluirEndereco.php?cod=" . $value["cod"] . "'>Excluir endereço</a></p><br>";
                    }
                }
                ?>

                <a href="Endereco/inserirEndereco.php">Inserir novo endereço</a>

                <hr><h4><b>MEUS DOCUMENTOS</b></h4>
                
                <?php
                    //seleciona os documentos cadastrados
                    $validateDocs = false;
                    $conteudoDocsNull = "<p>Não há documentos registrados!</p>";
                    $sql = "select data_upload, descricao, descricao_doc, documento_empresa_privada.cod from documento_empresa_privada
                    INNER JOIN documento_tipo ON 
                    documento_empresa_privada.tipo = documento_tipo.cod
                    WHERE cnpj = $myCnpj";
                    $conteudoDocs = "";

                foreach ($connection->query($sql) as $key => $value) {
                    $validateDocs = true;
                    $conteudoDocs .= "<p><a href='../../../scripts/abrirArquivoPDF.php?filename=" . $value['cod'] .  ".pdf&";
                    $conteudoDocs .= "dir=Documentos/&titulo=" . $value['descricao'] . " - $myCnpj'>" . $value['descricao_doc'] ;
                    $conteudoDocs .= "</a> <a href='Documentos/alterarDocumento.php?cod=" . $value['cod'] .  "'><img src='../../../Imagens/icons/edit-icon.png' width='15' height='15'></a>";
                    $conteudoDocs .= "</a> <a href='Documentos/deletarDocumento.php?cod=" . $value['cod'] .  "'><img src='../../../Imagens/icons/delete-icon.png' width='15' height='15'></a></p>";
                }
                if (!$validateDocs) {
                    //se não houverem documentos cadastrados...
                    echo $conteudoDocsNull;
                } else {
                    //se houverem documentos cadastrados...
                    echo $conteudoDocs;
                }

                ?>

                <a href="Documentos/inserirDocumento.php">Inserir novo documento</a>    
                <hr></br>
                <button class="btn btn-md buttoncad" onclick="goBack()">Concluir Alterações</button></br></br></br></br>
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
