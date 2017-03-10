<?php

namespace app\models;

use app\components\custom\CActiveRecord;

/**
 * @property string $name
 */
class Gender extends CActiveRecord
{
    const GENDER_MALE = 'Male';
    const GENDER_FEMALE = 'Female';
    
    public static function tableName()
    {
        return 'genders';
    }
    
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'min' => 1, 'max' => 16],
        ];
    }
    
    public static function listGenders()
    {
        return [self::GENDER_MALE, self::GENDER_FEMALE];
    }
}
