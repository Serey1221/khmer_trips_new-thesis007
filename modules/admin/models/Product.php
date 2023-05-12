<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $namekh
 * @property int|null $tourday
 * @property int|null $tournight
 * @property int|null $tourhour
 * @property int|null $tourmin
 * @property string|null $overview
 * @property string|null $overviewkh
 * @property string|null $highlight
 * @property string|null $highlight_kh
 * @property string|null $pick_up
 * @property string|null $pick_up_kh
 * @property string|null $drop_off
 * @property string|null $drop_off_kh
 * @property string|null $price_include_kh
 * @property string|null $price_exclude_kh
 * @property int|null $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property float|null $rate
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['img_url', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['admin']],
            [['tourday', 'tournight', 'tourhour', 'tourmin', 'status', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['overview', 'overviewkh', 'highlight', 'highlight_kh'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['rate'], 'number'],
            [['name', 'namekh', 'pick_up', 'pick_up_kh', 'drop_off', 'drop_off_kh', 'price_include_kh', 'price_exclude_kh'], 'string', 'max' => 255],
        ];
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
                'placeholder' => '@webroot/img/placeholder-3.png',
                'path' => '@webroot/upload/city/{id}',
                'url' => '@web/upload/city/{id}',
                'thumbs' => [
                    'thumb' => ['width' => 300, 'height' => 300],
                ],
            ],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'namekh' => 'Namekh',
            'tourday' => 'Tourday',
            'tournight' => 'Tournight',
            'tourhour' => 'Tourhour',
            'tourmin' => 'Tourmin',
            'overview' => 'Overview',
            'overviewkh' => 'Overviewkh',
            'highlight' => 'Highlight',
            'highlight_kh' => 'Highlight Kh',
            'pick_up' => 'Pick Up',
            'pick_up_kh' => 'Pick Up Kh',
            'drop_off' => 'Drop Off',
            'drop_off_kh' => 'Drop Off Kh',
            'price_include_kh' => 'Price Include Kh',
            'price_exclude_kh' => 'Price Exclude Kh',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'rate' => 'Rate',
            'img_url' => 'Img Url',
        ];
    }
    // public function beforeSave($insert)
    // {
    //     if (parent::beforeSave($insert)) {
    //         $this->slug = Yii::$app->formater->slugify($this->slug);
    //         if ($this->isNewRecord) {
    //             $this->created_at = date('Y-m-d H:i:s');
    //             $this->created_by = Yii::$app->user->identity->id;
    //         } else {
    //             $this->updated_at = date('Y-m-d H:i:s');
    //             $this->updated_by = Yii::$app->user->identity->id;
    //         }
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    public function getStatusTemp()
    {
        if ($this->status == 1) {
            return '<span class="badge badge-pill badge-info">Publish</span>';
        } else {
            return '<span class="badge badge-pill badge-danger">Inactive</span>';
        }
    }
}
