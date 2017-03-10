<?php

namespace app\models;

use app\components\custom\CActiveRecord;
use app\components\helpers\ArrayHelper;

/**
 * @property string $name
 */
class Severity extends CActiveRecord
{
    const SEVERITY_INFO = 'Info';
    const SEVERITY_NOTICE = 'Notice';
    const SEVERITY_WARNING = 'Warning';
    const SEVERITY_ERROR = 'Error';
    const SEVERITY_FATAL = 'Fatal';
    
    public static function tableName()
    {
        return 'severity';
    }
    
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'min' => 1, 'max' => 16],
        ];
    }
    
    public static function listSeverities($severity = self::SEVERITY_INFO, $isHigher = true)
    {
        return ArrayHelper::divide([
            self::SEVERITY_INFO,
            self::SEVERITY_NOTICE,
            self::SEVERITY_WARNING,
            self::SEVERITY_ERROR,
            self::SEVERITY_FATAL,
        ], $severity, $isHigher);
    }
}
