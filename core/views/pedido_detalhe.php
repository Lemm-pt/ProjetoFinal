<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <h1 class="text-center">Detalhe do pedido</h1>
                    <div class="text-center text-warning h3">
                        <span><strong>Mesa</strong></span>
                        <?= $dados_pedido->mesa ?>
                    </div>

            <div class="row">
                <div class="col">
                    <div class="p-2 my-3">
                        <span><strong>Data e hora do pedido</strong></span><br>
                        <?= $dados_pedido->data_pedido ?>
                    </div>
                   
                </div>
                <div class="col">
                   
                    <div class="p-2 my-3">
                        <span><strong>Contribunte</strong></span><br>
                        <?= $dados_pedido->contribuinte ?>
                    </div>
                </div>
                <div class="col align-self-center">
                    <div class="text-center mb-3">
                    <strong> Estado do pedido</strong>
                    </div>
                    <div>
                        <h6 class="text-center text-danger"><?= $dados_pedido->estado ?></h6>
                    </div>
                </div>
            </div>

            <!-- dados do pedido -->
            <div class="row mb-5">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th class="text-center">Quantidade</th>
                                <th class="text-end">Preço / Uni.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($produtos_pedido as $produto): ?>
                                <tr>
                                    <td><?= $produto->designacao_produto ?></td>
                                    <td class="text-center"><?= $produto->quantidade ?></td>
                                    <td class="text-end"><?= number_format($produto->preco_unidade,2,',','.') . ' €' ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3" class="text-end">Total: <strong><?= number_format($total_pedido,2,',','.') . ' €'?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col text-center mb-5">
                    <a href="?a=inicio" class="btn btn-primary btn-100">início</a>
                    <a href="?a=historico_pedidos_hoje" class="btn btn-primary btn-100">Hoje</a>
                    <a href="?a=historico_pedidos" class="btn btn-primary btn-100">Histórico</a>
                </div>
                <div class="mb-5">
                    &nbsp;
                </div>
            </div>



            
            
            






            <!-- lista de produtos da encomenda -->

        </div>
    </div>
</div>