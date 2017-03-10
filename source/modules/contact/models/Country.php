<?php

namespace app\modules\contact\models;

use app\components\custom\CActiveRecord;

/**
 * @property string $name
 */
class Country extends CActiveRecord
{
    public static function tableName()
    {
        return 'countries';
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
