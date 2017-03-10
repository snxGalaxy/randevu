<?php

namespace app\modules\mailbox\models;

use app\components\custom\CActiveRecord;

/**
 * @property string $name
 */
class Category extends CActiveRecord
{
    public static function tableName()
    {
        return 'categories';
    }
    
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'min' => 1, 'max' => 16],
        ];
    }
}
