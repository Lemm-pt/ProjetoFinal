<?php

// namespace para as classes serem importadas atraves do composer
namespace core\classes;

use Exception;

class FastControl{
   
    //________________________________________________________________//
    ////////////////////////////////////////////////////////////////////
    // mostra as views, recebe a coleção das views e as variáveis através dos dados
    public static function Layout($estruturas, $dados = null){

        //verifica se as estruturas é um array
        if(!is_array($estruturas)){
            // apenas na fase de desenvolvimento
            throw new Exception("Coleção de estruturas inválida");
        }//else{

        // }

        // variáveis
        // passar para o interior dos includes variáveis que são defenidas aqui
        if(!empty($dados) && is_array($dados)){
            //vem o 'titulo' => 'hsjsjsjsjjs', passa a ser a variável $titulo
            extract($dados); 

        }

         // apresentar as views{
         foreach($estruturas as $estrutura){
            include("../core/views/$estrutura.php");
         }

    }

        //________________________________________________________________//
    ////////////////////////////////////////////////////////////////////
    // mostra as views, recebe a coleção das views e as variáveis através dos dados
    public static function Layout_admin($estruturas, $dados = null){

        //verifica se as estruturas é um array
        if(!is_array($estruturas)){
            // apenas na fase de desenvolvimento
            throw new Exception("Coleção de estruturas inválida");
        }//else{

        // }

        // variáveis
        // passar para o interior dos includes variáveis que são defenidas aqui
        if(!empty($dados) && is_array($dados)){
            //vem o 'titulo' => 'hsjsjsjsjjs', passa a ser a variável $titulo
            extract($dados); 

        }

         // apresentar as views{
         foreach($estruturas as $estrutura){
            include("../../core/views/$estrutura.php");
         }

    }

     //________________________________________________________________//
    ////////////////////////////////////////////////////////////////////
    public static function userLogado(){
        //verifica se existe um user com sessao iniciada
        //para mostrar o login se caso nao estiver logado
        return isset($_SESSION['user']);// return false ou true
    }

        //________________________________________________________________//
    ////////////////////////////////////////////////////////////////////
    public static function adminLogado(){
        //verifica se existe um admin com sessao iniciada
        //para mostrar o login se caso nao estiver logado
        return isset($_SESSION['admin']);// return false ou true
    }

    public static function criarHash($num_caracteres = 12){

        // criar hashes, substr uma parte de uma string, str_shuffle mistura as letras, de 0 até num de chars(por defeito está 12)
        $chars = '01234567890123456789abcdefghijklmnopqrstuwxyzabcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZABCDEFGHIJKLMNOPQRSTUWXYZ';
        return substr(str_shuffle($chars), 0, $num_caracteres);
    }

     //________________________________________________________________//
    ////////////////////////////////////////////////////////////////////
    public static function redirect($rota = '', $admin = false){

        // faz o redirecionamento para a URL desejada (rota)
        if(!$admin){
            header("Location: " . BASE_URL . "?a=$rota");
        }else{
            header("Location: " . BASE_URL . "/admin?a=$rota");
        }
    }


       // ===========================================================
    // encriptação
    // ===========================================================
    public static function aesEncriptar($valor)
    {   // transforma binário em hexadecimal a partir de uma srtring openssl_encrypt
        //valor = dados, aes-256-cbc = metodo do algoritmo, AES_KEY = chave, OPENSSL_RAW_DATA = constante, AES_IV = inicialização de vetor
        // tudo isto atraves de umas chaves randómicas defenidadas em config.php "aes Encriptação" ver mais detalhes no video 62
        return bin2hex(openssl_encrypt($valor, 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV));
    }

    // ===========================================================
    // segue os mesmos metodos da encriptação mas aqui passa do hexadecimal para o binario através de hex2bin (processo inverso)
    public static function aesDesencriptar($valor)
    {
        return openssl_decrypt(hex2bin($valor), 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV);
    }


    //________________________________________________________________//
    ////////////////////////////////////////////////////////////////////
    public static function printData($data){
        if(is_array($data) || is_object($data)){
            echo '<pre>';
            print_r($data);
        } else {
            echo '<pre>';
            echo $data;
        }

        die('<br>TERMINADO');
    }



}



?>