<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;

$di->set('view', function () {
    global $config;

    $view = new View();
    $view->setViewsDir($config->application->viewsDir);
    return $view;
});

$di->set('url', function () {
    global $config;

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
});

$di->set('flash', function () {
    return new Phalcon\Flash\Session([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning',
    ]);
});

$di->set('router', include realpath('../app/config/router.php'));

$di->set('db', function () {
    global $config;

    $dbConfig = $config->database->toArray();
    $adapater = $dbConfig['adapter'];
    unset($dbConfig['adapter']);
    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

    return new $class($dbConfig);
});