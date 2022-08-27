<?php


namespace candidate\forms\candidate\traits;


use candidate\entities\candidate\Note;

trait NoteTrait
{
    public $deadline;
    public $description;
    public $candidate_id;
    public $created_by;
    public $updated_by;
    public $created_at;
    public $updated_at;

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        $label = new Note();
        return $label->attributeLabels();
    }
}