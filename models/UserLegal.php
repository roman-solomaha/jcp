<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_legal".
 *
 * @property integer $id
 * @property integer $inn
 * @property integer $kpp
 * @property string $company_name
 * @property integer $user_id
 *
 * @property User $user
 */
class UserLegal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_legal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inn', 'kpp', 'user_id'], 'integer'],
            [['user_id'], 'required'],
            [['company_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'inn' => Yii::t('app', 'Inn'),
            'kpp' => Yii::t('app', 'Kpp'),
            'company_name' => Yii::t('app', 'Company Name'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
