<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking_passenger".
 *
 * @property int $id
 * @property int|null $is_lead
 * @property int|null $booking_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $phone_number
 * @property string|null $email
 * @property int|null $age
 * @property string|null $created_at
 * @property int|null $created_by
 */
class BookingPassenger extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking_passenger';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'phone_number'], 'required'],
            [['is_lead', 'booking_id', 'age', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            ['email', 'email'],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['phone_number'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_lead' => 'Is Lead',
            'booking_id' => 'Booking ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'phone_number' => 'Phone Number',
            'email' => 'Email',
            'age' => 'Age',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->created_at = date('Y-m-d H:i:s');
                $this->created_by = Yii::$app->user->identity->id;
            }
            return true;
        } else {
            return false;
        }
    }
}
