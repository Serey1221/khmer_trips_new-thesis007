<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $name_kh
 * @property string|null $description
 * @property int|null $country_id
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['img_url', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['admin']],
            [['country_id', 'status',], 'integer'],
            [['name', 'name_kh', 'description'], 'required', 'on' => ['admin']],
            [['name', 'name_kh', 'description'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \mohorev\file\UploadImageBehavior::class,
                'attribute' => 'img_url',
                'scenarios' => ['admin'],
                'placeholder' => '@webroot/img/placeholder-3.png',
                'path' => '@webroot/upload/city/{id}',
                'url' => '@web/upload/city/{id}',
                'thumbs' => [
                    'thumb' => ['width' => 300, 'height' => 300],
                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'name_kh' => 'Name Kh',
            'description' => 'Description',
            'country_id' => 'Country ID',
            'img_url' => 'Img Url',
            'status' => 'Status',
        ];
    }
    public function getStatusTemp()
    {
        if ($this->status == 1) {
            return '<span class="badge badge-pill badge-info">Publish</span>';
        } else {
            return '<span class="badge badge-pill badge-danger">Inactive</span>';
        }
    }
}
