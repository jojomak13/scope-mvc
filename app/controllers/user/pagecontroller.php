<?php

namespace SCOPE\Controllers\User;

use SCOPE\Core\Controller;

class PageController extends Controller
{
    public function notFoundAction()
    {
        $this->_template->swapTemplate(['view' => ':view_path']);
        $this->view();    
    }

    public function accessDeniedAction()
    {
        $this->_template->swapTemplate(['view' => ':view_path']);
        $this->view();
    }
}