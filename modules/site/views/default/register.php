<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = 'Регистрация';
?>
<h1 class="text-center"><?= $this->title ?></h1>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <?php
        $form = ActiveForm::begin([
            'enableAjaxValidation'   => false,
            'enableClientValidation' => false
        ]);

        echo $form->field($model, 'phone')->textInput([
            'class' => 'form-control mask-phone',
            'autofocus' => true
        ]);
        echo $form->field($model, 'password');


        echo Html::submitButton('Регистрация', ['class' => 'btn btn-primary']);

        $form::end();
        ?>
    </div>
</div>