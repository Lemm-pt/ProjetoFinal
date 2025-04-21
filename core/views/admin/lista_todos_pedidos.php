<?php 
use core\classes\FastControl;

//    echo "<pre>";
//     var_dump($lista_todos_pedidos);
//     die();
//     echo "</pre>";
?>
<div class="container-fluid">
    <div class="row mt-3">

        <div class="col-md-2">
            <?php include(__DIR__ . '/layouts/admin_menu.php') ?>
        </div>

        <div class="col-md-10">

            <h3>Lista de pedidos </h3>
            <hr>

        <?php if (count($lista_todos_pedidos) == 0) : ?>
            <hr>
            <p>Não existem pedidos registados.</p>
            <hr>
        <?php else : ?>
            <small>
                <table class="table table-striped" id="tabela-todos-pedidos">
                    <thead class="table-dark">
                        <tr>
                           
                            <th>User</th>
                            <th>Mesa</th>
                            <th>Estado</th>
                            <th>Contribuinte</th>
                            <th>Conta</th>
                            <th><i class="bi bi-search h3"></i></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($lista_todos_pedidos as $pedido) : ?>
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
        $('#tabela-todos-pedidos').DataTable({
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

</script>