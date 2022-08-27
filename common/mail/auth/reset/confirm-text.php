<?php

use candidate\entities\user\User;
use yii\web\View;

/* @var $this View */
/* @var $user User */

$resetLink = Yii::$app->get('frontendUrlManager')->createAbsoluteUrl(['auth/reset/confirm', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

Parolni tiklash uchun quyidagi havolaga o'ting:

<?= $resetLink ?>
