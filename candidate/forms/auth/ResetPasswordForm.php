<?php
namespace candidate\forms\auth;

use Yii;
use yii\base\Model;

class ResetPasswordForm extends Model
{
    public $password;

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'password' => Yii::t('app', 'Parol'),
        ];
    }
}
