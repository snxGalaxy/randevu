<?php

namespace app\modules\event\models;

use app\components\custom\CActiveRecord;
use app\models\Gender;

/**
 * @property integer $event_id
 * @property string $gender_name
 * @property float $price
 */
class Cost extends CActiveRecord
{
    public static function tableName()
    {
        return 'costs';
    }
    
    public function rules()
    {
        return [
            [['event_id', 'gender_name', 'price'], 'required'],
            [['event_id'], 'exists', 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['gender_name'], 'exists', 'targetClass' => Gender::className(), 'targetAttribute' => ['gender_name' => 'name']],
            [['price'], 'double'],
        ];
    }
}
