<?php

use candidate\helpers\GenderHelper;
use candidate\status\CandidateStatus;;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchForm candidate\readModels\candidate\CandidateReadRepository */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Yuborgan arizangiz holatini tekshirish');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="candidate-check">

    <h2><?= Html::encode($this->title) ?></h2>

    <?php  echo $this->render('_search', ['model' => $searchForm]); ?>

    <?php
         if (empty($dataProvider->getModels())){
            echo Html::tag('h3', Yii::t('app','Bunday ariza mavjud emas!'));
         } elseif (!empty($queryParams)){
            echo DetailView::widget([
                'model' => $dataProvider->getModels()[0],
                'attributes' => [
                    'first_name',
                    'last_name',
                    'middle_name',
                    'address:html',
                    'country_origin',
                    'email:html',
                    'phone',
                    [
                        'label' => Yii::t('app', 'Yosh'),
                        'format'    => 'html',
                        'value'     => function ($data) {
                            if ($data->ago) {
                                return $data->ago;
                            }
                        },
                    ],
                    'hired:boolean',
                    [
                        'attribute' => 'gender',
                        'format'    => 'html',
                        'value'     => function ($data) {
                            if ($data->id) {
                                return GenderHelper::getGenderHtml($data);
                            }
                        },
                    ],
                    [
                        'attribute' => 'status',
                        'format'    => 'html',
                        'value'     => function ($data) {
                            if ($data->status) {
                                return CandidateStatus::getLabel($data->status);
                            }
                        },
                    ],
                ],
            ]);
        }
    ?>
</div>