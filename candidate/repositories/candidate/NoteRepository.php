<?php


namespace candidate\repositories\candidate;


use candidate\entities\candidate\Note;
use candidate\entities\NotFoundException;
use Yii;
use yii\db\StaleObjectException;
use yii\db\ActiveRecord;

class NoteRepository
{
    public function get(int $id)
    {
        return $this->getBy(['candidate_id' => $id]);
    }

    /**
     * @param $condition
     * @return array|ActiveRecord|null
     */
    private function getBy($condition)
    {
        if (empty($item = Note::find()->where($condition)->limit(1)->one())) {
            throw new NotFoundException(Yii::t('app', 'Note not found!'));
        }
        return $item;
    }

    /**
     * @param Note $item
     */
    public function save(Note $item)
    {
        if (!$item->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param Note $item
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function remove(Note $item)
    {
        if (!$item->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}