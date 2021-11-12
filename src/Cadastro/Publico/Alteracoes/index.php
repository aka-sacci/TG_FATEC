<?php

require_once "../../../../vendor/autoload.php";
include_once "../../../scripts/validaLogin.php";
require_once '../../../scripts/utils/converterPontuacaoCNPJ.php';
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');


$myCnpj = $_SESSION['cnpj'];

//DADOS DO CADASTRO & CONTATO
$sqlDadosCadastro = "select * from instituicao_publica where cnpj = $myCnpj";
$sqlCadHist = "SELECT status_cadastro_hist.data, status_cadastro.descricao, status_cadastro.status 
FROM status_cadastro_hist INNER JOIN status_cadastro ON status_cadastro_hist.status = status_cadastro.cod 
WHERE cnpj = $myCnpj ORDER BY status_cadastro_hist.data ASC ";


//DADOS DO ENDEREÇO
//checka a quantidade de endereços
$sql = "SELECT COUNT(cod) FROM endereco_instituicao_publica WHERE cnpj = " . $myCnpj . "";
foreach ($connection->query($sql) as $key => $value) {
    $nroEnderecos = $value["COUNT(cod)"];
}
//pega o endereco principal (sempre o primeiro a ser inserido)
$sql = "select * from endereco_instituicao_publica where cnpj = '" . $myCnpj . "' order by cod ASC limit 1";
$enderecoPrincipal = $connection->query($sql);


?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Meus dados cadastrais</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

    <body>
      
      <H2><b>INFORMAÇÕES GERAIS</b></H2>
      <p>*Para alterar as informações gerais, é necessário realizar tais alterações diretamente com a Receita Federal. Se este processo já foi feito, 
        <a href="DadosCadastrais/atualizarDadosCadastrais.php">clique aqui para atualizar os dados cadastrais</a></p>

      <?php
        foreach ($connection->query($sqlDadosCadastro) as $key => $value) {
                echo '<p><b>CNPJ</b></p> <p>' .  converterCNPJ($value['cnpj']) . '</p>';
                echo '<p><b>Razão Social</b></p><p>' . $value['razao_social'] . '</p>';
                echo '<p><b>Nome Fantasia</b></p><p>' . $value['nome_fantasia'] . '</p>';
                echo '<p><b>Ente Federativo Responsável (EFR)</b></p><p>' . $value['efr'] . '</p>';
                echo '<p><b>Natureza Jurídica</b></p><p>' . $value['natureza'] . '</p>';
                $telefone = $value['telefone'];
                $email = $value['email'];
        }
        ?>


        <br><H2><b>INFORMAÇÕES PARA CONTATO/LOGIN</b></H2>
        <?php
        echo '<p><b>Telefone</b></p><p>' . $telefone . ' <a href="Telefone/alterarTelefone.php">Alterar</a></p>';
        echo '<p><b>Email</b></p><p>' . $email . ' <a href="Login/alterarLogin.php">Alterar</a></p>';
        ?>
      <p><a href="Login/alterarSenha.php">Alterar Senha</a></p>



    <br><h2><b>MEUS ENDEREÇOS</b></h2>
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
        $sql = "select * from endereco_instituicao_publica where cnpj = '" . $myCnpj . "' order by cod DESC LIMIT $limit";
        //caso tenha mais que um, é retornado todos os endereços EXCETO o primeiro a ser inserido (o principal);
        foreach ($connection->query($sql) as $key => $value) {
            echo "<p>" . $value['logradouro'] . ", " . $value['numero'] . ", " . $value['bairro'] . " - " .  $value['cidade'] . " (" . $value['uf'] . ") </p>";
            echo "<p>Descrição: " . $value['descricao'] . ". <a href='Endereco/alterarEndereco.php?cod=" . $value["cod"] . "'>Alterar endereço</a>
            <a href='Endereco/excluirEndereco.php?cod=" . $value["cod"] . "'>Excluir endereço</a></p><br>";
        }
    }
    ?>
    <a href="Endereco/inserirEndereco.php">Inserir novo endereço</a>



    <br><br><h2><b>HISTÓRICO DO CADASTRO</b></h2>
    <?php
    foreach ($connection->query($sqlCadHist) as $key => $value) {
        $dataStatusRaw = strtotime($value['data']);
        $dataStatus = strftime('%A, %d/%m/%Y', $dataStatusRaw);
        $horaStatus = strftime('%H:%M', $dataStatusRaw);
        echo '<p>' . $dataStatus . ' às ' . $horaStatus . ' - ' . $value['status'] . ': ' . $value['descricao'] . '</p>';
    }
    ?>

    </body>


</html>
