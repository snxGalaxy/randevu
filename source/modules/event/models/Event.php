<?php

namespace app\modules\event\models;

use app\components\custom\CActiveRecord;
use app\modules\contact\models\Address;

/**
 * @property integer $id
 * @property integer $begins_at
 * @property integer $address_id
 * @property string $created_by_user_name
 * @property integer $is_confirmed
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property Cost[] $costs
 */
class Event extends CActiveRecord
{
    public static function tableName()
    {
        return 'events';
    }
    
    public function rules()
    {
        return [
            [['begins_at', 'address_id', 'created_by_user_name', 'is_confirmed'], 'required'],
            [['address_id'], 'exists', 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'id']],
            [['created_by_user_name'], 'exists', 'targetClass' => User::className(), 'targetAttribute' => ['created_by_user_name' => 'name']],
            [['is_confirmed'], 'integer'],
            [['begins_at', 'created_at', 'updated_at', 'deleted_at'], 'date', 'format' => Yii::$app->formatter->datetimeFormat],
        ];
    }
    
    public function getCosts()
    {
        return $this->hasMany(Cost::className(), ['event_id' => 'id']);
    }
}
