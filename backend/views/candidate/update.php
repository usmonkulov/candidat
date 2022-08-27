<?php

use candidate\entities\candidate\Candidate;
use candidate\forms\candidate\CandidateForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $form CandidateForm */
/* @var $model Candidate */

$this->title = Yii::t('app', 'Tahrirlash: {name}', [
    'name' => $model->first_name . ' ' . $model->last_name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nomzodlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->first_name . ' ' . $model->last_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Tahrirlash');
?>
<div class="candidate-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
        'form' => $form,
    ]) ?>

</div>