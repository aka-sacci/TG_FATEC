<?php

require_once "../../vendor/autoload.php";
session_start();
if (isset($_SESSION['login'])) {
    $email = $_SESSION['login'];
    $senha = $_SESSION['pwd'];
    $log = false;

    $connection  = require '../scripts/connectionClass.php';
    $sql = "select * from login_instituicao_publica where login = '" . $email . "' and senha = '" . $senha . "' limit 1";
    foreach ($connection->query($sql) as $key => $value) {
        $log = true;
        $cnpj = $value['cnpj'];
    }
    if (!$log) {
        header('location:../Cadastro/Publico/login.php');
    }
    echo "<script>sessionStorage.setItem('counterItens', 1);</script>";
} else {
    header('location:../Cadastro/Publico/login.php');
}

?>
<!DOCTYPE html>

<html lang="pt">
 <head>

    <meta charset="utf-8">
    <title>LicitaTudo - Meu cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../scripts/utils/itensActions.js"></script>
</head>

    <body>

    <!--    início selecionar categoria -->
    <p>Selecionar categoria: 
    <select>
        <?php
        $sql = "select * from categoria order by categoria";
        foreach ($connection->query($sql) as $key => $value) {
            $val = $value['cod'];
            $text = $value['categoria'];
            echo "<option value='$val'>$text</option>";
        }
        ?>
    </select>
    </p>
    <!--    fim selecionar categoria -->


    <!--    início itens -->
    <h3>Itens</h3>
    <div class="divItens">

    <p class="p1" id="p1">
    <input type="text" placeholder="Item #1" maxlength="50" id="txtItem1" name="txtItem1" required>
    <textarea placeholder="Descrição detalhada do item #1" maxlength="400" id="txtDesc1" name="txtDesc1" required ></textarea>
    <input type="number" placeholder="Quantidade" id="txtQtde1" name="txtQtde1" value="1" required>
    <select id="selectQtde1" name="selectQtde1">
        <option value="un">Unidade</option>
        <option value="mt">Metro</option>
        <option value="lt">Litro</option>
    </select>
    </p>

    </div>

    <p><button onclick="adicionarItem()" type="button">Adicionar mais um item</button>
        <button onclick="deletarItem()" type="button">Remover</button></p>
    <br>
    <!--    fim itens -->

    <!--    início modo -->
    <p>Modo do pedido:
    <select>
        <?php
        $sql = "select * from modo_pedido order by modo";
        foreach ($connection->query($sql) as $key => $value) {
            $val = $value['cod'];
            $text = $value['modo'];
            echo "<option value='$val'>$text</option>";
        }
        ?>
    </select></p>
    <!--    fim modo -->

    <!--    início distância -->
    <p>Distância (KM)</p>
    <!--    fim distância -->

    </body>


</html>
