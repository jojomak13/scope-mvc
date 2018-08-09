<?php
/**
 * App core class
 * Create url & load controllers
 * URL Format /controller/method/params
 */

namespace SCOPE\Core;

use SCOPE\Helpers\Helper;
   
class Core {

    use Helper;

    const NOTFOUND_CONTROLLER = 'Page';
    const NOTFOUND_ACTION = 'notFound';

    private $_controller = 'index';
    private $_action = 'default';
    private $_params = [];

    private $_template;
    private $_registry;
    private $_authentication;

    public function __construct(Template $template, Registry $registry, Authentication $auth)
    {
        $this->_template = $template;
        $this->_registry = $registry;
        $this->_authentication = $auth;

        $this->getUrl();
    }

    private function getUrl()
    {   

        $url = ltrim($_SERVER['REQUEST_URI'], '/');
        $url = explode('/', $url, 3);
        
        $this->_controller = !empty($url[0]) ? $url[0] : $this->_controller;
        $this->_action = !empty($url[1]) ? $url[1] : $this->_action; 
        if(!empty($url[2])){
            $this->_params = explode('/', $url[2]);
        }

    }

    public function renderApp()
    {   
      
        // Set the controller full name   
        $controllerName = 'SCOPE\Controllers\\' . ucfirst($_SESSION['defaultPath']) . '\\' . ucfirst($this->_controller) . 'Controller';
        $actionName = ucfirst($this->_action) . 'Action';

        // Check if requested Class AND Method not exists
        if(!class_exists($controllerName) || !method_exists($controllerName, $actionName)){
            $this->_controller = self::NOTFOUND_CONTROLLER;
            $this->_action = self::NOTFOUND_ACTION;
            $actionName = $this->_action . 'Action';
            $controllerName = 'SCOPE\Controllers\\' . ucfirst($_SESSION['defaultPath']) . '\\' . ucfirst($this->_controller) . 'Controller';
        }

        // Start Authentication
        if($this->_authentication->publicAccess($this->_controller, $this->_action)){

            if($this->_authentication->isAuthorized() && $this->_controller == 'auth' && $this->_action == 'login'){
                isset($_SERVER['HTTP_REFERER'])? $this->redirect($_SERVER['HTTP_REFERER']) : $this->redirect('/');
            }
           
            if(!$this->_authentication->hasAccess()){
                $this->redirect('/page/accessdenied');    
            }
        }else {
            if($this->_controller != 'auth' && $this->_action != 'login'){
                $this->redirect('/auth/login'); 
            }
        }
        // End Authentication
    
       
        // Istansiate the requested controller [class]
        $controller = new $controllerName;

        // Send data Main Controller
        $controller->getController($this->_controller);
        $controller->getAction($this->_action);
        $controller->getParams($this->_params);
        $controller->getTemplate($this->_template);
        $controller->getRegistry($this->_registry);
        $controller->$actionName();
        
    }

} 