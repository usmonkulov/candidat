<?php

namespace candidate\services\auth;

use yii\base\Model;

class RefreshTokenForm extends Model
{
    public $refresh_token;

    public function rules(): array
    {
        return [
            [['refresh_token'], 'required'],
            [['refresh_token'], 'string'],
        ];
    }
}