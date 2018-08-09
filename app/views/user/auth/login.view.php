<script>
window.onload = function(){
<?php
    $msgs = $this->messenger->getMessages();
    if(!empty($msgs)): foreach($msgs as $data):
?>
        msg("<?= $data[0] ?>", "<?= $data[1] ?>", "<?= $data[2]?>")
<?php endforeach; endif;?>
}
</script>

<div class="unix-login">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="login-content card">
                    <div class="login-form">
                        <h3><?= @$head ?></h3>
                        <form method="POST" autocomplete="off">
                            <div class="form-group">
                                <label><?= @$text_username ?></label>
                                <input type="text" class="form-control" name="username" placeholder="<?= @$text_username ?>">
                            </div>
                            <div class="form-group">
                                <label><?= @$text_password ?></label>
                                <input type="password" class="form-control" name="password" placeholder="<?= @$text_password ?>">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remeber"> <?= @$text_remeber ?>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-dark m-b-30 m-t-30" name="login"><?= @$login ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
