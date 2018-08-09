
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="usersprivileges/create" class="btn btn-info btn-addon pull-right"><i class="ti-plus"></i> <?= @$text_add_privilege?></a>
                    <span class="clearfix"></span>
                    <div class="table-responsive m-t-40">
                        <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?= @$text_privilegename ?></th>
                                    <th><?= @$text_privilege ?></th>
                                    <th><?= @$text_control ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($privileges)): foreach($privileges as $privilege):?>
                                <tr>
                                    <td><?= $privilege->PrivilegeName ?></td>
                                    <td><?= $privilege->Privilege ?></td>
                                    <td>
                                        <a href="usersprivileges/edit/<?= $privilege->PrivilegeId ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="usersprivileges/delete/<?= $privilege->PrivilegeId ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>