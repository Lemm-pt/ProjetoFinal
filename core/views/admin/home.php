<div class="container-fluid">
    <div class="row mt-3">
        
        <div class="col-md-2">
            <?php include(__DIR__ . '/layouts/admin_menu.php')?>
        </div>

        <div class="col-md-10">
            
            <!-- apresenta informações sobre o total de pedidos PENDENTES -->
            <h4>Pedidos pendentes de hoje</h4>
            <?php if($total_pedidos_pendentes == 0): ?>
                <p class="text-a1a1a1">Não existem pedidos pendentes.</p>
            <?php else: ?>                
                <div class="alert alert-info p-2">
                    <span class="me-3">Existem pedidos pendentes: <strong><?= $total_pedidos_pendentes ?></strong></span>
                    <a href="?a=lista_pedidos&f=pendente">Ver</a>
                </div>
            <?php endif; ?>

            <hr>
            <!-- apresenta informações sobre o total de pedidos pagos -->
            <h4>Pedidos Pagos de hoje</h4>
            <?php if($total_pedidos_pagos == 0): ?>
                <p class="text-a1a1a1">Não existem pedidos pagos.</p>
            <?php else: ?>                
                <div class="alert alert-warning p-2">
                    <span class="me-3">Existem pedidos pagos: <strong><?= $total_pedidos_pagos ?></strong></span>
                    <a href="?a=lista_pedidos&f=pago">Ver</a>
                </div>
            <?php endif; ?>

        </div>

    </div>
</div>