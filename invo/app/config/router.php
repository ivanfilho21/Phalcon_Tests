<?php

use Phalcon\Mvc\Router;

// $router = new Router();
$router = new Router(false);
$router->removeExtraSlashes(true);

$router->notFound([
    'controller' => 'Index',
    'action'     => 'notFound',
]);

$router->add('/', ['controller' => 'index', 'action' => 'index'])->setName('index.index');
$router->add('/signin', ['controller' => 'session', 'action' => 'index'])->setName('session.index');

$router->handle();

return $router;