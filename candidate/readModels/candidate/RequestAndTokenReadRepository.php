<?php

namespace candidate\readModels\candidate;

use candidate\entities\candidate\Candidate;
use candidate\forms\candidate\search\RequestAndTokenSearchForm;
use yii\data\ActiveDataProvider;

class RequestAndTokenReadRepository
{

    public function search(RequestAndTokenSearchForm $form): ActiveDataProvider
    {
        $query = Candidate::find();

        if ($form->hasErrors()) {
            $query->andWhere('1=0');
        }

        $query->andFilterWhere(['ilike', 'request_no', $form->request_no])
            ->andFilterWhere(['ilike', 'token', $form->token]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => [1, 100]
            ]
        ]);
    }
}