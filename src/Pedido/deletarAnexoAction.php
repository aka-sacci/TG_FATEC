<?php

session_start();
$myCnpj = $_SESSION['cnpj'];
$connection  = require '../scripts/connectionClass.php';
$validate = false;
$codDoc = $_POST["txtCod"];

$sql = "select * from login_instituicao_publica where login = '" . $_SESSION['login'] . "' and senha = '" . $_POST['txtSenha'] . "' limit 1";
foreach ($connection->query($sql) as $key => $value) {
    $validate = true;
}

if (!$validate) {
    echo "Senha incorreta!";
} else {
    $sql = "delete from anexos_pedido where cod = $codDoc";
    $prepare = $connection->prepare($sql);
    $prepare->execute();
    unlink("../../files/Pedidos/Anexos/ANEXO$codDoc.pdf");
    echo "<link rel='shortcut icon' type='image/x-icon' href='../../../../Imagens/Logo-Licita.ico'>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
        <link rel='stylesheet' href='../../../../scripts/utils/style.css'>
        <script type='text/javascript' src='../../../../scripts/utils/scriptsBasicos.js'></script>
        <div class='container py-4 col-lg-4' id='container-corpoindex'>
            <div class='alert alert-info' role='alert'>
            <h4 class='alert-heading'>O anexo foi excluído com sucesso!</h4>
            </div></br>          
            <a class='btn btn-md buttoncad' href='visualisarMeuPedido.php?cod=$codDoc'>Voltar</a>
        </div>";
}
