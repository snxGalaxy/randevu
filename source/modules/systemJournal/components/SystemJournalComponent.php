<?php

namespace app\modules\systemJournal\components;

use app\models\Severity;
use app\modules\systemJournal\models\SystemJournal;
use app\modules\user\models\User;
use Yii;
use yii\base\Exception;

class SystemJournalComponent
{
    private $username;
    
    public function __construct()
    {
        $this->username = is_a(Yii::$app, 'yii/web/Application') ? Yii::$app->user->identity->name : User::USER_RANDEVU;
    }
    
    public static function build()
    {
        return new SystemJournalComponent();
    }
    
    private function log($severity, $subject, $content = null)
    {
        $systemJournal = new SystemJournal([
            'severity_name' => $severity,
            'reporter_user_name' => $this->username,
            'subject' => $subject,
            'content' => $content,
            'is_readed' => in_array($severity, Severity::listSeverities(Severity::SEVERITY_WARNING)) ? 0 : 1,
        ]);
        
        if (!$systemJournal->save()) {
            throw new Exception('Can\'t save SystemJournal record: ' . implode('; ', $systemJournal->getErrors()));
        }
    }
    
    public function info($subject, $content = null)
    {
        $this->log(Severity::SEVERITY_INFO, $subject, $content);
    }
    
    public function notice($subject, $content = null)
    {
        $this->log(Severity::SEVERITY_NOTICE, $subject, $content);
    }
    
    public function warning($subject, $content = null)
    {
        $this->log(Severity::SEVERITY_WARNING, $subject, $content);
    }
    
    public function error($subject, $content = null)
    {
        $this->log(Severity::SEVERITY_ERROR, $subject, $content);
    }
    
    public function fatal($subject, $content = null)
    {
        $this->log(Severity::SEVERITY_FATAL, $subject, $content);
    }
}
