<?php

$loader->registerDirs([
    $config->application->controllersDir,
    $config->application->modelsDir,
])->register();

$loader->registerNamespaces([
    'App\Forms' => APP_PATH . '/app/forms/',
]);