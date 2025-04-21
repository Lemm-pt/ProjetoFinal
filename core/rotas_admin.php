<?php

// coleção de rotas
$rotas = [
    'inicio' => 'admin@index',

    // admin
    'admin_login' => 'admin@admin_login',
    'admin_login_submit' => 'admin@admin_login_submit',
    'admin_logout' => 'admin@admin_logout',

    // produtos
    'lista_produtos' => 'admin@lista_produtos',
    'lista_todos_produtos' => 'admin@lista_todos_produtos',
    'detalhe_produto' => 'admin@detalhe_produto',
    'novo_produto' => 'admin@novo_produto',
    'inserir_produto' => 'admin@inserir_produto',
    'user_historico_pedidos' => 'admin@user_historico_pedidos',

    // pedidos
    'lista_pedidos' => 'admin@lista_pedidos',
    'lista_todos_pedidos' => 'admin@lista_todos_pedidos',
    'detalhe_pedido' => 'admin@detalhe_pedido',
    'pedido_alterar_estado' => 'admin@pedido_alterar_estado',
    'criar_pdf_pedido' => 'admin@criar_pdf_pedido',
];

// define ação por defeito
$acao = 'inicio';

// verifica se existe a ação na query string
if(isset($_GET['a'])){

    // verifica se a ação existe nas rotas
    if(!key_exists($_GET['a'], $rotas)){
        $acao = 'inicio';
    } else {
        $acao = $_GET['a'];
    }
}

// trata a definição da rota
$partes = explode('@',$rotas[$acao]);
$controlador = 'core\\controllers\\'.ucfirst($partes[0]);
$metodo = $partes[1];

$ctr = new $controlador();
$ctr->$metodo();


?>