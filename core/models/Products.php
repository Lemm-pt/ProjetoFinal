<?php

namespace core\models;

use core\classes\Database;
use core\classes\FastControl;

class Products{
 
    // _________________________________________________________________ //
    ///////////////////////////////////////////////////////////////////////
  public function availableProductsLlist($category){
   
    // buscar todas as informações da base de dados disponíveis (stock > 0 e visivel = 1)
    $bd = new Database();

    //buscar a lista de categorias abaixo
    $categories = $this->categoryList();

    $sql =  "SELECT * FROM rapidask_produtos";
    $sql .= " WHERE visivel = 1";

    if(in_array($category, $categories)){ // procurar no array
      $sql .= " AND categoria = '$category'";// colocar aspas porque no sql entenderá como uma string
    }

    //die($sql);

    $products = $bd->select($sql);
    return $products;
  }

      // _________________________________________________________________ //
    ///////////////////////////////////////////////////////////////////////
    public function categoryList(){
   
      // devolve a lista de categorias da bd
      $bd = new Database();
      $resultados = $bd->select("SELECT DISTINCT categoria FROM rapidask_produtos") ;
      //tranformar resultados num array
      $categories = [];
      foreach($resultados as $resultado){
        array_push($categories, $resultado->categoria); // inserir no array
      }
  
      return $categories;
    }


         // _________________________________________________________________ //
    ///////////////////////////////////////////////////////////////////////
    public function veirfyStock($id_product){
      $bd = new Database();
      $parametros = [
        ':id_product' => $id_product
      ];
      $resultados = $bd->select("SELECT * FROM rapidask_produtos WHERE id_produto = :id_product AND visivel = 1 AND stock > 0", $parametros) ;
     return count($resultados) != 0 ? true : false;

    }


        // ===========================================================
        public function buscar_produtos_por_ids($ids){

          $bd = new Database();
          return $bd->select("
              SELECT * FROM rapidask_produtos
              WHERE id_produto IN ($ids)
          ");
      }
  
}//end class Products