<?php

function generatePDF($conteudo, $dir)
{
    require_once "../../../vendor/autoload.php";
    $header = '
    <table width="100%" style="border-bottom: 1px solid #000000; vertical-align: center; font-family: sans-serif; font-size: 9pt; color: #000088;"><tr>
    <td width="20%" align="CENTER"><img src="../../Imagens/Logo-Licita.png" width="100px"/></td>        
    <td width="80%" align="LEFT" style="vertical-align: MIDDLE;"><h1>LICITATUDO™ - PORTAL DE COMPRAS PÚBLICAS</h1>
    </td>
    </tr></table>';

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'c',
        'margin_left' => 10,
        'margin_right' => 10,
        'margin_top' => 33,
        'margin_bottom' => 10,
        'margin_header' => 3,
    ]);
    $mpdf->SetHTMLHeader($header);
    $mpdf->setFooter('{PAGENO}');
    $mpdf->WriteHTML($conteudo);
    $mpdf->Output($dir, "f");
}
