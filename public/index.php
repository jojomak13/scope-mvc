<?php

    namespace SCOPE;

    use SCOPE\Core\Core;
    use SCOPE\Core\SessionManager;
    use SCOPE\Core\Template;
    use SCOPE\Core\Registry;
    use SCOPE\Core\Language;
    use SCOPE\Core\Messenger;
    use SCOPE\Core\Authentication;

    if(!defined('DS')){
        define('DS', DIRECTORY_SEPARATOR);
    }

    require_once '..' . DS . 'app' . DS . 'config' . DS . 'config.php';
    require_once CORE_PATH . DS . 'autoload.php';

    $session = new SessionManager();
    $session->start();

    // Check the default path
    if(!isset($session->defaultPath)){
        $session->defaultPath = USER_PATH;
    }

    if(!isset($session->lang)){
        $session->lang = DEFAULT_LANGUAGE;
    }

    // SET CSS and JS Images and language PATH
    defined('CSS') ? null : define('CSS', DS . 'assest' . DS . $session->defaultPath . DS . 'css');
    defined('JS') ? null : define('JS', DS . 'assest' . DS . $session->defaultPath . DS . 'js');
    defined('IMAGES') ? null : define('IMAGES', DS . 'assest' . DS . $session->defaultPath . DS . 'images');

    // Get the template parts
    $templateParts = require_once '..' . DS . 'app' . DS . 'config' . DS . $session->defaultPath . 'TempParts.php';
    // Inject the template parts into Template constructor
    $template = new Template($templateParts);

    $auth = Authentication::getInstance($session);

    $messenger = Messenger::getInstance($session);

    $registry = Registry::getInstance();
    $registry->session = $session;
    $registry->language =  new Language();
    $registry->messenger = $messenger;

    // Initialize core class
    $core = new Core($template, $registry, $auth);
    // Start Your App
    $core->renderApp();
