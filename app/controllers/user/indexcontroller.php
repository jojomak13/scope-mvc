<?php

namespace SCOPE\Controllers\User; 

use SCOPE\Core\Controller;

class IndexController extends Controller
{

    public function defaultAction()
    {
        $this->language->load('index.default');  

        $this->view();   
    }

}