<?php

namespace app\modules\contact\models;

use app\components\custom\CActiveRecord;

/**
 * @property string $name
 */
class City extends CActiveRecord
{
    public static function tableName()
    {
        return 'cities';
    }
    
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
            [['name'], 'string', 'min' => 1, 'max' => 64],
        ];
    }
}
