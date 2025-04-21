<?php

//////  para mostrar os erros em modo desenvolvimento ///////
ini_set('error_reporting', E_ALL); // mesmo resultado de: error_reporting(E_ALL);
ini_set('display_errors', 1);
/////////////////////////////////////////////////////////////////////////////////

// abrir sessão
session_start();

use core\classes\Database;
/*
carregar config
carregar classes
carregar o sistema de routes
*/

// para carregar o composer e assim todas as classes do projeto com os namespaces
// para fazer apenas um require_once foi designado no composer.json para carregar tudo que está no core (se forem classes)
require_once('../vendor/autoload.php');

//carrega  o sistemas de routes
require_once('../core/routes.php');


/////// testes ///////////////////////////////////
// $bd = new Database();
// $clientes = $bd->select("SELECT * FROM clientes");
// echo '<pre>';
// print_r($clientes);



?>