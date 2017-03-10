<?php

namespace app\modules\user\models;

use app\components\custom\CActiveRecord;
use app\components\helpers\ArrayHelper;

/**
 * @property string $name
 */
class Role extends CActiveRecord
{
    const ROLE_ROOT = 'Root';
    const ROLE_ADMIN = 'Administrator';
    const ROLE_USER = 'User';
    
    public static function tableName()
    {
        return 'roles';
    }
    
    public function rules()
    {
        return [
            [['name'], 'string', 'min' => 3, 'max' => 16],
            [['name'], 'unique'],
        ];
    }
    
    public static function listRoles($role = self::ROLE_USER, $isHigher = true)
    {
        return ArrayHelper::divide([
            self::ROLE_USER,
            self::ROLE_ADMIN,
            self::ROLE_ROOT,
        ], $role, $isHigher);
    }
}
