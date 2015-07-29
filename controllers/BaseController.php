<?php

namespace app\controllers;

use app\models\Settings;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\filters\VerbFilter;
use yii\web\Controller;

class BaseController extends Controller
{
    public $layout = 'main';

    public function actions()
    {
        Yii::$app->language = Settings::findOne(['name' => 'lang'])->value;
        return [
            'error' => 'yii\web\ErrorAction',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('UTC_TIMESTAMP'),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ]
        ];
    }
}