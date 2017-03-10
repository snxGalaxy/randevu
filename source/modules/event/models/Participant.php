<?php

namespace app\modules\event\models;

use app\components\custom\CActiveRecord;
use app\modules\profile\models\Profile;
use Yii;

/**
 * @property integer $event_id
 * @property integer $profile_id
 * @property integer $participant_number
 * @property float $prepayment
 * @property float $discount
 * @property integer $is_paid
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property Participant[] $sympathies
 */
class Participant extends CActiveRecord
{
    public static function tableName()
    {
        return 'participants';
    }
    
    public function rules()
    {
        return [
            [['event_id', 'profile_id', 'participant_number', 'prepayment', 'discount', 'is_paid'], 'required'],
            [['event_id'], 'exists', 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['profile_id'], 'exists', 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
            [['prepayment', 'discount'], 'double'],
            [['participant_number', 'is_paid'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'date', 'format' => Yii::$app->formatter->datetimeFormat],
        ];
    }
    
    public function getSympathies()
    {
        return $this->hasMany(Sympathy::className(), ['participant_event_id' => 'event_id', 'participant_profile_id' => 'profile_id']);
    }
}
