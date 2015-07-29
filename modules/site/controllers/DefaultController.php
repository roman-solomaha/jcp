<?php

namespace app\modules\site\controllers;

use app\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use app\models\ext\Review;
use app\modules\site\components\SiteController;
use app\models\forms\LoginForm;
use app\models\forms\VerifyForm;
use app\models\forms\RegistrationForm;

class DefaultController extends SiteController
{
    public function actionCatalog()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->where(['status' => 1]),
            'pagination' => [
                'pageSize' => 0,
            ],
            'sort' => [
                'defaultOrder' => [
                    'updated_at' => SORT_DESC
                ]
            ]
        ]);

        return $this->render('catalog', ['dataProvider' => $dataProvider]);
    }

    public function actionInfo()
    {
        return $this->render('info');
    }

    public function actionReviews()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Review::find()->where(['status' => 1]),
            'pagination' => [
                'pageSize' => 0,
            ],
            'sort' => [
                'defaultOrder' => [
                    'updated_at' => SORT_DESC
                ]
            ]
        ]);

        $model = new Review();
        if($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->set('review',
                'Ваш отзыв принят, и будет опубликован после провернки модератором. Спасибо!');
            return $this->refresh();
        }

        return $this->render('reviews', ['model' => $model, 'dataProvider' => $dataProvider]);
    }

    public function actionCabinet()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('login');
        }

        $user = Yii::$app->user->identity->user;

        if($user->status == 0){
            return $this->redirect('verify');
        }

        return $this->render('cabinet', ['user' => $user]);
    }

    public function actionVerify()
    {
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->user->status == 1) {
            return $this->redirect('cabinet');
        }

        $model = new VerifyForm();
        $user = Yii::$app->user->identity->user;

        $model->phone = $user->phone;

        if ($model->load(Yii::$app->request->post()) && $model->verify()) {
            return $this->redirect('cabinet');
        }

        return $this->render('verify', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('cabinet');
        }

        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->redirect('cabinet');
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionNewVerify()
    {
        if(!Yii::$app->user->isGuest){

        }
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('cabinet');
        }

        $model = new LoginForm();

        if($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('cabinet');
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}