<?php

namespace app\models;

use Exception;
use Yii;

/**
 * This is the model class for table "booking_activity".
 *
 * @property int $id
 * @property int|null $booking_id
 * @property int|null $payment_id
 * @property string|null $type
 * @property string|null $created_at
 * @property int|null $created_by
 */
class BookingActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TYPE_CREATE = 'make booking';
    const TYPE_CANCEL = 'cancelled booking';
    const TYPE_CONFIRM = 'confirmed booking';
    const TYPE_DECLINE = 'declined booking';
    const TYPE_PAYMENT = 'payment booking';
    const TYPE_ADD_PASSENGER = 'add new passenger';
    const TYPE_UPDATE_PASSENGER = 'update passenger';
    const TYPE_DELETE_PASSENGER = 'delete passenger';
    const TYPE_CHANGE_STATUS = 'update booking status';
    const TYPE_MODIFY = 'modify booking';

    public static function tableName()
    {
        return 'booking_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['booking_id', 'payment_id', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['type'], 'string', 'max' => 30],
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
            'payment_id' => 'Payment ID',
            'type' => 'Type',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
    public function getPayment()
    {
        return $this->hasOne(BookingPayment::class, ['id' => 'payment_id']);
    }

    public function getUserAction()
    {
        return $this->user->user_type == 1 ? 'Admin' : 'You';
    }

    public function getTypeAsText()
    {
        switch ($this->type) {
            case self::TYPE_CREATE:
                return 'Booking created';
                break;
            case self::TYPE_CANCEL:
                return 'Booking cancelled';
                break;
            case self::TYPE_DECLINE:
                return 'Booking declined';
                break;
            case self::TYPE_CONFIRM:
                return 'Booking confirmed';
                break;
            case self::TYPE_PAYMENT:
                $via = !empty($this->payment->method) ? ' via ' . $this->payment->method->name : '';
                return 'Booking payment' . $via;
                break;
        }
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public static function addActivity($data)
    {
        $type = isset($data['type']) ? $data['type'] : null;
        $booking_id = isset($data['booking_id']) ? $data['booking_id'] : null;
        $payment_id = isset($data['payment_id']) ? $data['payment_id'] : null;

        $activityTransactionException = Yii::$app->db->beginTransaction();
        try {
            $activity = new BookingActivity();
            $activity->booking_id = $booking_id;
            $activity->payment_id = $payment_id;
            $activity->type = $type;
            $activity->created_at = date("Y-m-d H:i:s");
            $activity->created_by = Yii::$app->user->identity->id;
            if (!$activity->save()) throw new Exception(print_r($activity->getErrors()));

            $activityTransactionException->commit();
        } catch (Exception $ex) {
            Yii::$app->session->setFlash('warning', $ex->getMessage());
            $activityTransactionException->rollBack();
        }
    }
}
