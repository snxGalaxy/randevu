<?php

namespace app\models;

use app\components\custom\CActiveRecord;

/**
 * @property string $name
 */
class MimeType extends CActiveRecord
{
    public static function tableName()
    {
        return 'mime_types';
    }
    
    public function rules()
    {
        return [
            [['name'], 'string', 'min' => 1, 'max' => 16],
            [['name'], 'unique'],
        ];
    }
}
