<?php

namespace api\controllers\user;

use api\helpers\DateHelper;
use candidate\entities\user\User;
use candidate\helpers\UserHelper;
use yii\helpers\Url;
use yii\rest\Controller;

class ProfileController extends Controller
{
    /**
     * @return array
     */
    public function actionIndex(): array
    {
        return $this->serializeUser($this->findModel());
    }

    /**
     * @return string[][]
     */
    public function verbs(): array
    {
        return [
            'index' => ['get'],
        ];
    }

    /**
     * @return User
     */
    private function findModel(): User
    {
        return User::findOne(\Yii::$app->user->id);
    }

    /**
     * @param User $user
     * @return array
     */
    private function serializeUser(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->username,
            'email' => $user->email,
            'date' => [
                'created' => DateHelper::formatApi($user->created_at),
                'updated' => DateHelper::formatApi($user->updated_at),
            ],
            'status' => [
                'code' => $user->status,
                'name' => UserHelper::statusName($user->status),
            ],
        ];
    }
}