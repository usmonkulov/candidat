<?php

use candidate\forms\auth\LoginForm;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model LoginForm */

$this->title = Yii::t("app","Adminka");
?>

<div class="login-box">
    <div class="mt-3 offset-lg-4 col-lg-4">
        <?= Html::tag('h1', Html::encode($this->title), ['class' => 'text-center']) ?>
        <?= Html::tag('p', Yii::t('app',"Seansni boshlash uchun tizimga kiring"), ['class' => 'text-center']) ?>
        <?= Alert::widget() ?>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app',"Kirish"), ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
