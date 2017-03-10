<?php

namespace app\modules\profile\models;

use app\components\custom\CActiveRecord;
use app\models\File;
use app\models\Gender;
use app\modules\contact\models\Email;
use app\modules\contact\models\Phone;
use app\modules\contact\models\Website;

/**
 * @property integer $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property integer $avatar_file_id
 * @property integer $birthday_at
 * @property string $gender_name
 * @property integer $is_blacklisted
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property File $avatarFile
 * @property Email[] $emails
 * @property Email $primaryEmail
 * @property Phone[] $phones
 * @property Phone $primaryPhone
 * @property Website[] $websites
 * @property Website $primaryWebsite
 * @property File[] $files
 */
class Profile extends CActiveRecord
{
    public static function tableName()
    {
        return 'profiles';
    }
    
    public function rules()
    {
        return [
            [['first_name', 'birthday_at', 'gender_name'], 'required'],
            [['first_name', 'middle_name', 'last_name'], 'string', 'min' => 1, 'max' => 64],
            [['avatar_file_path'], 'exists', 'targetClass' => File::className(), 'targetAttribute' => ['avatar_file_path' => 'path']],
            [['is_blacklisted'], 'integer'],
            [['gender_name'], 'exists', 'targetClass' => Gender::className(), 'targetAttribute' => ['gender_name' => 'name']],
            [['birthday_at', 'created_at', 'updated_at', 'deleted_at'], 'date', 'format' => Yii::$app->formatter->datetimeFormat],
        ];
    }
    
    public function getAvatarFile()
    {
        return $this->hasOne(File::className(), ['id' => 'avatar_file_id']);
    }
    
    public function getEmails()
    {
        return $this->hasMany(Email::className(), ['address' => 'email_address'])->viaTable('profile_email', ['profile_id' => 'id']);
    }
    
    public function getPrimaryEmail()
    {
        return $this->hasOne(Email::className(), ['address' => 'email_address'])->viaTable('profile_email', ['profile_id' => 'id', 'is_primary' => 1]);
    }
    
    public function getPhones()
    {
        return $this->hasMany(Phone::className(), ['number' => 'phone_number'])->viaTable('profile_phone', ['profile_id' => 'id']);
    }
    
    public function getPrimaryPhone()
    {
        return $this->hasOne(Phone::className(), ['number' => 'phone_number'])->viaTable('profile_phone', ['profile_id' => 'id', 'is_primary' => 1]);
    }
    
    public function getWebsites()
    {
        return $this->hasMany(Website::className(), ['address' => 'website_address'])->viaTable('profile_website', ['profile_id' => 'id']);
    }
    
    public function getPrimaryWebsite()
    {
        return $this->hasOne(Website::className(), ['address' => 'website_address'])->viaTable('profile_website', ['profile_id' => 'id', 'is_primary' => 1]);
    }
    
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['id' => 'file_id'])->viaTable('profile_file', ['profile_id' => 'id']);
    }
}
