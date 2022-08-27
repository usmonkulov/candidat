<?php

namespace candidate\forms\candidate;

use candidate\forms\candidate\traits\CandidateTrait;
use candidate\helpers\GenderHelper;
use candidate\status\CandidateStatus;
use yii\base\Model;

class CandidateForm extends Model
{
    use CandidateTrait;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['hired', 'default', 'value' => false],
            [['birthday'], 'date', 'format' => 'php:Y-m-d'],
            [['first_name', 'last_name', 'address', 'country_origin', 'phone', 'birthday','gender'], 'required'],
            [['address'], 'string'],
            [['is_deleted', 'status'], 'integer'],
            [['hired'], 'boolean'],
            [['first_name', 'last_name', 'middle_name', 'country_origin'], 'string', 'max' => 255],
            ['email', 'email'],
            ['gender', 'in', 'range' => [GenderHelper::GENDER_MALE, GenderHelper::GENDER_FEMALE]],
            [['phone'], 'string', 'max' => 20],
            [['gender'], 'string', 'max' => 1],
        ];
    }
}