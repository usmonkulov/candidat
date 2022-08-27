<?php

namespace candidate\useCases\auth;

use candidate\entities\user\User;
use candidate\forms\auth\LoginForm;
use candidate\repositories\UserRepository;

class AuthService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function auth(LoginForm $form): User
    {
        $user = $this->users->findByUsernameOrEmail($form->username);
        if (!$user || !$user->isActive() || !$user->validatePassword($form->password)) {
            throw new \DomainException('Login yoki parol xato.');
        }
        return $user;
    }
}