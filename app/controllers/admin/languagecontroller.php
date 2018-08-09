<?php

namespace SCOPE\Controllers\Admin;

use SCOPE\Core\Controller;
use SCOPE\Helpers\Helper;

class LanguageController extends Controller
{
    use Helper;

    private $langs = ['en', 'ar'];

    public function defaultAction()
    {
       $lang = $this->filterString($this->_params[0]);

       if(in_array($lang, $this->langs)){
            $this->session->lang = $lang;
       }

       $this->redirect($_SERVER['HTTP_REFERER']);
    }
}
