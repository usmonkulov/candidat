<?php

namespace api\bootstrap;

use candidate\helpers\Transaction;
use candidate\repositories\UserNameRepository;
use candidate\repositories\UserRefreshTokenRepository;
use candidate\services\auth\AuthService;
use candidate\services\auth\JwtAuthService;
use sizeg\jwt\Jwt;
use yii\base\BootstrapInterface;
use yii\di\Instance;
use yii\web\User;

class SetUp implements BootstrapInterface
{

    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->setSingleton(Jwt::class, function () use ($app) {
            return $app->jwt;
        });

        $container->setSingleton(User::class, function () use ($app) {
            return $app->user;
        });

        $container->set(AuthService::class, [], [
            Instance::of(Jwt::class),
            Instance::of('security'),
            Instance::of('request'),
            $app->params['tokenSettings'],
        ]);

        $container->set(JwtAuthService::class, [], [
            Instance::of(UserNameRepository::class),
            Instance::of(UserRefreshTokenRepository::class),
            Instance::of(Transaction::class),
            Instance::of(AuthService::class)
        ]);
    }
}