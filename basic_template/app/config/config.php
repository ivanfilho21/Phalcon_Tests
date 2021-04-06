<?php

return [
    'database' => [
        'adapter'       =>  'Mysql',
        'host'          =>  'localhost',
        'username'      =>  'username',
        'password'      =>  'secret',
        'dbname'        =>  'test_db',
        'charset'       =>  'utf8',
    ],
    'application' => [
        'controllersDir' => APP_PATH . '/app/controllers/',
        'modelsDir' => APP_PATH . '/app/models/',
        'viewsDir' => APP_PATH . '/app/views/',
        'baseUri' => '/',
    ]
];