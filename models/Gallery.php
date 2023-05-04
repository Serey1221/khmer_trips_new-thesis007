<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cms_home_banner".
 *
 * @property int $id
 * @property int|null $img_id
 * @property string|null $sub_title
 * @property string|null $title
 * @property string|null $button_text
 * @property string|null $button_url
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['title', 'img_url'], 'required'],
            ['img_url', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['admin']],
            [['sub_title', 'title', 'description'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \mohorev\file\UploadImageBehavior::class,
                'attribute' => 'img_url',
                'scenarios' => ['admin'],
                // 'placeholder' => '@web/img/placeholder-2.png',
                'placeholder' => '@app/web/img/placeholder.png',
                'path' => '@webroot/upload/gallery/{id}',
                'url' => '@web/upload/gallery/{id}',
                'thumbs' => [
                    'thumb' => ['width' => 400, 'quality' => 90],
                ],
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img_id' => 'Img ID',
            'sub_title' => 'Sub Title',
            'title' => 'Title',
        ];
    }
    // public static function find()
    // {
    //     return parent::find()->where(['city.name' => 1]);
    // }
}
