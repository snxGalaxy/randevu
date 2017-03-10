<?php

namespace app\models;

use app\components\custom\CActiveRecord;
use Yii;

/**
 * @property integer $id
 * @property string $path
 * @property string $mime_type_name
 * @property string $display_name
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class File extends CActiveRecord
{
    public static function tableName()
    {
        return 'files';
    }
    
    public function rules()
    {
        return [
            [['path', 'mime_type_name', 'display_name'], 'required'],
            [['path'], 'string', 'min' => 5, 'max' => 1024],
            [['path'], 'unique'],
            [['mime_type_name'], 'exists', 'targetClass' => MimeType::className(), 'targetProperty' => ['mime_type_name' => 'name']],
            [['display_name'], 'string', 'min' => 5, 'max' => 64],
            [['created_at', 'updated_at', 'deleted_at'], 'date', 'format' => Yii::$app->formatter->datetimeFormat],
        ];
    }
}
