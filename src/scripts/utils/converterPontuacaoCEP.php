<?php

function converterCEP($myCEP)
{
    $parte1 = substr($myCEP, 0, 5);
    $parte2 = substr($myCEP, 5, 3);

    $convertido = $parte1 . "-" . $parte2;
    return $convertido;
}
