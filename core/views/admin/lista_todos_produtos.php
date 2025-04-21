<?php
    use core\classes\FastControl;
    // echo "<pre>";
    // var_dump($produtos);
    // die();
    // echo "</pre>";
?>

<div class="container-fluid">
    <div class="row mt-3">
        
        <div class="col-md-2">
            <?php include(__DIR__ . '/layouts/admin_menu.php')?>
        </div>

        <div class="col-md-10">
            <h3>Lista de produtos</h3>
            <hr>

            <?php if(count($produtos) == 0): ?>
                <p class="text-center text-muted">Não existem produtos registados.</p>
            <?php else: ?>
                <!-- apresenta a tabela de produtos -->
                <table class="table table-striped" id="tabela-todos-produtos">
                    <thead class="table-dark">
                        <tr  class="text-center">
                            
                            <th></th>
                            <th>Nome</th>
                            <th class="text-center">Preço</th>
                            <th class="text-center">Stock inicial</th>
                            <th class="text-center">Validade</th>
                            <th class="text-center">Ação</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($produtos as $produto): ?>
                            <tr class="text-center">
                                
                                <td><img src="../assets/images/produtos/<?= $produto->imagem ?>" class="img-fluid" width="55" height="55"></td>
                                <td>
                                    <a href="?a=detalhe_produto&p=<?= FastControl::aesEncriptar($produto->id_produto)?>"><?= $produto->nome_produto ?></a>                                    
                                </td>
                                <td><?= $produto->preco ?></td>
                                <td><?= $produto->stock ?></td>
                                <td><?= $produto->validade ?></td>
                                <td>
                                   <a href="?a=detalhe_produto&p=<?= FastControl::aesEncriptar($produto->id_produto) ?>">
                                      <i class="fas fa-search"></i>
                                   </a> &nbsp;
                                   <a href="?a=produto_editar&amp;id=20">
                                      <i class="fas fa-pencil-alt"></i>
                                   </a>&nbsp;
                                   <a href="?a=produto_eliminar&amp;id=20">
                                      <i class="fas fa-trash-alt"></i>
                                   </a>
                                 </td>
                            </tr>
                        <?php endforeach;?>

                    </tbody>
                </table> <br><br><br>
            <?php endif; ?>

        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tabela-todos-produtos').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No data available in table",
                "info": "Mostrando página _PAGE_ de um total de _PAGES_",
                "infoEmpty": "Não existem produtos disponíveis",
                "infoFiltered": "(Filtrado de um total de _MAX_ produtos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Apresenta _MENU_ produtos por página",
                "loadingRecords": "Carregando...",
                "processing": "Processando...",
                "search": "Procurar:",
                "zeroRecords": "Não foram encontradas produtos",
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