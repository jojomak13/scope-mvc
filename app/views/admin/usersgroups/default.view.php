
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="/usersgroups/create" class="btn btn-info btn-addon pull-right"><i class="ti-plus"></i> <?= $text_new_group ?></a>
                    <span class="clearfix"></span>
                    <div class="table-responsive m-t-40">
                        <table class="display nowrap table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th><?= @$text_groupName ?></th>
                                    <th><?= @$text_control ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($groups)): foreach($groups as $group):?>
                                <tr>
                                    <td><?= $group->GroupName ?></td>
                                    <td>
                                        <a href="usersgroups/edit/<?= $group->GroupId ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="usersgroups/delete/<?= $group->GroupId ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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