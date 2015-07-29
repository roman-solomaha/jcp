<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_product_extra".
 *
 * @property integer $id
 * @property string $price
 * @property integer $quantity
 * @property integer $discount
 * @property integer $product_extra_id
 * @property integer $order_products_id
 *
 * @property OrderProduct $orderProducts
 * @property ProductExtra $productExtra
 */
class OrderProductExtra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_product_extra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['quantity', 'discount', 'product_extra_id', 'order_products_id'], 'integer'],
            [['product_extra_id', 'order_products_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'price' => Yii::t('app', 'Price'),
            'quantity' => Yii::t('app', 'Quantity'),
            'discount' => Yii::t('app', 'Discount'),
            'product_extra_id' => Yii::t('app', 'Product Extra ID'),
            'order_products_id' => Yii::t('app', 'Order Products ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasOne(OrderProduct::className(), ['id' => 'order_products_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductExtra()
    {
        return $this->hasOne(ProductExtra::className(), ['id' => 'product_extra_id']);
    }
}
