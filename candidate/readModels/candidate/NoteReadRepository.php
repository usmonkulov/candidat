<?php

namespace candidate\readModels\candidate;

use candidate\entities\candidate\Note;
use candidate\forms\candidate\search\NoteSearchForm;
use yii\data\ActiveDataProvider;

class NoteReadRepository
{
    /**
     * @param NoteSearchForm $form
     * @param $candidate
     * @return ActiveDataProvider
     */
    public function search(NoteSearchForm $form, $candidate): ActiveDataProvider
    {
        $query = Note::find()->andWhere(['candidate_id' => $candidate->id]);

        if ($form->hasErrors()) {
            $query->andWhere('1=0');
        }

        $query->andFilterWhere(['ilike', 'description', $form->description]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => [1, 100]
            ]
        ]);
    }
}