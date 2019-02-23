<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'homeUrl' => '/admin',
    'components' => [
        'request' => [
            'baseUrl' => '/admin',
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            /*
             * Удалили потому что YII2 User RBAC поставили
             * https://github.com/dektrium/yii2-user/blob/master/docs/usage-with-advanced-template.md#install
             'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],*/
            // заменили куки по инструкции
            // https://github.com/dektrium/yii2-user/blob/0.9.12/docs/usage-with-advanced-template.md#use-independent-sessions-in-one-domain
            'identityCookie' => [
                'name'     => '_backendIdentity',
                'path'     => '/admin',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            // инструкция тут
            // https://github.com/dektrium/yii2-user/blob/0.9.12/docs/usage-with-advanced-template.md#use-independent-sessions-in-one-domain
            'name' => 'BACKENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/admin',
            ],
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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => include_once '_urlManager.php'
        ],

    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            // following line will restrict access to profile, recovery, registration and settings controllers from backend
            'as backend' => 'dektrium\user\filters\BackendFilter',
            'controllerMap' => [
                'admin' => [
                    'class'  => 'dektrium\user\controllers\AdminController',
                    'layout' => '//admin-layout',
                ],
            ],
        ],
    ],
    'params' => $params,
];
