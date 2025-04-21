<div class="container">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center text-primary"><?= $_SESSION['erro'] ?></h3>
   
            <?php if(isset($_SESSION['erro'])):?>  
                    <div class="alert alert-<?= $_SESSION['cor_erro'] ?> text-center p-2">
                        <?= '<i class="bi bi-emoji-'. $_SESSION['face'] . '-fill h1"></i>' ?>
                        <p clas="text-primary">Por questões de segurança foi-lhe enviado um email</p>
                        <p clas="text-primary">Verifique a sua caixa de entrada para validar conta <br>
                            <span class="text-danger">(também poderá estar em spam)</span></p>
                         <!-- back -->
                <div class="my-4 text-center">
                    <a href="?a=inicio"><input type="submit" value="Voltar" class="btn btn-primary"></a>
                </div>
                        <?php unset($_SESSION['erro']) ?>
                        <?php unset($_SESSION['cor_erro']) ?>
                        <?php unset($_SESSION['erro_email']) ?>
                    </div>
                <?php endif; ?>

            


        </div>
    </div>
</div>