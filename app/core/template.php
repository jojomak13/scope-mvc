<?php

namespace SCOPE\Core;

use SCOPE\Helpers\TemplateHelper;

class Template
{
    use TemplateHelper;
    
    private $_templateParts;
    private $_actionView;
    private $_registry;
    private $_data;


    public function __get($key)
    {
        return $this->_registry->$key;
    }
    
    public function __construct($templateParts)
    {
        $this->_templateParts = $templateParts;
        echo $this->_actionView;
    }

    public function setActionView($actionViewPath)
    {
        $this->_actionView = $actionViewPath;
    }

    public function setData($data)
    {
        $this->_data = $data;
    }

    public function setRegistry($registry)
    {
        $this->_registry = $registry;
    }

    private function renderHeadStart()
    {
       extract($this->_data);
       require_once TEMPLATE_PATH . DS . $_SESSION['defaultPath'] . DS . 'headstart.php' ;
    }

    private function renderHeadEnd()
    {
        extract($this->_data);
        require_once TEMPLATE_PATH . DS . $_SESSION['defaultPath'] . DS . 'headend.php' ;
    }

    private function renderFooter()
    {
        extract($this->_data);
        require_once TEMPLATE_PATH . DS . $_SESSION['defaultPath'] . DS . 'footer.php' ;
    }

    public function swapTemplate($template)
    {
        $this->_templateParts['template'] = $template;
    }

    public function addScript($script)
    {
        if(array_key_exists('footer_resources', $this->_templateParts))
        {
           $this->_templateParts['footer_resources'] = array_merge($this->_templateParts['footer_resources'], $script); 
        }
    }

    private function renderTemplate()
    {
        if(array_key_exists('template', $this->_templateParts)) {
            extract($this->_data);
            foreach($this->_templateParts['template'] as $key => $file)
            {
                if($file == ':view_path'){
                    require_once($this->_actionView); 
                } else {
                    require_once TEMPLATE_PATH . DS . $_SESSION['defaultPath'] . DS . $file;
                }
            }
        }
    }

    private function renderHeaderResources()
    {
        if(array_key_exists('header_resources', $this->_templateParts))
        {
            $resources = '';
            $headerResources = $this->_templateParts['header_resources'][$this->session->lang];
            foreach($headerResources as $key => $file){
                if(preg_match('/.css/i', $file)){
                    $resources .= '<link rel="stylesheet" href="' . CSS . DS . $file . '">';
                } else {
                    $resources .= '<script src="' . JS . DS . $file . '"></script>';
                }
            } 
        }
        echo $resources;
    }

    private function renderFooterResources()
    {
        if(array_key_exists('footer_resources', $this->_templateParts))
        {
            $resources = '';
            $headerResources = $this->_templateParts['footer_resources'];
            foreach($headerResources as $key => $file){
                $resources .= '<script src="' . JS . DS . $file . '"></script>';
            } 
        }
        echo $resources;
    }

    public function renderView()
    {
        $this->renderHeadStart();
        $this->renderHeaderResources();
        $this->renderHeadEnd();

        $this->renderTemplate();

        $this->renderFooterResources();
        $this->renderFooter();
    }
   
}