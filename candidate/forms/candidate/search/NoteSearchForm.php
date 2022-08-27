<?php

namespace candidate\forms\candidate\search;

use candidate\forms\candidate\traits\NoteTrait;
use yii\base\Model;

class NoteSearchForm extends Model
{
    use NoteTrait;

    public function rules(): array
    {
        return [
            [['deadline', 'candidate_id', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
        ];
    }
}