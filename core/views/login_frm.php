<div class="container">
    <div class="row my-5">
        <div class="col-sm-4 offset-sm-4">

            <div>
                <h3 class="text-center text-success">LOGIN</h3>

                <form action="?a=login_submit" method="post">

                <?php if(isset($_SESSION['erro'])):?>  
                    <div class="alert alert-<?= $_SESSION['cor_erro'] ?> text-center p-2">
                        <?= '<i class="bi bi-emoji-'. $_SESSION['face'] . '-fill h1"></i> <br> ' . $_SESSION['erro']; ?>
                        <?php unset($_SESSION['erro']) ?>
                        <?php unset($_SESSION['cor_erro']) ?>
                        <?php unset($_SESSION['face']) ?>
                    </div>
                <?php endif; ?>

                    <div class="my-3">
                        <label>Email:</label>
                        <input type="email" name="text_email" placeholder="Email" required class="form-control">
                    </div>

                    <div class="my-3">
                        <label>Palavra-passe:</label>
                        <input type="password" name="text_senha" placeholder="Palavra-passe" required class="form-control">
                    </div>

                    <div class="my-3 text-center">
                        <input type="submit" value="Entrar" class="btn btn-primary">
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>