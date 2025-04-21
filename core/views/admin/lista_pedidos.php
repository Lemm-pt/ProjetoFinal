<?php 
use core\classes\FastControl;
?>
<div class="container-fluid">
    <div class="row mt-3">

        <div class="col-md-2">
            <?php include(__DIR__ . '/layouts/admin_menu.php') ?>
        </div>

        <div class="col-md-10">

            <h3>Lista de pedidos <?= $filtro != '' ? $filtro : '' ?></h3>
            <hr>

            <div class="row">
                <div class="col">
                    <a href="?a=lista_pedidos" class="btn btn-primary btn-sm">Ver todos os pedidos de hoje</a>
                </div>
                <div class="col">
                    <?php
                    $f = '';
                    if (isset($_GET['f'])) {
                        $f = $_GET['f'];
                    }
                    ?>

                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 text-end col-form-label">Escolher estado:</label>
                        <div class="col-sm-8">
                            <select id="combo-status" class="form-control" onchange="definir_filtro()">
                                <option value="" <?= $f == '' ? 'selected' : '' ?>></option>
                                <option value="pendente" <?= $f == 'pendente' ? 'selected' : '' ?>>Pendentes</option>
                                <option value="pago" <?= $f == 'pago' ? 'selected' : '' ?>>Pagos</option>
                                <option value="cancelada" <?= $f == 'cancelada' ? 'selected' : '' ?>>Canceladas</option>
                            </select>
                        </div>
                    </div>
            </div>
        </div>

        <?php if (count($lista_pedidos) == 0) : ?>
            <hr>
            <p>Não existem pedidos registados.</p>
            <hr>
        <?php else : ?>
            <small>
                <table class="table table-striped" id="tabela-pedidos">
                    <thead class="table-dark">
                        <tr>
                            <th>User</th>
                            <th>mesa</th>
                            <th>Estado</th>
                            <th>Contribuinte</th>
                            <th>Conta</th>
                            <th><i class="bi bi-search h3"></i></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($lista_pedidos as $pedido) : ?>
                            <tr>
                                <td><?= $pedido->user ?></td>
                                <td><?= $pedido->mesa ?></td>
                                <td><?= $pedido->estado ?></td>
                                <td><?= $pedido->contribuinte ?></td>
                                <td><?= '€' . $pedido->conta ?></td>
                                <td> <!-- aesEncriptar para encriptar o id na url em vez de 10 por,ex. aparece uma hash -->
                                    <a href="?a=detalhe_pedido&p=<?= FastControl::aesEncriptar($pedido->id_pedido) ?>">Detalhes</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table><br><br><br>
                <small>
                <?php endif; ?>

    </div>

</div>
</div>

<script>
    $(document).ready(function() {
        $('#tabela-pedidos').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No data available in table",
                "info": "Mostrando página _PAGE_ de um total de _PAGES_",
                "infoEmpty": "Não existem encomendas disponíveis",
                "infoFiltered": "(Filtrado de um total de _MAX_ encomendas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Apresenta _MENU_ encomendas por página",
                "loadingRecords": "Carregando...",
                "processing": "Processando...",
                "search": "Procurar:",
                "zeroRecords": "Não foram encontradas encomendas",
                "paginate": {
                    "first": "Primeira",
                    "last": "Última",
                    "next": "Seguinte",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": ativar para ordenar a coluna de forma ascendente",
                    "sortDescending": ": ativar para ordenar a coluna de forma descendente"
                }
            }
        });
    });

    function definir_filtro() {
        var filtro = document.getElementById("combo-status").value;
        // reload da página com determinado filtro
        window.location.href = window.location.pathname + "?" + $.param({
            'a': 'lista_pedidos',
            'f': filtro
        });
    }
</script>