<?php

$filename = $_GET['filename'];
$dir = "../../files/";
$dir .= $_GET['dir'];
$dir .= $filename;
$titulo = $_GET['titulo'];
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename=' . $titulo . '.pdf;');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($dir));
header('Accept-Ranges: bytes');
@readfile($dir);
