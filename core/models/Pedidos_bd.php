<?php

namespace core\models;

use core\classes\Database;
use core\classes\FastControl;

class Pedidos_bd
{
   
    public function guardar_pedido($dados_pedidos, $dados_produtos){
          /*
             1. guardar os dados do pedido
             2. buscar o id_pedido criado
             3. guardar os dados dos produtos 
          */

          $bd = new Database();

          //guardar os dados do pedido
          $parametros = [
              ':id_pedido'    => 0,
              ':id_user'      => $_SESSION['id_user'], // também poderia ser $dados_pedidos['id_user']
              ':mesa'         => $_SESSION['mesa'],       // também poderia ser $dados_pedidos['mesa']
              ':data_pedido' => date("Y-m-d H:i:s"),
              ':contribuinte' => $dados_pedidos['contribuinte'],
              ':estado'       => $dados_pedidos['estado'],
              ':mensagem'     => $dados_pedidos['mensagem'],
              ':conta'        => $dados_pedidos['conta'],
              ':created_at'   => date("Y-m-d H:i:s"),
              ':updated_at'   => date("Y-m-d H:i:s")
          ];
          $bd->insert("INSERT INTO rapidask_pedidos VALUES(
                    :id_pedido,
                    :id_user,
                    :mesa,
                    :data_pedido,
                    :contribuinte,
                    :estado,
                    :mensagem,
                    :conta,
                    :created_at,
                    :updated_at
                  )
          ", $parametros);

    

          // buscar o id id_pedido
             $id_pedido = $bd->select("SELECT MAX(id_pedido) id_pedido 
               FROM rapidask_pedidos")[0]->id_pedido;

        //guardar os dados do produto

        foreach ($dados_produtos as $produto) {
            $parametros = [
                ':id_pedido_produto'   => 0,
                ':id_pedido'           => $id_pedido,
                ':id_produto'          => $produto['id_produto'],
                ':designacao_produto'  => $produto['designacao_produto'],
                ':imagem'              => $produto['imagem'],
                ':preco_unidade'       => $produto['preco_unidade'],
                ':quantidade'          => $produto['quantidade'],
                ':created_at'          => date("Y-m-d H:i:s")
            ];
            $bd->insert("INSERT INTO rapidask_pedido_produto VALUES(
          :id_pedido_produto,
          :id_pedido,
          :id_produto,
          :designacao_produto,
          :imagem,
          :preco_unidade,
          :quantidade,
          :created_at
        )
", $parametros);
        }

    //               // testes
    //   echo '<pre>';
    //   echo '<br><br>id_pedido = '.$id_pedido ;
    //   print_r($dados_pedidos);
    //   print_r($dados_produtos);

      echo '</pre>';
    //     die('Terminado');
    }

     // ================================================================
     public function buscar_historico_pedidos($id_user)
     {
         // buscar o histório de encomendas do cliente = id_cliente
         $parametros = [
             ':id_user' => $id_user
         ];
 
         $bd = new Database();
         $resultados = $bd->select("
             SELECT *
             FROM rapidask_pedidos
             WHERE id_user = :id_user
             ORDER BY data_pedido DESC
         ", $parametros);
 
         return $resultados;
     }
 
     // ================================================================
     public function verificar_pedido_user($id_user, $id_pedido)
     {
         // verificar se a encomenda pertence ao cliente identificado
         $parametros = [
             ':id_user' => $id_user,
             ':id_pedido' => $id_pedido
         ];
 
         $bd = new Database();
         $resultado = $bd->select("
             SELECT id_pedido
             FROM rapidask_pedidos
             WHERE id_pedido = :id_pedido
             AND id_user = :id_user
         ", $parametros);
 
         return count($resultado) == 0 ? false : true;
     }
 
    //  // ================================================================
     public function detalhes_de_pedido($id_user, $id_pedido)
     {
         // vai buscar os dados da encomenda e a lista dos produtos do pedido
         $parametros = [
             ':id_user' => $id_user,
             ':id_pedido' => $id_pedido
         ];
 
         // dados do pedido
         $bd = new Database();
         $dados_pedido = $bd->select("
             SELECT *
             FROM rapidask_pedidos
             WHERE id_user = :id_user
             AND id_pedido = :id_pedido
         ", $parametros)[0];
 
         // dados da lista de produtos da encomenda
         $parametros = [
             ':id_pedido' => $id_pedido
         ];
 
         $produtos_pedido = $bd->select("
             SELECT *
             FROM rapidask_pedido_produto
             WHERE id_pedido = :id_pedido
         ", $parametros);
 
         // devolver ao controlador os dados do detalhe do pedido em array
         return [
             'dados_pedido' => $dados_pedido,
             'produtos_pedido' => $produtos_pedido
         ];
     }
 
    //  // ================================================================
     public function pagar_pedido($id_pedido)
     {
         $parametros = [
             ':id_pedido' => $id_pedido
         ];
 
         $bd = new Database();
         $resultado = $bd->select("
             SELECT * FROM rapidask_pedidos 
             WHERE id_pedido = :id_pedido 
             AND estado = 'PENDENTE'", $parametros);
 
         if(count($resultado) == 0){
             return false;
         }
 
         // efetuar a alteração do estado da encomenda indicada
         $bd->update("
             UPDATE rapidask_pedidos
             SET estado = 'PAGO',
             updated_at = NOW()
             WHERE id_pedido = :id_pedido
         ", $parametros);
 
         return true;
     }

}



?>