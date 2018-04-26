<?php

$config = [
    'id' => 'app-frontend',
    'name'=>'Strategy Project',
    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-EN',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                    'on missingTranslation' => ['app\components\TranslationEventHandler', 'handleMissingTranslation']
                ],
                'admin' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-EN',
                    'fileMap' => [
                        'admin' => 'admin.php',
                    ],
                    'on missingTranslation' => ['app\components\TranslationEventHandlerAdmin', 'handleMissingTranslation']
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '9zoBCqlsIr-Jp3yMS8sSH7V980Nnu3Jv',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'authManager' => [
//            'class' => 'yii\rbac\DbManager',
//            'defaultRoles' => ['guest'],
//        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/login'],
        ],
//        'rbac' => [
//            'class' => 'yii\rbac\DbManager',
//            'itemTable' => '{{%podium_auth_item}}',
//            'itemChildTable' => '{{%podium_auth_item_child}}',
//            'assignmentTable' => '{{%podium_auth_assignment}}',
//            'ruleTable' => '{{%podium_auth_rule}}',
//        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'timeZone' => 'UTC',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager'=> require(__DIR__ . '/url.php'),
    ],
    'modules' => require(__DIR__ . '/modules.php'),
    'params' => require(__DIR__ . '/params.php'),
    'on beforeAction' => function($event) {
    },
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];

    // $config['debug']['class'] => 'yii\debug\Module';
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}
return $config;