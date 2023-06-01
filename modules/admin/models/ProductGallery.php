<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product_gallery".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $img_url
 * @property string|null $title
 * @property string|null $description
 */
class ProductGallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => \mohorev\file\UploadImageBehavior::class,
                'attribute' => 'img_url',
                'scenarios' => ['admin'],
                // 'placeholder' => '@web/img/placeholder-2.png',
                'placeholder' => '@app/web/img/placeholder.png',
                'path' => '@webroot/upload/product-gallery/{id}',
                'url' => '@web/upload/product-gallery/{id}',
                'thumbs' => [
                    'thumb' => ['width' => 400, 'quality' => 90],
                ],
            ],
        ];
    }
    public function rules()
    {
        return [
            [['title', 'img_url'], 'required'],
            ['img_url', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['admin']],
            [['product_id'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 50],
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
            'img_url' => 'Img Url',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }
}
