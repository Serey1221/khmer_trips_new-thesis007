<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $select_date
 * @property int|null $total_guest
 * @property float|null $price
 * @property float|null $total_price
 * @property int|null $created_by
 * @property string|null $created_at
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'total_guest', 'created_by'], 'integer'],
            [['select_date', 'created_at'], 'safe'],
            [['price', 'total_price'], 'number'],
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
            'select_date' => 'Select Date',
            'total_guest' => 'Total Guest',
            'price' => 'Price',
            'total_price' => 'Total Price',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
