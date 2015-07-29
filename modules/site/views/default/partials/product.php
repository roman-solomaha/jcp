<?php
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\bootstrap\ActiveForm */
?>

<p><?= $model->article ?></p>
<p><?= $model->cost ?></p>
<p><?=  Html::img($model->image_filename ?
        '/' . $model->image_filename :
        $assets . '/img/placeholder.png'); ?></p>
<p><?= $model->category ?></p>
<p><?= $model->description ?></p>