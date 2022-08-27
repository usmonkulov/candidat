<?php

use candidate\entities\user\User;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $user User */

$resetLink = Yii::$app->get('frontendUrlManager')->createAbsoluteUrl(['auth/reset/confirm', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <?=Html::tag('p',Yii::t("app","Parolni tiklash uchun quyidagi havolaga o'ting:"))?>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
