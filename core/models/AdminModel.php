<?php

namespace core\models;

use core\classes\Database;
use core\classes\FastControl;

class AdminModel
{

    // ===========================================================
    public function validar_login($usuario_admin, $senha)
    {

        // verificar se o login é válido
        $parametros = [
            ':usuario_admin' => $usuario_admin
        ];

        $bd = new Database();
        $resultados = $bd->select("
            SELECT * FROM rapidask_admins 
            WHERE utilizador = :usuario_admin 
            AND deleted_at IS NULL
        ", $parametros);

        if (count($resultados) != 1) {
            // não existe usuário admin
            return false;
        } else {

            // temos usuário admin. Vamos ver a sua password
            $usuario_admin = $resultados[0];

            // verificar a password
            if (!password_verify($senha, $usuario_admin->password)) {

                // password inválida
                return false;
            } else {

                // login válido
                return $usuario_admin;
            }
        }
    }

    // ===========================================================
    // produtos
    // ===========================================================
    // public function lista_produtos()
    // {
    //     // vai buscar todos os clientes registados na base de dados
    //     $bd = new Database();
    //     $resultados = $bd->select("
    //         SELECT *, COUNT(rapidask_pedido_produto.id_produto) total_vendidos
    //         FROM rapidask_produtos LEFT JOIN rapidask_pedido_produto
    //        ON rapidask_produtos.id_produto = rapidask_pedido_produto.id_produto
    //     ");
    //     return $resultados;
    // }


     public function lista_produtos()
    {
        // vai buscar todos os produtos que já forma vendidos e os seus socks 
        $bd = new Database();
        $resultados = $bd->select("
            SELECT *, SUM(pp.quantidade) as total_vendidos,
            stock - SUM(pp.quantidade) as stock_atual
            FROM rapidask_produtos p
            JOIN rapidask_pedido_produto pp
            ON p.id_produto = pp.id_produto
            GROUP BY p.nome_produto;
        ");
        return $resultados;
    }

    public function lista_todos_produtos()
    {
        // vai buscar todos os produtos
        $bd = new Database();
        $resultados = $bd->select("
            SELECT * FROM rapidask_produtos 
            GROUP BY nome_produto;
        ");
        return $resultados;
    }

    // public function lista_produtos()
    // {
    //     // vai buscar todos os clientes registados na base de dados
    //     $bd = new Database();
    //     $resultados = $bd->select("
    //         SELECT 
    //             rapidask_produtos.id_produto,
    //             rapidask_produtos.categoria,
    //             rapidask_produtos.nome_produto,
    //             rapidask_produtos.descricao,
    //             rapidask_produtos.imagem,
    //             rapidask_produtos.preco,
    //             rapidask_produtos.stock,
    //             rapidask_produtos.validade,
    //             rapidask_produtos.created_at,
    //         COUNT(rapidask_pedido_produto.id_produto) total_vendidos
    //         FROM rapidask_produtos LEFT JOIN rapidask_pedido_produto
    //         ON rapidask_produtos.id_produto = rapidask_pedido_produto.id_produto
    //         GROUP BY rapidask_produto.id_produto
    //     ");
    //     return $resultados;
    // }

    // ===========================================================
    public function buscar_produto($id_produto)
    {
        $parametros = [
            'id_produto' => $id_produto
        ];

        $bd = new Database();
        $resultados = $bd->select("
                SELECT 
                    *
                FROM rapidask_produtos 
                WHERE id_produto = :id_produto
            ", $parametros);
        return $resultados[0];
    }

      // ===========================================================
      public function verificar_produto($nome_produto)
      { // verificar se produto já existe para não inserir repetido
          $parametros = [
              'nome_produto' => $nome_produto
          ];
  
          $bd = new Database();
          $resultados = $bd->select("
                  SELECT * FROM rapidask_produtos 
                  WHERE nome_produto = :nome_produto
              ", $parametros);
          return $resultados[0];
      }


       // _________________________________________________________________ //
    ///////////////////////////////////////////////////////////////////////
  public function inserir_produto(){

    //produto pronto para ser inserido na bd
    $bd = new Database();

      $parametros = [
         ':categoria' => trim($_POST['text_categoria']),
         ':nome'      => trim($_POST['text_nome']),
         ':descricao' => trim($_POST['text_descricao']),
         ':imagem'    => $_FILES['text_imagem']['name'],
         ':preco'     => trim($_POST['text_preco']),
         ':stock'     => trim($_POST['text_stock']),
         ':visivel'   => 1,
         ':validade'  => $_POST['text_validade']
         // ':created_at'    => 0,
         // ':updated_at'    => 0,
         // ':deleted_at'    => 0,
  
       ];

      $bd->insert("
        INSERT INTO rapidask_produtos VALUES(
             0,
            :categoria,     
            :nome,    
            :descricao,    
            :imagem,
            :preco,
            :stock,     
            :visivel,   
            :validade,   
             NOW(),
             NOW(),
             NULL

         )
        ", $parametros);
        return $bd != false ? true : false;
     }
  

    // ===========================================================
    public function total_pedido_produto($id_produto)
    {
        $parametros = [
            'id_produto' => $id_produto
        ];
        $bd = new Database();
        return $bd->select("
            SELECT COUNT(*) total 
            FROM rapidask_pedidos 
            WHERE id_produto = :id_produto
        ", $parametros)[0]->total;
    }

    // ===========================================================
    public function buscar_encomendas_cliente($id_cliente)
    {
        // buscar todas as encomendas do cliente indicado
        $parametros = [
            ':id_cliente' => $id_cliente
        ];
        $bd = new Database();
        return $bd->select("
            SELECT * FROM encomendas WHERE id_cliente = :id_cliente
        ", $parametros);
    }



    // ===========================================================
    // ENCOMENDAS
    // ===========================================================
    public function total_pedidos_pendentes()
    {
        $hoje = date('Y-m-d');
        // vai buscar a quantidade de pedidos pendentes
        $bd = new Database();
        $resultados = $bd->select("
            SELECT COUNT(*) total FROM rapidask_pedidos
            WHERE estado = 'PENDENTE' AND updated_at LIKE '$hoje%'
        ");
        return $resultados[0]->total;
    }

    // ===========================================================
    public function total_pedidos_pagos()
    {
        $hoje = date('Y-m-d');
        // vai buscar a quantidade de pedidos em processamento
        $bd = new Database();//COUNT(*) total nova coluna total, alíase como as total
        $resultados = $bd->select("
            SELECT updated_at, COUNT(*) total FROM rapidask_pedidos
            WHERE estado = 'PAGO' AND updated_at LIKE '$hoje%'
        ");
        return $resultados[0]->total;
    }

    // ===========================================================
    public function lista_pedidos($filtro, $id_user)
    {
        $hoje = date('Y-m-d');
        $bd = new Database();// WHERE 1 dá sempre verdadeiro para obrigar a passar para ler o AND
        $sql = "SELECT p.*, u.user, u.telemovel FROM rapidask_pedidos p LEFT JOIN rapidask_users u ON p.id_user = u.id_user WHERE 1";
        if ($filtro != '') {
            $sql .= " AND p.estado = '$filtro'";
        }
        if(!empty($id_user)){
            $sql .= " AND p.id_user = $id_user";
        }
        $sql .= " AND p.data_pedido LIKE '$hoje%'";
        $sql .= " ORDER BY p.id_pedido DESC";
        return $bd->select($sql);
    }

     
          // ===========================================================
      public function lista_todos_pedidos()
      {
        $bd = new Database();
        $resultados = $bd->select("
            SELECT p.*,  u.user
            FROM rapidask_pedidos p
            LEFT JOIN rapidask_users u
            ON p.id_user = u.id_user;
            GROUP BY p.id_pedido;
        ");
        return $resultados;
      }

      

    // ===========================================================
    public function buscar_detalhes_pedido($id_pedido)
    {
        // vai buscar os detalhes de uma encomenda
        $bd = new Database();

        $parametros = [
            ':id_pedido' => $id_pedido
        ];

        // buscar os dados da encomenda
        $dados_pedido = $bd->select("
            SELECT rapidask_users.user, rapidask_pedidos.* 
            FROM rapidask_users, rapidask_pedidos 
            WHERE rapidask_pedidos.id_pedido = :id_pedido
            AND rapidask_pedidos.id_user = rapidask_users.id_user
            ", $parametros);

        // lista de produtos da encomenda
        $lista_produtos = $bd->select("
            SELECT * 
            FROM rapidask_pedido_produto 
            WHERE id_pedido = :id_pedido", $parametros);
            
        return [
            'pedido' => $dados_pedido[0],
            'lista_produtos' => $lista_produtos
        ];

    }

    // ===========================================================
    public function atualizar_status_encomenda($id_encomenda, $estado)
    {
        // atualizar o estado da encomenda
        $bd = new Database();

        $parametros = [
            ':id_encomenda' => $id_encomenda,
            ':status' => $estado
        ];

        $bd->update("
            UPDATE encomendas
            SET
                status = :status,
                updated_at = NOW()
            WHERE id_encomenda = :id_encomenda
        ", $parametros);
    }
}
