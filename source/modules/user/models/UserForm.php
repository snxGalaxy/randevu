<?php

namespace app\modules\user\models;

use app\components\custom\CForm;
use app\components\helpers\ArrayHelper;
use app\modules\contact\models\Email;
use Yii;

class UserForm extends CForm
{
    const SCENARIO_ADD = 'add';
    const SCENARIO_EDIT = 'edit';
    const SCENARIO_REGISTER = 'register';
    
    public $username;
    public $password;
    public $repeatPassword;
    public $role;
    public $email;
    public $isActive;
    
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app/user', 'Username'),
            'password' => Yii::t('app/user', 'Password'),
            'repeatPassword' => Yii::t('app/user', 'Repeat Password'),
            'role' => Yii::t('app/user', 'User Role'),
            'email' => Yii::t('app/user', 'Email'),
            'isActive' => Yii::t('app/user', 'Active'),
        ];
    }
    
    public function attributeHints()
    {
        return [
            'repeatPassword' => Yii::t('app/user', 'Should match \'password\' field'),
            'role' => Yii::t('app/user', 'Role defines user rights and permissions'),
            'isActive' => Yii::t('app/user', 'Inactive users can\'t login to system'),
        ];
    }
    
    public function scenarios()
    {
        return [
            self::SCENARIO_ADD => ['username', 'password', 'repeatPassword', 'role', 'email'],
            self::SCENARIO_EDIT => ['username', 'password', 'role', 'email', 'isActive'],
            self::SCENARIO_REGISTER => ['username', 'password', 'repeatPassword'],
        ];
    }
    
    public function rules()
    {
        return [
            [['username', 'password', 'repeatPassword', 'role', 'email'], 'safe', 'on' => self::SCENARIO_ADD],
            [['username', 'password', 'email', 'role', 'isActive'], 'safe', 'on' => self::SCENARIO_EDIT],
            [['username', 'password', 'repeatPassword'], 'safe', 'on' => self::SCENARIO_REGISTER],
            [['username', 'password', 'role', 'email'], 'required'],
            [['repeatPassword'], 'required', 'on' => [self::SCENARIO_ADD, self::SCENARIO_REGISTER]],
            [['isActive'], 'required', 'on' => self::SCENARIO_EDIT],
            [['username'], 'string', 'min' => 3, 'max' => 32],
            [['username'], 'unique', 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'name']],
            [['password'], 'string', 'min' => 6, 'max' => 32],
            [['passwordRepeat'], 'compare', 'compareAttribute' => 'password'],
            [['email'], 'string', 'min' => 5, 'max' => 128],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => Email::className(), 'targetAttribute' => ['email' => 'address'], 'on' => [self::SCENARIO_ADD, self::SCENARIO_REGISTER]],
            [['isActive'], 'boolean', 'on' => self::SCENARIO_EDIT],
        ];
    }
    
    public function add()
    {
        $email = new Email([
            'address' => $this->email,
            'is_verified' => 0,
            'is_blacklisted' => 0,
        ]);
        
        if (!$email->save()) {
            $this->addError('email', implode('; ', ArrayHelper::extractValues($email->getErrors())));
            
            return false;
        }
        
        $user = new User([
            'name' => $this->username,
            'password' => $this->password,
            'role_name' => $this->role,
            'email' => $email->address,
            'is_active' => 1,
        ]);
        
        if (!$user->validate()) {
            $this->addError('username', implode('; ', ArrayHelper::extractValues($user->getErrors())));
            
            return false;
        }
        
        $user->password = User::hashPassword($user->password);
        
        if (!$user->save(false)) {
            $this->addError('username', implode('; ', ArrayHelper::extractValues($user->getErrors())));
            
            return false;
        }
        
        return true;
    }
    
    public function edit()
    {
        $user = User::findOne($this->username);
        $user->setAttributes([
            'password' => $this->password,
            'role_name' => $this->role,
            'email' => $this->email,
            'is_active' => $this->isActive,
        ], false);
        
        if (!$user->update()) {
            $this->addError('username', implode('; ', ArrayHelper::extractValues($user->getErrors())));
            
            return false;
        }
        
        return true;
    }
    
    public function register()
    {
        $this->role = Role::ROLE_USER;
        
        return $this->add();
    }
}
