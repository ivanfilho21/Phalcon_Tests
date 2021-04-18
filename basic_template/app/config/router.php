<?php

use Phalcon\Mvc\Router;

$router = new Router(false);
$router->removeExtraSlashes(true);

$router->notFound([
    'controller' => 'Index',
    'action'     => 'notFound',
]);

$router->add('/', ['controller' => 'Index', 'action' => 'index'])->setName('index.index');
$router->add('/like', ['controller' => 'Index', 'action' => 'like'])->setName('index.like');

return $router;