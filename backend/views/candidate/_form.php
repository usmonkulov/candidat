<?php

use candidate\entities\candidate\Candidate;
use candidate\forms\candidate\CandidateForm;
use candidate\helpers\GenderHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this View */
/* @var $form CandidateForm */
/* @var $activeForm ActiveForm */
/* @var $model Candidate|null */
?>

<div class="candidate-form">

    <?php $activeForm = ActiveForm::begin(); ?>
    <?= $activeForm->errorSummary([$form]); ?>
    <div class="row">
    <div class="col-md-6">
        <?= $activeForm->field($form, 'last_name')->textInput(['maxlength' => true]) ?>

        <?= $activeForm->field($form, 'first_name')->textInput(['maxlength' => true]) ?>

        <?= $activeForm->field($form, 'middle_name')->textInput(['maxlength' => true]) ?>

        <?= $activeForm->field($form, 'birthday')->widget(MaskedInput::class, [
            'clientOptions' => [
                'alias' => 'yyyy-mm-dd',
            ]
        ]) ?>

        <?php
//            echo $activeForm->field($model, 'status')->checkbox(!isset($update->isNewRecord) ? ['value' => EnumApiUrlStatus::STATUS_ENABLED, 'checked' => true] : []);
             echo $activeForm->field($form, 'gender')->radioList(ArrayHelper::map(GenderHelper::getGenderForSelect(), 'id', 'value'))
        ?>

    </div>
    <div class="col-md-6">
        <?= $activeForm->field($form, 'phone')->widget(MaskedInput::class, [
            'mask' => '(99) 999-99-99',
        ]) ?>

        <?= $activeForm->field($form, 'email')->widget(MaskedInput::class, [
            'clientOptions' => [
                'alias' =>  'email'
            ],
        ]) ?>

        <?= $activeForm->field($form, 'country_origin')->textInput(['maxlength' => true]) ?>

        <?= $activeForm->field($form, 'address')->textarea(['rows' => 3]) ?>

        <?= $activeForm->field($form, 'hired')->checkbox() ?>

    </div>
</div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Yuborish'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>