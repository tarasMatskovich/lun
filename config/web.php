<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ru5UNWQITqEiTh9Eu-U1H25yvwJVynNV',
        ],
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'index/index',
                'admin' => 'admin/index',
                'admin/add' => 'admin/add',
                'admin/ajax/building/save' => 'admin/save',
                'admin/ajax/apartment/save' => 'admin/saveapartment',
                'admin/ajax/house/save' => 'admin/savehouse',
                'admin/list' => 'admin/list',
                'admin/list/<id:\d+>' => 'admin/show',
                'admin/edit/<id:\d+>' => 'admin/edit',
                'admin/update/<id:\d+>' => 'admin/update',
                'admin/delete/<id:\d+>' => 'admin/delete',
                'admin/house/<id:\d+>' => 'admin/showhouse',
                'admin/house/delete/<id:\d+>' => 'admin/deletehouse',
                'admin/house/edit/<id:\d+>' => 'admin/edithouse',
                'admin/house/update/<id:\d+>' => 'admin/updatehouse',
                'admin/typical/apartment/<id:\d+>' => 'admin/typicalshowapartment',
                'admin/nontypical/apartment/<id:\d+>' => 'admin/nontypicalshowapartment',
                'admin/typical/apartment/edit/<id:\d+>' => 'admin/typicaleditapartment',
                'admin/nontypical/apartment/edit/<id:\d+>' => 'admin/nontypicaleditapartment',
                'admin/typical/apartment/update/<id:\d+>' => 'admin/typicalupdateapartment',
                'admin/nontypical/apartment/update/<id:\d+>' => 'admin/nontypicalupdateapartment',
                'admin/apartment/typical/delete/<id:\d+>' => 'admin/typicaldelete',
                'admin/apartment/nontypical/delete/<id:\d+>' => 'admin/nontypicaldelete',
                'search' => 'search/index',
            ],
        ],
    ],
    'params' => $params,
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
