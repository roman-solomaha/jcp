<?php
namespace app\modules\manager\components\widgets;

use yii\base\Widget;
use yii\helpers\Url;
use yii\helpers\Html;

class EndColumns extends Widget
{
    public function run()
    {
        return [
            [
                'attribute' => 'created_at',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'format' => ['date', 'php:d.m.Y h:i']
            ],
            [
                'attribute' => 'Удалить',
                'format' => 'raw',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'value' => function($model){
                    /* @var $model \yii\db\ActiveRecord */
                    return Html::a('Удалить <i class="fa fa-remove"></i>',
                        Url::to(['delete', 'modelName' => $model->className(), 'id' => $model->id]),
                        ['data-method' => 'delete', 'class' => 'btn btn-sm btn-danger']);
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'value' => function ($model){
                    /* @var $model \yii\db\ActiveRecord */
                    return Html::a($model->status ?
                        '<i class="fa fa-check text-success"></i>' :
                        '<i class="fa fa-remove text-danger"></i>',
                        Url::to(['toggle-status', 'modelName' => $model->className(), 'id' => $model->id]),
                        ['data-method' => 'put', 'class' => 'btn btn-sm btn-default']);
                }
            ],
        ];
    }
}