
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" autocomplete="off">
                        <div class="form-group">
                            <label for="privilegename"><?= @$text_privilegename ?></label>
                            <input type="text" name="privilegename" id="privilegename" class="form-control" value="<?= $privilege->PrivilegeName ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="privilege"><?= @$text_privilege ?></label>
                            <input type="text" name="privilege" id="privilege" class="form-control" value="<?= $privilege->Privilege ?>" required />                     
                        </div>
                        <div class="form-group">
                            <input type="submit" value="<?= @$text_edit ?>" name="edit" class="btn btn-primary btn-rounded">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>