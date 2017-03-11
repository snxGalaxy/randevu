<?php

namespace app\modules\systemJournal\models;

use app\components\custom\CForm;
use app\components\helpers\ArrayHelper;
use app\models\Severity;
use Yii;
use yii\db\Exception;

class SystemJournalForm extends CForm
{
    public $severity;
    public $subject;
    public $content;
    
    public function rules()
    {
        return [
            [['severity', 'subject', 'content'], 'safe'],
            [['severity', 'subject'], 'required'],
            [['severity'], 'exist', 'targetClass' => Severity::className(), 'targetAttribute' => ['severity' => 'name']],
            [['subject'], 'string', 'min' => 1, 'max' => 128],
            [['content'], 'string', 'min' => 1, 'max' => 16000],
        ];
    }
    
    public function create()
    {
        $systemJournal = new SystemJournal([
            'severity_name' => $this->severity,
            'reporter_user_name' => Yii::$app->user->identity->name,
            'subject' => $this->subject,
            'content' => $this->content,
            'is_readed' => 0,
        ]);
        
        if (!$systemJournal->save()) {
            throw new Exception('Can\'t save system journal record: ' . implode('; ', ArrayHelper::extractValues($systemJournal->getErrors())));
        }
        
        return true;
    }
}
