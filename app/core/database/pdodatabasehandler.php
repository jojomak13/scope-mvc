<?php

namespace SCOPE\Core\DataBase;

class PDODataBaseHandler extends DatabaseHandler
{
    
    private static $_instance;
    private static $_handler;

    private static $_dsn = 'mysql:hostname=' . DB_HOST_NAME . ';dbname=' .  DB_NAME;
    private static $_options = [
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
       \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
    ];


    private function __construct(){
        self::init();
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array(&self::$_handler, $name), $arguments);
    }

    protected static function init()
    {
        try {
            self::$_handler = new \PDO(self::$_dsn, DB_USER_NAME, DB_PASSWORD, self::$_options);
        
        } catch (\PDOException $e){
          echo 'Can\'t connect to database ' . $e->getMessage();  
        }
    }

    public static function getInstance()
    {
        if(self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}




   
   
    