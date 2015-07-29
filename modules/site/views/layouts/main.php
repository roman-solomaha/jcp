<?php
use yii\helpers\Html;
use app\modules\site\components\ModuleAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */

$assets = ModuleAsset::register($this)->baseUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link rel="shortcut icon" href="<?= Yii::getAlias('@web/images/favicon.ico') ?>"/>
    <link rel="apple-touch-icon-precomposed" sizes="57x57"
          href="<?= Yii::getAlias('@web/images/apple-touch-icon-57x57.png') ?>"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="<?= Yii::getAlias('@web/images/apple-touch-icon-114x114.png') ?>"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="<?= Yii::getAlias('@web/images/apple-touch-icon-72x72.png') ?>"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="<?= Yii::getAlias('@web/images/apple-touch-icon-144x144.png') ?>"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60"
          href="<?= Yii::getAlias('@web/images/apple-touch-icon-60x60.png') ?>"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
          href="<?= Yii::getAlias('@web/images/apple-touch-icon-120x120.png') ?>"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76"
          href="<?= Yii::getAlias('@web/images/apple-touch-icon-76x76.png') ?>"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
          href="<?= Yii::getAlias('@web/images/apple-touch-icon-152x152.png') ?>"/>

    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web/images/favicon-196x196.png') ?>" sizes="196x196"/>
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web/images/favicon-96x96.png') ?>" sizes="96x96"/>
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web/images/favicon-32x32.png') ?>" sizes="32x32"/>
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web/images/favicon-16x16.png') ?>" sizes="16x16"/>
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web/images/favicon-128.png') ?>" sizes="128x128"/>

    <meta name="application-name" content="Jobbio"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="<?= Yii::getAlias('@web/images/mstile-144x144.png') ?>"/>
    <meta name="msapplication-square70x70logo" content="<?= Yii::getAlias('@web/images/mstile-70x70.png') ?>"/>
    <meta name="msapplication-square150x150logo" content="<?= Yii::getAlias('@web/images/mstile-150x150.png') ?>"/>
    <meta name="msapplication-wide310x150logo" content="<?= Yii::getAlias('@web/images/mstile-310x150.png') ?>"/>
    <meta name="msapplication-square310x310logo" content="<?= Yii::getAlias('@web/images/mstile-310x310.png') ?>"/>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin(['options' => ['class' => 'navbar-inverse']]);
    echo Nav::widget(['options' => ['class' => 'navbar-nav navbar-left'],
                      'items' => [['label' => 'В Админку', 'url' => ['/manager'],
                                   'visible' => Yii::$app->user->identity && Yii::$app->user->identity->user->role == 'admin'],
                                  ['label' => Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->getId()],]]);

    echo Nav::widget(['options' => ['class' => 'navbar-nav navbar-right'],
                      'items' => [['label' => 'Каталог', 'url' => ['default/catalog']],
                                  ['label' => 'Инфо', 'url' => ['default/info']],
                                  ['label' => 'Отзывы', 'url' => ['default/reviews']],
                                  ['label' => 'Вход', 'url' => ['default/login'],
                                   'visible' => Yii::$app->user->isGuest],
                                  ['label' => 'Регистрация', 'url' => ['default/register'],
                                   'visible' => Yii::$app->user->isGuest],
                                  ['label' => 'Кабинет', 'url' => ['default/cabinet'],
                                   'visible' => !Yii::$app->user->isGuest],
                                  ['label' => 'Выход', 'url' => ['default/logout'],
                                   'linkOptions' => ['data-method' => 'post'],
                                   'visible' => !Yii::$app->user->isGuest]],]);
    NavBar::end();
    ?>
    <div class="content">
        <div class="container">
            <?= $content ?>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
