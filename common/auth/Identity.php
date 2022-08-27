<?php

namespace common\auth;

use candidate\readModels\UserReadRepository;
use Lcobucci\JWT\Token;
use candidate\entities\user\User;
use yii\web\IdentityInterface;

class Identity implements IdentityInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function getUser(): User
    {
        $user = new self;
        return $user->user;
    }

    public static function findIdentity($id)
    {
        $user = self::getRepository()->findActiveById($id);
        return $user ? new self($user) : null;
    }

    /**
     * @param Token $token
     * @param $type
     * @return Identity|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        \Yii::debug($type);
        $user = self::getRepository()->findActiveById($token->getClaim('uid'));
        return $user ? new self($user) : null;
    }

    public function getId(): int
    {
        return $this->user->id;
    }

    public function getAuthKey(): string
    {
        return $this->user->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    private static function getRepository(): UserReadRepository
    {
        return \Yii::$container->get(UserReadRepository::class);
    }
}