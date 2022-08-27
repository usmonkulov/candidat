<?php

namespace candidate\entities\user\events;

use candidate\entities\user\User;

class UserSignUpConfirmed
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}