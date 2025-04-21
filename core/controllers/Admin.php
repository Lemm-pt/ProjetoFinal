<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\PDF;
use core\classes\FastControl;
use core\models\AdminModel;

class admin
{
    // ===========================================================
    // usuário admin: lubiomarona@gmail.com
    // senha:         123456
    // ===========================================================
    public function index()
    { 

      
        // // verifica se já existe sessão aberta (admin)
        if (!FastControl::adminLogado()) {
            FastControl::redirect('admin_login', true);
            return;
        }

        // // verificar se existem pedidos em estado PENDENTE
        //para retornar para o inicio admin
        $ADMIN = new AdminModel();
        $total_pedidos_pendentes = $ADMIN->total_pedidos_pendentes();
        $total_pedidos_pagos = $ADMIN->total_pedidos_pagos();

        // echo $total_pedidos_pendentes . "<br>";
        // echo $total_pedidos_pagos;
        // die();
        $data = [
            'total_pedidos_pendentes' => $total_pedidos_pendentes,
            'total_pedidos_pagos' => $total_pedidos_pagos
        ];

        // // já existe um admin logado
        FastControl::Layout_admin([
            'admin/layouts/html_header',
            'admin/layouts/header',
            'admin/home',
            'admin/layouts/footer',
            'admin/layouts/html_footer',
        ], $data);
    }


    // ===========================================================
    // AUTENTICAÇÃO
    // ===========================================================
    public function admin_login()
    {
        // se já está logado redireciona para o index do admin
        if (FastControl::adminLogado()) {
            FastControl::redirect('inicio', true);
            return;
        }

        // // apresenta o quadro de login
        FastControl::Layout_admin([
            'admin/layouts/html_header',
            'admin/layouts/header',
            'admin/login_frm',
            'admin/layouts/footer',
            'admin/layouts/html_footer',
        ]);
    }

//     // ===========================================================
    public function admin_login_submit()
    {
        // verifica se já existe um utilizador logado
        if (FastControl::adminLogado()) {
            FastControl::redirect('inicio', true);
            return;
        }

        // verifica se foi efetuado o post do formulário de login do admin
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            FastControl::redirect('inicio', true);
            return;
        }

        // validar se os campos vieram corretamente preenchidos
        if (
            !isset($_POST['text_admin']) ||
            !isset($_POST['text_senha']) ||
            !filter_var(trim($_POST['text_admin']), FILTER_VALIDATE_EMAIL)
        ) {
            // erro de preenchimento do formulário
            $_SESSION['erro'] = 'Login inválido';
            FastControl::redirect('admin_login', true);
            return;
        }

        // prepara os dados para o model
        $admin = trim(strtolower($_POST['text_admin']));
        $senha = trim($_POST['text_senha']);

        // carrega o model e verifica se login é válido
        $admin_model = new AdminModel();
        $resultado = $admin_model->validar_login($admin, $senha);

        // analisa o resultado
        if (is_bool($resultado)) {

            // login inválido
            $_SESSION['erro'] = 'Login inválido';
            FastControl::redirect('login', true);
            return;
        } else {

            // login válido. Coloca os dados na sessão do admin
            $_SESSION['admin'] = $resultado->id_admin;
            $_SESSION['admin_usuario'] = $resultado->utilizador;

            // redirecionar para a página inicial do backoffice
            FastControl::redirect('inicio', true);
        }
    }

//     // ===========================================================
    public function admin_logout()
    {

        // faz o logout do admin da sessão
        unset($_SESSION['admin']);
        unset($_SESSION['admin_usuario']);

        // redirecionar para o início
        FastControl::redirect('inicio', true);
    }




//     // ===========================================================
//     // produtos já vendidos
//     // ===========================================================
    public function lista_produtos()
    {
        // verifica se existe um admin logado
        if (!FastControl::adminLogado()) {
            FastControl::redirect('inicio', true);
            return;
        }

        // vai buscar a lista de clientes
        $ADMIN = new AdminModel();
        $produtos = $ADMIN->lista_produtos();
        $data = [
            'produtos' => $produtos
        ];

        // apresenta a página da lista de clientes
        FastControl::Layout_admin([
            'admin/layouts/html_header',
            'admin/layouts/header',
            'admin/lista_produtos',
            'admin/layouts/footer',
            'admin/layouts/html_footer',
        ], $data);
    }

     // ===========================================================
     //  todos os produtos inserirdos
    // ===========================================================
public function lista_todos_produtos()
{
    // verifica se existe um admin logado
    if (!FastControl::adminLogado()) {
        FastControl::redirect('inicio', true);
        return;
    }

    // vai buscar a lista de clientes
    $ADMIN = new AdminModel();
    $produtos = $ADMIN->lista_todos_produtos();
    $data = [
        'produtos' => $produtos
    ];

    // apresenta a página da lista de clientes
    FastControl::Layout_admin([
        'admin/layouts/html_header',
        'admin/layouts/header',
        'admin/lista_todos_produtos',
        'admin/layouts/footer',
        'admin/layouts/html_footer',
    ], $data);
}

//     // ===========================================================
    public function detalhe_produto()
    {
        // verifica se existe um admin logado
        if (!FastControl::adminLogado()) {
            FastControl::redirect('inicio', true);
            return;
        }

        // verifica se existe um id_produto na query string
        if (!isset($_GET['p'])) {
            FastControl::redirect('inicio', true);
            return;
        }

        $id_produto = FastControl::aesDesencriptar($_GET['p']);
        // verifica se o id_produto é válido
        if (empty($id_produto)) {
            FastControl::redirect('inicio', true);
            return;
        }

        // buscar os dados do cliente
        $ADMIN = new AdminModel();
        $data = [
            'dados_produto' => $ADMIN->buscar_produto($id_produto),
            'total_pedidos' => $ADMIN->total_pedido_produto($id_produto)
        ];

        // apresenta a página das encomendas
        FastControl::Layout_admin([
            'admin/layouts/html_header',
            'admin/layouts/header',
            'admin/detalhe_produto',
            'admin/layouts/footer',
            'admin/layouts/html_footer',
        ], $data);
    }

//     // ===========================================================
//     public function cliente_historico_encomendas()
//     {
//         // verifica se existe um admin logado
//         if (!FastControl::adminLogado()) {
//             FastControl::redirect('inicio', true);
//             return;
//         }

//         // verifica se existe o id_cliente encriptado
//         if (!isset($_GET['c'])) {
//             FastControl::redirect('inicio', true);
//         }

//         // definir o id_cliente que vem encriptado
//         $id_cliente = FastControl::aesDesencriptar($_GET['c']);
//         $ADMIN = new AdminModel();

//         $data = [
//             'cliente' => $ADMIN->buscar_cliente($id_cliente),
//             'lista_encomendas' => $ADMIN->buscar_encomendas_cliente($id_cliente)
//         ];

//         // apresenta a página das encomendas
//         FastControl::Layout_admin([
//             'admin/layouts/html_header',
//             'admin/layouts/header',
//             'admin/lista_encomendas_cliente',
//             'admin/layouts/footer',
//             'admin/layouts/html_footer',
//         ], $data);
//     }


//     // ===========================================================
//     // Pedidos
//     // ===========================================================
    public function lista_pedidos()
    {
        // verifica se existe um admin logado
        if (!FastControl::adminLogado()) {
            FastControl::redirect('inicio', true);
            return;
        }

        // apresenta a lista de encomendas (usando filtro se for o caso)
        // verifica se existe um filtro da query string
        $filtros = [
            'pendente' => 'PENDENTE',
            'pago' => 'PAGO',
            'cancelado' => 'CANCELADO',
            // 'enviada' => 'ENVIADA',
            // 'concluida' => 'CONCLUIDA',
        ];

        $filtro = '';
        if (isset($_GET['f'])) {

            // verifica se a variável é uma key dos filtros
            if (key_exists($_GET['f'], $filtros)) {
                $filtro = $filtros[$_GET['f']];
            }
        }

        // vai buscar o id user se existir na query string
        $id_user = null;
        if(isset($_GET['u'])){
            $id_user = FastControl::aesDesencriptar($_GET['u']);
        }

        // carregar a lista de pedidos
        $admin_model = new AdminModel();
        $lista_pedidos = $admin_model->lista_pedidos($filtro, $id_user);

        $data = [
            'lista_pedidos' => $lista_pedidos,
            'filtro' => $filtro
        ];

        // apresenta a página dos pedidos
        FastControl::Layout_admin([
            'admin/layouts/html_header',
            'admin/layouts/header',
            'admin/lista_pedidos',
            'admin/layouts/footer',
            'admin/layouts/html_footer',
        ], $data);
    }


    // ===========================================================
//     // todos os Pedidos
//     // ===========================================================
    public function lista_todos_pedidos()
    {
        // verifica se existe um admin logado
        if (!FastControl::adminLogado()) {
            FastControl::redirect('inicio', true);
            return;
        }

        // carregar a lista de pedidos
        $admin_model = new AdminModel();
        $lista_todos_pedidos = $admin_model->lista_todos_pedidos();

        $data = [
            'lista_todos_pedidos' => $lista_todos_pedidos
        ];

        // apresenta a página dos pedidos
        FastControl::Layout_admin([
            'admin/layouts/html_header',
            'admin/layouts/header',
            'admin/lista_todos_pedidos',
            'admin/layouts/footer',
            'admin/layouts/html_footer',
        ], $data);
    }

//     // ===========================================================
    public function detalhe_pedido()
    {
        // verifica se existe um admin logado
        if (!FastControl::adminLogado()) {
            FastControl::redirect('inicio', true);
            return;
        }

        //buscar o id_encomenda
        $id_pedido = null;
        if (isset($_GET['p'])) {
            $id_pedido = FastControl::aesDesencriptar($_GET['p']);
        }
        if (gettype($id_pedido) != 'string') {
            FastControl::redirect('inicio', true);
            return;
        }

        //carregar os dados da encomenda selecionada
        $admin_model = new AdminModel();
        $pedido = $admin_model->buscar_detalhes_pedido($id_pedido);

        //apresentar os dados por forma a poder ver os detalhes e alterar o seu status
        $data = $pedido;
        FastControl::Layout_admin([
            'admin/layouts/html_header',
            'admin/layouts/header',
            'admin/pedido_detalhe',
            'admin/layouts/footer',
            'admin/layouts/html_footer',
        ], $data);
    }

//     // ===========================================================
//     public function encomenda_alterar_estado()
//     {
//         // verifica se existe um admin logado
//         if (!FastControl::adminLogado()) {
//             FastControl::redirect('inicio', true);
//             return;
//         }

//         //buscar o id_encomenda
//         $id_encomenda = null;
//         if (isset($_GET['e'])) {
//             $id_encomenda = FastControl::aesDesencriptar($_GET['e']);
//         }
//         if (gettype($id_encomenda) != 'string') {
//             FastControl::redirect('inicio', true);
//             return;
//         }

//         // buscar o novo estado
//         $estado = null;
//         if (isset($_GET['s'])) {
//             $estado = $_GET['s'];
//         }
//         if (!in_array($estado, STATUS)) {
//             FastControl::redirect('inicio', true);
//             return;
//         }

//         // regras de negócio para gerir a encomenda (novo estado)

//         // atualizar o estado da encomenda na base de dados
//         $admin_model = new AdminModel();
//         $admin_model->atualizar_status_encomenda($id_encomenda, $estado);

//         // executar operações baseadas no novo estado
//         switch ($estado) {
//             case 'PENDENTE':
//                 // não existem ações
//                 $this->operacao_notificar_cliente_mudanca_estado($id_encomenda);
//                 break;

//             case 'EM PROCESSAMENTO':
//                 // não existem ações
//                 break;

//             case 'ENVIADA':
//                 // enviar um email com a notificação ao cliente sobre o envio da encomenda
//                 $this->operacao_notificar_cliente_mudanca_estado($id_encomenda);
//                 $this->operacao_enviar_email_encomenda_enviada($id_encomenda);

//                 break;

//             case 'CANCELADA':
//                 $this->operacao_notificar_cliente_mudanca_estado($id_encomenda);
//                 break;

//             case 'CONCLUIDA':
//                 $this->operacao_notificar_cliente_mudanca_estado($id_encomenda);
//                 break;
//         }

//         // redireciona para a página da própria encomenda
//         FastControl::redirect('detalhe_encomenda&e='.$_GET['e'], true);
//     }


//     // ===========================================================
//     // OPERAÇÕES APÓS MUDANÇA DE ESTADO
//     // ===========================================================
    
//     public function operacao_notificar_cliente_mudanca_estado($id_encomenda)
//     {
//         // vai enviar um email para o cliente indicando que a encomenda sofreu alterações
//     }

//     // ===========================================================
//     private function operacao_enviar_email_encomenda_enviada($id_encomenda)
//     {
//         // executar as operações para enviar email ao cliente.
//     }

//     // ===========================================================
//     public function criar_pdf_encomenda()
//     {
//         // verifica se existe um admin logado
//         if (!FastControl::adminLogado()) {
//             FastControl::redirect('inicio', true);
//             return;
//         }

//         //buscar o id_encomenda
//         $id_encomenda = null;
//         if (isset($_GET['e'])) {
//             $id_encomenda = FastControl::aesDesencriptar($_GET['e']);
//         }
//         if (gettype($id_encomenda) != 'string') {
//             FastControl::redirect('inicio', true);
//             return;
//         }

//         // vai buscar os dados da encomenda
//         $id_encomenda = FastControl::aesDesencriptar($_GET['e']);
//         $admin_model = new AdminModel();
//         $encomenda = $admin_model->buscar_detalhes_encomenda($id_encomenda);
        
//         // buscar dados do cliente
//         // Store::printData($encomenda);

//         // criar o PDF com os detalhes da encomenda

//         $pdf = new PDF();
//         $pdf->set_template(getcwd() . '/assets/templates_pdf/template.pdf');
//         $pdf->apresentar_pdf();
        
//     }



  //________________________________________________________//
   ////////////////////////////////////////////////////////////
   public function novo_produto(){
    // apresenta o layout para criar um novo produto

    // verifica se existe um admin logado
    if (!FastControl::adminLogado()) {
        FastControl::redirect('inicio', true);
        return;
    }

    // apresenta a página das encomendas
    FastControl::Layout_admin([
        'admin/layouts/html_header',
        'admin/layouts/header',
        'admin/novo_produto',
        'admin/layouts/footer',
        'admin/layouts/html_footer',
    ]);
 }


 //________________________________________________________//
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function inserir_produto(){

    ///////// testes ///////////
    //     echo '<pre>';
    //    print_r($_FILES);
    //    echo '</pre>';
 // verifica se existe um admin logado
   if (!FastControl::adminLogado()) {
      FastControl::redirect('inicio', true);
       return;
   }

    //verifica se houve submissão de formulário, para que ninguém entre por a url
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
       $this->index(); 
       return; 
    }

    // trata a imagem

    if(isset($_FILES["text_imagem"])) {
        $arquivo = $_FILES["text_imagem"];
    //   echo $arquivo['name'];
    //     // Verifica se o arquivo é uma imagem
    //     $tipo = mime_content_type($arquivo["tmp_name"]);
    //     if($tipo != "image/jpeg" && $tipo != "image/png" && $tipo != "image/gif") {
    //       die("Erro: arquivo enviado não é uma imagem.");
    //     }
      
        //Define o caminho onde o arquivo será salvo
       $caminho = "../assets/images/produtos/" . basename($arquivo["name"]);

       // Move o arquivo para a pasta de destino
        if(move_uploaded_file($arquivo["tmp_name"], $caminho)) {
          echo "Arquivo enviado com sucesso!";
        } else {
          echo "Erro ao enviar arquivo.";

       // move_uploaded_file($arquivo['tmp_name'], 'images/' . $arquivo['name']);
        }
      }
    // criação de novo produto


    //verifica se na db se o produto já está registado
    $produto = new AdminModel(); // buscar no models
    if ($produto->verificar_produto($_POST['text_nome'])) {
       $_SESSION['erro'] = '<i class="bi bi-exclamation-triangle"></i> Este nome já se encontra registado!';
       $_SESSION['cor_erro'] = 'danger';
       $this->novo_produto(); //retorna ao formulário através da função acima novo_produto
       return;
    }else{
        //produto pronto para ser inserido na bd
        $data = $produto->inserir_produto();
        if($data){
           $_SESSION['erro'] = '<i class="bi bi-check"></i> Produto inserido com sucesso';
           $_SESSION['cor_erro'] = 'success';
           $this->novo_produto(); //retorna ao formulário através da função acima novo_produto
        }
    }

    
 }

 }


?>