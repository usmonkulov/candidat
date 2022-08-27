<?php

use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchForm candidate\readModels\candidate\CandidateReadRepository */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Arizalarim');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app',"Kabinet"), 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="candidate-index">
    <?= Html::tag('p', Html::a(Yii::t('app',"Kabinet"), ['cabinet/'], ['class' => 'btn btn-success'])) ?>
    <h2><?= Html::encode($this->title) ?></h2>

    <?= GridView::widget([
        'options'      => ['class' => 'table-responsive'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchForm,
        'summary' => 'Namoyish etilayabdi <strong>{begin}-{end}</strong> ta yozuv <strong>{totalCount}</strong> tadan.',
        'columns' => [
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
            [
                'attribute' => 'middle_name',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::a($data->middle_name, ['candidate/view', 'id' => $data->id]);
                }
            ],
           'phone',
            [
                'class'      => ActionColumn::class,
                'template'   => '{view}',
                'urlCreator' => function ($action, $model) {
                    if ($action === 'view')
                        return ['cabinet/candidate/view','id' => $model->id];
                    return null;
                }
            ],
        ],
    ]); ?>

</div>