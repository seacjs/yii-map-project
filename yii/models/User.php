<?php

namespace app\models;
use app\models\Title;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;

use yii\db\ActiveRecord;
use yii\db\Connection;

use yii\db\Query;
use yii\helpers\ArrayHelper;
use app\models\BaseActiveRecord;
//use karpoff\icrop\CropImageUploadBehavior;
//use app\models\query\UserQuery;
use yii\helpers\VarDumper;


class User extends ActiveRecord implements \yii\web\IdentityInterface
{


    public function getHouses() {

    }

    public function getHouse() {

    }


    const STATUS_BLOCKED = 0;
    const STATUS_NEW = 1;
    const STATUS_ACTIVE = 10;

    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
             TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => self::className(), 'message' => Yii::t('app', 'ERROR_USERNAME_EXISTS')],
            ['username', 'string', 'min' => 3, 'max' => 255],
            ['name', 'string', 'min' => 3, 'max' => 255],

            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className(), 'message' => Yii::t('app', 'ERROR_EMAIL_EXISTS')],
            ['email', 'string', 'max' => 255],

            [['status'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_NEW],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],

        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => Yii::t('app', 'USER_CREATED'),
            'updated_at' => Yii::t('app', 'USER_UPDATED'),
            'visit_at' => Yii::t('app','USER_VISIT'),
            'username' => Yii::t('app', 'USER_USERNAME'),
            'email' => Yii::t('app', 'USER_EMAIL'),
            'status' => Yii::t('app', 'USER_STATUS'),
        ];
    }

    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';
    const SCENARIO_CHANGE_PASSWORD = 'change_password';
    const SCENARIO_FAST_SETTINGS = 'fast_settings';
    const SCENARIO_SETTINGS = 'settings';

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_FAST_SETTINGS] = ['search_team','ready_to_tournament'];
        $scenarios[self::SCENARIO_SETTINGS] = ['country_id','description','name','android_platform','ios_platform'];
        $scenarios[self::SCENARIO_CHANGE_PASSWORD] = ['password','new_password','new_password_repeat'];
        $scenarios[self::SCENARIO_LOGIN] = ['username', 'password'];
        $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }

    public $new_password;
    public $new_password_repeat;

    public function init()
    {
        parent::init();
        $this->trigger(self::EVENT_INIT);
    }

    protected function afterLogin($identity, $cookieBased, $duration)
    {
        $this->trigger(self::EVENT_INIT, new UserEvent([
            'identity' => $identity,
            'cookieBased' => $cookieBased,
            'duration' => $duration,
        ]));
    }

//    public function getIsOnline() {
//        if(($this->online + Yii::$app->params['online_time']) >= time()) {
//            return true;
//        } else return false;
//    }
//
//    public function setOnline() {
//        $user = User::findOne($this->id);
//        $user->online = time();
//        $user->save();
//    }

    /**
     * @inheritdoc
     */
    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    /**
     * @inheritdoc
     */
    public static function getStatusesArray()
    {
        return [
            self::STATUS_BLOCKED => Yii::t('app', 'USER_STATUS_BLOCKED'),
            self::STATUS_NEW => Yii::t('app', 'USER_STATUS_NEW'),
            self::STATUS_ACTIVE => Yii::t('app', 'USER_STATUS_ACTIVE'),

        ];
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken is not implemented.');
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    /**
     * @param string $email_confirm_token
     * @return static|null
     */
    public static function findByEmailConfirmToken($email_confirm_token)
    {
        return static::findOne(['email_confirm_token' => $email_confirm_token, 'status' => self::STATUS_NEW]);
    }
    /**
     * Generates email confirmation token
     */
    public function generateEmailConfirmToken()
    {
        $this->email_confirm_token = Yii::$app->security->generateRandomString();
    }
    /**
     * Removes email confirmation token
     */
    public function removeEmailConfirmToken()
    {
        $this->email_confirm_token = null;
    }
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @param integer $timeout
     * @return static|null
     */
    public static function findByPasswordResetToken($token, $timeout)
    {
        if (!static::isPasswordResetTokenValid($token, $timeout)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @param integer $timeout
     * @return bool
     */
    public static function isPasswordResetTokenValid($token, $timeout)
    {
        if (empty($token)) {
            return false;
        }
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $timeout >= time();
    }
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

}
