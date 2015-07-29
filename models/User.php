<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $role
 * @property string $phone
 * @property string $password
 * @property integer $verify_code
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $discount_id
 *
 * @property Order[] $orders
 * @property Token[] $tokens
 * @property Discount $discount
 * @property UserExtra[] $userExtras
 * @property UserLegal[] $userLegals
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'discount_id'], 'required'],
            [['verify_code', 'status', 'discount_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['role', 'phone'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 255],
            [['phone'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'role' => Yii::t('app', 'Role'),
            'phone' => Yii::t('app', 'Phone'),
            'password' => Yii::t('app', 'Password'),
            'verify_code' => Yii::t('app', 'Verify Code'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'discount_id' => Yii::t('app', 'Discount ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(Token::className(), ['user_id' => 'id']);
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
    public function getUserExtras()
    {
        return $this->hasMany(UserExtra::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLegals()
    {
        return $this->hasMany(UserLegal::className(), ['user_id' => 'id']);
    }
}
