<?php

use candidate\entities\user\User;
use yii\web\View;


/* @var $this View */
/* @var $user User */
$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->email_confirm_token]);
?>
Hello <?= $user->username ?>,

Elektron pochtangizni tasdiqlash uchun quyidagi havolaga o'ting:

<?= $confirmLink ?>
