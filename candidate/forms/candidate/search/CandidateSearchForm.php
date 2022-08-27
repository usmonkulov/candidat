<?php

namespace candidate\forms\candidate\search;

use candidate\forms\candidate\traits\CandidateTrait;
use yii\base\Model;

class CandidateSearchForm extends Model
{
    use CandidateTrait;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['is_deleted', 'ago','status','id'], 'integer'],
            [['hired'], 'boolean'],
            [['first_name', 'last_name', 'middle_name', 'country_origin', 'email', 'phone', 'gender', 'address','token', 'request_no'], 'string'],
        ];
    }
}