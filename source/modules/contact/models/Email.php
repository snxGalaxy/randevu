<?php

namespace app\modules\contact\models;

use app\components\custom\CActiveRecord;

/**
 * @property string $address
 * @property integer $is_verified
 * @property integer $is_blacklisted
 */
class Email extends CActiveRecord
{
    const EMAIL_ROOT = 'randevu@system.root';
    
    public static function tableName()
    {
        return 'emails';
    }
    
    public function rules()
    {
        return [
            [['address'], 'required'],
            [['address'], 'string', 'min' => 5, 'max' => 128],
            [['address'], 'email'],
            [['address'], 'unique'],
            [['is_verified', 'is_blacklisted'], 'integer'],
        ];
    }
}
