<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'АПК ТЕХНОЛОГИИ',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'timeZone' => 'Europe/Moscow',

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'x7RQ0DqHYKr4c2qlN1bEZSP_GEwF-wHx',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
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
                // UnitController Единицы измерения
                'unit/<action:(edit|delete)>/<id:\d+>' => 'unit/<action>',

                // ProductController Продукты
                'product/<action:(edit|delete)>/<id:\d+>' => 'product/<action>',

                // LegalSubjectController Доверенные лица
                'legal-subject/<action:(edit|delete)>/<id:\d+>' => 'legal-subject/<action>',

                // CompanyController Контрагенты
                'company/<action:(edit|delete)>/<id:\d+>' => 'company/<action>',

                // CompanyAliasController Псевдонимы контрагентов
                'company-alias/<action:(index|create)>/<company_id:\d+>' => 'company-alias/<action>',
                'company-alias/<action:(edit)>/<id:\d+>' => 'company-alias/<action>',
                'company-alias/<action:(edit)>/<id:\d+>/<company_id:\d+>' => 'company-alias/<action>',
                'company-alias/<action:(delete)>/<id:\d+>' => 'company-alias/<action>',
                'company-alias/<action:(delete)>/<id:\d+>/<company_id:\d+>' => 'company-alias/<action>',
            ],
        ],
    ],
    'params' => $params,
    'container' => [
        'definitions' => [
            yii\grid\GridView::class => [
                'tableOptions' => [
                    'class' => 'table table-condensed table-striped table-bordered table-hover mt-2'
                ],
                'formatter' => [
                    'class' => 'yii\i18n\Formatter',
                    'nullDisplay' => '',
                ],
            ],
        ],
    ],
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
