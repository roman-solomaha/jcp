<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\manager\components\VendorAsset;
use app\modules\manager\components\ModuleAsset;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $products app\models\Product */
$assets = ModuleAsset::register($this)->baseUrl;
?>

<pre>
    <?php var_dump($products->details) ?>
</pre>

<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <?php
        $form = ActiveForm::begin([
            'id' => 'form-create',
            'enableAjaxValidation' => false,
            'enableClientValidation' => false,
            'options' => [
                'enctype' => 'multipart/form-data',
            ]
        ]);
        ?>
        <?= $form->field($products, 'article') ?>
        <?= $form->field($products, 'category')->dropDownList($products->categoryList()) ?>
        <?= $form->field($products, 'cost') ?>

        <?= $form->field($products, 'image')->fileInput([
            'class' => 'image-upload',
            'data-filename' => '#image_filename',
            'data-placeholder' => Url::to($assets . '/img/placeholder.png'),
            'data-image' => $products->image_filename ?
                Url::to(['/' . $products->image_filename, ['q' => rand()]]) :
                Url::to($assets . '/img/placeholder.png')
        ]) ?>
        <div class="hide">
            <?= $form->field($products, 'image_filename')->textInput(['id' => 'image_filename']) ?>
        </div>

        <div class="wrapper-for-clones-rows">
            <?php
//            if($products->images) {
//                foreach ($products->images as $index => $image) {
//                    echo $this->render('partials/form-image',
//                        [
//                            'image' => $image,
//                            'form' => $form,
//                            'index' => $index
//                        ]);
//                }
//            } else {
//                echo $this->render('partials/form-image',
//                    [
//                        'image' => $images,
//                        'form' => $form,
//                        'index' => 0
//                    ]);
//            }
            ?>
        </div>

        <?= $form->field($products, 'description')->textarea(['rows' => 4]) ?>

        <div class="wrapper-for-clones-rows">
            <?php
//            if($products->details) {
//                foreach ($products->details as $index => $detail) {
//                    echo $this->render('partials/form-detail',
//                        [
//                            'detail' => $detail,
//                            'form' => $form,
//                            'index' => $index
//                        ]);
//                }
//            } else {
//                echo $this->render('partials/form-detail',
//                    [
//                        'detail' => $details,
//                        'form' => $form,
//                        'index' => 0
//                    ]);
//            }
            ?>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <?= Html::submitButton($products->isNewRecord ? 'Создать' : 'Изменить',
                    ['class' => 'btn ' . ($products->isNewRecord ? 'btn-primary' : 'btn-danger')]) ?>
            </div>
        </div>

        <?php
        $form->end();
        ?>
    </div>
</div>