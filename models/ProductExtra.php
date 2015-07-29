<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_extra".
 *
 * @property integer $id
 * @property string $name
 * @property integer $quantity
 * @property string $cost
 * @property string $price
 * @property string $created_at
 * @property string $updated_at
 * @property integer $product_id
 * @property integer $discount_id
 *
 * @property OrderProductExtra[] $orderProductExtras
 * @property Discount $discount
 * @property Product $product
 */
class ProductExtra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_extra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'product_id', 'discount_id'], 'required'],
            [['quantity', 'product_id', 'discount_id'], 'integer'],
            [['cost', 'price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'quantity' => Yii::t('app', 'Quantity'),
            'cost' => Yii::t('app', 'Cost'),
            'price' => Yii::t('app', 'Price'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'product_id' => Yii::t('app', 'Product ID'),
            'discount_id' => Yii::t('app', 'Discount ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProductExtras()
    {
        return $this->hasMany(OrderProductExtra::className(), ['product_extra_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['id' => 'discount_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
