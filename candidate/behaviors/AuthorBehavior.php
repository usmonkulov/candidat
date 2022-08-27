<?php

namespace candidate\behaviors;


use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class AuthorBehavior extends Behavior
{
    public $createdByAttribute = 'created_by';
    public $updatedByAttribute = 'updated_by';

    /**
     * @return string[]
     */
    public function events(): array
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
        ];
    }

    /**
     * Yaratilgan vaqtda created_by ga user id yoziladi
     */
    public function beforeInsert()
    {
        $owner = $this->owner;
        if ($owner->hasProperty($this->createdByAttribute))
            $owner->{$this->createdByAttribute} = Yii::$app->user->id;
    }

    /**
     * Yangilangan vaqtda updated_by ga user id yoziladi
     */
    public function beforeUpdate()
    {
        $owner = $this->owner;
        if ($owner->hasProperty($this->updatedByAttribute))
            $owner->{$this->updatedByAttribute} = Yii::$app->user->id;
    }
}