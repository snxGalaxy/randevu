<?php

namespace app\commands;

use app\components\custom\CConsoleController;
use app\components\helpers\DbHelper;
use app\components\helpers\FileHelper;
use app\models\Gender;
use app\models\Severity;
use app\modules\contact\models\Email;
use app\modules\user\models\Role;
use app\modules\user\models\User;
use Yii;

class DefaultDataController extends CConsoleController
{
    public function actionReset()
    {
        $this->stdout('Resetting constants');
        DbHelper::foreignKeyChecks(false);
        DbHelper::batchInsert(Role::tableName(), 'name', Role::listRoles());
        DbHelper::batchInsert(Gender::tableName(), 'name', Gender::listGenders());
        DbHelper::batchInsert(Severity::tableName(), 'name', Severity::listSeverities());
        $this->stdout('Resetting users');
        $rootEmailAddress = Email::EMAIL_ROOT;
        DbHelper::insert(Email::tableName(), [
            'address' => $rootEmailAddress,
            'is_verified' => 1,
            'is_blacklisted' => 0,
        ]);
        DbHelper::insert(User::tableName(), [
            'name' => User::USER_RANDEVU,
            'password' => User::hashPassword(User::USER_RANDEVU),
            'role_name' => Role::ROLE_ROOT,
            'email_address' => $rootEmailAddress,
            'is_active' => 1,
        ]);
        DbHelper::foreignKeyChecks(true);
        $this->stdout('Resetting directories');
        FileHelper::createDirectory(Yii::getAlias('@shared'));
        Yii::$app->systemJournal->notice('Database default values are resetted');
        
        return self::EXIT_CODE_NORMAL;
    }
}
