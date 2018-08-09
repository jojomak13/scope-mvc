
<?php

if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}

 // DataBase
 defined('DB_HOST_NAME')    ? null : define ('DB_HOST_NAME', 'localhost');
 defined('DB_USER_NAME')    ? null : define ('DB_USER_NAME', 'root');
 defined('DB_PASSWORD')     ? null : define ('DB_PASSWORD', '');
 defined('DB_NAME')      ? null : define ('DB_NAME', 'scope-mvc');
 defined('DB_PORT_NUMBER')  ? null : define ('DB_PORT_NUMBER', 3306);
 defined('DB_CONN_DRIVER')  ? null : define ('DB_CONN_DRIVER', 2);

// App Path
define('APP_PATH', realpath(__DIR__) . DS . '..');

// Libraires Path
define('CORE_PATH', APP_PATH . DS . 'core');

// Controllers path
define('CONTROLLERS_PATH', APP_PATH . DS . 'controllers');

// Models Path
define('MODELS_PATH', APP_PATH . DS . 'models');

// Views Path
define('VIEWS_PATH', APP_PATH . DS . 'views');

// Default user path
define('USER_PATH', 'user');

//  Amdin path
define('ADMIN_PATH', 'admin');

// Template Path
define('TEMPLATE_PATH', APP_PATH . DS . 'templates');

// Session Handler
defined('SESSION_NAME') ? null : define('SESSION_NAME', '_ESTORE_SESSION');
defined('SESSION_LIFE_TIME') ? null : define('SESSION_LIFE_TIME', 0);
defined('SESSION_SAVE_PATH') ? null : define('SESSION_SAVE_PATH', APP_PATH . DS . '..' . DS . 'session');

// Default Language
define('DEFAULT_LANGUAGE', 'en');

// Language path
define('LANGUAGE_PATH', APP_PATH . DS . 'languages');

// Salt
defined('APP_SALT') ? null : define ('APP_SALT', '$2a$07$wOuAuWbJ67Oa4EgqO11GjG$');

 // Uplaod Save Path
 defined('UPLOAD_PATH') ? null : define('UPLOAD_PATH', APP_PATH . DS . '..' . DS . 'public' . DS . 'uploads');
 defined('IMAGE_UPLOAD_PATH') ? null : define('IMAGE_UPLOAD_PATH', UPLOAD_PATH . DS . 'images');
 defined('DOCS_UPLOAD_PATH') ? null : define('DOCS_UPLOAD_PATH', UPLOAD_PATH . DS . 'docs');
// Max upload file size
defined('MAX_UPLOAD_SIZE')? null : define('MAX_UPLOAD_SIZE', ini_get('upload_max_filesize'));
