<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="firstname"><?= @$text_firstname ?></label>
                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?= $this->getValue('firstname')?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname"><?= @$text_lastname ?></label>
                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?= $this->getValue('lastname')?>">
                        </div>
                        <div class="form-group">
                            <label for="username"><?= @$text_username ?></label>
                            <input type="text" class="form-control" name="username" id="username" value="<?= $this->getValue('username')?>">
                        </div>
                        <div class="form-group">
                            <label for="password"><?= @$text_password ?></label>
                            <input type="password" class="form-control" name="password" id="password" value="<?= $this->getValue('password')?>">
                        </div>
                        <div class="form-group">
                            <label for="cnpassword"><?= @$text_cnpassword ?></label>
                            <input type="password" class="form-control" name="cnpassword" id="cnpassword" value="<?= $this->getValue('cnpassword')?>">
                        </div>
                        <div class="form-group">
                            <label for="email"><?= @$text_email ?></label>
                            <input type="text" class="form-control" name="email" id="email" value="<?= $this->getValue('email')?>">
                        </div>
                        <div class="form-group">
                            <label for="image"><?= @$text_image ?></label>
                            <input type="file" class="form-control" name="image" id="image" value="<?= $this->getValue('image')?>">
                        </div>
                        <div class="form-group">
                            <label for="usergroup"><?= @$text_usergroup ?></label>
                            <select name="usergroup" id="usergroup" class="form-control">
                            <option value=""><?= @$text_choose_group ?></option>
                            <?php if(!empty($usersgroups)): foreach($usersgroups as $usergroup): ?>
                                <option value="<?= $usergroup->GroupId ?>"><?= $usergroup->GroupName ?></option>
                            <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="<?= @$text_create ?>" name="add" class="btn btn-primary btn-rounded">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>