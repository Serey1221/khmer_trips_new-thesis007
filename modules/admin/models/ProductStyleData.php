<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product_style_data".
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $style_id
 */
class ProductStyleData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_style_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'style_id'], 'integer'],
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
            'style_id' => 'Style ID',
        ];
    }
}
