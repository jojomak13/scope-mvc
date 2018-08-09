<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="firstname"><?= @$text_firstname ?></label>
                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?= $user->FirstName ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname"><?= @$text_lastname ?></label>
                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?= $user->LastName ?>">
                        </div>
                        <div class="form-group">
                            <label for="username"><?= @$text_username ?></label>
                            <input type="text" class="form-control" name="username" id="username" value="<?= $user->UserName ?>">
                        </div>
                        <div class="form-group">
                            <label for="password"><?= @$text_password ?></label>
                            <input type="password" class="form-control" name="password" id="password" >
                        </div>
                        <div class="form-group">
                            <label for="cnpassword"><?= @$text_cnpassword ?></label>
                            <input type="password" class="form-control" name="cnpassword" id="cnpassword" >
                        </div>
                        <div class="form-group">
                            <label for="email"><?= @$text_email ?></label>
                            <input type="text" class="form-control" name="email" id="email" value="<?= $user->Email ?>">
                        </div>
                        <div class="form-group">
                            <label for="image"><?= @$text_image ?></label>
                            <input type="file" class="form-control" name="image" id="image" value="<?= $this->getValue('image')?>">
                        </div>
                        <div class="form-group">
                            <label for="usergroup"><?= @$text_usergroup ?></label>
                            <select name="usergroup" id="usergroup" class="form-control">
                            <?php if(!empty($usersgroups)): foreach($usersgroups as $usergroup): ?>
                                <option value="<?= $usergroup->GroupId ?>" <?= $this->selected($user->GroupId, $usergroup->GroupId) ?>><?= $usergroup->GroupName ?></option>
                            <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="<?= @$text_save ?>" name="edit" class="btn btn-primary btn-rounded">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
