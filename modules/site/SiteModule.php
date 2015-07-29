<?php

namespace app\modules\site;

use yii\base\Module;

class SiteModule extends Module
{
    public $controllerNamespace = 'app\modules\site\controllers';

    public function init()
    {
        parent::init();

        $this->defaultRoute = 'default/index';
    }
}
