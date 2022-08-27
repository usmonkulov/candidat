<?php

use candidate\entities\candidate\Candidate;
use candidate\helpers\GenderHelper;
use candidate\status\CandidateStatus;
use yii\bootstrap4\Modal;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Candidate */

$this->title = Yii::t('app', 'Arizalarim');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app',"Kabinet"), 'url' => ['cabinet/default/index']];
$this->title = $model->first_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Arizalarim'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="candidate-view">

    <?= Html::tag('p', Html::a(Yii::t('app',"Kabinet"), ['cabinet/'], ['class' => 'btn btn-success'])) ?>
    <h2><?= Html::encode($this->title) ?></h2>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => Yii::t('app','Eslatma (Note)'),
                'format'    => 'html',
                'value'     => function ($data) {
                    if(!empty($data->note->candidate_id)){
                        return $data->note->description;
                    }
                    return null;
                },
            ],
            [
                'label' => Yii::t('app','Tugash vaqti'),
                'format'    => 'html',
                'value'     => function ($data) {
                    if(!empty($data->note->candidate_id)){
                        return date("Y-m-d", strtotime($data->note->updated_at . '+' . $data->note->deadline . ' day')) . ' ' . Yii::t('app','<b>Muddat: </b>' . $data->note->deadline . '-kun');
                    }
                    return null;
                },
            ],
            'id',
            'first_name',
            'last_name',
            'middle_name',
            'address:html',
            'country_origin',
            'email:email',
            'phone',
            [
                'label' => Yii::t('app', 'Yosh'),
                'format'    => 'html',
                'value'     => function ($data) {
                    if ($data->birthday) {
                        return $data->ago;
                    }
                },
            ],
            'hired:boolean',
            [
                'attribute' => 'gender',
                'format'    => 'html',
                'value'     => function ($data) {
                    if ($data->id) {
                        return GenderHelper::getGenderHtml($data);
                    }
                },
            ],
            [
                'attribute' => 'status',
                'format'    => 'html',
                'value'     => function ($data) {
                    if ($data->id) {
                        return CandidateStatus::getLabel($data->status);
                    }
                },
            ],
            [
                'attribute' => 'created_by',
                'format'    => 'html',
                'value'     => function ($data) {
                    if ($data->created_by) {
                        return $data->createdBy->username;
                    }
                    return null;
                },
            ],
            'created_at',
            [
                'attribute' => 'updated_by',
                'format'    => 'html',
                'value'     => function ($data) {
                    if ($data->updated_by) {
                        return $data->updatedBy->username;
                    }
                    return null;
                },
            ],
            'updated_at',
        ],
    ]) ?>

</div>
<?php
Modal::begin([
    'title' => Html::tag('h3',Yii::t('app','Eslatma yozing')),
    'id' => 'myModal',
    'size' => 'modal-lg',
]);

echo "<div id='modalContent'>Mazmuni</div>";

Modal::end();