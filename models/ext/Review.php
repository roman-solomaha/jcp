<?php

namespace app\models\ext;

use Yii;

class Review extends \app\models\Review
{
    /**
     * @inheritdoc
     */
    static function listRating(){
        return [
            0 => 'Плохо',
            1 => 'Нормально',
            2 => 'Отлично'
        ];
    }
}