<?php

namespace app\modules\manager\components;

use yii\web\AssetBundle;

class ModuleAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/manager/assets';

    public $js = [
        'js/main.min.js',
    ];

    public $css = [
        'css/main.min.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle'
    ];
}