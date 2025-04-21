<?php
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
        <div class="col-12 ">
            <h3 class="my-3 tex-primary">
             <i class="bi bi-align-top text-warning h1"></i> Mesa   <?= $_SESSION['mesa'] == true ? $_SESSION['mesa'] : ' ' ?>
           </h3>
           <h5 class="text-center text-success">Pedido confirmado</h5>
           <h6 class="text-center text-success">Será servido assim que possível</h6>
           <h6 class="text-center text-success"> <i class="bi bi-emoji-wink-fill h2 text-warning"></i> OBRIGADO</h6>
        </div>

<div class="container">
    <div class="row">
        <div class="col">

                <div style="margin-bottom: 80px;">
                    <table class="table">
                        <thead>
                            <tr>
                              
                                <th>Produto</th>
                                <th class="text-center">Quantidade</th>
                                <th class="text-end">Valor total</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 0; // para ir de 0 à ultima linha dos pedidos
                            $total_rows = count($pedidos);
                            ?>
                            <?php foreach ($pedidos as $produto) : ?>
                                <?php if ($index < $total_rows - 1) : ?>

                                    <!-- lista dos produtos -->
                                    <tr>
                                      
                                        <td class="align-middle"><h6><?= $produto['titulo'] ?></h6></td>
                                        <td class="text-center align-middle">
                                           <h6 id="quantidade" ><?= $produto['quantidade'] ?></h6>
                                        </td>
                                        <td class="text-end align-middle"><h5><?= number_format($produto['preco'],2,',','.') . '€' ?></h5></td>
                
                                    </tr>

                                <?php else : ?>

                                    <!-- total -->
                                    <tr>
                                        <td></td>
                                        <td class="text-end"><h5>Total:</h5></td>
                                        <td class="text-end"><h5><?= number_format($produto,2,',','.') . '€' ?></h5></td>
                                       
                                    </tr>

                                <?php endif; ?>
                                <?php $index++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
               
                               
                                
                    <div class="row">
                      <div class="col">
                        <h4 class="my-3 tex-primary text-center">
                           <a href="?a=inicio" style="text-decoration:none">
                             <i class="bi bi-journal-x  h1 text-warning"></i>  Voltar
                           </a>
                        </h4>        
                     </div>
                     <?php /*  ?>
                     <div class="col text-end">
                        <h4 class="my-3 tex-primary">
                            <a href="?a=finalizar_pedido" style="text-decoration:none">
                            <i class="bi bi-wallet2 h1 text-warning"></i> Escolher método de pagamento</a>
                         </h4> 
                        </div>
                    

                    <div>
                        dados do user:
                        <?php print_r($user); ?>
                    </div>
                   <?php */ ?>
                </div>
                </div>

         


        </div>
    </div>
</div>