<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'randevu',
    'name' => 'Randevu',
    'version' => '0.1',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'WMz8ym_B9ofpbgb7RzyxYaW9hnD2BYak',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
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
//            'useFileTransport' => true,
        ],
//        'log' => [
//            'traceLevel' => YII_DEBUG ? 3 : 0,
//            'targets' => [
//                [
//                    'class' => 'yii\log\FileTarget',
//                    'levels' => ['error', 'warning'],
//                ],
//            ],
//        ],
        'db' => require(__DIR__ . '/db_local.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'app/layout/left' => 'layout/left.php',
                    ],
                ],
            ],
        ],
        'systemJournal' => function () {
            return app\modules\systemJournal\components\SystemJournalComponent::build();
        },
    ],
//    'language' => 'ru-RU',
    'modules' => [
        'contact' => ['class' => 'app\modules\contact\Module'],
        'blacklist' => ['class' => 'app\modules\blacklist\Module'],
        'event' => ['class' => 'app\modules\event\Module'],
        'mailbox' => ['class' => 'app\modules\mailbox\Module'],
        'profile' => ['class' => 'app\modules\profile\Module'],
        'statistics' => ['class' => 'app\modules\statistics\Module'],
        'systemJournal' => ['class' => 'app\modules\systemJournal\Module'],
        'user' => ['class' => 'app\modules\user\Module'],
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
