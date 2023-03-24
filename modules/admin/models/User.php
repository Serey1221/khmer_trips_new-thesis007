<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\InvalidArgumentException;
use yii\helpers\ArrayHelper;

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_INACTIVE = 2;
    const STATUS_ACTIVE = 1;

    public $created_at, $updated_at;
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public $password, $current_password, $new_password, $confirm_password, $file, $verifyCode, $bio;
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
            [['email', 'username'], 'unique'],
            [['email', 'username'], 'required', 'on' => ['update', 'profile', 'create']],
            [['role_id', 'status'], 'integer'],
            [['email', 'password_hash', 'password_reset_token', 'auth_key', 'verification_token', 'username'], 'string'],
            [['created_at', 'updated_at'], 'safe'],

            [['password', 'new_password', 'confirm_password', 'current_password'], 'string', 'min' => 6],
            [['current_password'], 'required', 'on' => ['security']],
            ['current_password', function ($attribute, $params, $validator) {
                $user = self::findOne(Yii::$app->user->identity->id);
                if (empty($this->current_password) || !$user->validatePassword($this->current_password)) {
                    $this->addError($attribute, 'Incorrect old password.');
                }
            }],
            ['new_password', 'required', 'when' => function ($model) {
                return $model->current_password != '';
            }, 'whenClient' => "function (attribute, value) {
                return $('#user-current_password').val() != '';
            }"],
            ['confirm_password', 'compare', 'compareAttribute' => 'new_password', 'skipOnEmpty' => false, 'message' => "Passwords don't match.", 'on' => ['security']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role',
            'current_password' => Yii::t('app', 'Current Password'),
            'new_password' => Yii::t('app', 'New Password'),
            'confirm_password' => Yii::t('app', 'Confirm Password'),
            'email' => 'Email',
            'created_at' => 'Created Date',
            'updated_at' => 'Updated Date',
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'status' => 'Status',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ($this->isNewRecord) {
                $this->created_at = date('Y-m-d H:i:s');
            } else {
                $this->updated_at = date('Y-m-d H:i:s');
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {

        function checkEmail($email)
        {
            $find1 = strpos($email, '@');
            $find2 = strpos($email, '.');
            return ($find1 !== false && $find2 !== false && $find2 > $find1);
        }

        if (checkEmail($username)) {
            return static::findOne(['email' => $username, 'status' => self::STATUS_ACTIVE]);
        } else {
            return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
        }
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE,
            'user_type_id' => 1
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
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
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . md5(time());
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
