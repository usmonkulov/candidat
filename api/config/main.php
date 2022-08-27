<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'timeZone'            => 'Asia/Tashkent',
    'language'            => 'uz',
    'bootstrap' => [
        'log',
        'api\bootstrap\SetUp',
        [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => 'json',
                'application/xml' => 'xml',
            ],
        ],
    ],
    'components' => [
        'request'    => [
            'parsers'   => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'ipHeaders' => [
                'X-Forwarded-For',
                'X-Real-IP',
            ]
        ],
        'response'   => [
            'formatters' => [
                'json' => [
                    'class'         => \yii\web\JsonResponseFormatter::class,
                    'prettyPrint'   => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ]
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl'     => true,
            'enableStrictParsing' => true,
            'showScriptName'      => false,
            'rules' => [
                ''                             => 'site/index',
                'error'                        => 'site/error',
                'POST auth/login'              => 'auth/auth/login',
                'POST auth/refresh-token'      => 'auth/auth/refresh-token',

                'POST candidate/send'          => 'candidate/candidate/send',
                'POST candidate/check'         => 'candidate/candidate/check',
                'GET candidate/label'          => 'candidate/candidate/label',
                'GET candidate/count'          => 'candidate/candidate/count',
            ],
        ],
        'jwt'        => [
            'class' => \sizeg\jwt\Jwt::class,
            'key'   => 'secret',
        ],
        'formatter'  => [
            'defaultTimeZone' => 'Asia/Tashkent',
            'dateFormat'      => 'dd-MM-yyyy',
            'timeFormat'      => 'HH:mm:ss',
            'datetimeFormat'  => 'dd-MM-yyyy HH:mm:ss',
        ],
        'user'       => [
            'identityClass'   => \common\auth\Identity::class,
            'enableSession'   => false,
            'enableAutoLogin' => false,
        ],
    ],
    'params' => $params,

    'as authenticator' => [
        'class'  => \sizeg\jwt\JwtHttpBearerAuth::class,
        'except' => [
            'auth/auth/login',
            'auth/auth/refresh-token',
            'auth/one-id/get-auth-url',
            'auth/one-id/auth',
            'site/error',
            'site/index',
            'debug/default/*'
        ],
    ],
    'as access'        => [
        'class'  => \yii\filters\AccessControl::class,
        'except' => [
            'auth/auth/login',
            'auth/auth/refresh-token',
            'auth/one-id/get-auth-url',
            'auth/one-id/auth',
            'site/error',
            'site/index',
            'debug/default/*'
        ],
        'rules'  => [
            [
                'allow' => true,
                'roles' => ['@'],
            ]
        ],
    ],
];
