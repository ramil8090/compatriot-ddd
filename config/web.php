<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$db_dev = require  __DIR__ . '/db_dev.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'app\bootstrap\ContainerBootstrap',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'ru',
    'modules' => [
        'rbac' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'mainLayout' => '@app/modules/admin/views/layouts/main.php',
            'menus' => [
                'menu' => null,
                'user' => null,
            ]
        ],
    ],
    'components' => [
        'formatter' => [
            'dateFormat' => 'php:d F Y',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceLanguage' => 'en',
                    'forceTranslation' => true,
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'X4sX0jfxDev0Tan-1uNnMr-6Zuuf3AdO',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 3000,
            'on new-user' => [\app\events\handles\UserNotification::class, 'handleNewUser'],
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
        'db' => YII_ENV == 'dev' ? $db_dev : $db,
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['uz','ru', 'en'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableDefaultLanguageUrlCode'=>true,
            'enableLanguageDetection'=>false,
            'rules' => [
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',  //Allow by default to all.
            'debug/*',
            'compatriot/*',
            'search/*',
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '*', '::1'],
    ];
}

return $config;
