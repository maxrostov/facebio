<?php

return [
    'class' => 'yii\db\Connection',

    'dsn' => 'pgsql:host=localhost;port=5432;dbname=facebio',
    'username' => 'facebio_admin',
    'password' => 'facebio_admin3000',
    'charset' => 'utf8',

//    'dsn' => 'mysql:host=localhost;dbname=facebio',
//    'username' => 'root',
//    'password' => '123',
//    'charset' => 'utf8',


    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
