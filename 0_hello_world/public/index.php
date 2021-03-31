<?php

ini_set('display_errors', true);
ini_set('display_startup_errors', true);
error_reporting(E_ALL);

// phpinfo();

use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// registrar o autoloader
$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . '/controllers',
        APP_PATH . '/models/',
    ]
);

$loader->register();


// configurar as dependências

$di = new FactoryDefault();

$di['view'] = function() {
    $view = new View();
    $view->setViewsDir(APP_PATH . '/views/');
    return $view;
};


// configurar URL principal
$di['url'] = function() {
    $url = new UrlProvider();
    $url->setBaseUri('/phalcon/0_hello_world/');
    return $url;
};

// configurar conexão ao MySql
$di['db'] = function() {
    return new DbAdapter([
        'host' => 'localhost',
        'username' => 'ivanfilho',
        'password' => 'root',
        'dbname' => 'phalcon_db',
    ]);
};

// tratamento da execução do App
$app = new Application($di);

try {
    // $res = $app->handle();
    // $res->send();
    echo $app->handle()->getContent();
} catch(Exception $e) {
    echo 'Erro na execução do App.<br>' .$e->getMessage() .'.';
}