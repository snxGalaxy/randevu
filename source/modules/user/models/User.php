<?php

namespace app\modules\user\models;

use app\components\custom\CActiveRecord;
use app\components\helpers\TimeHelper;
use app\modules\contact\models\Email;
use yii\web\IdentityInterface;

/**
 * @property string $name
 * @property string $password
 * @property string $role_name
 * @property string $email_address
 * @property integer $is_active
 * @property string $auth_key
 * @property string $access_token
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property Email $email
 */
class User extends CActiveRecord implements IdentityInterface
{
    const USER_RANDEVU = 'randevu';
    
    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['name', 'password', 'role_name', 'email_address', 'auth_key', 'access_token'], 'required'],
            [['name'], 'string', 'min' => 3, 'max' => 64],
            [['name'], 'unique'],
            [['password'], 'string', 'min' => 6, 'max' => 32],
            [['role_name'], 'exist', 'targetClass' => Role::className(), 'targetAttribute' => ['role_name' => 'name']],
            [['email_address'], 'exist', 'targetClass' => Email::className(), 'targetAttribute' => ['email_address' => 'address']],
            [['is_active'], 'integer'],
            [['auth_key', 'access_token'], 'string', 'min' => 23, 'max' => 23],
            [['auth_key', 'access_token'], 'unique'],
            [['created_at', 'updated_at', 'deleted_at'], 'date', 'format' => TimeHelper::FORMAT_TIMESTAMP],
        ];
    }
    
    public function getEmail()
    {
        return $this->hasOne(Email::className(), ['address' => 'email_address']);
    }
    
    public static function hashPassword($password)
    {
        return md5($password . 'UtFlc9SUi8');
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function getId()
    {
        return $this->name;
    }

    public function validateAuthKey($authKey)
    {
        return $authKey === $this->auth_key;
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::find()->where(['access_token' => $token])->one();
    }
    
    public function init()
    {
        $this->on(self::EVENT_INIT, [$this, 'generateIds']);
        
        return parent::init();
    }

    public function generateIds()
    {
        if (empty($this->auth_key)) {
            $this->auth_key = uniqid('', true);
        }

        if (empty($this->access_token)) {
            $this->access_token = uniqid('', true);
        }
    }
}
