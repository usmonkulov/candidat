<?php


namespace candidate\forms\candidate\search;

use candidate\forms\candidate\traits\CandidateTrait;
use yii\base\Model;

class RequestAndTokenSearchForm extends Model
{
    use CandidateTrait;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['token', 'request_no'], 'required'],
            [['token', 'request_no'], 'string'],
        ];
    }
}