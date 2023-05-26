<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product_city".
 *
 * @property int $id
 * @property int $product_id
 * @property int $city_id
 */
class ProductCity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'city_id'], 'required'],
            [['product_id', 'city_id'], 'integer'],
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
        ];
    }
}
