<?php

namespace SCOPE\Controllers\Admin;

use SCOPE\Core\Controller;

class PageController extends Controller
{
    public function notFoundAction()
    {
        $this->language->load('pages.notfound');

        $this->_template->swapTemplate(['view' => ':view_path']);
        $this->view();    
    }

    public function accessDeniedAction()
    {
        $this->language->load('pages.accessdenied');

        $this->_template->swapTemplate(['view' => ':view_path']);
        $this->view();
    }
}