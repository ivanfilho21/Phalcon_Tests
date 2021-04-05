<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', true);
date_default_timezone_set('America/Sao_Paulo');

define('APP_PATH', realpath('..'));

try {
    $array = include APP_PATH . '/app/config/config.php';
    $config = new Phalcon\Config($array);

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
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}