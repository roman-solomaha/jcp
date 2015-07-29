<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = 'Подтверждение телефона';
?>
<h1 class="text-center"><?= $this->title ?></h1>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <?php
        $form = ActiveForm::begin([
            'enableAjaxValidation'   => false,
            'enableClientValidation' => false
        ]);

        echo $form->field($model, 'phone')->textInput(['disabled' => true]);
        echo $form->field($model, 'verify_code', ['template' => $this->render('partials/template-verify')])->textInput([
            'class' => 'form-control',
            'autofocus' => true
        ]);

        echo Html::submitButton('Подтвердить', ['class' => 'btn btn-primary']);

        $form::end();
        ?>
    </div>
</div>