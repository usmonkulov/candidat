<?php

/* @var $this yii\web\View */
/* @var $model UserEditForm */
/* @var $user User */

use candidate\entities\user\User;
use candidate\forms\manage\user\UserEditForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app',"Profilni tahrirlash");
$this->params['breadcrumbs'][] = ['label' => Yii::t('app',"Kabinet"), 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = Yii::t('app',"Profil");
?>
<div class="user-update">

    <div class="row">
        <div class="col-sm-6">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'email')->textInput(['maxLength' => true]) ?>
            <?= $form->field($model, 'phone')->textInput(['maxLength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', "Tahrirlash"), ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
