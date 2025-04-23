<?php 
use core\classes\FastControl;
?>
<div class="container-fluid navegacao">
    <div class="row">
        <div class="col-6 p-3">
            <h3>ESPLANAPP ADMIN</h3>
        </div>
        <div class="col-6 p-3 text-end align-self-center">
            <?php if(FastControl::adminLogado()):?>
                <i class="fas fa-user me-2 text-warning"></i>
                <?= $_SESSION['admin_usuario'] ?>
                <span class="mx-2">|</span>
                <a href="?a=admin_logout"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
            <?php endif; ?>
        </div>
    </div>
</div>