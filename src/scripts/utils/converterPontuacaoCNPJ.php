<?php

function converterCNPJ($myCNPJ)
{
    $parte1 = substr($myCNPJ, 0, 2);
    $parte2 = substr($myCNPJ, 2, 3);
    $parte3 = substr($myCNPJ, 5, 3);
    $parte4 = substr($myCNPJ, 8, 4);
    $parte5 = substr($myCNPJ, 12, 4);
    $convertido = $parte1 . "." . $parte2 . "." . $parte3 . "/" . $parte4 . "-" . $parte5;
    return $convertido;
}
