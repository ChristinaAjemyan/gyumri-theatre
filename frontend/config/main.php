<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'language' => 'am',
    'bootstrap' => [
        'log',
        [
            'class' => 'frontend\components\LanguageSelector'
        ]
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => array(
//                'staff/index/<page:\d+>/<type:\d+>' => 'staff/index',
                '<controller:\w+>/<action:\w+>/<page:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<slug:[Ա-Ֆա-ֆА-Яа-яЁёA-Za-z0-9 -_.]+>' => '<controller>/<action>',
                //'staff/view/<slug:[Ա-Ֆա-ֆА-Яа-яЁёA-Za-z0-9 -_.]+>' => 'staff/view',
                //'performance/view/<slug:[Ա-Ֆա-ֆА-Яа-яЁёA-Za-z0-9 -_.]+>' => 'performance/view',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],
        'i18n' => [
            'translations' => [
                'home' => [
                    'class' => 'yii\i18n\PhpMessageSource'
                ],
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                ],
            ],
        ]

    ],
    'params' => $params,
];
