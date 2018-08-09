<?php

namespace SCOPE\Core;

class Authentication
{
    private static $_instance;
    private $_session;

    private $url;
    private $publicUrls = [
        '/auth/login',
        '/auth/logout',
        '/index/default',
        '/page/accessdenied',
        '/page/notfound',
        '/language/default',
    ];

    private function __construct($session)
    {
        $this->_session = $session;
    }

    private function __clone() {}

    public static function getInstance(SessionManager $session)
    {
       if(self::$_instance === NULL){
          self::$_instance = new self($session);
       }
       return self::$_instance;
    }

    public function publicAccess($controller, $action)
    {
        $this->url = strtolower('/' . $controller . '/' . $action);
        return isset($this->_session->auth) || in_array($this->url, $this->publicUrls) ? true : false;
    }

    public function isAuthorized()
    {
        return isset($this->_session->auth);
    }

    public function hasAccess()
    {
        if(in_array($this->url, $this->publicUrls) || in_array($this->url, $this->_session->auth->privileges)){
            return true;
        }
        return false;
    }

}
