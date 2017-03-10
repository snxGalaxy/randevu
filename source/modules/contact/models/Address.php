<?php

namespace app\modules\contact\models;

use app\components\custom\CActiveRecord;

/**
 * @property integer $id
 * @property string $street
 * @property string $city_name
 * @property string $country_name
 */
class Address extends CActiveRecord
{
    public static function tableName()
    {
        return 'addresses';
    }
    
    public function rules()
    {
        return [
            [['street', 'city_name', 'country_name'], 'required'],
            [['street'], 'string', 'min' => 1, 'max' => 64],
            [['city_name'], 'exists', 'targetClass' => City::className(), 'targetAttribute' => ['city_name' => 'name']],
            [['country_name'], 'exists', 'targetClass' => Country::className(), 'targetAttribute' => ['country_name' => 'name']],
        ];
    }
}
