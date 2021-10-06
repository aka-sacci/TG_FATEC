<?php

declare(strict_types=1);

$pdo = null;

try {
    $pdo = new PDO('mysql:host=localhost;dbname=database_portal', 'root', ''); //PARAMETROS DE CONEXÃO
} catch (Exception $e) {
    echo $e->getCode() . ': ' . $e->getMessage();
    die();
}

return $pdo;
