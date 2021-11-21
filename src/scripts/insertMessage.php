<?php

$nome = $_POST['cname'];
$email = $_POST['cemail'];
$mensagem = $_POST['cmessage'];
$connection = require 'connectionClass.php';
$sql = "insert into mensagem (nome, email, mensagem, status) values ('$nome', '$email', '$mensagem', 1)";
$prepare = $connection->prepare($sql);
$prepare->execute();
echo "<p>Sua mensagem foi enviada com sucesso! Clique <a href='../../'>aqui</a> para retornar</p>";
