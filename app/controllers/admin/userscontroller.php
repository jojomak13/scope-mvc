<?php

namespace SCOPE\Controllers\Admin;

use SCOPE\Core\Controller;
use SCOPE\Models\UsersModel;
use SCOPE\Models\UsersGroupsModel;
use SCOPE\Models\ProfilesModel;
use SCOPE\Helpers\Helper;
use SCOPE\Helpers\Validate;
use SCOPE\Core\Messenger;
use SCOPE\Core\FileUploader;

class UsersController extends Controller
{
    use Helper;
    use Validate;

    private $label_validate = [
        'firstname'   => 'req',
        'lastname'    => 'req',
        'username'    => 'req',
        'password'    => 'eqfield(cnpassword)',
        'email'       => 'req|email',
        'usergroup'   => 'req|int'
    ];

    public function defaultAction()
    {
       $scripts = [
        '1' => 'datatables.min.js',
        '2' => 'dataTables.buttons.min.js',
        '3' => 'buttons.flash.min.js',
        '4' => 'jszip.min.js',
        '5' => 'pdfmake.min.js',
        '6' => 'vfs_fonts.js',
        '7' => 'buttons.html5.min.js',
        '8' => 'buttons.print.min.js',
        '9' => 'datatables-init.js',
       ];
       $this->_template->addScript($scripts);

       $this->language->load('template.temp');
       $this->language->load('users.default');
       $this->language->load('users.labels');

       $this->_data['users'] = UsersModel::getAll();

       $this->view();
    }


    public function createAction()
    {

        $this->language->load('template.temp');
        $this->language->load('users.create');
        $this->language->load('users.labels');
        $this->language->load('validate.messages');

        $this->_data['usersgroups'] = UsersGroupsModel::getAll();

        if(isset($_POST['add']) && $this->isValid($this->label_validate, $_POST)){

            $user = new UsersModel();
            $user->UserName = $this->filterString($_POST['username']);
            $user->cryptPassword($_POST['password']);
            $user->Email = $this->filterEmail($_POST['email']);
            $user->GroupId = $this->filterInt($_POST['usergroup']);
            $user->Status = 1;
            $user->SubscriptionDate = date('Y-m-d', time());
            $user->LastLogin = date('Y-m-d h:i:s', time());

             // Check if the user exists
             if(UsersModel::getBy(['UserName' => [$user->UserName, UsersModel::DATA_TYPE_STR]])){
                $this->messenger->add('User name already exists try another one', Messenger::APP_MESSAGE_WARNING);
                $this->redirect('/users/create');
            }

            if(!empty($_FILES['image']['name'])){
                $image = new FileUploader($_FILES['image']);
                try{
                    $image->upload();
                }catch(\Exception $e){
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $this->redirect('/users/create');
                }
            }

            if($user->save()){
                $profile = new ProfilesModel();
                $profile->Id = $user->Id;
                $profile->FirstName = $this->filterString($_POST['firstname']);
                $profile->LastName = $this->filterString($_POST['lastname']);
                $profile->Image = !empty($image)? $image->getFullName() : '';
                if($profile->save(false)){
                    $this->messenger->add('User create successfully');
                } else {
                    $this->messenger->add('Some thing went wrong please try again', Messenger::APP_MESSAGE_ERROR);
                }

            } else {
                $this->messenger->add('Some thing went wrong please try again', Messenger::APP_MESSAGE_ERROR);
            }

            $this->redirect('/users');
        }

        $this->view();
    }

    public function editAction()
    {
        $userid = $this->filterInt($this->_params[0]);

        $userdata = UsersModel::getUser($userid);

        if($userid == false){
            $this->messenger->add('There is no user with this id', MESSENGER::APP_MESSAGE_ERROR);
            $this->redirect('/users');
        }

        $this->language->load('template.temp');
        $this->language->load('users.edit');
        $this->language->load('users.labels');
        $this->language->load('validate.messages');

        $this->_data['user'] = $userdata;
        $this->_data['usersgroups'] = UsersGroupsModel::getAll();

        if(isset($_POST['edit']) && $this->isValid($this->label_validate, $_POST)){

            $user = new UsersModel();
            $user->Id = $userid;
            $user->UserName = $this->filterString($_POST['username']);
            $user->Email = $this->filterEmail($_POST['email']);
            $user->cryptPassword($_POST['password'], $userdata->Password);
            $user->GroupId = $this->filterInt($_POST['usergroup']);
            $user->Status = $userdata->Status;
            $user->SubscriptionDate = date('Y-m-d', time());
            $user->LastLogin = date('Y-m-d h:i:s', time());

            if(UsersModel::userExists($user->UserName, $user->Id)){
                $this->messenger->add('User name already exists try another one', Messenger::APP_MESSAGE_WARNING);

            } else {

                $image = $userdata->Image;
                if(!empty($_FILES['image']['name'])){
                    $image = new FileUploader($_FILES['image']);
                    try{
                        $image->upload();
                    }catch(\Exception $e){
                        $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                        $this->redirect('/users/create');
                    }
                    // Check if there is no image from last time
                    !empty($userdata->Image)? unlink(IMAGE_UPLOAD_PATH . DS . $userdata->Image) : '';
                    $image = $image->getFullName();
                }

                if($user->save()){
                    $profile = new ProfilesModel();
                    $profile->Id = $user->Id;
                    $profile->FirstName = $this->filterString($_POST['firstname']);
                    $profile->LastName =  $this->filterString($_POST['lastname']);
                    $profile->Image = $image;

                    $profile->save();
                    $this->messenger->add('User edit successfully');
                } else {
                    $this->messenger->add('Some thing went wrong please try again', Messenger::APP_MESSAGE_ERROR);
                }
                $this->redirect('/users');
            }

        }

        $this->view();
    }

    public function deleteAction()
    {
        $userid = $this->filterInt($this->_params[0]);

        $user = UsersModel::getByPK($userid);

        if($user == false){
            $this->messenger->add('There is no user with this id', MESSENGER::APP_MESSAGE_ERROR);
            $this->redirect('/users');
        }

        if($user->delete()){
            $this->messenger->add('User deleted successfully');
        }else{
            $this->messenger->add('Some thing went wrong please try again', MESSENGER::APP_MESSAGE_ERROR);
        }

        $this->redirect('/users');
    }

    public function approveAction()
    {
        $userid = $this->filterInt($this->_params[0]);

        $userdata = UsersModel::getByPK($userid);

        if($userdata == false){
            $this->messenger->add('There is no user with this id', MESSENGER::APP_MESSAGE_ERROR);
            $this->redirect('/users');
        }

        $user = new UsersModel();
        $user = $userdata;
        $user->Status = 1;

        if($user->save()){
            $this->messenger->add('User approved successfully');
        }else{
            $this->messenger->add('Some thing went wrong please try again', MESSENGER::APP_MESSAGE_ERROR);
        }

        $this->redirect('/users');
    }

}
