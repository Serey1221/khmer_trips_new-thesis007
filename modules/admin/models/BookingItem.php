<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "booking_item".
 *
 * @property int $id
 * @property string|null $code
 * @property int|null $booking_id
 * @property int|null $product_id
 * @property string|null $departure_date
 * @property string|null $return_date
 * @property int|null $total_guest
 * @property float|null $price
 * @property float|null $total_price
 */
class BookingItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['booking_id', 'product_id', 'total_guest'], 'integer'],
            [['departure_date', 'return_date'], 'safe'],
            [['price', 'total_price'], 'number'],
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
            'booking_id' => 'Booking ID',
            'product_id' => 'Product ID',
            'departure_date' => 'Departure Date',
            'return_date' => 'Return Date',
            'total_guest' => 'Total Guest',
            'price' => 'Price',
            'total_price' => 'Total Price',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
