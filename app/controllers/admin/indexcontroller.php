<?php

namespace SCOPE\Controllers\Admin; 

use SCOPE\Core\Controller;

class IndexController extends Controller
{
    
    public function defaultAction()
    {
        
        $this->language->load('template.temp');
        $this->language->load('index.default');
        $this->view();
    }
}