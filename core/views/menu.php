<?php
//verificar se existe minha mesa e pedidos

use core\models\Users;

$user = new Users();

// if(isset($_GET['user'])){
//     $_SESSION['user'] = $_GET['user'];
//     if($user->buscar_nome_user($_SESSION['user']) != $_SESSION['user']){
//         print_r($user->buscar_nome_user($_SESSION['user']));
//        echo 'user inválido';
//     }
//   }  

   if(isset($_GET['user']) && $_GET['user'] == $user->buscar_nome_user($_GET['user'])) {
    $_SESSION['user'] = $_GET['user'];
    $_SESSION['id_user'] = $user->buscar_id_user($_GET['user']);
  }

  if(isset($_GET['mesa'])) {
    $_SESSION['mesa'] = $_GET['mesa'];
  }

//calcula o num de produtos em mesa
$total_products = 0;
if(isset($_SESSION['pedidos'])){
  foreach($_SESSION['pedidos'] as $quantidade){
    $total_products += $quantidade;
  }
}

?>
<div class="container">
    <div class="row">
        <div class="  col ">
            <a href="?a=minha_mesa" style="text-decoration:none">
                <h3 class="my-3 tex-primary"> <i class="bi bi-align-top text-warning h1"></i> Mesa
                    <?= $_SESSION['mesa'] == true ? $_SESSION['mesa'] : ' ' ?>
            </a>
        </div>
        <div class=" col text-center ">
            <a href="?a=inicio" style="text-decoration:none">
                <h3 class="my-3 tex-primary"> <i class="bi bi-emoji-wink-fill text-warning h1"></i>
                    <?= $_SESSION['user'] == true ? $_SESSION['user'] : ' ' ?>
            </a>
        </div>
        <div class="col text-end">
            <a href="?a=minha_mesa" style="text-decoration:none">
                <h3 class="my-3 tex-primary">
                <i class="bi bi-eye-fill h3 text-warning"></i> Pedidos 
                <span class="badge bg-success h3" id="pedidos_mesa_menu"><?= $total_products == 0 ? '' : $total_products ?></span> 
                </h3>
            </a>
        </div>

        <hr>

    </div>
</div>

<div class="container espaco-fundo">

    <!-- titulo da página -->
    <div class="row">
        <div class="col-12 text-center my-4">

            <a href="?a=menu&c=tudo" class="btn btn-primary m-1">Tudo</a>
            <?php foreach ($categories as $category) : ?>
            <a href="?a=menu&c=<?= $category ?>" class="btn btn-primary m-1">
                <?= ucfirst(preg_replace("/\_/", " ", $category)) // preg_replace se tiver _ entre palavras na bd tranforma-se em " "?>
            </a>
            <?php  endforeach; ?>
        </div>
    </div>

    <!-- produtos -->
    <div class="row">

        <?php if (count($products) == 0) : ?>

        <div class="text-center my-5">
            <h3>Não existem produtos disponíveis.</h3>
        </div>

        <?php else : ?>

        <!-- ciclo de apresentação dos produtos -->
        <?php foreach ($products as $product) : ?>
        <div class="col-sm-4 col-6 p-2">

            <div class="text-center p-2 m-2 box-produto">
            <span type="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $product->id_produto ?>"> <?php // click do modal ?>
                <img src="assets/images/produtos/<?= $product->imagem ?>" class="img-fluid">
                <h5><?= $product->nome_produto ?></h5>
           </span>


<!-- Modal -->
<div class="modal fade" id="exampleModal<?= $product->id_produto ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $product->id_produto ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel<?= $product->id_produto ?>"><?= $product->nome_produto ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?= $product->descricao ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>








                <h5 class="text-primary"><?= preg_replace("/\./", ",", $product->preco) . '€' ?></h5>
                <div>
                    <?php if($product->stock > 0):?>
                    <button class="btn btn-info btn-sm h5" onclick="adicionar_pedido(<?= $product->id_produto ?>)">
                        <span class="h6 text-light">Pedir</span> <i
                            class="bi bi-send-plus-fill h3 text-light"></i> </button>
                    <?php else:?>
                    <button type="button" disabled class="btn btn-danger btn-sm h4 "> <span class="h6">Indisponível <i
                                class="bi bi-send-slash-fill h3 text-light"></i></span></button>
                    <?php endif;?>
                </div>
            </div>

        </div>
        <?php endforeach; ?>

        <?php endif ?>

    </div>
</div>