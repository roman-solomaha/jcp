<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\modules\manager\components\widgets\EndColumns;
use app\modules\manager\components\ModuleAsset;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Склад';
?>
<h1>
    <?= $this->title ?>
    <a href="<?= Url::to(['form']) ?>" class="btn btn-success pull-right">Создать</a>
</h1>

<?php
$columns = [
    'id',
    [
        'attribute' => 'article',
        'format' => 'raw',
        'value' => function($model){
            /* @var $model app\models\Product */
            return Html::a($model->article, Url::to(['form', 'id' => $model->id]));
        }
    ],
    [
        'attribute' => 'category',
        'format' => 'raw',
        'value' => function($model){
            /* @var $model app\models\Product */
            return $model->categoryList()[$model->category];
        }
    ],
    'cost',
    [
        'attribute' => 'Детали',
        'format' => 'raw',
        'value' => function($model){
            /* @var $model app\models\Product */
            /* @var $detailDataProvider yii\data\ActiveDataProvider */
            $detailDataProvider = new ActiveDataProvider([
                'query' => $model->getDetail(),
                'pagination' => [
                    'pageSize' => 0
                ]
            ]);

            return ListView::widget([
                'dataProvider' => $detailDataProvider,
                'layout' => '{items}',
                'itemOptions' => ['class' => 'product-detail'],
                'itemView' => 'partials/table-detail'
            ]);
        }
    ],
    'description',
    [
        'attribute' => 'image_filename',
        'format' => 'raw',
        'value' => function ($model) {
            /* @var $assets string */
            /* @var $model app\models\Product */
            $assets = ModuleAsset::register($this)->baseUrl;
            return Html::img($model->image_filename ?
                '/' . $model->image_filename :
                $assets . '/img/placeholder.png');
        },
    ],
    [
        'attribute' => 'Галерея',
        'format' => 'raw',
        'value' => function($model){
            /* @var $model app\models\Product */
            /* @var $imageDataProvider yii\data\ActiveDataProvider */
            $imageDataProvider = new ActiveDataProvider([
                'query' => $model->getImage(),
                'pagination' => [
                    'pageSize' => 0
                ]
            ]);

            return ListView::widget([
                'dataProvider' => $imageDataProvider,
                'layout' => '{items}',
                'itemOptions' => ['class' => 'product-image'],
                'itemView' => 'partials/table-image'
            ]);
        }
    ]
];

$columns = array_merge($columns, EndColumns::begin()->run());

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => '{items}',
    'tableOptions' => ['class' => 'table table-striped table-bordered'],
    'columns' => $columns
]);
?>