<?php 
    use core\classes\FastControl;

    $num_pedidos = 0;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center m-3 text-warning">Pedidos de hoje</h3>

            <?php if (count($historico_pedidos_hoje) == 0) : ?>
                <p class="text-center">Não existem pedidos registadas.</p>
            <?php else : ?>

                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Hora</th>
                            <th>Mesa</th>
                            <th>Contribuinte</th>
                            <th><i class="bi bi-search h3"></i></th>
                            <th><i class="bi bi-cash-coin h3"></i></th>
                        </tr>
                    </thead>

                    <tbody>
                      <?php foreach ($historico_pedidos_hoje as $pedido) : ?>
                        <?php if(substr($pedido->data_pedido, -19, 10) == date("Y-m-d")): ?>
                            <tr>
                                <td><?= substr($pedido->data_pedido, -9) ?></td>
                                <td><?= $pedido->mesa ?></td>
                                <td><?= $pedido->contribuinte ?></td>
                                <td> <!-- aesEncriptar para encriptar o id na url em vez de 10 por,ex. aparece uma hash -->
                                    <a href="?a=detalhe_pedido&id=<?= FastControl::aesEncriptar($pedido->id_pedido) ?>">Detalhes</a>
                                </td>
                                <td> <!-- aesEncriptar para encriptar o id na url em vez de 10 por,ex. aparece uma hash -->
                               <?php if($pedido->estado == "PAGO"){
                                     $linkavel = "disabled-link"; 
                                     $status = "PAGO"; 
                               }else{
                                     $linkavel = "sem-decoration";
                                     $status = "PAGAR";  
                               }
                                ?>
                                    <a href="?a=pagamento&id=<?= FastControl::aesEncriptar($pedido->id_pedido) ?>"
                                    class="<?= $linkavel?>"><?= $status ?></a>
                                </td>
                            </tr>
                          <?php $num_pedidos++;
                            endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                  
                <p class="text-end">Total pedidos: <strong><?= $num_pedidos ?></strong></p>

            <?php endif; ?>
        </div>
    </div>
</div>