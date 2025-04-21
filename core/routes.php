<?php

// coleção de routes (array associativo)
$routes = [
     'inicio' => 'main@index',
     'menu' => 'main@menu',
    

     // new user
     'new_user'      => 'main@new_user',
     'user_create'   => 'main@user_create',
     'confirm_email' => 'main@confirm_email',
     //login
     'login'         => 'main@login',
     'login_submit'  => 'main@login_submit',
     'logout'        => 'main@logout',

     //perfil
     'perfil'        => 'main@perfil',
     'alterar_dados_pessoais' => 'main@alterar_dados_pessoais',
    'alterar_dados_pessoais_submit' => 'main@alterar_dados_pessoais_submit',
    'alterar_password' => 'main@alterar_password',
    'alterar_password_submit' => 'main@alterar_password_submit',

     // minha mesa
     'adicionar_pedido'       => 'pedidos@adicionar_pedido',
     'minha_mesa'             => 'pedidos@minha_mesa',
     'limpar_mesa'            => 'pedidos@limpar_mesa',
     //'adicionar_retirar'      => 'pedidos@adicionar_retirar',
     'remover_produto_mesa'   => 'pedidos@remover_produto_mesa',
     'adicionar_produto_mesa' => 'pedidos@adicionar_produto_mesa',
     'retirar_produto_mesa'   => 'pedidos@retirar_produto_mesa',
     //'pedidos'                => 'pedidos@pedidos',
     'finalizar_pedido'        => 'pedidos@finalizar_pedido',
     'finalizar_pedido_resumo' => 'pedidos@finalizar_pedido_resumo',
     // historico pedidos
    'historico_pedidos' => 'main@historico_pedidos',
    'historico_pedidos_hoje' => 'main@historico_pedidos_hoje',
    'detalhe_pedido' => 'main@historico_pedidos_detalhe',

    // pagamento
    'pagamento' => 'main@pagamento'
     
];

// define ação por defeito
$acao = 'inicio';

//verifica se existe a ação na query url
if(isset($_GET['a'])){

    // verifica se a ação existe nas routes
    // se nao existir se nao tiver 'a' na url abre como inicio
    if(!key_exists( $_GET['a'], $routes)){
        $acao = 'inicio';
    }else{
        $acao = $_GET['a'];
    }
}

// trata a definição da rota --- @ é o separador
$partes = explode('@', $routes[$acao]);
$controlador = 'core\\controllers\\'.ucfirst($partes[0]); //ucfirst 1ª letra capitalizada
$metodo = $partes[1];

$ctr = new $controlador();
$ctr->$metodo();

/// testes /////////
//echo "$controlador - $metodo";

//var_dump($partes);
//output:
//array(2) { [0]=> string(4) "main" [1]=> string(5) "index" }

?>