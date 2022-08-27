<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model candidate\readModels\candidate\RequestAndTokenReadRepository */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="candidate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['check'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?php  echo $form->field($model, 'request_no') ?>
        </div>
        <div class="col-md-6">
            <?php  echo $form->field($model, 'token') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Qidirish'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Qayta o\'rnatish'),'check', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>