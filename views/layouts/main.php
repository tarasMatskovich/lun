<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container">
<?php
NavBar::begin([ // отрываем виджет
    'brandLabel' => 'Main', // название организации
    'brandUrl' => Yii::$app->homeUrl, // ссылка на главную страницу сайта
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top main-menu', // стили главной панели
    ],
    'renderInnerContainer' => true,
    'innerContainerOptions' => [
            'class' => 'container'
    ]
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'], // стили ul
    'items' => [
        ['label' => 'Главная', 'url' => ['/index/index']],
        ['label' => 'Поиск квартиры', 'url' => ['/search/index']],
        ['label' => 'Админ. панель', 'url' => ['/admin/index']],
    ],
]);
NavBar::end(); // закрываем виджет
?>
</div>

<div class="content">
    <div class="container">
        <?=$content?>
    </div>
</div>

<?php $this->endBody() ?>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>-->
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->
</body>
</html>
<?php $this->endPage() ?>
