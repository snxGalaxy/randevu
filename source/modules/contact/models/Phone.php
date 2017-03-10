<?php

namespace app\modules\contact\models;

use app\components\custom\CActiveRecord;

/**
 * @property string $number +123456789012
 * @property integer $is_verified
 * @property integer $is_blacklisted
 */
class Phone extends CActiveRecord
{
    public static function tableName()
    {
        return 'phones';
    }
    
    public function rules()
    {
        return [
            [['number'], 'required'],
            [['number'], 'match', 'pattern' => '/^\+\d{12,15}$/'],
            [['number'], 'unique'],
            [['is_verified', 'is_blacklisted'], 'integer'],
        ];
    }
}
