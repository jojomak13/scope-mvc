
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" autocomplete="off">
                        <div class="form-group">
                            <label for="groupName"><?= @$text_groupName ?></label>
                            <input type="text" name="groupName" id="groupName" class="form-control" value="<?= $this->getValue('groupName')?>" />
                        </div>
                        
                        <!-- Start privileges -->
                        <div class="m-b-20">
                            <h3><?= @$text_groupPrivileges ?></h3>
                            <div class="row">
                                <?php if($privileges != false): foreach($privileges as $privilege): ?>
                                <div class="col-md-4">
                                    <div class="check-input">
                                        <label for="<?= $privilege->PrivilegeName ?>"><?= $privilege->PrivilegeName ?></label>
                                        <input type="checkbox" name="privilege[]" id="<?= $privilege->PrivilegeName ?>" value="<?= $privilege->PrivilegeId ?>">
                                    </div>
                                </div>
                                <?php endforeach; endif; ?>
                            </div>
                        </div>
                        <!-- End privileges -->
                        <div class="form-group">
                            <input type="submit" value="<?= @$text_create ?>" name="add" class="btn btn-primary btn-rounded">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>