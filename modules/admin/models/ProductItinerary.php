<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product_itinerary".
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $city_id
 * @property string|null $title
 * @property string|null $description
 * @property int|null $is_stay
 * @property int|null $is_breakfast
 * @property int|null $is_lunch
 * @property int|null $is_dinner
 */
class ProductItinerary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_itinerary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'city_id', 'is_stay', 'is_breakfast', 'is_lunch', 'is_dinner'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 100],
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
            'city_id' => 'City ID',
            'title' => 'Title',
            'description' => 'Description',
            'is_lunch' => 'Lunch',
            'is_dinner' => 'Dinner',
            'is_stay' => 'Stay',
        ];
    }
}
