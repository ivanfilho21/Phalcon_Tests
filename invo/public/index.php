<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('..') . '/');

use Dotenv\Dotenv;

try {
    require_once APP_PATH . 'vendor/autoload.php';
    
    /**
     * Load ENV variables
     */
    
    Dotenv::createImmutable(APP_PATH)->load();
    
    define('DEBUG_MODE', getenv('DEBUG_MODE') == '1' || strcasecmp('TRUE', getenv('DEBUG_MODE')) == 0);

    ini_set('display_errors', DEBUG_MODE);
    ini_set('display_startup_errors', DEBUG_MODE);
    date_default_timezone_set(getenv('TIME_ZONE'));

    /**
     * Load configuration
     */
    $config = include APP_PATH . 'app/config/config.php';

    $loader = new Phalcon\Loader();
    include APP_PATH . 'app/config/loader.php';

    /**
     * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
     */
    $di = new Phalcon\Di\FactoryDefault();
    include APP_PATH . 'app/config/services.php';

    $application = new Phalcon\Mvc\Application($di);
    $response = $application->handle();
    $response->send();
} catch(\Exception $e) {
    if (DEBUG_MODE) {
        echo $e->getMessage() . '<br>';
        echo '<pre>' . $e->getTraceAsString() . '</pre>';
    }
}