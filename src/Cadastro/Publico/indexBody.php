<?php

function returnBody()
{

    $content = '<hr class="featurette-divider">';
    $content .= '<div class="container">';
    $content .= '<div class="row mar-bot5">';
    $content .=  '<div class="col-md-offset-3 col-md-12">';
    $content .=         '<div class="centro">';
    $content .=                '<h2>ESPAÇO INSTITUIÇÃO PÚBLICA</h2>';
    $content .=                '<p class="pprincipal">Aqui você pode Consultar e alterar seus dados cadastrais, além de criar e consultar seus pedidos e ainda ficar por dentro dos pedidos em aberto das outras Instituições públicas.</p> ';
    $content .=            '</div>';
    $content .=        '</div>';
    $content .=    '</div></br>';
    $content .=    '<div class="row mar-bot40">';
    $content .=        '<div class="col-lg-3" >';
    $content .=            '<a href="Alteracoes">';
    $content .=            '<div class="align-center service-col centro"> ';
    $content .=                '<div class="service-icon centro">';
    $content .=                   ' <figure><i class="fa fa-database"></i></figure>';
    $content .=                '</div></a>';
    $content .=                    '<h3>Consultar seus dados</h3></br></br>';
    $content .=                  ' <a class="btn btn-md buttoncad" type="button" href="Alteracoes">Clique aqui</a>  ';
    $content .=           '</div>';
    $content .=        '</div>';
    $content .=        '<div class="col-lg-3">';
    $content .=           ' <a href="../../Pedido/criarPedido.php">';
    $content .=           '<div class="align-center service-col centro">';
    $content .=              ' <div class="service-icon centro">';
    $content .=                  ' <figure><i class="fa fa-folder-plus"></i></figure>';
    $content .=              '</div></a>';
    $content .=                   ' <h3>Criar novo pedido</h3></br></br>';
    $content .=                   ' <a class="btn btn-md buttoncad" type="button" href="../../Pedido/criarPedido.php">Clique aqui</a>';
    $content .=            '</div>';
    $content .=        '</div>'  ;
    $content .=        '<div class="col-lg-3" >';
    $content .=            '<a href="../../Pedido/meusPedidos.php">';
    $content .=            '<div class="align-center service-col centro">';
    $content .=               '<div class="service-icon centro">';
    $content .=                    '<figure><i class="fa fa-list-alt"></i></figure>';
    $content .=                '</div></a>';
    $content .=                    '<h3>Ver meus pedidos</h3></br></br>';
    $content .=                    '<a class="btn btn-md buttoncad" type="button" href="../../Pedido/meusPedidos.php">Clique aqui</a>';
    $content .=            '</div>';
    $content .=        '</div>' ;
    $content .=        '<div class="col-lg-3" >';
    $content .=            '<a href="../../Perfis/Pedidos/buscarPedido.php">';
    $content .=            '<div class="align-center service-col centro">' ;
    $content .=                '<div class="service-icon centro">';
    $content .=                    '<figure><i class="fa fa-building"></i></figure>';
    $content .=                '</div></a>';
    $content .=                    '<h3>Banco de Preços</h3></br></br>';
    $content .=                    '<a class="btn btn-md buttoncad" type="button" href="../../Perfis/Pedidos/buscarPedido.php">Clique aqui</a>';
    $content .=            '</div>';
    $content .=        '</div>' ;
    $content .=    '</div>';
    $content .= '</div>';
    return $content;
}
