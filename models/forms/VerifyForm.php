<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\ext\User;
use yii\base\ErrorException;

/**
 * VerifyForm is the model behind the login form.
 */
class VerifyForm extends Model
{
    public $phone;
    public $verify_code;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['phone', 'verify_code'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'phone' => Yii::t('app', 'Phone'),
            'verify_code' => Yii::t('app', 'Verify Code'),
        ];
    }

    public function init()
    {
        parent::init();
    }

    public function verify()
    {
        if (!$this->phone) {
            $this->addError('phone', Yii::t('exceptions', 'Phone cannot be blank.'));
            return false;
        }

        if (!$this->verify_code) {
            $this->addError('verify_code', Yii::t('exceptions', 'Verification code from SMS cannot be blank.'));
            return false;
        }

        $user = User::findOne(['phone' => $this->phone]);

        if (!$user) {
            $this->addError('phone', 'Телефон не найден');
            return false;
        }

        if($user->verify_code == $this->verify_code){
            $user->status = 1;
            if (!$user->save() || !$user->refresh()) {
                throw new ErrorException('Not save');
            }
            return true;
        }

        $this->addError('verify_code', 'Неверный код');
        return false;
    }
}