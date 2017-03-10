<?php

namespace app\modules\mailbox\models;

use app\components\custom\CActiveRecord;
use app\modules\contact\models\Email;
use app\modules\user\models\User;
use Yii;

/**
 * @property integer $id
 * @property string $subject
 * @property string $content
 * @property integer $is_ingoing
 * @property string $created_by_user_name
 * @property string $category_name
 * @property string $message_id
 * @property string $in_reply_to
 * @property integer $is_readed
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property Email[] $recipients
 * @property Email $sender
 */
class Letter extends CActiveRecord
{
    public static function tableName()
    {
        return 'letters';
    }
    
    public function rules()
    {
        return[
            [['content', 'is_ingping', 'created_by_user_name', 'message_id', 'is_readed'], 'required'],
            [['subject'], 'string', 'min' => 1, 'max' => 128],
            [['content'], 'string', 'min' => 1, 'max' => 16000],
            [['created_by_user_name'], 'exists', 'targetClass' => User::className(), 'targetAttribute' => ['created_by_user_name' => 'name']],
            [['category_name'], 'exists', 'targetClass' => Category::className(), 'targetAttribute' => ['category_name' => 'name']],
            [['message_id', 'in_reply_to'], 'string', 'min' => 1, 'max' => 128],
            [['is_ingoing', 'is_readed'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'date', 'format' => Yii::$app->formatter->datetimeFormat],
        ];
    }
    
    public function getRecipients()
    {
        return $this->hasMany(Email::className(), ['address' => 'email_address'])->viaTable('letter_email', ['letter_id' => 'id', 'is_sender' => 0]);
    }
    
    public function getSender()
    {
        return $this->hasOne(Email::className(), ['address' => 'email_address'])->viaTable('letter_email', ['lettter_id' => 'id', 'is_sender' => 1]);
    }
}
