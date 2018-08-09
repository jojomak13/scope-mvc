<?php

namespace SCOPE\Controllers\Admin;

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


    public function loginAction() {}

    public function logoutAction()
    {
        $this->session->kill();
        $this->redirect('/');
    }
}