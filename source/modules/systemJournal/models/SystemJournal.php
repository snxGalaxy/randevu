<?php

namespace app\modules\systemJournal\models;

use app\components\custom\CActiveRecord;
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
    
    public function rules()
    {
        return [
            [['severity_name', 'reporter_user_name', 'content', 'is_readed'], 'required'],
            [['severity_name'], 'exists', 'targetClass' => Severity::className(), 'targetAttribute' => ['severity_name' => 'name']],
            [['reporter_user_name'], 'exists', 'targetClass' => User::className(), 'targetAttribute' => ['reporter_user_name' => 'name']],
            [['subject'], 'string', 'min' => 1, 'max' => 128],
            [['content'], 'string', 'min' => 1, 'max' => 16000],
            [['is_readed'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'date', 'format' => Yii::$app->formatter->datetimeFormat],
        ];
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['reporter_user_name' => 'name']);
    }
}
