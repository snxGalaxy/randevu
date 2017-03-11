<?php

namespace app\modules\systemJournal\models;

use app\components\custom\CActiveRecord;
use app\components\helpers\TimeHelper;
use app\models\Severity;
use app\modules\user\models\User;
use Yii;

/**
 * @property integer $id
 * @property string $severity_name
 * @property string $reporter_user_name
 * @property string $subject
 * @property string $content
 * @property integer $is_readed
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property User $user
 */
class SystemJournal extends CActiveRecord
{
    public static function tableName()
    {
        return 'system_journal';
    }
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/systemJournal', 'ID'),
            'severity_name' => Yii::t('app/systemJournal', 'Severity'),
            'reporter_user_name' => Yii::t('app/systemJournal', 'Reporter User'),
            'subject' => Yii::t('app/systemJournal', 'Subject'),
            'content' => Yii::t('app/systemJournal', 'Content'),
            'is_readed' => Yii::t('app/systemJournal', 'Readed'),
            'created_at' => Yii::t('app/systemJournal', 'Reported At'),
            'updated_at' => Yii::t('app/systemJournal', 'Updated At'),
            'deleted_at' => Yii::t('app/systemJournal', 'Deleted At'),
        ];
    }
    
    public function rules()
    {
        return [
            [['severity_name', 'reporter_user_name', 'subject', 'is_readed'], 'required'],
            [['severity_name'], 'exist', 'targetClass' => Severity::className(), 'targetAttribute' => ['severity_name' => 'name']],
            [['reporter_user_name'], 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['reporter_user_name' => 'name']],
            [['subject'], 'string', 'min' => 1, 'max' => 128],
            [['content'], 'string', 'min' => 1, 'max' => 16000],
            [['is_readed'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'date', 'format' => TimeHelper::FORMAT_TIMESTAMP],
        ];
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['reporter_user_name' => 'name']);
    }
}
