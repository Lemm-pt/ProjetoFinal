<div class="container">
    <div class="row my-5">
        <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1">
         <!-- alterar_dados_pessoais_submit vai para o controlador Main -->
        <form action="?a=alterar_dados_pessoais_submit" method="post"> 

        <? // print_r($dados_pessoais); ?>

            <div class="form-group">
                <label>Email:</label> <!-- maxlength determina o tamanho do input tal como está na BD -->
                <input type="email" maxlength="50" name="text_email" class="form-control" required value="<?= $dados_pessoais->email ?>">
            </div>

            <div class="form-group">
                <label>Estabelicimento:</label>
                <input type="text" maxlength="77" name="text_nome" class="form-control" required value="<?= $dados_pessoais->user ?>">
            </div>

            <div class="form-group">
                <label>Telemóvel:</label>
                <input type="text" maxlength="20" name="text_telemovel" class="form-control" value="<?= $dados_pessoais->telemovel ?>">

            <div class="form-group">
                <label>Localidade:</label>
                <input type="text" maxlength="250" name="text_localidade" class="form-control" required value="<?= $dados_pessoais->localidade ?>">
            </div>

            <div class="text-center my-4"> <!-- btn-100 defenido em app.cs com min-width -->
                <a href="?a=perfil" class="btn btn-primary btn-100">Cancelar</a>
                <input type="submit" value="Salvar" class="btn btn-primary btn-100">
            </div>

        </form>
<!-- a mensagem de erro foi guardada na session em "alterar_dados_pessoais_submit" e "alterar_password_submit" no controler Main -->
        <?php if(isset($_SESSION['erro'])):?> 
            <div class="alert alert-danger text-center p-2">
                <?= $_SESSION['erro'] ?>
                <?php unset($_SESSION['erro']) ?>
            </div>
        <?php endif; ?>

        </div>
    </div>
</div>