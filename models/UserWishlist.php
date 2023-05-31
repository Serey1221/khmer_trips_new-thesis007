<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_wishlist".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $product_id
 */
class UserWishlist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_wishlist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
        ];
    }
}
