<?php

use candidate\forms\candidate\CandidateForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $form CandidateForm */
/* @var $model null*/

$this->title = Yii::t('app', 'Nomzodingiz uchun ariza yuborish');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="candidate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'form' => $form,
        'model' => $model,
    ]) ?>

</div>