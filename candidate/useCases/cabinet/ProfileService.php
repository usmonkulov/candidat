<?php

namespace candidate\useCases\cabinet;

use candidate\forms\user\ProfileEditForm;
use candidate\repositories\UserRepository;

class ProfileService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function edit($id, ProfileEditForm $form): void
    {
        $user = $this->users->get($id);
        $user->editProfile($form->email, $form->phone);
        $this->users->save($user);
    }
}