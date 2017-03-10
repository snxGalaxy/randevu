<?php

namespace app\modules\event\models;

use app\components\custom\CActiveRecord;
use app\modules\contact\models\Email;
use app\modules\mailbox\models\Letter;
use app\modules\profile\models\Profile;

/**
 * @property integer $event_id
 * @property integer $profile_id
 * @property string $used_email_address
 * @property integer $letter_id
 */
class Invitation extends CActiveRecord
{
    public static function tableName()
    {
        return 'invitatons';
    }
    
    public function rules()
    {
        return [
            [['event_id'], 'exists', 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['profile_id'], 'exists', 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
            [['used_email_address'], 'exists', 'targetClass' => Email::className(), 'targetAttribute' => ['used_email_address' => 'address']],
            [['letter_id'], 'exists', 'targetClass' => Letter::className(), 'targetAttribute' => ['letter_id' => 'id']],
        ];
    }
}
