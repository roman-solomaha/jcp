<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "discount".
 *
 * @property integer $id
 * @property integer $percent
 * @property integer $code
 * @property integer $status
 * @property string $started_at
 * @property string $finished_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Product[] $products
 * @property ProductExtra[] $productExtras
 * @property User[] $users
 */
class Discount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['percent', 'code', 'status'], 'integer'],
            [['started_at', 'finished_at', 'created_at', 'updated_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'percent' => Yii::t('app', 'Percent'),
            'code' => Yii::t('app', 'Code'),
            'status' => Yii::t('app', 'Status'),
            'started_at' => Yii::t('app', 'Started At'),
            'finished_at' => Yii::t('app', 'Finished At'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['discount_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductExtras()
    {
        return $this->hasMany(ProductExtra::className(), ['discount_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['discount_id' => 'id']);
    }
}
