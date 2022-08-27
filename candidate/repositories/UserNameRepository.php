<?php


namespace candidate\repositories;


use candidate\entities\NotFoundException;
use candidate\entities\user\User;

class UserNameRepository
{
    public function get($id): User
    {
        return $this->getBy(['id' => $id]);
    }

    /**
     * @param $username
     * @return User
     */
    public function getByUsername($username) : User
    {
        return $this->getBy(['username' => $username]);
    }

    private function getBy(array $condition): User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('User not found.');
        }
        return $user;
    }
}