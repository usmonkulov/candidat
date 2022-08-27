<?php
namespace candidate\forms\auth;

use Yii;
use yii\base\Model;
use candidate\entities\user\User;

class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => User::class,
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => Yii::t('app','Ushbu elektron pochta manziliga ega foydalanuvchi yo\'q.')
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'email' => Yii::t('app', 'Pochta'),
        ];
    }
}
