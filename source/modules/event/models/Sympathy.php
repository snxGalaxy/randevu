<?php

namespace app\modules\event\models;

use app\components\custom\CActiveRecord;

/**
 * @property integer $participant_event_id
 * @property integer $participant_profile_id
 * @property integer $target_participant_event_id
 * @property integer $target_participant_profile_id
 * @property integer $is_positive
 * @property Participant $targetParticipant
 */
class Sympathy extends CActiveRecord
{
    public static function tableName()
    {
        return 'sympathies';
    }
    
    public function rules()
    {
        return [
            [['participant_event_id', 'participant_profile_id', 'target_participant_event_id', 'target_participant_profile_id', 'is_positive'], 'required'],
            [['participant_profile_id', 'target_participant_profile_id'], 'exists', 'targetClass' => Participant::className(), 'targetAttribute' => ['participant_profile_id' => 'event_id']],
            [['participant_event_id', 'target_participant_event_id'], 'exists', 'targetClass' => Participant::className(), 'targetAttribute' => ['participant_event_id' => 'event_id']],
            [['is_positive'], 'integer'],
        ];
    }
    
    public function getTargetParticipant()
    {
        return $this->hasOne(Participant::className(), ['event_id' => 'target_participant_event_id', 'profile_id' => 'target_participant_profile_id']);
    }
}
