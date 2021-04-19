<?php

$di->set('view', function () use ($config) {
    $view = new Phalcon\Mvc\View();
    $view->setViewsDir(APP_PATH . $config->application->viewsDir);
    $view->registerEngines([
        '.volt' => function ($view, $di) use ($config) {
            $volt = new Phalcon\Mvc\View\Engine\Volt($view, $di);

            $volt->setOptions(array(
                'compiledPath' => APP_PATH . $config->application->voltCacheDir,
                'compiledSeparator' => '_',
                'compileAlways' => true,
            ));

            $compiler = $volt->getCompiler();
            $compiler->addFunction('strftime', "strftime");
            $compiler->addFunction('strtotime', "strtotime");
            $compiler->addFunction('utf8_encode', "utf8_encode");
            $compiler->addFunction('ucwords', "ucwords");

            return $volt;
        },
        '.phtml' => Phalcon\Mvc\View\Engine\Php::class,
    ]);

    return $view;
});

$di->set('url', function () use ($config) {
    $url = new Phalcon\Mvc\Url();
    $url->setBaseUri($config->application->baseUri);
    return $url;
});

$di->set('session', function () {
    $session = new Phalcon\Session\Adapter\Files();
    $session->start();

    return $session;
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