<?php

use candidate\forms\candidate\CandidateForm;
use candidate\helpers\GenderHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this View */
/* @var $model CandidateForm */
/* @var $form ActiveForm */
?>

<div class="candidate-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary([$model]); ?>
    <div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'birthday')->widget(MaskedInput::class, [
            'clientOptions' => [
                'alias' => 'yyyy-mm-dd',
            ]
        ]) ?>

        <?= $form->field($model, 'gender')->radioList(ArrayHelper::map(GenderHelper::getGenderForSelect(), 'id', 'value')) ?>

    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
            'mask' => '(99) 999-99-99',
        ]) ?>

        <?= $form->field($model, 'email')->widget(MaskedInput::class, [
            'clientOptions' => [
                'alias' =>  'email'
            ],
        ]) ?>

        <?= $form->field($model, 'country_origin')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>

    </div>
</div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Yuborish'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>