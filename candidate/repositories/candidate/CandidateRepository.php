<?php

namespace candidate\repositories\candidate;

use candidate\entities\candidate\Candidate;
use candidate\entities\NotFoundException;
use Yii;
use yii\db\StaleObjectException;
use yii\db\ActiveRecord;

class CandidateRepository
{
    public function get(int $id)
    {
        return $this->getBy(['id' => $id]);
    }

    /**
     * @param $condition
     * @return array|ActiveRecord|null
     */
    private function getBy($condition)
    {
        if (empty($item = Candidate::find()->where($condition)->limit(1)->one())) {
            throw new NotFoundException(Yii::t('app', 'Candidate not found!'));
        }
        return $item;
    }

    /**
     * @param int $status
     * @return bool|int|string|null
     */
    public static function getCount(int $status){
        return Candidate::find()->andWhere(['status' => $status, 'is_deleted' => 1])->count();
    }


    /**
     * @param Candidate $item
     */
    public function save(Candidate $item)
    {
        if (!$item->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param Candidate $item
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function remove(Candidate $item)
    {
        if (!$item->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}