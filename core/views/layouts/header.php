<?php use core\classes\FastControl;
//calcula o num de produtos em mesa
$total_products = 0;
if(isset($_SESSION['pedidos'])){
  foreach($_SESSION['pedidos'] as $quantidade){
    $total_products += $quantidade;
  }
}
// para a url dia para o solicitado do menu pedidos por os colaboradores verem pedidos só de hoje
$hoje = date("Y-m-d");
?>

<div class="cointaner-fluid navegacao">
    <div class="row">
        <div class="col-4 p-3 h3 text-success">
            <a style="text-decoration: none; margin-left:10px;" href="?a=inicio"> <img src="../public/assets/images/logo.png" width="50px"><?= APP_NAME ?> </a>
        </div>


      
        <div class="col-8 text-end p-3 ">
            <a href="?a=inicio" class="nav-item"> <i class="bi bi-house-fill h3"></i> Início</a>
            <a href="?a=menu" class="nav-item"> <i class="bi bi-journals h3"></i> Menu</a>

            <a href="?a=minha_mesa" class="nav-item">
               <i class="bi bi-align-top h3"></i>Minha mesa <span class="badge bg-success h3" id="pedidos_mesa"><?= $total_products == 0 ? '' : $total_products ?></span> 
            </a> 

           <!--  <a href="?a=pedidos" class="nav-item"> <i class="bi bi-ui-checks h3"></i> Pedidos</a> -->

            <?php // verifica se já foi selecionada o numero de mesa?>
        <?php if(FastControl::userLogado()):?>

        <a href="?a=historico_pedidos_hoje" class="nav-item"> <i class="bi bi-card-checklist h3"></i> Pedidos</a>
        <a href="?a=perfil" class="nav-item"> <i class="bi bi-person-badge h3"></i><?= $_SESSION['user'] ?></a>
        <a href="?a=logout" class="nav-item"> <i class="bi bi-x-circle-fill h3"></i> Logout</a>

        <?php else:?>

        <a href="?a=login" class="nav-item"> <i class="bi bi-box-arrow-in-right h3"></i> Login</a>
        <a href="?a=new_user" class="nav-item"> <i class="bi bi-person-plus-fill h3"></i> Criar conta</a>

        <?php endif;?>

        </div>
    </div>
</div>