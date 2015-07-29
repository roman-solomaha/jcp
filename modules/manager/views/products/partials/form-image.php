<?php
/* @var $image app\models\ProductImage */
/* @var $form yii\widgets\ActiveForm */
/* @var $index integer */

use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\manager\components\ModuleAsset;

$assets = ModuleAsset::register($this)->baseUrl;
?>

<pre>
    <?php var_dump($image) ?>
</pre>

<div class="row">
    <div class="col-sm-9">
        <?= $form->field($image, sprintf('[%d]image', $index), ['inputOptions' =>
            [
                'name' => sprintf('ProductImage[%d][image]', $index),
                'class' => 'image-upload form-control',
                'data-filename' => '#image_filename_' . $index,
                'data-placeholder' => Url::to($assets . '/img/placeholder.png'),
                'data-image' => $image->image_filename ?
                    Url::to(['/' . $image->image_filename, ['q' => rand()]]) :
                    Url::to($assets . '/img/placeholder.png')
            ]])->fileInput() ?>
        <div class="hide">
            <?= $form->field($image, 'image_filename', ['inputOptions' =>
                [
                    'id' => 'image_filename_' . $index,
                    'name' => sprintf('ProductImage[%d][image]', $index)
                ]]) ?>
        </div>
    </div>
    <div class="col-sm-3">
        <label for="">&emsp;</label>

        <div class="group-field">
            <?= Html::button($index == 0 ? '+' : '-',
                ['class' => $index == 0 ? 'btn btn-clone btn-block' : 'btn btn-remove btn-block']) ?>
        </div>
    </div>
</div>