<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('..') . '/');

try {
    $config = new Phalcon\Config\Adapter\Ini(APP_PATH . '/config.ini');

    define('DEBUG_MODE', $config->global->debugMode);

    ini_set('display_errors', DEBUG_MODE);
    ini_set('display_startup_errors', DEBUG_MODE);
    date_default_timezone_set($config->global->timeZone);

    $loader = new Phalcon\Loader();
    include APP_PATH . '/app/config/loader.php';

    /**
     * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
     */
    $di = new Phalcon\Di\FactoryDefault();
    include APP_PATH . '/app/config/services.php';

    $application = new Phalcon\Mvc\Application($di);
    $response = $application->handle();
    $response->send();
} catch(\Exception $e) {
    if (DEBUG_MODE) {
        echo $e->getMessage() . '<br>';
        echo '<pre>' . $e->getTraceAsString() . '</pre>';
    }
}