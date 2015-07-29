<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $sku
 * @property string $cost
 * @property string $price
 * @property string $main_image
 * @property string $description
 * @property integer $quantity
 * @property integer $status
 * @property integer $sort
 * @property string $created_at
 * @property string $updated_at
 * @property integer $category_id
 * @property integer $discount_id
 *
 * @property OrderProduct[] $orderProducts
 * @property Category $category
 * @property Discount $discount
 * @property ProductExtra[] $productExtras
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'category_id', 'discount_id'], 'required'],
            [['cost', 'price'], 'number'],
            [['description'], 'string'],
            [['quantity', 'status', 'sort', 'category_id', 'discount_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'sku'], 'string', 'max' => 100],
            [['main_image'], 'string', 'max' => 255]
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
            'sku' => Yii::t('app', 'Sku'),
            'cost' => Yii::t('app', 'Cost'),
            'price' => Yii::t('app', 'Price'),
            'main_image' => Yii::t('app', 'Main Image'),
            'description' => Yii::t('app', 'Description'),
            'quantity' => Yii::t('app', 'Quantity'),
            'status' => Yii::t('app', 'Status'),
            'sort' => Yii::t('app', 'Sort'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'category_id' => Yii::t('app', 'Category ID'),
            'discount_id' => Yii::t('app', 'Discount ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
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
    public function getProductExtras()
    {
        return $this->hasMany(ProductExtra::className(), ['product_id' => 'id']);
    }
}
