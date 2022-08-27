<?php

namespace candidate\repositories;

use candidate\entities\NotFoundException;
use candidate\entities\user\UserRefreshToken;

class UserRefreshTokenRepository
{
    public function getActiveByToken($token): UserRefreshToken
    {
        return $this->getBy([
            'and',
            ['refresh_token' => $token],
            ['>', 'expired_date', date('Y-m-d H:i:s.u')]
        ]);
    }

    public function save(UserRefreshToken $userRefreshToken): void
    {
        if (!$userRefreshToken->save()) {
            \Yii::error($userRefreshToken->getErrors());
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(UserRefreshToken $userRefreshToken): void
    {
        if (!$userRefreshToken->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    private function getBy(array $condition): UserRefreshToken
    {
        if (!$item = UserRefreshToken::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('User Refresh Token is not found.');
        }
        return $item;
    }
}