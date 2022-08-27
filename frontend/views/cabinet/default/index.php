<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use candidate\readModels\candidate\CandidateReadRepository;

/* @var $searchForm CandidateReadRepository */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app',"Kabinet");
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="cabinet-index">
    <?= Html::tag('h2', Html::encode($this->title))?>
    <?= Html::tag('p', Html::a(Yii::t('app',"Profilni tahrirlash"), ['cabinet/profile/edit'], ['class' => 'btn btn-primary'])) ?>
    <?= Html::tag('p', Html::a(Yii::t('app',"Arizalarim"), ['cabinet/candidate/index'], ['class' => 'btn btn-success'])) ?>
    <?= Html::tag('p', Yii::t('app',"Assalomu alaykum"))?>
</div>
