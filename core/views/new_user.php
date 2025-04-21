<div class="container">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center text-primary">Registo</h3>

            <form action="?a=user_create" method="post">

   
            <?php if(isset($_SESSION['erro'])):?>  
                    <div class="alert alert-<?= $_SESSION['cor_erro'] ?> text-center p-2">
                        <?= '<i class="bi bi-emoji-'. $_SESSION['face'] . '-fill h1"></i> <br> ' . $_SESSION['erro']; ?>
                        <?php unset($_SESSION['erro']) ?>
                        <?php unset($_SESSION['cor_erro']) ?>
                        <?php unset($_SESSION['erro_email']) ?>
                    </div>
                <?php endif; ?>

               <!-- nome -->
               <div class="my-3">
                    <label>Nome estabelecimento <span class="text-danger h3">*</span></label>
                    <input type="text" name="text_nome" placeholder="Nome" class="form-control" required>
                </div>

                <!-- email -->
                <div class="my-3">
                    <label>Email <span class="text-danger h3">*</span></label>
                    <input type="email" name="text_email" placeholder="Email" class="form-control" required>
                </div>

                <!-- senha_1 -->
                <div class="my-3">
                    <label>Palavra-passe <span class="text-danger h3">*</span></label>
                    <input type="password" name="text_senha_1" placeholder="Senha" class="form-control" required>
                </div>

                <!-- senha_2 -->
                <div class="my-3">
                    <label>Repetir a Palavra-passe <span class="text-danger h3">*</span></label>
                    <input type="password" name="text_senha_2" placeholder="Repetir a senha" class="form-control" required>
                </div>


                <!-- telefone -->
                <div class="my-3">
                    <label>Telemóvel</label>
                    <input type="text" name="text_telemovel" placeholder="Telemovel" class="form-control">
                </div>

                   <!-- telefone -->
                   <div class="my-3">
                    <label>Localidade</label>
                    <input type="text" name="text_localidade" placeholder="Localidade" class="form-control">
                </div>

                <!-- submit -->
                <div class="my-4 text-center">
                    <input type="submit" value="Criar conta" class="btn btn-primary">
                </div>

            </form>


        </div>
    </div>
</div>