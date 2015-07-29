<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $dataProvider yii\data\ActiveDataProvider; */

$this->title = 'Каталог';
?>

<h1><?= $this->title ?></h1>

<?php
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'partials/product',
    'options' => ['class' => 'row'],
    'itemOptions' => ['class' => 'col-xs-12 col-sm-6 col-md-4'],
    'layout' => '{items}',
]);
?>