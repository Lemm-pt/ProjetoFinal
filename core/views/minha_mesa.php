<?php
//calcula o num de produtos em mesa
$total_products = 0;
if (isset($_SESSION['pedidos'])) {
    foreach ($_SESSION['pedidos'] as $quantidade) {
        $total_products += $quantidade;
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-4 ">
            <h3 class="my-3 tex-primary">
                <i class="bi bi-align-top text-warning h1"></i> Mesa <?= $_SESSION['mesa'] == true ? $_SESSION['mesa'] : ' ' ?>
            </h3>
        </div>
        <div class="col-4 text-center ">
            <h4 class="my-3 tex-primary">
                <a href="<?= BASE_URL ?>index.php?a=menu&mesa=<?= $_SESSION['mesa'] ?>&user=<?= $_SESSION['user'] ?>" style="text-decoration:none"> <i class="bi bi-journal-plus h1 text-warning"></i> Acrescentar pedido</a>
                </4>
        </div>
        <div class="col-4 text-end">
            <h3 class="my-3 tex-primary">
                Pedidos <span class="badge bg-success h3" id="pedidos_mesa"><?= $total_products == 0 ? '' : $total_products ?></span>
            </h3>

        </div>




        <div class="container">
            <div class="row">
                <div class="col">

                    <?php if ($pedidos == null) : ?>

                        <p class="text-center text-warning h3">Nada pedido ainda. <br> <i class="bi bi-emoji-expressionless h2"></i></p>
                        <div class="mt-4 text-center">
                            <a href="<?= BASE_URL ?>index.php?a=menu&mesa=<?= $_SESSION['mesa'] ?>&user=<?= $_SESSION['user'] ?>" class="btn btn-primary">Ir para a ementa</a>
                        </div>


                    <?php else : ?>

                        <div style="margin-bottom: 80px;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Produto</th>
                                        <th class="text-center">Quantidade</th>
                                        <th class="text-end">Valor total</th>
                                        <th></th>
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
                                                <td><img src="assets/images/produtos/<?= $produto['imagem']; ?>" class="img-fluid" width="50px"></td>
                                                <td class="align-middle">
                                                    <h5><?= $produto['titulo'] ?></h5>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <h5 id="quantidade"><?= $produto['quantidade'] ?></h5>
                                                </td>
                                                <td class="text-end align-middle">
                                                    <h4><?= number_format($produto['preco'], 2, ',', '.') . '€' ?></h4>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <!-- tambem dá com a função str_replace para substituir , por . -->
                                                    <a href="?a=remover_produto_mesa&id_produto=<?= $produto['id_produto'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-times"></i>
                                                    </a>

                                                    <!-- <button class="btn btn-warning btn-sm"
                                            onclick="adicionar_pedido(<? //= //$produto['id_produto'] 
                                                                        ?>)"><i class="fas fa-minus"></i></button>
                                              
                                            <a href="?a=adicionar_retirar&id_produto=<? //= $produto['id_produto'] 
                                                                                        ?>&quantidade=<? //= $produto['quantidade'] 
                                                                                                                                ?>&op=retirar"
                                              onclick="adicionar_retirar(<? //= $produto['id_produto'],  $produto['quantidade'] 
                                                                            ?>)"
                                               class="btn btn-warning btn-sm"><i class="fas fa-minus"></i>
                                            </a> -->
                                                </td>
                                            </tr>

                                        <?php else : ?>

                                            <!-- total -->
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-end">
                                                    <h3>Total:</h3>
                                                </td>
                                                <td class="text-end">
                                                    <h3><?= number_format($produto, 2, ',', '.') . '€' ?></h3>
                                                </td>
                                                <td></td>
                                            </tr>

                                        <?php endif; ?>
                                        <?php $index++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col">
                                    <!-- <a href="?a=limpar_carrinho" class="btn btn-sm btn-primary">Limpar carrinho</a> -->
                                    <span onclick="limpar_mesa()" class="h4 my-3 text-primary">
                                        <i class="bi bi-journal-x  h1 text-warning"></i> Anular tudo
                                        <span class="my-3" id="confirmar_limpar_mesa" style="display: none; ">
                                            <br> <span class="text-warning h5"> <?php //display: none fica escondido 
                                                                                ?>
                                                <i class="bi bi-exclamation-triangle-fill h3 text-danger"></i> Tem a certeza?<br>
                                                <button class="btn btn-sm btn-primary" onclick="limpar_mesa_off()">Não</button>
                                                <a href="?a=limpar_mesa" class="btn btn-sm btn-primary">Sim</a>
                                            </span>
                                </div>

                                <div class="col text-center">
                                    <h4 class="my-3 tex-primary">
                                        <a href="?a=finalizar_pedido" style="text-decoration:none">
                                            <i class="bi bi-journal-check h1 text-warning"></i> Pedir conta</a>
                                        </h4>
                                </div>
                              
                                <div class="col text-end">
                                 <div class="input-group mb-3">
                                 <i class="bi bi-credit-card-2-front h1 text-warning"></i> &nbsp  &nbsp
                                  <form action="?a=finalizar_pedido_resumo" method="post">
                                    <input type="text" class="form-control" name="contribuinte" placeholder="Nº contribuinte opcional" >
                                    
                                    <input type="submit" value="Enviar e Pedir conta" class="btn btn-primary">
                                  </form>
                                 </div>
                                </div>
                                

                                <!-- <div class="col text-center input-group mb-3">
                        <h4 class="my-3 tex-primary">
                        <form>
                        <i class="bi bi-credit-card-2-front h1 text-warning"></i>
                          <input type="text" class="form-control" placeholder="Adicionar nº contribuinte" aria-label="Recipient's username" aria-describedby="button-addon2">
                          <a href="?a=finalizar_pedido" style="text-decoration:none">
                          <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                             Finalizar
                            </button>
                            </a>
                            </form>
                         </4> 
                        </div> -->




                            </div>

                           
                             
                                
                        </div>

                    <?php endif; ?>


                </div>
            </div>
        </div>