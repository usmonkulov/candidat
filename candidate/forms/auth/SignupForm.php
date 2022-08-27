<?php
namespace candidate\forms\auth;

use Yii;
use yii\base\Model;
use candidate\entities\user\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $phone;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => Yii::t('app',"Bu foydalanuvchi nomi allaqachon olingan.")],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => Yii::t('app',"Bu elektron pochta manzili allaqachon olingan.")],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['phone', 'required'],
            ['phone', 'integer'],
            ['phone', 'unique', 'targetClass' => User::class, 'message' => Yii::t('app',"Bu telefon nomer allaqachon olingan.")],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'username' => Yii::t('app', 'Foydalanuvchi nomi'),
            'email' => Yii::t('app', 'Pochta'),
            'phone' => Yii::t('app', 'Telefon'),
            'parol' => Yii::t('app', 'Parol'),
        ];
    }
}
