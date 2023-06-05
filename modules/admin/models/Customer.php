<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $name
 * @property string|null $gender
 * @property string|null $date_of_birth
 * @property string|null $address
 * @property string|null $phone_number
 * @property string|null $email
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['date_of_birth'], 'safe'],
            [['name', 'gender'], 'string', 'max' => 100],
            [['address', 'email'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'address' => 'Address',
            'phone_number' => 'Phone Number',
            'email' => 'Email',
        ];
    }
    public function getFullName()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
