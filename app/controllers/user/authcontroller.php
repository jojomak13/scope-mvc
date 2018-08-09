<?php

namespace SCOPE\Controllers\User;

use SCOPE\Core\Controller;
use SCOPE\Models\UsersModel;
use SCOPE\Helpers\Validate;
use SCOPE\Helpers\Helper;
use SCOPE\Core\Messenger;

class AuthController extends Controller
{
    use Validate;
    use Helper;

    private $inputs_roles = [
        'username' => 'req',
        'password' => 'req'
    ];

    public function loginAction()
    {
        $this->_template->swapTemplate(['view' => ':view_path']);
        $this->language->load('validate.messages');
        $this->language->load('auth.login');
        $this->language->load('auth.labels');
        
        if(isset($_POST['login']) && $this->isValid($this->inputs_roles, $_POST)){
           $username = $this->filterString($_POST['username']);
           $founduser = UsersModel::LoginAuth($username, $_POST['password'], $this->session);
           
           if($founduser){
               $this->messenger->add('Login Successfully', MESSENGER::APP_MESSAGE_SUCCESS, 'Welcome ' . $founduser[0]);
               if($founduser[1] == 2){
                  $this->redirect('/changepath');    
               } else {
                    $this->redirect('/');
               }
           } else {
               $this->messenger->add('Wrong details', MESSENGER::APP_MESSAGE_ERROR, 'Admin Authenticate');
           }
        }
        
        $this->view(); 
    }

    public function logoutAction()
    {
        $this->session->kill();
        $this->redirect('/');
    }
}