<?php

use yii\web\Request;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
// $baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());

$language = 'en-US';
if (isset($_COOKIE['lang'])) {
    if (strpos($_COOKIE['lang'], 'kh-KM') !== false) {
        $language = 'kh-KM';
    } else {
        $language = 'en-US';
    }
}
$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());


$config = [
    'id' => 'zay-web',
    'language' => $language,
    'sourceLanguage' => 'en-US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\Admin\Admin',
            'as beforeRequest' => [  //if guest user access site so, redirect to login page.
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    'components' => [
    'authClientCollection' => [
        'class' => 'yii\authclient\Collection',
        'clients' => [
            'google' => [
                'class' => 'yii\authclient\clients\Google',
                'clientId' => 'google_client_id',
                    'clientSecret' => 'google_client_secret',
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '1206753316714715',
                    'clientSecret' => '16881f004686c8220be8828b7a6cd527',
                ],
                
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'p3no0Lph70zk0CfgiOQ69zIycMyhbImD',
            // 'baseUrl' => $baseUrl,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formater' => [
            'class' => 'app\components\Formater',
        ],
        'formatter' => [
            'thousandSeparator' => '.',
            'currencyCode' => '$',
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
            'useFileTransport' => true,
 
            // 'transport' => [
			// 	'class' => 'Swift_SmtpTransport',
			// 	'host' => 'smtp.hostinger.com',
			// 	'username' => 'penghak@dernham.app',
			// 	'password' => '3Kt3RzXF9vJPDqG@',
			// 	'port' => '587',
			// 	'encryption' => 'tls',
			// ],
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

        'i18n' => [
            'class' => 'app\components\NewI18N',
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/languages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ]
                ]
            ]
        ],

        //     'urlManager' => [
        //         'baseUrl' => $baseUrl,
        //         'enablePrettyUrl' => true,
        //         'showScriptName' => false,
        //         'rules' => [
        //             '<controller:\w+>/<id:\d+>' => '<controller>/view',
        //             '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        //             '<controller:\w+>/<action:^a-zZ-A>' => '<controller>/<action>',

        //             [
        //                 'pattern' => 'zay',
        //                 'route' => 'zay/index',
        //                 'suffix' => '',
        //             ],
        //             [
        //                 'pattern' => 'zay/<category:[^/.]*>',
        //                 'route' => 'zay/index',
        //                 'suffix' => '',
        //             ],
        //             [
        //                 'pattern' => 'zay/<category:[^/.]*>/<slug:[^.]*>',
        //                 'route' => 'zay/view',
        //                 'suffix' => '',
        //             ],
        //         ],
        //     ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    // $config['bootstrap'][] = 'debug';
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
