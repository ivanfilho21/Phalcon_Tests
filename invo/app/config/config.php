<?php

use Phalcon\Config;

return new Config([
    'database' => [
        'adapter'  => getenv('DB_ADAPTER'),
        'host'     => getenv('DB_HOST'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'dbname'   => getenv('DB_DBNAME'),
        'charset'  => getenv('DB_CHARSET'),
    ],
    'application' => [
        'controllersDir' => getenv('CONTROLLERS_DIR'),
        'pluginsDir' => getenv('PLUGINS_DIR'),
        'libraryDir' => getenv('LIBRARY_DIR'),
        'modelsDir' => getenv('MODELS_DIR'),
        'formsDir' => getenv('FORMS_DIR'),
        'viewsDir' => getenv('VIEWS_DIR'),
        'voltCacheDir' => getenv('VOLT_CACHE_DIR'),
        'baseUri' => getenv('BASE_URI'),
    ]
]);