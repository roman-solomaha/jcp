<?php

namespace app\models\forms;

use app\components\ModelException;
use app\models\Discount;
use Yii;
use yii\base\Model;
use app\models\ext\User;
use yii\db\Expression;

class RegistrationForm extends Model
{
    public $phone;
    public $password;

    public function rules()
    {
        return [
            [['phone', 'password'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'phone' => Yii::t('app', 'Phone'),
            'password' => Yii::t('app', 'Password'),
        ];
    }

    public function init()
    {
        parent::init();
    }

    public function register()
    {
        if(!$this->phone){
            $this->addError('phone', Yii::t('exceptions', 'Phone cannot be blank.'));
            return false;
        }

        if(!$this->password){
            $this->addError('password', Yii::t('exceptions', 'Password cannot be blank.'));
            return false;
        }

        if (User::findOne(['phone' => $this->phone])) {
            $this->addError('phone', Yii::t('exceptions', 'This phone is already exists'));
            return false;
        }

        $discount = new Discount();

        $discount->attributes = [
            'code'       => $this->phone,
            'status'     => 1,
            'started_at' => new Expression('UTC_TIMESTAMP'),
            'created_at' => new Expression('UTC_TIMESTAMP'),
            'updated_at' => new Expression('UTC_TIMESTAMP'),
        ];

        if (!$discount->save() || !$discount->refresh()) {
            throw new ModelException($discount);
        }

        $user = new User();
        $user->attributes = $this->attributes;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $user->verify_code = rand(1000, 10000);

        $user->discount_id = $discount->id;

        if (!$user->save() || !$user->refresh()) {
            throw new ModelException($user);
        }

        // TODO: Выслать СМС с проверочным кодом на $user->phone

        return Yii::$app->user->login($user->getActiveToken(), Yii::$app->params['remember']);
    }
}