<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property string|null $code
 * @property int|null $customer_id
 * @property string|null $total_amount
 * @property float|null $paid
 * @property int|null $total_item
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property int|null $status
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */

    const BOOKED = 2, CONFIRMED = 1, CANCELLED = 0, DECLINED = 10;

    public function rules()
    {
        return [
            [['customer_id', 'total_item', 'status'], 'integer'],
            [['paid', 'total_amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'string'],
            [['code'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'customer_id' => 'Customer ID',
            'total_amount' => 'Total Amount',
            'paid' => 'Paid',
            'total_item' => 'Total Item',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'status' => 'Status',
        ];
    }

    public function getBalance_amount()
    {
        return floatval($this->total_amount - $this->paid);
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }
    public function getPassenger()
    {
        return $this->hasOne(BookingPassenger::class, ['booking_id' => 'id']);
    }
    public function getItems()
    {
        return $this->hasMany(BookingItem::class, ['booking_id' => 'id']);
    }

    public function getBookingStatus()
    {
        switch ($this->status) {
            case self::BOOKED:
                return "<span class='badge badge-success'>On Request</span>";
                break;

            case self::CONFIRMED:
                return "<span class='badge badge-success'>Confirmed</span>";
                break;

            case self::CANCELLED:
                return "<del>Cancelled</del>";
                break;

            case self::DECLINED:
                return "<del>Declined</del>";
                break;
        }
    }

    public function getPaymentStatus()
    {
        if ($this->paid > 0 && $this->paid < $this->total_amount) {
            return "<span class='badge badge-success'>Partial Paid</span>";
        }
        if ($this->paid == 0) {
            return "<span class='badge badge-warning'>Unpaid</span>";
        }
        if ($this->paid == $this->total_amount) {
            return "<span class='badge badge-success'>Full Paid</span>";
        }
    }
}
