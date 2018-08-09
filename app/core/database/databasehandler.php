<?php

namespace SCOPE\Core\DataBase;

abstract class DataBaseHandler
{
    const DB_DRIVER_MYSQLI = 1;
    const DB_DRIVER_PDO = 2;

    private function __construct() {}

    abstract protected static function init();
    abstract protected static function getInstance();
    
    public static function factory()
    {
        $currentDriver = DB_CONN_DRIVER;

        if($currentDriver == self::DB_DRIVER_PDO){
            return PDODataBaseHandler::getInstance();
        } elseif($currentDriver == self::DB_DRIVER_MYSQLI) {
            return ;
        }
    }
}