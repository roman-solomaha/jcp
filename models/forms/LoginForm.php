<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $phone;
    public $password;
    public $rememberMe = true;

    public function rules()
    {
        return [
            [['phone', 'password'], 'required'],
            ['rememberMe', 'boolean'],
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

    public function login()
    {
        $user = \app\models\ext\User::findOne(['phone' => $this->phone]);

        if(!$this->phone){
            $this->addError('phone', Yii::t('exceptions', '%s cannot be blank', ['Phone']));
            return false;
        }

        if(!$this->password){
            $this->addError('password', Yii::t('exceptions', '{field} cannot be blank', Yii::t('app', 'Password')));
            return false;
        }

        if (!$user || !Yii::$app->getSecurity()->validatePassword($this->password, $user->password)) {
            $this->addError('phone', Yii::t('exceptions', 'Invalid phone or password'));
            return false;
        }

        return Yii::$app->user->login($user->getActiveToken(), Yii::$app->params['remember']);
    }
}
