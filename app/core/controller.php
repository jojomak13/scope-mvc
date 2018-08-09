<?php

namespace SCOPE\Core;

use SCOPE\Core\Core; // delete it

class Controller 
{
    protected $_controller;
    protected $_action;
    protected $_params;
    protected $_template;
    protected $_registry;

    protected $_data = []; 


    public function __get($key)
    {
       return $this->_registry->$key;
    }

    public function getController($controller)
    {
        $this->_controller = $controller;
    }

    public function getAction($action)
    {
        $this->_action = $action;
    }

    public function getParams(array $params)
    {
        $this->_params = $params;
    }

    public function getTemplate($template)
    {
        $this->_template = $template;
    }

    public function getRegistry($registry)
    {
        $this->_registry = $registry;
    }

    public function getLanguage($language)
    {
        $this->_language = $language;
    }

    public function view()
    {

       // Set the view path
       $viewPath = VIEWS_PATH . DS . $_SESSION['defaultPath'] . DS . $this->_controller . DS . $this->_action . '.view.php';

       // Check the view file if not exists
       if(!file_exists($viewPath)){
            trigger_error('The View file path <strong id="err">[' . $this->_controller . DS . $this->_action . ']</strong> is not exists', E_USER_WARNING); 
       }
       
       $this->_data = array_merge($this->_data, $this->language->getDictionary());
       
       $this->_template->setActionView($viewPath);
       $this->_template->setData($this->_data);
       $this->_template->setRegistry($this->_registry);
       $this->_template->renderView();

    }

}