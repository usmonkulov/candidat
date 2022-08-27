<?php

namespace candidate\readModels\candidate;

use candidate\entities\candidate\Candidate;
use candidate\forms\candidate\search\CandidateSearchForm;
use Yii;
use yii\data\ActiveDataProvider;

class CandidateReadRepository
{
    /**
     * @param CandidateSearchForm $form
     * @param $userId
     * @return ActiveDataProvider
     */
    public function search(CandidateSearchForm $form, $userId = null): ActiveDataProvider
    {
        $query = Candidate::find()->andWhere(['is_deleted' => 1])->orderBy('id desc');

        if(!(Yii::$app->controllerNamespace == 'backend\controllers')){
            $query->andWhere(['created_by' => $userId]);
        }

        if ($form->hasErrors()) {
            $query->andWhere('1=0');
        }

        $query->andFilterWhere([
            'id' => $form->id,
            'birthday' => $form->birthday,
            'hired' => $form->hired,
            'status' => $form->status,
            'is_deleted' => $form->is_deleted,
            'created_at' => $form->created_at,
            'updated_at' => $form->updated_at,
            'ago' => $form->ago,
        ]);

        $query->andFilterWhere(['ilike', 'first_name', $form->first_name])
            ->andFilterWhere(['ilike', 'last_name', $form->last_name])
            ->andFilterWhere(['ilike', 'middle_name', $form->middle_name])
            ->andFilterWhere(['ilike', 'address', $form->address])
            ->andFilterWhere(['ilike', 'country_origin', $form->country_origin])
            ->andFilterWhere(['ilike', 'email', $form->email])
            ->andFilterWhere(['ilike', 'phone', $form->phone])
            ->andFilterWhere(['ilike', 'gender', $form->gender]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => [1, 100]
            ]
        ]);
    }
}