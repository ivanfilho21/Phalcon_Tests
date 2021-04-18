<?php

$loader->registerDirs([
    APP_PATH . $config->application->controllersDir,
    APP_PATH . $config->application->modelsDir,
])->register();

$loader->registerNamespaces([
    'App\Forms' => APP_PATH . 'app/forms/',
]);