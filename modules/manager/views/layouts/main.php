<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\manager\components\ModuleAsset;
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
    <meta name="application-name" content="ZeeXee" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="<?= Yii::getAlias('@web/images/favicon.ico') ?>" />
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web/images/favicon-196x196.png') ?>" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
        NavBar::begin([
            'options' => ['class' => 'navbar-inverse']
                      ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => [
                ['label' => 'Вернуться на сайт', 'url' => Url::home()],
                ['label' => Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->getId() ],
            ]
        ]);

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Заказы', 'url' => ['default/orders']],
                ['label' => 'Склад', 'url' => ['products/index']],
                ['label' => 'Клиенты', 'url' => ['default/clients']],
                ['label' => 'Отзывы', 'url' => ['default/reviews']],
                ['label' => 'Аналитика', 'url' => ['default/analytics']]
            ],
        ]);
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
