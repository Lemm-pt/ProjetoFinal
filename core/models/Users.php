<?php

namespace core\models;

use core\classes\Database;
use core\classes\FastControl;

class Users{
 
    // _________________________________________________________________ //
    ///////////////////////////////////////////////////////////////////////
  public function verify_repeat_email($email){

    //verifica se na db existe outra conta com o mesmo email já registado

      
    $bd = new Database();

    $parametros = [ // trim remove espaços no inicio ou no fim
       ':e' => strtolower(trim($email))
    ];

    $resultados = $bd->select("SELECT email FROM rapidask_users WHERE email = :e", $parametros);
    if(count($resultados) != 0){
        return true;
    }else{
        return false;
    }

 

  }// fim metodo verify_repeat_email


  // _________________________________________________________________ //
    ///////////////////////////////////////////////////////////////////////
  public function user_insert(){

     //cliente pronto para ser inserido na bd
     $bd = new Database();

     // cria uma hash para o cliente
   $purl = FastControl::criarHash();
 

$parametros = [
    ':nome'      => trim($_POST['text_nome']),
    ':email'     => strtolower(trim($_POST['text_email'])),
    ':senha'     => password_hash($_POST['text_senha_1'], PASSWORD_DEFAULT),
    ':telemovel' => trim($_POST['text_telemovel']),
    ':localidade'=> trim($_POST['text_localidade']),
    ':purl'      => $purl,
    ':activo'    => 0,
    // ':created_at'    => 0,
    // ':updated_at'    => 0,
    // ':deleted_at'    => 0,
   
];

$bd->insert("
     INSERT INTO rapidask_users VALUES(
         0,
        :nome,     
        :email,    
        :senha,    
        :telemovel,
        :localidade,
        :purl,     
        :activo,   
         NOW(),
         NOW(),
         NULL

     )
", $parametros);

// retorna o purl criado
return $purl;

  }// fim metodo user_insert


  // _________________________________________________________________ //
    ///////////////////////////////////////////////////////////////////////
    public function email_valid($purl){


      $bd = new Database();
  
      $parametros = [
        ':purl'      => $purl, 
      ];
    
    $resultados = $bd->select("SELECT * FROM rapidask_users WHERE purl = :purl ", $parametros);
    // verifica se foi encontrado o cliente
    if(count($resultados) != 1){
       return false;
    }

    // foi encontrado o user e o seu respetivo id
    $id_user = $resultados[0]->id_user;
    // teste //
    // echo $resultados[0]->email.'<br>';
    // echo $resultados[0]->user.'<br>';
    // die($id_user);

    // Atualizar os dados do cliente
    $parametros = [
      ':id_user'      => $id_user, 
    ];

     $bd->update("UPDATE rapidask_users SET 
                  activo = 1,  
                  purl = NULL, 
                  updated_at = NOW()
                  WHERE id_user = :id_user", $parametros);

    return true;
  
  }


    // _________________________________________________________________ //
    ///////////////////////////////////////////////////////////////////////
    // ===========================================================
    public function login_validation($email, $senha)
    {

        // verificar se o login é válido
        $parametros = [
            ':email' => $email
        ];

        $bd = new Database();
        $resultados = $bd->select("
            SELECT * FROM rapidask_users 
            WHERE email = :email 
            AND activo = 1 
            AND deleted_at IS NULL
        ", $parametros);

        if (count($resultados) != 1) {

            // não existe usuário
            return false;
        } else {

            // temos usuário. Vamos ver a sua password
            $user = $resultados[0];

            // verificar a password
            if (!password_verify($senha, $user->senha)) {

                // password inválida
                return false;
            } else {

                // login válido
                return $user;
            }
        }
    }
     // _________________________________________________________________ //
    ///////////////////////////////////////////////////////////////////////
    // ===========================================================

    public function buscar_dados_user($id_user){
        $parametros = [
            ':id_user' => $id_user
        ];
        $bd = new Database();
        $resultados = $bd->select("
            SELECT * FROM rapidask_users 
            WHERE id_user = :id_user 
        ", $parametros);

        return $resultados[0];

    }

    public function buscar_nome_user($user){
        $parametros = [
            ':user' => $user
        ];
        $bd = new Database();
        $resultados = $bd->select("
            SELECT * FROM rapidask_users 
            WHERE user = :user 
        ", $parametros);

        return $resultados[0]->user;

    }
    public function buscar_id_user($user){
        $parametros = [
            ':user' => $user
        ];
        $bd = new Database();
        $resultados = $bd->select("
            SELECT * FROM rapidask_users 
            WHERE user = :user 
        ", $parametros);

        return $resultados[0]->id_user;

    }



    // ===========================================================
    public function verificar_se_email_existe_noutra_conta($id_user, $email){

        // verificar se existe a conta de email noutra conta de user
        $parametros = [
            ':email' => $email,
            ':id_user' => $id_user
        ];
        $bd = new Database();
        $resultados = $bd->select("
            SELECT id_user
            FROM rapidask_users
            WHERE id_user <> :id_user
            AND email = :email
        ",$parametros);

        if(count($resultados) != 0){
            return true;
        } else {
            return false;
        }
    }

    // ===========================================================
    public function atualizar_dados_cliente($email, $nome, $localidade, $telemovel){

        // atualiza os dados do cliente na base de dados
        $parametros = [
            ':id_user' => $_SESSION['id_user'],
            ':email' => $email,
            ':nome' => $nome,
            ':telemovel' => $telemovel,
            ':localidade' => $localidade
            
        ];

        $bd = new Database();

        $bd->update("
            UPDATE rapidask_users
            SET
                email = :email,
                user = :nome,
                telemovel = :telemovel,
                localidade = :localidade,
                updated_at = NOW()
            WHERE id_user = :id_user
        ", $parametros);
    }

    // ===========================================================
    public function ver_se_senha_esta_correta($id_user, $senha_atual){

        // verifica se a senha atual está correta (de acordo com o que está na base de dados)
        $parametros = [
            ':id_user' => $id_user            
        ];

        $bd = new Database();

        $senha_na_bd = $bd->select("
            SELECT senha 
            FROM rapidask_users 
            WHERE id_user = :id_user
        ", $parametros)[0]->senha;

        // verificar se a senha corresponde à senha atualmente na bd 
        //(vê se são iguais comparando senha digitada no form com a hash que está na bd)
        return password_verify($senha_atual, $senha_na_bd);
    }

    // ===========================================================
    public function atualizar_a_nova_senha($id_user, $nova_senha){

        // atualização da senha do cliente
        $parametros = [
            ':id_user' => $id_user, // encriptar a nova senha
            ':nova_senha' => password_hash($nova_senha, PASSWORD_DEFAULT)
        ];

        $bd = new Database();
        $bd->update("
            UPDATE rapidask_users
            SET
                senha = :nova_senha,
                updated_at = NOW()
            WHERE id_user = :id_user
        ", $parametros);
    }


    

}//fim class

?>