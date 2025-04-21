<?php

// namespace para as classes serem importadas atraves do composer
namespace core\classes;

use Exception;
use PDO;
use PDOException;

class Database{
    // gestão de base de dados
    // 1 ligar
    // 2 comunicar
    // 3 fechar

    //privada porque só é acessivel aos metodos dentro desta classe
    private $ligacao;

         // ============================================================
     private function ligar(){

        $this->ligacao = new PDO(

            'mysql:'.
            'host='.MYSQL_SERVER.';'.
            'dbname='.MYSQL_DATABASE.';'.
            'charset='.MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)//fica na memoria ajuda mais rapido

        );

        //seria como:
         // new PDO('mysql:host=localhost;dbname=lemm;charset=utf-8, user, pass');
    }

     // ============================================================
     private function desligar(){
        // desliga-se da base de dados
        $this->ligacao = null;
    }


      // ============================================================
    // CRUD
    // ============================================================
    
    public function select($sql, $parametros = null){

        //trim para poder colocar o codigo sql em quebra de linha e assim já não reconhece espaços
        $sql = trim($sql);

        // verifica se é uma instrução SELECT i, se caso insesitif--- $sql, instrução sql
        if(!preg_match("/^SELECT/i", $sql)){
           // erro aparece apenas para mim proprio quando estou a programar
            throw new Exception('Base de dados - Não é uma instrução SELECT.');
            //ou simplesmente 
           // die('Base de dados - Não é uma instrução SELECT.');
        }

        // liga
        $this->ligar();

        $resultados = null;

        // comunica
        try {
            
            // comunicação com a bd
            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
             //fetchAll, vai buscar tudo---  FETCH_CLASS, em formato objeto  ou FETCH_ASSOC, array associativo
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }
            // $e, para ter acesso ao erro
        } catch (PDOException $e) {
            
            // caso exista erro
            return false;
        }

        // desliga da bd
        $this->desligar();

        // devolve os resultados obtidos
        return $resultados;
    }

    // ============================================================
    public function insert($sql, $parametros = null){
  //trim para poder colocar o codigo sql em quebra de linha e assim já não reconhece espaços
        $sql = trim($sql);

        // verifica se é uma instrução INSERT
        if(!preg_match("/^INSERT/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução INSERT.');
        }

        // liga
        $this->ligar();

        // comunica
        try {
            
            // comunicação com a bd
            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            
            // caso exista erro
            return false;
        }

        // desliga da bd
        $this->desligar();
    }

    // ============================================================
    public function update($sql, $parametros = null){
 //trim para poder colocar o codigo sql em quebra de linha e assim já não reconhece espaços
        $sql = trim($sql);

        // verifica se é uma instrução UPDATE
        if(!preg_match("/^UPDATE/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução UPDATE.');
        }

        // liga
        $this->ligar();

        // comunica
        try {
            
            // comunicação com a bd
            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            
            // caso exista erro
            return false;
        }

        // desliga da bd
        $this->desligar();
    }

    // ============================================================
    public function delete($sql, $parametros = null){
 //trim para poder colocar o codigo sql em quebra de linha e assim já não reconhece espaços
        $sql = trim($sql);

        // verifica se é uma instrução DELETE
        if(!preg_match("/^DELETE/i", $sql)){
            throw new Exception('Base de dados - Não é uma instrução DELETE.');
        }

        // liga
        $this->ligar();

        // comunica
        try {
            
            // comunicação com a bd
            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            
            // caso exista erro
            return false;
        }

        // desliga da bd
        $this->desligar();
    }


    // ============================================================
    // GENÉRICA
    // ============================================================
    public function statement($sql, $parametros = null){
 // trim para poder colocar o codigo sql em quebra de linha e assim já não reconhece espaços
        $sql = trim($sql);
        
        // verifica se é uma instrução diferente das anteriores
        if(preg_match("/^(SELECT|INSERT|UPDATE|DELETE)/i", $sql)){
            throw new Exception('Base de dados - Instrução inválida.');
        }

        // liga
        $this->ligar();

        // comunica
        try {
            
            // comunicação com a bd
            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            
            // caso exista erro
            return false;
        }

        // desliga da bd
        $this->desligar();
    }
  
}


?>