<?php

use candidate\forms\auth\ResetPasswordForm;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model ResetPasswordForm */

$this->title = Yii::t('app',"Parolni yiklash");
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <?= Html::tag('h2', Html::encode($this->title))?>
    <?= Html::tag('p', Yii::t('app','Yangi parol kiriting'))?>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app',"Saqlash"), ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
