<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\FastControl;
use core\models\Products;
use core\models\Users;
use core\models\Pedidos_bd;

class Main
{

   //________________________________________________________//
   ////////////////////////////////////////////////////////////
   public function index(){

      //  TESTES
      //  $_SESSION['user'] = 'Luciano';
      //  $email = new EnviarEmail();
      //  $email->send_user_email_confirmation();
      //die('OK');

      FastControl::layout([
         'layouts/html_header',
         'layouts/header',
         'starting_page',
         'layouts/footer',
         'layouts/html_footer',

      ]);
   }


   //________________________________________________________//
   ////////////////////////////////////////////////////////////
   public function new_user(){
      // apresenta o layout para criar um novo user

      //verifica se já existe sessão aberta
      if (FastControl::userLogado()) {
         $this->index(); // se está logado vai para o index acima
         return; // para o restante codigo não seja lido
      }

      ///////////  testes  ////////////
      //  $_SESSION['user'] = 'Luciano ';
      //  die('OK');

      FastControl::layout([
         'layouts/html_header',
         'layouts/header',
         'new_user',
         'layouts/footer',
         'layouts/html_footer',

      ]);
   }


   //________________________________________________________//
   ///////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function user_create(){

      ///////// testes ///////////
      //     echo '<pre>';
      //    print_r($_POST);
      /*
      1. verificar se as senhas conciendem
      2. base de dados - já existe outra conta com o mesmo email
      3. registo do user na bd:
         criar um purl
         guardar os dados na tabela rapidask_users
         enviar um email com o purl para o user
         apresentar uma mensagem indicando que deve validar conta
      */

      //verifica se já existe sessão aberta
      if (FastControl::userLogado()) {
         $this->index(); // se está logado vai para o index acima
         return; // para o restante codigo não seja lido
      }

      //verifica se houve submissão de formulário, para que ninguém entre por a url
      if ($_SERVER['REQUEST_METHOD'] != 'POST') {
         $this->index(); // se está logado vai para o index acima
         return; // para o restante codigo não seja lido
      }

      // criação de novo user

      //verifica se as senhas são iguais
      if ($_POST['text_senha_1'] != $_POST['text_senha_2']) {
         $_SESSION['erro'] = '<i class="bi bi-exclamation-triangle-fill h2"></i> Palavras-passe não coenncidem!';
         $_SESSION['cor_erro'] = 'danger';
         $_SESSION['face'] = 'frown';
         $this->new_user(); //retorna ao formulário através da função acima new_user
         return;
      }

      //verifica se na db existe outra conta com o mesmo email já registado
      $user = new Users(); // buscar no models
      if ($user->verify_repeat_email($_POST['text_email'])) {
         $_SESSION['erro'] = '<i class="bi bi-exclamation-triangle-fill h2"></i> Este email já está registado!';
         $_SESSION['cor_erro'] = 'danger';
         $_SESSION['face'] = 'frown';
         $this->new_user(); //retorna ao formulário através da função acima new_user
         return;
      }

      //user pronto para ser inserido na bd
      // vai ao model inserir o user na bd e devolve o purl
      $purl = $user->user_insert();

      //envio de email para o user para confirmar conta
      $email = new EnviarEmail();
      $email_user = strtolower(trim($_POST['text_email']));
      $resultado = $email->send_user_email_confirmation($email_user, $purl);
      if ($resultado) {
         // inserido com sucesso
         $_SESSION['erro'] = 'Registado com sucesso';
         $_SESSION['cor_erro'] = 'success';
         $_SESSION['face'] = 'smile';
         FastControl::layout([
            'layouts/html_header',
            'layouts/header',
            'new_user_success',
            'layouts/footer',
            'layouts/html_footer',
         ]);

         return;
         
      
      } else {
         echo '<p class="text-danger"><i class="bi bi-exclamation-triangle-fill h2"></i> Problema no envio do email</p>';
         return;
      }
   }

   //________________________________________________________//
   //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function confirm_email(){

      //verifica se já existe sessão aberta
      if (FastControl::userLogado()) {
         $this->index(); // se está logado vai para o index acima
         return; // para o restante codigo não seja lido
      }

      //verifica se a url tem purl, pode ser que alguém altera propositadamente a URL
      if (!isset($_GET['purl'])) {
         $this->index(); // se não há purl vai para o index acima
         return; // para o restante codigo não seja lido
      }

      //verifica se o purl é válido
      $purl = $_GET['purl'];
      if (strlen($_GET['purl']) != 12) {
         $this->index(); // cumprimento errado do purl vai para o index acima
         return; // para o restante codigo não seja lido
      }

      /*
   1. conectar à bd
   2. pesquisar a existência de um cliente com o purl indicado
   3. não existe errorexiste
        a. remover o purl do cliente
        b. ativar ativo = 1
        c. apresentar mensagem de registo concluído com sucesso
    */
      $user = new Users(); // ativar o model
      $resultado = $user->email_valid($purl); // correr a função para validar o purl
      if ($resultado) {
          // email validado com sucesso
          $_SESSION['erro'] = 'Validado com sucesso';
          $_SESSION['cor_erro'] = 'success';
          $_SESSION['face'] = 'smile';
          FastControl::layout([
             'layouts/html_header',
             'layouts/header',
             'new_user_success_email',
             'layouts/footer',
             'layouts/html_footer',
          ]);
 
          return;
      } else {
         //redirecuinar para a pagina inicial
            FastControl::redirect('already_valided');
      }
   }


    //________________________________________________________//
   //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function login() {

      // verificar se já existe um user logado para não mostrar o quadro de login quando este tá logado
      if(FastControl::userLogado()){
         FastControl::redirect();// vai para a página principal
         return;
      }

      FastControl::layout([
         'layouts/html_header',
         'layouts/header',
         'login_frm',
         'layouts/footer',
         'layouts/html_footer',

      ]);
   }


     //________________________________________________________//
   //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     // ===========================================================
     public function login_submit()
     {
 
         // verifica se já existe um utilizador logado
         if (FastControl::userLogado()) {
            FastControl::redirect();
             return;
         }
 
         // verifica se foi efetuado o post do formulário de login
         if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            FastControl::redirect();
             return;
         }
 
         // validar se os campos vieram corretamente preenchidos
         if (
             !isset($_POST['text_email']) ||
             !isset($_POST['text_senha']) ||
             !filter_var(trim($_POST['text_email']), FILTER_VALIDATE_EMAIL)
         ) {
             // erro de preenchimento do email
             $_SESSION['erro'] = 'Campo de email vazio';
             $_SESSION['cor_erro'] = 'danger';
             $_SESSION['face'] = 'frown';
             FastControl::redirect('login');
             return;
         }

         if ( !isset($_POST['text_senha']) ) {
            // erro de preenchimento da senha
            $_SESSION['erro'] = 'Campo de palavra-passe vazio';
            $_SESSION['cor_erro'] = 'danger';
            $_SESSION['face'] = 'frown';
            FastControl::redirect('login');
            return;
        }
 
         // prepara os dados para o model
         $email = trim(strtolower($_POST['text_email']));
         $senha = trim($_POST['text_senha']);
 
         // carrega o model e verifica se login é válido
         $user = new Users();
         $resultado = $user->login_validation($email, $senha);
 
         // analisa o resultado
         if(is_bool($resultado)){
          
             // login inválido
             $_SESSION['erro'] = 'Login inválido';
             $_SESSION['cor_erro'] = 'danger';
             $_SESSION['face'] = 'frown';
             FastControl::redirect('login');
             return;
 
         } else {
             //  // login válido coloca os dados na sessão
            $_SESSION['id_user'] = $resultado->id_user;
            $_SESSION['user']    = $resultado->user;
            $_SESSION['email']   = $resultado->email;
            
 
                 // redirectionamento para a ementa
                 if(isset($_SESSION['tmp_pedido'])){
                    // remove a variável temporária da sessão
                    unset($_SESSION['tmp_pedido']);
                     // redirectionamento para o resumo do pedido
                    FastControl::redirect('finalizar_pedido_resumo');
                 }else{
                    FastControl::redirect();
                 }
              
             
         }
     }
 
     // ===========================================================
     public function logout(){
 
         // remove as variáveis da sessão
         unset($_SESSION['id_user']);
         unset($_SESSION['user']);
         unset($_SESSION['email']);
 
         // redireciona para o início da loja
         FastControl::redirect();
     }
   //________________________________________________________//
   //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function menu()
   {
      // apresenta a pagina da ementa

      //buscar a lista de produtos disponiveis
           $products = new Products(); // buscar do models
           $category = 'tudo';
           //analisa que categoria mostrar
           if(isset($_GET['c'])){
            $category = $_GET['c'];
           }
           $products_list = $products->availableProductsLlist($category);
           $categories_list = $products->categoryList();

         // teste para ver produtos  FastControl::printData($products_list);

         $data = [
            'products'   => $products_list,
            'categories' => $categories_list,
         ];

      FastControl::layout([
         'layouts/html_header',
         'layouts/header',
         'menu',
         'layouts/footer',
         'layouts/html_footer',

      ], $data);
   }

   // =============================================================================
   // perfil do user
   // =============================================================================
   public function perfil(){

    // verifica se existe um utilizador logado
    if(!FastControl::userLogado()) {
        FastControl::redirect();
        return;
    }

 

    // // buscar informações do client
    $user = new Users();
    $dtemp = $user->buscar_dados_user($_SESSION['id_user']);
    
    $dados_user = [
        'Email' => $dtemp->email,
        'Nome user' => $dtemp->user,
        'Localidade' => $dtemp->localidade,
        'Telemovel' => $dtemp->telemovel,
        // a partir daqui pode se adicionar novos campos que não estejam na bd como:
        //'contribuinte' => '445577777',
    ];

    $dados = [
        'dados_user' => $dados_user
    ];
    // print_r($dados);

    //apresentação da página de perfil
    FastControl::Layout([
        'layouts/html_header',
        'layouts/header',
        'perfil_navegacao',
        'perfil',
        'layouts/footer',
        'layouts/html_footer',
    ], $dados);

}


 // ===========================================================
 public function alterar_dados_pessoais()
 {
     // verifica se existe um utilizador logado
     if(!FastControl::userLogado()) {
        FastControl::redirect();
         return;
     }

     // vai buscar os dados pessoais
     $user = new Users();
     $dados = [
         'dados_pessoais' => $user->buscar_dados_user($_SESSION['id_user'])
     ];

     // apresentação da página de perfil
     FastControl::Layout([
         'layouts/html_header',
         'layouts/header',
         'perfil_navegacao',
         'alterar_dados_pessoais',
         'layouts/footer',
         'layouts/html_footer',
     ], $dados);
 }



   // ===========================================================
   public function alterar_dados_pessoais_submit()
   {
       // verifica se existe um utilizador logado
       if(!FastControl::userLogado()) {
        FastControl::redirect();
           return;
       }

       // verifica se existiu submissão de formulário para impedir que se chegue aqui sem login
       if($_SERVER['REQUEST_METHOD'] != 'POST'){
        FastControl::redirect();
           return;
       }

       // validar dados vindo dom form da view alterar_dados_pessoais
       $email = trim(strtolower($_POST['text_email'])); // trim remove espaços atrás ou à frente
       $nome = trim($_POST['text_nome']);
       $localidade = trim($_POST['text_localidade']);
       $telemovel = trim($_POST['text_telemovel']);

       // validar se é email válido
       if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ // filter_var função que verifica se email é válido
           $_SESSION['erro'] = "Endereço de email inválido.";
           $this->alterar_dados_pessoais(); // retorna à view do form e mostra o erro
           return;
       }

       // validar rapidamente os restantes campos
       if(empty($nome) || empty($localidade) || empty($email)){
           $_SESSION['erro'] = "Preencha corretamente o formulário.";
           $this->alterar_dados_pessoais();// retorna à view do form e mostra o erro
           return;
       }

       // validar se este email já existe noutra conta do user
       $user = new Users();
       $existe_noutra_conta = $user->verificar_se_email_existe_noutra_conta($_SESSION['id_user'], $email);
       if($existe_noutra_conta){
           $_SESSION['erro'] = "O email já se encontra registado.";
           $this->alterar_dados_pessoais();// retorna à view do form e mostra o erro
           return;
       }

      // atualizar os dados do cliente na base de dados
      $user->atualizar_dados_cliente($email, $nome, $localidade, $telemovel);
  
       // atualizar os dados do cliente na sessao
       $_SESSION['email'] = $email;
       $_SESSION['user'] = $nome; 

       // redirecionar para a página do perfil
       FastControl::redirect('perfil');
   }

   // ===========================================================
   public function alterar_password()
   {
       // verifica se existe um utilizador logado
       if(!FastControl::userLogado()) {
        FastControl::redirect();
           return;
       }        

       // apresentação da página de alteração da password
       FastControl::Layout([
           'layouts/html_header',
           'layouts/header',
           'perfil_navegacao',
           'alterar_password',
           'layouts/footer',
           'layouts/html_footer',
       ]);
   }

   // ===========================================================
   public function alterar_password_submit()
   {
       // verifica se existe um utilizador logado
       if(!FastControl::userLogado()) {
        FastControl::redirect();
           return;
       }

       // verifica se existiu submissão de formulário
       if($_SERVER['REQUEST_METHOD'] != 'POST'){
        FastControl::redirect();
           return;
       }

       // validar dados
       $senha_atual = trim($_POST['text_password_atual']);
       $nova_senha = trim($_POST['text_nova_password']);
       $repetir_nova_senha = trim($_POST['text_repetir_nova_password']);

       // validar se a nova senha vem com dados ou vazia
       if(strlen($nova_senha) < 3){
           $_SESSION['erro'] = "Indique a nova password e a repetição da nova password (min 6 caracteres).";
           $this->alterar_password();
           return;
       }

       // verificar se a nova senha a a sua repetição coincidem
       if($nova_senha != $repetir_nova_senha){
           $_SESSION['erro'] = "A nova password e a sua repetição não são iguais.";
           $this->alterar_password();
           return;
       }

       // verificar se a senha atual está correta
       $cliente = new Users();// ver_se_senha_esta_correta procedimento em Users no Model
       if(!$cliente->ver_se_senha_esta_correta($_SESSION['id_user'], $senha_atual)){
           $_SESSION['erro'] = "A password atual está errada.";
           $this->alterar_password();
           return;
       }

       // verificar se a nova senha é diferente da senha atual
       if($senha_atual == $nova_senha){
           $_SESSION['erro'] = "A nova password é igual à senha atual.";
           $this->alterar_password();
           return;
       }

       // atualizar a nova senha
       $cliente->atualizar_a_nova_senha($_SESSION['id_user'], $nova_senha);

       // redirecionar para a página do perfil
       FastControl::redirect('perfil');
   }

   // ===========================================================
   public function historico_pedidos()
   {
       // verifica se existe um utilizador logado
       if(!FastControl::userLogado()) {
           FastControl::redirect();
           return;
       }

       // carrega o histórico das encomendas
       $pedidos = new Pedidos_bd();
       $historico_pedidos = $pedidos->buscar_historico_pedidos($_SESSION['id_user']);

      // FastControl::printData($historico_pedidos);

       $data = [
           'historico_pedidos' => $historico_pedidos
       ];

       // apresentar a view com o histórico das encomendas
       FastControl::Layout([
           'layouts/html_header',
           'layouts/header',
           'perfil_navegacao',
           'historico_pedidos',
           'layouts/footer',
           'layouts/html_footer',
       ], $data);
   }

    // ===========================================================
    public function historico_pedidos_hoje()
    {
        // verifica se existe um utilizador logado
        if(!FastControl::userLogado()) {
         FastControl::redirect();
            return;
        }
 
        // carrega o histórico das encomendas
        $pedidos = new Pedidos_bd();
        $historico_pedidos_hoje = $pedidos->buscar_historico_pedidos($_SESSION['id_user']);
 
       // FastControl::printData($historico_pedidos);
 
        $data = [
            'historico_pedidos_hoje' => $historico_pedidos_hoje
        ];
 
        // apresentar a view com o histórico das encomendas
        FastControl::Layout([
            'layouts/html_header',
            'layouts/header',
            'historico_pedidos_hoje',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    // ===========================================================
    public function historico_pedidos_detalhe(){

        // verifica se existe um utilizador logado
        if(!FastControl::userLogado()) {
            FastControl::redirect();
            return;
        }

        // verificar se veio indicado um id_pedido (encriptado)
        if(!isset($_GET['id'])){
            FastControl::redirect();
            return;
        }

        // $id_pedido = null;

        // verifica se o id_pedido é uma string com 32 caracteres
        if(strlen($_GET['id']) != 32){
            FastControl::redirect();
            return;
        } else {
            $id_pedido = FastControl::aesDesencriptar($_GET['id']);
            if(empty($id_pedido)){
                FastControl::redirect();
                return;
            }
        }
        // echo 'Fim<br>';
        // echo $id_pedido;

        // verifica se o pedido pertence a este user
        $pedidos = new Pedidos_bd();
        $resultado = $pedidos->verificar_pedido_user($_SESSION['id_user'], $id_pedido);
        if(!$resultado){
            FastControl::redirect();
            return;
        }

        // vamos buscar os dados de detalhe do pedido.
        //bastava apenas o id_pedido mas assim com os 2 ficam mais reforçados de segurança
        $detalhe_pedido = $pedidos->detalhes_de_pedido($_SESSION['id_user'], $id_pedido);

        //FastControl::printData($detalhe_pedido);

        // calcular o valor total do pedido
        $total = 0;
        foreach($detalhe_pedido['produtos_pedido'] as $produto){
            $total += ($produto->quantidade * $produto->preco_unidade);
        }

        $data = [
            'dados_pedido' => $detalhe_pedido['dados_pedido'],
            'produtos_pedido' => $detalhe_pedido['produtos_pedido'],
            'total_pedido' => $total
        ];

        // vamos apresentar a nova view com esses dados.
        FastControl::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao',
            'pedido_detalhe',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    // ===========================================================
     public function pagamento()
     {
    //     // simulação do webhook do getaway de pagamento

    //     /* 
    //         verificar se vem o código da encomenda
    //         verificar se a encomenda com o código indicado está pendente
    //         alterar o estado da encomenda de pendente para em processamento
    //     */

    //     // verificar se o código da encomenda veio indicado
        // $id_pedido = '';
        // if(!isset($_GET['id'])){
        //     return;
        // } else {
        //     $id_pedido = $_GET['id'];
        // }


         // verificar se veio indicado um id_pedido (encriptado)
         if(!isset($_GET['id'])){
            FastControl::redirect();
            return;
        }

        // $id_pedido = null;

        // verifica se o id_pedido é uma string com 32 caracteres
        if(strlen($_GET['id']) != 32){
            FastControl::redirect();
            return;
        } else {
            $id_pedido = FastControl::aesDesencriptar($_GET['id']);
            if(empty($id_pedido)){
                FastControl::redirect();
                return;
            }
        }

        // verificar se existe o código ativo (PENDENTE)
        $pedido = new Pedidos_bd();
        $resultado = $pedido->pagar_pedido($id_pedido);
          // mostrar se o resultado do return do model pagar_pedido do Pedidos_db se é 1 ou 0
       // echo (int)$resultado;
       if((int)$resultado == 1){
        FastControl::Layout([
            'layouts/html_header',
            'layouts/header',
            'sucesso',
            'layouts/footer',
            'layouts/html_footer'
        ]);
       }else{
         FastControl::Layout([
           'layouts/html_header',
           'layouts/header',
           'insucesso',
           'layouts/footer',
           'layouts/html_footer'
        ]);
       }


     }









    // public function criar_pdf()
    // {

    //     $pdf = new PDF();
    //     // $pdf->set_template(getcwd() . '/assets/templates_pdf/template.pdf');

    //     $pdf->apresentar_pdf();
    // }


}// fim class controlador