<?php

use candidate\entities\user\User;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $user User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->email_confirm_token]);
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <?=Html::tag(Yii::t('app',"Elektron pochtangizni tasdiqlash uchun quyidagi havolaga o'ting:"))?>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>
