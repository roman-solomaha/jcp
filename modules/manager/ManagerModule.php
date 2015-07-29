<?php

namespace app\modules\manager;

use Yii;
use yii\base\Module;

class ManagerModule extends Module
{
    public $controllerNamespace = 'app\modules\manager\controllers';

    public function init()
    {
        parent::init();

        Yii::$app->errorHandler->errorAction = 'manager/default/error';

        $this->defaultRoute = 'default/orders';
    }
}
