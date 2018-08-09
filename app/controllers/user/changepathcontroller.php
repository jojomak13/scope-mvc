<?php

namespace SCOPE\Controllers\User;

use SCOPE\Core\Controller;
use SCOPE\helpers\Helper;

class ChangePathController extends Controller
{
    use Helper;

    public function defaultAction()
    {

        if($_SESSION['defaultPath'] == USER_PATH){
            $_SESSION['defaultPath'] = ADMIN_PATH;
        } else {
            $_SESSION['defaultPath'] = USER_PATH;
        }

        $this->redirect('/');
    }
}