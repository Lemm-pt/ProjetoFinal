<?php

namespace core\controllers;


use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\FastControl;
use core\models\Pedidos_bd;
use core\models\Products;
use core\models\Users;

class pedidos
{


    //________________________________________________________//
    ////////////////////////////////////////////////////////////
    public function adicionar_pedido()
    { //não leva parametros porque ele vem por a url

        //vai buscar o id_produto à url
        if (!isset($_GET["id_product"])) {
            // header('Loation: ' . BASE_URL . 'index.php?a=menu');
            echo isset($_SESSION['pedidos']) ? count($_SESSION['pedidos']) : '';
            return;
        }
        //define o id do produto
        $id_product = $_GET["id_product"];

        //bloco de codigo para gerir o stock com logica e não ser adicionado à toa por a url
        $products = new Products(); //vai ao models
        $resultados = $products->veirfyStock($id_product);
        if (!$resultados) {
            //header('Loation: ' . BASE_URL . 'index.php?a=menu');
            echo isset($_SESSION['pedidos']) ? count($_SESSION['pedidos']) : '';
            return;
        }

        //adiciona/gestão da variavel de sessÃO DOS PEDIDOS
        /*
 1. puxar o array dos pedidos da sessão para o php
 2. adicionar/gerir o array dos pedidos
 3. recolocar o array na sessão
 */
        $pedidos = [];
        if (isset($_SESSION['pedidos'])) {
            $pedidos = $_SESSION['pedidos'];
        }
        /*
 'minha mesa'  se xistir um pedido vai acrescentando
 [3] -> 2
 [4] -> 1
 */
        //adicionar o produto aos pedidos
        if (key_exists($id_product, $pedidos)) {
            //já existe o pedido. Acrescenta mais uma unidade
            $pedidos[$id_product]++;
        } else {
            //adicionar novo produto aos pedidos
            $pedidos[$id_product] = 1;
        }
        //atualiza os dados dos pedidos na sessão
        $_SESSION['pedidos'] = $pedidos;

        //devolve a resposta com o número de produtos pedidos
        $total_products = 0;
        foreach ($pedidos as $quantidade) {
            $total_products += $quantidade;
        }
        echo $total_products;
    }



    //________________________________________________________//
    ////////////////////////////////////////////////////////////
    public function limpar_mesa()
    {

        // limpa a mesa de todos os produtos pedidos
        unset($_SESSION['pedidos']);
        // ou $_SESSION['pedidos'] = []; // mas pode dar complicaçãoes

        //refresh a página da minha mesa
        $this->minha_mesa(); // ou podia usar o conteudo das views abaixo

    }
    //________________________________________________________//
    ////////////////////////////////////////////////////////////
    public function minha_mesa()
    {

        // apresenta a pagina dos pedidos da mesa
        // $mesa = '';
        // if($_GET['mesa']){
        //  $mesa = $_GET['mesa'];
        //  $_SESSION['mesa'] = $mesa;
        // }

        // //verificar se existe minha mesa e pedidos
        // if(isset($_GET['mesa_num'])) {
        //    $mesa_num = $_GET['mesa_num'];
        //    $_SESSION['mesa_num'] = $mesa_num;
        //  }//else{
        // //     $mesa_num = null;
        // //    $_SESSION['mesa_num'] = $mesa_num;
        // // }  
        //$mesa_num = $_GET['mesa_num'] == true ? $_SESSION['mesa_num'] = $_GET['mesa_num'] : 0 ;
        // verificar se existe carrinho
        if (!isset($_SESSION['pedidos']) || count($_SESSION['pedidos']) == 0) {
            $dados = [
                'pedidos' => null
            ];
        } else {

            /* 
   id buscar à bd os dados dos produtos que existem na minha mesa
   criar um ciclo que constroi a estrutura dos dados para a minha mesa
   */

            $ids = [];
            foreach ($_SESSION['pedidos'] as $id_produto => $quantidade) {
                array_push($ids, $id_produto);
            }
            $ids = implode(",", $ids);
            $produtos = new Products();
            $produtos_do_pedido = $produtos->buscar_produtos_por_ids($ids);

            /*
   fazer ciclo por cada produto da minha mesa
   identificar o id e usar os dados da bd para criar uma coleção de dados para a pag da minha mesa
   imagem | titulo | quantidade | preço | x
   */
            $dados_tmp = [];
            // foreach para percorrer até tiver quantidade
            foreach ($_SESSION['pedidos'] as $id_produto => $quantidade_mesa) {
                // foreach para percorrer os produtos nde cada id
                foreach ($produtos_do_pedido as $produto) {
                    if ($produto->id_produto == $id_produto) {
                        $imagem = $produto->imagem;
                        $titulo = $produto->nome_produto;
                        $quantidade = $quantidade_mesa;
                        $preco = $produto->preco * $quantidade;

                        //colocar o produto na coleção
                        array_push($dados_tmp, [
                            'mesa_num'   => isset($_SESSION['mesa']) ? $_SESSION['mesa'] : ' ',
                            'id_produto' => $id_produto,
                            'imagem'     => $imagem,
                            'titulo'     => $titulo,
                            'quantidade' => $quantidade,
                            'preco'      => $preco,
                            'data'       => date('d-m  h:i')
                        ]);
                        break;
                    } //end if
                } // end foreach resultados
            } // end foreach session

            // calcular o total
            $total_pedido = 0;
            foreach ($dados_tmp as $item) {
                $total_pedido += $item['preco'];
            }
            // adicionar o total ao array
            //array_push($dados_tmp, ['Total' => $total_pedido ]);  ou
            array_push($dados_tmp,  $total_pedido);
            //FastControl::printData($dados_tmp); 
            // FastControl::printData($resultados);
            // FastControl::printData($ids);
            // FastControl::printData($_SESSION['pedidos']);
            // die();


            $dados = [
                'pedidos' => $dados_tmp,
            ];
        }

        // apresenta a página de minha mesa
        FastControl::Layout([
            'layouts/html_header',
            'layouts/header',
            'minha_mesa',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }


    //não existe minha mesa?
    //mesa vazia --> link para voltar à ementa
    //existe minha mesa
    // image | designação | quantidade | preço(X)
    // image | designação | quantidade | preço(X)
    // image | designação | quantidade | preço(X)
    // total | sum()

    //________________________________________________________//
    // ===========================================================
    public function remover_produto_mesa()
    {

        // vai buscar o id_produto na query string
        $id_produto = $_GET['id_produto'];

        // buscar o carrinho à sessão
        $pedidos = $_SESSION['pedidos'];

        // remover o produto do carrinho
        unset($pedidos[$id_produto]);

        // atualizar o carrinho na sessão
        $_SESSION['pedidos'] = $pedidos;

        // apresentar novamente a página do carrinho
        $this->minha_mesa();
    }


    // ===========================================================
    public function finalizar_pedido()
    {
        // para teste mostra as variáveis de sessãao
        // FastControl::printData($_SESSION);
        //  exit();
        /*
            verificar se existe cliente logado
            não existe?
             - colocar um referrer na sessao
             - abrir o quadro de login
             -apos login com sucesso, regressar à loja
             - remover o referrer da sessao
             existe
             passo 2 confirmar

            */

        // verifica se existe cliente logado
        if (!isset($_SESSION['user'])) {

            // coloca na sessão um referrer temporário (referrer é "donde é que eu venho")
            $_SESSION['tmp_pedido'] = true;

            // redirecionar para o quadro de login redirect uma função criada na classe FastControl
            FastControl::redirect('login');
        } else {

            FastControl::redirect('finalizar_pedido_resumo');
        }

        // unset($_SESSION['mesa']);
    }

    // ===========================================================
    public function finalizar_pedido_resumo(){

        // verificar se existe user logado
        if(!isset($_SESSION['user'])){
            FastControl::redirect('inicio');
        }

        //verifica se pode avançar para guardar o pedido(para não ser guardada 2 vezes com refresh)
        if(!isset($_SESSION['pedidos']) && count($_SESSION['pedidos']) == 0){
            FastControl::redirect('inicio');
          return;
        }

         // informaçãoes do pedido 
        $ids = [];
        foreach ($_SESSION['pedidos'] as $id_produto => $quantidade) {
            array_push($ids, $id_produto);
        }
        $ids = implode(",", $ids);
        $produtos = new Products();
        $produtos_do_pedido = $produtos->buscar_produtos_por_ids($ids);

        /*
fazer ciclo por cada produto da minha mesa
identificar o id e usar os dados da bd para criar uma coleção de dados para a pag da minha mesa
imagem | titulo | quantidade | preço | x
*/
        $dados_tmp = [];
        // foreach para percorrer até tiver quantidade
        foreach ($_SESSION['pedidos'] as $id_produto => $quantidade_mesa) {
            // foreach para percorrer os produtos nde cada id
            foreach ($produtos_do_pedido as $produto) {
                if ($produto->id_produto == $id_produto) {
                    $imagem = $produto->imagem;
                    $titulo = $produto->nome_produto;
                    $quantidade = $quantidade_mesa;
                    $preco = $produto->preco * $quantidade;

                    //colocar o produto na coleção
                    array_push($dados_tmp, [
                        'mesa_num'   => isset($_SESSION['mesa']) ? $_SESSION['mesa'] : ' ',
                        'id_produto' => $id_produto,
                        'imagem'     => $imagem,
                        'titulo'     => $titulo,
                        'quantidade' => $quantidade,
                        'preco'      => $preco,
                        'data'       => date('d-m  h:i')
                    ]);
                    break;
                } //end if
            } // end foreach resultados
        } // end foreach session

        // calcular o total
        $total_pedido = 0;
        foreach ($dados_tmp as $item) {
            $total_pedido += $item['preco'];
        }
        // adicionar o total ao array
        //array_push($dados_tmp, ['Total' => $total_pedido ]);  ou
        array_push($dados_tmp,  $total_pedido); //acrescentar o total
       // array_push($dados_tmp,  $_SESSION['id_user']);//acrescentar ao array mai o id user
        //FastControl::printData($dados_tmp); 
        // FastControl::printData($resultados);
        // FastControl::printData($ids);
        // FastControl::printData($_SESSION['pedidos']);
        // die();
        
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // preparar os dados da view

        // $dados = [ // assim vai buscar somente os dados edo pedido
        //     'pedidos' => $dados_tmp,
        // ];
        // assim vai buscar também os dados do user
        $dados = [];
        
        $dados['pedidos'] = $dados_tmp;

        ////////////////////////////////////////////////////
        // preparar as variáveis para enviar para a bd do pedido
        $dados_produtos = $produtos_do_pedido; // resultados que estava acima no foreach
        $contribuinte = 0;
        // ver se tem contribuinte
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['contribuinte'])){
               $contribuinte = $_POST['contribuinte'];
            }
        }else{
            $contribuinte = 0;
        }

        $dados_pedidos = [];
        $dados_pedidos['id_user'] = $_SESSION['id_user'];
        $dados_pedidos['mesa'] = $_SESSION['mesa'];
        $dados_pedidos['contribuinte'] =  $contribuinte;
        $dados_pedidos['estado'] =  'PENDENTE';
        $dados_pedidos['mensagem'] =  '';
        $dados_pedidos['conta'] =  $total_pedido;

        //statrus
        /*
        pendente      - pedido acabado de registar
        em tratamento - está a ser executado
        servida       - servida
        pago          - pedido que já foi pago
        cancelada     - cancelado
        */

        //________________________________________________
        // dados dos produtos do pedido
        //$produtos_do_pedido (nome_produto, preco)
        $dados_produtos = [];
        foreach ($produtos_do_pedido as $produto){
            $dados_produtos[] = [
                'id_produto' => $produto->id_produto,
                'designacao_produto' => $produto->nome_produto,
                'imagem' => $produto->imagem,
                'preco_unidade' => $produto->preco,
                'quantidade' => $_SESSION['pedidos'][$produto->id_produto],
            ];
        }

       

        // guardar na bd o pedido
        $pedido = new Pedidos_bd(); // buscar o model
        $pedido->guardar_pedido($dados_pedidos, $dados_produtos);

         // testes
    //   echo '<pre>';
    //   print_r($dados_pedidos);
    //   print_r($dados_produtos);

    //   echo '</pre>';
    //     die('Terminado');

        // print_r($dados_pedidos);
        // echo '////////////////////////////////////////////////////////////';
        // print_r($dados_produtos);
        // echo '////////////////////////////////////////////////////////////';
        // print_r($dados_tmp);
         // buscar os dados do user
        // $user = new Users();
        // $dados_user = $user->buscar_dados_user($_SESSION['user']);
        // $dados['user'] = $dados_user;

        // apresenta a página do resumo do pedido
        FastControl::Layout([
            'layouts/html_header',
            'layouts/header',
            'pedido_resumo',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);

        unset($_SESSION['pedidos']);

       // FastControl::printData($_SESSION);

    }

    //________________________________________________________//
    // ===========================================================
    // public function adicionar_retirar()
    // {

    //     // vai buscar o id_produto na query string
    //     $id_produto = $_GET['id_produto'];
    //     $quantidade = $_GET['quantidade'];
    //     $op = $_GET['op'];

    //     // buscar o carrinho à sessão
    //     $pedidos = $_SESSION['pedidos'];
    //     $pedidos[$id_produto] = $_GET['id_produto'];
    //     $pedidos[$quantidade] = $_GET['quantidade'];
    //     $pedidos[$op] = $_GET['op'];



    //     // apresentar novamente a página do carrinho
    //     $this->minha_mesa();
    // }
    //________________________________________________________//
    ////////////////////////////////////////////////////////////
    public function pedidos()
    {
        // apresenta a pagina dos pedidos pedidos

        FastControl::layout([
            'layouts/html_header',
            'layouts/header',
            'pedidos',
            'layouts/footer',
            'layouts/html_footer',

        ]);
    }
}// end of class



// Array   dados de cada produto
// (
//     [0] => stdClass Object
//         (
//             [id_produto] => 13
//             [categoria] => Cafetaria
//             [nome_produto] => cafe
//             [descricao] => cafe torrado marca delta 
//             [imagem] => cafe.jpg
//             [preco] => 0.80
//             [stock] => 100
//             [visivel] => 1
//             [created_at] => 
//             [updated_at] => 
//             [deleted_at] => 
//         )


// Array   quantidades
// (
//     [13] => 3
//     [16] => 2
//     [19] => 1
//     [18] => 1
// )