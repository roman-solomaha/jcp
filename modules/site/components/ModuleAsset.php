<?php

namespace app\modules\site\components;

use yii\web\AssetBundle;

class ModuleAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/site/assets';

    public $js = [
        'js/swipe.min.js',
        'js/main.min.js',
    ];

    public $css = [
        'css/main.min.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}