<?php

$params = require __DIR__ . '/params.php';
$db_admin = require __DIR__ . '/db.php';
$db_user = require __DIR__ . '/db_user.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'person/index',
    'bootstrap' => [
        'log',
//        'common\modules\Bootstrap'
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'DCH208OEFcyFOAcab-seFGke3WeYQgMg',
        ],
//        'as beforeRequest' => [
//            'class' => 'yii\filters\AccessControl',
//            'rules' => [
//                [
//                    'allow' => true,
//                    'actions' => ['login'],
//                ],
//                [
//                    'allow' => true,
//                    'roles' => ['@'],
//                ],
//            ],
//            'denyCallback' => function () {
//                return Yii::$app->response->redirect(['site/login']);
//            },
//        ],
//        https://stackoverflow.com/questions/33296156/what-is-best-way-to-redirect-on-login-page-in-yii2
//        'as beforeRequest' => [  //if guest user access site so, redirect to login page.
//            'class' => 'yii\filters\AccessControl',
//            'rules' => [
//                [
//                    'actions' => ['login', 'error'],
//                    'allow' => true,
//                ],
//                [
//                    'allow' => true,
//                    'roles' => ['@'],
//                ],
//            ],
//        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db_admin,
        'db_user' => $db_user,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],

    ],
    'params' => $params,
    'language' => 'ru-RU',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
