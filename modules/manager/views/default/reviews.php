<?php
use yii\grid\GridView;
use app\models\ext\Review;
use app\modules\manager\components\widgets\EndColumns;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $reviews yii\data\ActiveDataProvider */

$this->title = 'Отзывы';
?>
    <h1><?= $this->title ?></h1>

<?php
$columns = [
    'id',
    'author',
    'message',
    [
        'attribute' => 'rating',
        'format' => 'raw',
        'contentOptions' => ['class' => 'text-center'],
        'value' => function($model){
            return Review::listRating()[$model->rating];
        }
    ]
];

$columns = array_merge($columns, EndColumns::begin()->run());

echo GridView::widget([
    'dataProvider' => $reviews,
    'layout' => '{items}',
    'tableOptions' => ['class' => 'table table-striped table-bordered'],
    'columns' => $columns
]);
?>