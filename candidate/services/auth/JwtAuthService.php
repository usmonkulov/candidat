<?php

namespace candidate\services\auth;

use candidate\repositories\UserNameRepository;
use candidate\forms\auth\LoginForm;
use candidate\helpers\Transaction;
use candidate\repositories\UserRefreshTokenRepository;

class JwtAuthService
{
    private $users;
    private $tokens;
    private $transaction;
    private $auth;

    public function __construct(
        UserNameRepository $users,
        UserRefreshTokenRepository $tokens,
        Transaction $transaction,
        AuthService $auth
    )
    {
        $this->users = $users;
        $this->tokens = $tokens;
        $this->transaction = $transaction;
        $this->auth = $auth;
    }

    public function auth(LoginForm $form): array
    {
        $user = $this->users->getByUsername($form->username);

        if (!$user->validatePassword($form->password)) {
            throw new \DomainException('Undefined user or password.');
        }

        if (!$user->isActive()) {
            throw new \DomainException('User is not active.');
        }

        $access_token = $this->auth->generateJwtToken($user->id);
        $userRefreshToken = $this->auth->generateRefreshToken($user->id);

        $this->tokens->save($userRefreshToken);

        return [
            'access_token' => $access_token,
            'refresh_token' => $userRefreshToken->refresh_token,
        ];
    }

    public function refreshToken(RefreshTokenForm $form): array
    {
        $oldUserRefreshToken = $this->tokens->getActiveByToken($form->refresh_token);
        $user = $oldUserRefreshToken->user;
        $newAccessToken = $this->auth->generateJwtToken($user->id);
        $newRefreshToken = $this->auth->generateRefreshToken($user->id);

        $this->transaction->wrap(function() use ($oldUserRefreshToken, $newRefreshToken) {
             $this->tokens->remove($oldUserRefreshToken);
             $this->tokens->save($newRefreshToken);
        });

        return [
            'access_token' => $newAccessToken,
            'refresh_token' => $newRefreshToken->refresh_token,
        ];
    }
}