<?php

namespace app\modules\manager\controllers;

use app\models\Product;
use app\models\ProductDetail;
use app\models\User;
use app\models\Review;
use Yii;
use yii\base\ErrorException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use app\modules\manager\components\ManagerController;
use yii\helpers\Url;
use yii\helpers\Html;
use yii2vm\media\upload\ImageUpload;

class DefaultController extends ManagerController
{
    public function actionOrders()
    {
        return $this->render('orders');
    }

    public function actionReviews()
    {
        $reviews = new ActiveDataProvider([
            'query' => Review::find(),
            'pagination' => [
                'pageSize' => 0,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ]
        ]);

        return $this->render('reviews', ['reviews' => $reviews]);
    }

    public function actionAnalytics()
    {
        $users = User::findAll(['role' => 'client']);
        $reviews = Review::findAll(['status' => 1]);


        return $this->render('analytics',
            [
                'users' => $users,
                'reviews' => $reviews,
            ]
        );
    }

    public function actionClients()
    {
        $users = new ActiveDataProvider([
            'query' => User::find()->where(['role' => 'client']),
            'pagination' => [
                'pageSize' => 0,
            ]
        ]);

        return $this->render('clients', ['users' => $users]);
    }
}
