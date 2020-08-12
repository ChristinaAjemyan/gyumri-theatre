<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language'=>'hy',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceLanguage' => 'en',
                    'on missingTranslation' => ['common\components\TranslationEventHandler', 'handleMissingTranslation']
//                    'fileMap' => [
//                        //'main' => 'main.php',
//                    ],
                ],
            ],
        ],
        'translate' => [
            'class' => 'wfstudioru\translate\Translation',
            'key' => 'trnsl.1.1.20190627T210745Z.416bb7ab0ab53460.0db2b5e851fd799d161c7c968085f5849948977a',
        ],
    ],

];
