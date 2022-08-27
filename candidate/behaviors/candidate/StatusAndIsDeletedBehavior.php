<?php

namespace candidate\behaviors\candidate;

use candidate\status\CandidateStatus;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class StatusAndIsDeletedBehavior extends Behavior
{
    public $statusAttribute     = 'status';
    public $isDeletedAttribute  = 'is_deleted';
    public $requestNoAttribute  = 'request_no';
    public $tokenAttribute      = 'token';

    /**
     * @return string[]
     */
    public function events(): array
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
        ];
    }

    public function beforeInsert()
    {
        $owner = $this->owner;
        if ($owner->hasProperty($this->statusAttribute))
            $owner->{$this->statusAttribute} = CandidateStatus::STATUS_NEW;
        if ($owner->hasProperty($this->isDeletedAttribute))
            $owner->{$this->isDeletedAttribute} = 1;
        if ($owner->hasProperty($this->requestNoAttribute))
            $owner->{$this->requestNoAttribute} = time();
        if ($owner->hasProperty($this->tokenAttribute))
            $owner->{$this->tokenAttribute} = Yii::$app->security->generateRandomString(12);
    }
}