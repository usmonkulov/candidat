<?php

/* @var $this \yii\web\View */
/* @var $content string */

use candidate\repositories\UserNameRepository;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Bosh sahifa', 'url' => ['/site/index']],
        ['label' => 'Nomzodingiz uchun ariza yuborish', 'url' => ['/candidate/create']],
        ['label' => 'Yuborgan arizangiz holatini tekshirish', 'url' => ['/candidate/check']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('app','Kirish'), 'url' => ['/auth/auth/login']];
        $menuItems[] = ['label' => Yii::t('app','Ro\'yxatdan o\'tish'), 'url' => ['/auth/signup/request']];
    } else {
        $menuItems[] = ['label' => Yii::t('app','Kabinet'), 'url' => ['/cabinet']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/auth/auth/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton(
                'Logout (' . (new UserNameRepository())->get(Yii::$app->user->id)->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?php try {
            echo Breadcrumbs::widget([
                'homeLink' => ['label' => '<i class="fa fa-dashboard"></i> '.Yii::t('app', 'Bosh sahifa'), 'url' => Yii::$app->urlManager->createUrl("/")],
                'tag' => 'ol',
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => 'breadcrumb panel'],
                'encodeLabels' => false
            ]);
        } catch ( Exception $e ) {
            echo $e->getMessage();
        } ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::$app->name  . Yii::t('app', 'ni aniqlash platformasi') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
