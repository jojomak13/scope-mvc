
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="/users/create" class="btn btn-info btn-addon pull-right"><i class="ti-plus"></i> <?= $text_new_user ?></a>
                    <span class="clearfix"></span>

                    <div class="table-responsive m-t-40">
                        <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?= @$text_username ?></th>
                                    <th><?= @$text_email ?></th>
                                    <th><?= @$text_usergroup ?></th>
                                    <th><?= @$text_lastlogin ?></th>
                                    <th><?= @$text_control ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($users)): foreach($users as $user):?>
                                <tr>
                                    <td><?= $user->UserName ?></td>
                                    <td><?= $user->Email ?></td>
                                    <td><?= $user->GroupName ?></td>
                                    <td><?= $user->LastLogin ?></td>
                                    <td>
                                        <?php if($user->Status == 0) echo '<a href="/users/approve/' . $user->Id .'"  class="btn btn-warning"><i class="fa fa-check"></i></a>' ?>
                                        <a href="/users/edit/<?= $user->Id ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="/users/delete/<?= $user->Id ?>" onclick="niceAlert(event)"  class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
