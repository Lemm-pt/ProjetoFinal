<?php
use core\classes\FastControl;
?>
<div class="container-fluid">
    <div class="row mt-3">

        <div class="col-md-2">
            <?php include(__DIR__ . '/layouts/admin_menu.php') ?>
        </div>

        <div class="col-md-10">
            <h3>Detalhe do produto</h3>
            <hr>
                  
                <div class="row mt-3">
                <!-- nome  -->
                <div class="col-2"></div>
                <div class="col-10 fw-bold text-info h5"><?= $dados_produto->nome_produto ?></div>
                <!-- imagem  -->
                <div class="col-2"></div>
                <div class="col-10 p-2"><img src="../assets/images/produtos/<?= $dados_produto->imagem ?>" class="img-fluid" width="77"></div>
                <!-- Categoria -->
                <div class="col-3 text-end fw-bold">Categoria:</div>
                <div class="col-9"><?= $dados_produto->categoria ?></div>
                <!-- Desrição -->
                <div class="col-3 text-end fw-bold">Desrição:</div>
                <div class="col-9"><?= $dados_produto->descricao ?></div>
                <!-- Preço -->
                <div class="col-3 text-end fw-bold">Preço:</div>
                <div class="col-9"><?= empty($dados_produto->preco) ? '-' : $dados_produto->preco ?></div>
                <!-- Validade -->
                <div class="col-3 text-end fw-bold">Validade:</div>
                <div class="col-9"><?= $dados_produto->validade ?></a></div>
                <!-- ativo -->
                <div class="col-3 text-end fw-bold">ativo:</div>
                <div class="col-9"><?= $dados_produto->validade == '' ? '<span class="text-danger">Inativo</span>' : '<span class="text-success">Ativo</span>' ?></div>
                <!-- criado em -->
                <div class="col-3 text-end fw-bold">Produto vendido desde:</div>
                <?php
                $data = DateTime::createFromFormat('Y-m-d H:i:s', $dados_produto->created_at);
                ?>
                <div class="col-9"><?= $data->format('d-m-Y') ?></div>
            </div>

            <div class="row mt-3">
                <div class="col-9 offset-3">
                    <?php if ($total_pedidos == 0) : ?>
                        <div class="col text-center">
                            <p class="text-muted">Não existem pedidos deste produto.</p>
                        </div>
                    <?php else : ?>
                        <a href="?a=produto_historico_pedidos&p=<?= FastControl::aesEncriptar($dados_produto->id_produto) ?>" class="btn btn-primary">Ver histórico de pedidos...</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>



    </div>
</div>