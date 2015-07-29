<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $users app\models\User */
/* @var $reviews app\models\Review */


$this->title = 'Аналитика';
?>
<h1><?= $this->title ?></h1>

<div class="text-center">
    <div class="row">
        <div class="col-sm-4">
            <h3>Кленты</h3>
            <strong><?= count($users); ?></strong>
        </div>

        <div class="col-sm-4">
            <h3>Отзывы</h3>
            <strong><?= count($reviews); ?></strong>
        </div>
        <div class="col-sm-4">
            <h3>Заказы</h3>
            <strong>0</strong>
        </div>
    </div>
</div>