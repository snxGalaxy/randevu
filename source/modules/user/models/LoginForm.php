<?php

namespace app\modules\user\models;

use app\components\custom\CForm;
use Yii;

class LoginForm extends CForm
{
    public $username;
    public $password;
    public $isRemember;
    private $user;
    
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app/user', 'Username'),
            'password' => Yii::t('app/user', 'Password'),
            'isRemember' => Yii::t('app/user', 'Remember Me'),
        ];
    }
    
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username'], 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'name']],
            [['password'], 'validatePassword'],
            [['isRemember'], 'boolean'],
        ];
    }
    
    private function getUser()
    {
        if (empty($this->user)) {
            $this->user = User::findOne($this->username);
        }
        
        return $this->user;
    }
    
    public function validatePassword($attribute, $params)
    {
        $user = $this->getUser();
        
        if (empty($user) || $user->password != User::hashPassword($this->password)) {
            $this->addError('username', Yii::t('app/user', 'Incorrect username or password'));
        }
    }
    
    public function login($runValidation = true)
    {
        if ($runValidation && !$this->validate()) {
            return false;
        }
        
        return Yii::$app->user->login($this->getUser(), $this->isRemember ? 3600 * 24 * 30 : 0);
    }
}
