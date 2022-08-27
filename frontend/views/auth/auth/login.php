<?php

use candidate\forms\auth\LoginForm;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model LoginForm */

$this->title = Yii::t('app','Kirish');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-sm-6">
        <div class="well">
            <?= Html::tag('h1', $this->title);?>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput() ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
                <div class="col-md-6">
                    <div style="color:#999;margin-left: 75px">
                        <?= Html::a(Yii::t('app','Parolni tiklash'), ['auth/reset/request']) ?>.
                    </div>
                </div>
            </div>

            <div>
                <?= Html::submitButton($this->title, ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
