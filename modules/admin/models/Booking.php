<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $from_date
 * @property string|null $to_date
 * @property string|null $total_amount
 * @property float|null $paid
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
            [['id'], 'required'],
            [['id', 'product_id', 'status'], 'integer'],
            [['from_date', 'to_date', 'created_at', 'updated_at'], 'safe'],
            [['paid'], 'number'],
            [['created_by', 'updated_by'], 'string'],
            [['total_amount'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'total_amount' => 'Total Amount',
            'paid' => 'Paid',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'status' => 'Status',
        ];
    }
    public function getStatusTemp()
    {
        if ($this->status == 1) {
            return '<span class="badge badge-pill badge-info">Completed</span>';
        } else {
            return '<span class="badge badge-pill badge-danger">Cancelled</span>';
        }
    }
}
