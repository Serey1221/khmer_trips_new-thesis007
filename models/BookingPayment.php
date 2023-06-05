<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking_payment".
 *
 * @property int $id
 * @property int|null $booking_id
 * @property float|null $amount
 * @property string|null $date
 * @property int|null $method_id
 * @property string|null $remark
 * @property int|null $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 */
class BookingPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['booking_id', 'method_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['amount'], 'number'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'booking_id' => 'Booking ID',
            'amount' => 'Amount',
            'date' => 'Date',
            'method_id' => 'Method ID',
            'remark' => 'Remark',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getMethod()
    {
        return $this->hasOne(PaymentMethod::class, ['id' => 'method_id']);
    }
}
