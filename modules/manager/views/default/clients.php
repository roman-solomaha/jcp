<?php

use yii\grid\GridView;
use app\modules\manager\components\widgets\EndColumns;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $users yii\data\ActiveDataProvider */

$this->title = 'Клиенты';
?>
<h1><?= $this->title ?></h1>

<?php
$columns = [
    'id',
    'phone',
    'first_name',
    'second_name',
    'last_name',
    'address',
    'verify_code'
];

$columns = array_merge($columns, EndColumns::begin()->run());

echo GridView::widget([
    'dataProvider' => $users,
    'layout' => '{items}',
    'tableOptions' => ['class' => 'table table-striped table-bordered'],
    'columns' => $columns
]);
?>