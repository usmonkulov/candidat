<?php

namespace candidate\forms\candidate;

use candidate\entities\candidate\Candidate;
use candidate\entities\user\User;
use candidate\forms\candidate\traits\NoteTrait;
use yii\base\Model;

class NoteForm extends Model
{
    use NoteTrait;

    public function rules(): array
    {
        return [
            [['deadline', 'description', 'candidate_id'], 'required'],
            [['deadline', 'candidate_id', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['deadline', 'candidate_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['candidate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Candidate::class, 'targetAttribute' => ['candidate_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }
}