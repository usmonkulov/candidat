<?php

namespace candidate\forms\User;

use candidate\entities\user\User;
use Yii;
use yii\base\Model;

class ProfileEditForm  extends Model
{
    public $phone;
    public $email;

    public $_user;

    public function __construct(User $user, $config = [])
    {
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->_user = $user;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['phone', 'email'], 'required'],
            ['email', 'email'],
            [['email'], 'string', 'max' => 255],
            [['phone'], 'integer'],
            [['phone', 'email'], 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->_user->id]],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'phone' => Yii::t('app', 'Telefon'),
            'email' => Yii::t('app', 'Pochta'),
        ];
    }
}