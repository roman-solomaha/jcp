<?php
/* @var $detail app\models\ProductDetail */
/* @var $form yii\widgets\ActiveForm */
/* @var $index integer */

use yii\helpers\Html;

?>

<div class="row">
    <div class="col-sm-3">
        <?php
        echo $form->field($detail, 'name', ['inputOptions' =>
            [
                'name' => sprintf('ProductDetail[%d][name]', $index),
                'class' => 'form-control'
            ]
        ]);
        ?>
    </div>
    <div class="col-sm-3">
        <?php
        echo $form->field($detail, 'quantity', ['inputOptions' =>
            [
                'name' => sprintf('ProductDetail[%d][quantity]', $index),
                'class' => 'form-control'
            ]
        ]);
        ?>
    </div>
    <div class="col-sm-3">
        <?php
        echo $form->field($detail, 'cost', ['inputOptions' =>
            [
                'name' => sprintf('ProductDetail[%d][cost]', $index),
                'class' => 'form-control'
            ]
        ]);
        ?>
    </div>
    <div class="col-sm-3">
        <label for="">&emsp;</label>

        <div class="group-field">
            <?= Html::button($index == 0 ? '+' : '-',
                ['class' => $index == 0 ? 'btn btn-clone btn-block' : 'btn btn-remove btn-block']) ?>
        </div>
    </div>
</div>