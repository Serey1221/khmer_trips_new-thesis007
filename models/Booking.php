<?php

namespace app\models;

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

    public function getItems()
    {
        return $this->hasMany(BookingItem::class, ['booking_id' => 'id']);
    }

    public function getBookingStatus()
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

    public function getPassenger()
    {
        return $this->hasOne(BookingPassenger::class, ['booking_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {

                $length = 16;
                $result = false;
                $code = '';
                do {
                    $code = substr(str_shuffle(str_repeat($x = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
                    $has = self::findOne(['code' => $code]);
                    if (empty($has)) $result = true;
                } while (!$result);
                $this->code = $code;
                $this->status = 0;
                $this->created_at = date('Y-m-d H:i:s');
                $this->created_by = Yii::$app->user->identity->id;
            } else {
                $this->updated_at = date('Y-m-d H:i:s');
                $this->updated_by = Yii::$app->user->identity->id;
            }
            return true;
        } else {
            return false;
        }
    }
}
