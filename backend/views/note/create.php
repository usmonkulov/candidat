<?php

use candidate\forms\candidate\NoteForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $form NoteForm */
/* @var $model null*/

$this->title = Yii::t('app', 'Nomzod uchun muddat belgilash');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="note-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'form' => $form,
        'model' => $model,
    ]) ?>

</div>