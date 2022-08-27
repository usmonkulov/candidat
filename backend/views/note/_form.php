<?php

use candidate\forms\candidate\NoteForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $form NoteForm */
/* @var $activeForm ActiveForm */
?>

<div class="note-form">

    <?php $activeForm = ActiveForm::begin([
            'id' => 'prl-form',
    ]); ?>
    <?= $activeForm->errorSummary([$form]); ?>

    <?= $activeForm->field($form, 'deadline')->textInput(['maxlength' => true]) ?>

    <?= $activeForm->field($form, 'description')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Yuborish'), ['class' => 'btn btn-success', 'id' => 'save-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>