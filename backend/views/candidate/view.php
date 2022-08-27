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

$this->title = $model->first_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nomzodlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="candidate-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a(Yii::t('app', 'Tahrirlash'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a(Yii::t('app', 'O\'chirish'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Haqiqattan ham bu nomzodni oʻchirib tashlamoqchimisiz?'),
                'method' => 'post',
            ],
        ]) ?>

        <?php
            if(empty($model->note && $model->id)){
                echo Html::a(Yii::t('app', 'Intervyu vaqti qo\'shish'),
                    ['note/create', 'id' => $model->id],
                    ['class' => 'btn btn-success', 'id' => 'modal_button']);
            } else {
                echo Html::a(Yii::t('app', 'Intervyu vaqtini tahrirlash'),
                    ['note/update', 'candidate_id' => $model->id],
                    ['class' => 'btn btn-warning', 'id' => 'modal_button']);
            }
        ?>
        <?= Html::a(Yii::t('app', 'Nomzodlar'), ['index', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </p>

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
                        return CandidateStatus::getStatusHtml($data, 'view');
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