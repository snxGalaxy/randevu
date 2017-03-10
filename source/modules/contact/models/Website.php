<?php

namespace app\modules\contact\models;

use app\components\custom\CActiveRecord;

/**
 * @property string $address
 * @property integer $is_verified
 * @property integer $is_blacklisted
 */
class Website extends CActiveRecord
{
    public static function tableName()
    {
        return 'websites';
    }
    
    public function rules()
    {
        return [
            [['address'], 'required'],
            [['address'], 'string', 'min' => 4, 'max' => 256],
            [['address'], 'url'],
            [['address'], 'unique'],
            [['is_verified', 'is_blacklisted'], 'integer'],
        ];
    }
}
