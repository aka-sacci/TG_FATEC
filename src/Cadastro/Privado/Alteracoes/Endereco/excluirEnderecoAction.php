<?php

session_start();
$connection  = require '../../../../scripts/connectionClass.php';
$validate = false;
$codEndereco = $_POST["txtCod"];
$myCnpj = $_SESSION['cnpj'];

$sql = "select * from login_empresa_privada where login = '" . $_SESSION['login'] . "' and senha = '" . $_POST['txtSenha'] . "' limit 1";
foreach ($connection->query($sql) as $key => $value) {
    $validate = true;
}

if (!$validate) {
    echo "Senha incorreta!";
} else {
    $sql = "delete from endereco_empresa_privada where cod = $codEndereco and cnpj = $myCnpj";
    $prepare = $connection->prepare($sql);
    $prepare->execute();
    echo "<link rel='shortcut icon' type='image/x-icon' href='../../../../Imagens/Logo-Licita.ico'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
    <link rel='stylesheet' href='../../../../scripts/utils/style.css'>
    <script type='text/javascript' src='../../../../scripts/utils/scriptsBasicos.js'></script>
    <div class='container py-4 col-lg-4' id='container-corpoindex'>
        <div class='alert alert-info' role='alert'>
        <h4 class='alert-heading'>O endereço foi excluído com sucesso!</h4>
        </div></br>          
        <button class='btn btn-md buttoncad' onclick='goBack()'>Voltar</button>
    </div>";
}
