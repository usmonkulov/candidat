<?php

use candidate\helpers\GenderHelper;
use candidate\status\CandidateStatus;;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchForm candidate\readModels\candidate\CandidateReadRepository */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Nomzodlar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="candidate-index">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg>', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'options'      => ['class' => 'table-responsive'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchForm,
        'summary' => 'Namoyish etilayabdi <strong>{begin}-{end}</strong> ta yozuv <strong>{totalCount}</strong> tadan.',
        'rowOptions' => function($model)
        {
            if($model->status == CandidateStatus::STATUS_NEW)
                return [
                    'class' => 'danger'
                ];
            if($model->status == CandidateStatus::STATUS_INTERVIEW_SCHEDULED)
                return [
                    'class' => 'active'
                ];
            if($model->status == CandidateStatus::STATUS_ACCEPTED)
                return [
                    'class' => 'primary'
                ];
            if($model->status == CandidateStatus::STATUS_NOT_ACCEPTED)
                return [
                    'class' => 'success'
                ];
        },
        'columns' => [
            'id',
            [
                'attribute' => 'first_name',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::a($data->first_name, ['candidate/view', 'id' => $data->id]);
                }
            ],
            [
                'attribute' => 'last_name',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::a($data->last_name, ['candidate/view', 'id' => $data->id]);
                }
            ],
            'country_origin',
            'phone',
            'hired:boolean',
            [
                'attribute' => 'gender',
                'format'    => 'html',
                'value'     => function ($data) {
                    if ($data->id) {
                        return GenderHelper::getGenderHtml($data);
                    }
                },
                'filter'    =>  ArrayHelper::map(GenderHelper::getGenderForSelect(), 'id', 'value'),
            ],
            [
                'attribute' => 'status',
                'format'    => 'html',
                'value'     => function ($data) {
                    if ($data->id) {
                        return CandidateStatus::getStatusHtml($data, 'index');
                    }
                },
                'filter'    =>  ArrayHelper::map(CandidateStatus::getStatusForSelect(), 'id', 'value'),
            ],
            ['class' => ActionColumn::class],
        ],
    ]); ?>

</div>