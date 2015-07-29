<?php

namespace app\modules\manager\components;

use Yii;
use yii\base\ErrorException;
use yii\filters\AccessControl;
use app\controllers\BaseController;
use yii\helpers\Url;
use yii\helpers\Html;

class ManagerController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return Yii::$app->user->identity->user->role == 'admin';
                        }
                    ]
                ],
            ]
        ];
    }

    /* @var $modelName \yii\db\ActiveRecord */
    public function actionToggleStatus($modelName, $id)
    {
        /* @var $model \yii\db\ActiveRecord */
        $model = $modelName::findOne($id);
        if(!Yii::$app->request->isPut) {
            return new ErrorException('Доступ запрещён');
        }

        $model->status = $model->status == 1 ? 0 : 1;
        if(!$model->save() || !$model->refresh()){
            return new ErrorException('Невозможно изменить статус');
        }

        return $this->redirect(Url::to(Yii::$app->request->referrer));
    }

    /* @var $modelName \yii\db\ActiveRecord */
    public function actionDelete($modelName, $id)
    {
        /* @var $model \yii\db\ActiveRecord */
        $model = $modelName::findOne($id);
        if(!Yii::$app->request->isDelete) {
            return new ErrorException('Доступ запрещён');
        }

        $model->status = $model->status == 1 ? 0 : 1;
        if(!$model->delete()){
            return new ErrorException('Невозможно удалить');
        }

        return $this->redirect(Url::to(Yii::$app->request->referrer));
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
