<?php 
    use core\classes\FastControl;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <h3 class="text-center">Histórico de Pedidos</h3>

            <?php if (count($historico_pedidos) == 0) : ?>
                <p class="text-center">Não existem pedidos registadas.</p>
            <?php else : ?>

                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Data de pedido</th>
                            <th>Contribuinte</th>
                            <th>Estado</th>
                            <th>Colaborador</th>
                            <th><i class="bi bi-search"></i></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($historico_pedidos as $pedido) : ?>
                            <tr>
                                <td><?= $pedido->data_pedido ?></td>
                                <td><?= $pedido->contribuinte ?></td>
                                <td><?= $pedido->estado ?></td>
                                <td><?= $_SESSION['user'] ?></td>
                                <td> <!-- aesEncriptar para encriptar o id na url em vez de 10 por,ex. aparece uma hash -->
                                    <a href="?a=detalhe_pedido&id=<?= FastControl::aesEncriptar($pedido->id_pedido) ?>">Detalhes</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <p class="text-end">Total pedidos: <strong><?= count($historico_pedidos) ?></strong></p>

            <?php endif; ?>
        </div>
    </div>
</div>