<?php

ini_set('display_errors', true);
ini_set('display_startup_errors', true);
error_reporting(E_ALL);

session_start();

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\MySql as DbAdapter;
use Phalcon\Mvc\Url as UrlProvider;

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Register an autoloader
$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
    ]
);

/* $loader->registerNamespaces(
    [
        'App\Forms' => APP_PATH . '/forms/'
    ]
); */

$loader->register();

// Create a DI
$di = new FactoryDefault();

// Setup the view component
$di->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        return $view;
    }
);

// Setup a base URI
$di->set(
    'url',
    function () {
        $url = new UrlProvider();
        $url->setBaseUri('/phalcon/1_signup_form/');
        return $url;
    }
);

/* $di->setShared('session', function() {
    $session = new Phalcon\Session\Adapter\Files();
    $session->start();
    return $session;
}); */

$di->set(
    'forms',
    function () {
        return new Phalcon\Forms\Manager();
    }
);
/* 
$di->set(
    'flash',
    function () {
        return new Phalcon\Flash\Session();
    }
); */

// Setup database connection
$di->set(
    'db',
    function () {
        return new DbAdapter(
            [
                'host' => '127.0.0.1',
                'username' => 'ivanfilho',
                'password' => '',
                'dbname' => 'phalcon_signup_db'
            ]
        );
    }
);

$application = new Application($di);

try {
    // Handle the request
    $response = $application->handle();

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}