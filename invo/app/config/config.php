<?php

return [
    'database' => [
        'adapter'       =>  'Mysql',
        'host'          =>  'localhost',
        'username'      =>  'ivanfilho',
        'password'      =>  '',
        'dbname'        =>  'invo_db',
        'charset'       =>  'utf8',
    ],
    'application' => [
        'controllersDir' => APP_PATH . '/app/controllers/',
        'modelsDir' => APP_PATH . '/app/models/',
        'viewsDir' => APP_PATH . '/app/views/',
        'baseUri' => '/',
    ]
];