<div class="container-fluid">
    <div class="row mt-3">
        
        <div class="col-md-2">
            <?php include(__DIR__ . '/layouts/admin_menu.php')?>
        </div>

        <div class="col-md-10">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center text-primary">Inserir produto</h3>

            <form action="?a=inserir_produto" method="post" enctype="multipart/form-data">

   
            <?php if(isset($_SESSION['erro'])):?>  
                    <div class="alert alert-<?= $_SESSION['cor_erro'] ?> text-center p-2">
                        <?= $_SESSION['erro']; ?>
                        <?php unset($_SESSION['erro']) ?>
                        <?php unset($_SESSION['cor_erro']) ?>
                    </div>
                <?php endif; ?>

               <!-- Categoria -->
               <div class="my-3">
                    <label>Categoria produto </label>
                    <input type="text" name="text_categoria" placeholder="Categoria produto" class="form-control">
                </div>

                <!-- Nome -->
                <div class="my-3">
                    <label>Nome produto <span class="text-danger h3">*</span></label>
                    <input type="text" name="text_nome" placeholder="Nome produto" class="form-control" required>
                </div>

                <!-- Descrição -->
                <div class="my-3">
                    <label>Descrição </label>
                    <input type="text" name="text_descricao" placeholder="Descrição" class="form-control">
                </div>

                <!-- preço -->
                <div class="my-3">
                    <label>Preço <span class="text-danger h3">*</span></label>
                    <input type="text" name="text_preco" placeholder="preço" class="form-control" required>
                </div>


                <!-- Stock inicial -->
                <div class="my-3">
                    <label>Stock inicial <span class="text-danger h3">*</span></label>
                    <input type="text" name="text_stock" placeholder="Stock inicial" class="form-control" required>
                </div>

                   <!-- validade -->
                   <div class="my-3">
                    <label>validade</label>
                    <input type="date" name="text_validade" placeholder="validade" class="form-control">
                </div>

                <div class="my-3">
                <label>Inserir imagem</label>
                   <input type="file" name="text_imagem" accept="image/*">
               </div>

                <!-- submit -->
                <div class="my-4 text-center">
                    <input type="submit" value="Inserir" class="btn btn-primary">
                </div>

            </form>
                  

        </div>
        </div>
    </div>
</div>