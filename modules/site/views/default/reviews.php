<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ext\Review */
/* @var $dataProvider yii\data\ActiveDataProvider; */

$this->title = Yii::t('titles', 'Reviews');
?>
<h1><?= $this->title ?></h1>

<?php
echo Html::tag('strong', Yii::$app->session->get('review'));
Yii::$app->session->remove('review');

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'partials/review',
    'options' => ['class' => 'row'],
    'itemOptions' => ['class' => 'col-xs-12'], // col-sm-6 col-md-4
    'layout' => '{items}'
]);
?>

    <br/>
    <br/>
    <br/>

<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <?php
        $form = ActiveForm::begin([
            'enableAjaxValidation'   => false,
            'enableClientValidation' => false
        ]);

        echo $form->field($model, 'author');
        echo $form->field($model, 'rating')->radioList($model->listRating(), [
            'class' => 'btn-group',
            'data-toggle' => 'buttons',
            'unselect' => null,
            'item' => function ($index, $label, $name, $checked, $value) {

                return '<label class="btn' . ($value == '1' ? ' active ' : ' ') . $value . '">' .
                Html::radio($name, $value == '1', ['value' => $value]) . $label . '</label>';
            }
        ]);
        echo $form->field($model, 'message')->textarea(['rows' => 5]);

        echo Html::submitButton('Оставить отзыв', ['class' => 'btn btn-primary']);

        $form->end();
        ?>
    </div>
</div>

<br/>
<br/>
<br/>
<br/>
<br/>