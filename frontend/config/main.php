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
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            // 'identityClass' => 'common\models\User',
            // 'enableAutoLogin' => true,
            // 'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            // заменили куки по инструкции
            // https://github.com/dektrium/yii2-user/blob/0.9.12/docs/usage-with-advanced-template.md#use-independent-sessions-in-one-domain
    
            'identityCookie' => [
                'name'     => '_frontendIdentity',
                'path'     => '/',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            // инструкция тут
            // https://github.com/dektrium/yii2-user/blob/0.9.12/docs/usage-with-advanced-template.md#use-independent-sessions-in-one-domain
            'name' => 'FRONTENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/',
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
            'rules' => include_once '_urlManager.php',
        ],

    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            // following line will restrict access to admin controller from frontend application
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
        ],
    ],
    'params' => $params,
];
