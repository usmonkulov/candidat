<?php

namespace candidate\useCases\manage;

use candidate\entities\user\User;
use candidate\forms\manage\user\UserCreateForm;
use candidate\forms\manage\user\UserEditForm;
use candidate\repositories\UserRepository;
use candidate\services\newsletter\Newsletter;
use candidate\services\RoleManager;
use candidate\services\TransactionManager;

class UserManageService
{
    private $repository;
    private $roles;
    private $transaction;
    /**
     * @var Newsletter
     */
    private $newsletter;

    public function __construct(
        UserRepository $repository,
        RoleManager $roles,
        TransactionManager $transaction,
        Newsletter $newsletter
    )
    {
        $this->repository = $repository;
        $this->roles = $roles;
        $this->transaction = $transaction;
        $this->newsletter = $newsletter;
    }

    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->phone,
            $form->password
        );
        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
            $this->newsletter->subscribe($user->email);
        });
        return $user;
    }

    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email,
            $form->phone
        );
        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
        });
    }

    public function assignRole($id, $role): void
    {
        $user = $this->repository->get($id);
        $this->roles->assign($user->id, $role);
    }

    public function remove($id): void
    {
        $user = $this->repository->get($id);
        $this->repository->remove($user);
        $this->newsletter->unsubscribe($user->email);
    }
}