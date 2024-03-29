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
 * @property float|null $rating
 * @property string|null $type
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
    const ACTIVITY = 'activity';
    const TOUR = 'tour';

    /**
     * {@inheritdoc}
     */
    public $city_id, $style_id;
    public function rules()
    {
        return [
            [['tourhour', 'tourmin', 'city_id', 'style_id'], 'required', 'on' => self::ACTIVITY],
            [['tourday', 'tournight', 'city_id', 'style_id'], 'required', 'on' => self::TOUR],
            [['tourday', 'tournight'], 'integer', 'min' => 1, 'on' => self::TOUR],
            [['name', 'namekh'], 'required'],

            [['city_id', 'style_id'], 'safe'],

            ['img_url', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['admin']],
            [['tourhour', 'tourmin', 'status', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['overview', 'overviewkh', 'highlight', 'highlight_kh', 'price_include_kh', 'price_exclude_kh', 'price_include', 'price_exclude'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['rating'], 'number'],

            [['rate'], 'number', 'min' => 1],
            [['rate'], 'required'],

            [['type', 'code'], 'string', 'max' => 20],
            [['name', 'namekh', 'pick_up', 'pick_up_kh', 'drop_off', 'drop_off_kh'], 'string', 'max' => 255],
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
                'scenarios' => ['admin', self::ACTIVITY, self::TOUR],
                'placeholder' => '@webroot/img/placeholder-3.png',
                'path' => '@webroot/upload/product/{id}',
                'url' => '@web/upload/product/{id}',
                // 'thumbs' => [
                //     'thumb' => ['width' => 300, 'height' => 300],
                // ],
            ],
        ];
    }
    public function attributeLabels()
    {
        return [
            'code' => 'Tour Code',
            'city_id' => 'City',
            'style_id' => 'Product Style',
            'id' => 'ID',
            'name' => 'Name',
            'namekh' => 'Name in Khmer',
            'tourday' => 'Duration Day(s)',
            'tournight' => 'Duration Night(s)',
            'tourhour' => 'Duration Hour(s)',
            'tourmin' => 'Duration Minute(s)',
            'overview' => 'Overview',
            'overviewkh' => 'Overview khmer',
            'highlight' => 'Highlight',
            'highlight_kh' => 'Highlight Khmer',
            'pick_up' => 'Pick Up',
            'pick_up_kh' => 'Pick Up Khmer',
            'drop_off' => 'Drop Off',
            'drop_off_kh' => 'Drop Off Khmer',
            'price_include_kh' => 'Price Include Khmer',
            'price_exclude_kh' => 'Price Exclude Khmer',
            'price_include' => 'Price Include',
            'price_exclude' => 'Price Exclude',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'rating' => 'Rating',
            'img_url' => 'Image',
        ];
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {

                if ($this->isTour()) {
                    $this->tourhour = 0;
                    $this->tourmin = 0;
                }
                if ($this->isActivity()) {
                    $this->tourday = 0;
                    $this->tournight = 0;
                }
                $this->created_at = date('Y-m-d H:i:s');
                $this->created_by = Yii::$app->user->identity->id;
            } else {
                $this->updated_at = date('Y-m-d H:i:s');
                $this->updated_by = Yii::$app->user->identity->id;
            }
            return true;
        } else {
            return false;
        }
    }

    public function getDuration()
    {
        if ($this->type == 'activity') {
            $tourhour = $this->tourhour . ' hour(s)';
            if ($this->tourmin > 0) {
                $tourhour .= ' ' . $this->tourmin . ' minute(s)';
            }
            return $tourhour;
        } else {
            return $this->tourday . ' day(s) ' . $this->tournight . ' night(s)';
        }
    }

    public function getLocation()
    {
        if (!empty($this->cities)) {
            $str = '';
            foreach ($this->cities as $key => $value) {
                $str .= $value->city->name . ", ";
            }
            return rtrim($str, ', ');
        }
        return '';
    }

    public function getStatusTemp()
    {
        if ($this->status == 1) {
            return '<span class="badge badge-pill badge-info">Publish</span>';
        } else {
            return '<span class="badge badge-pill badge-danger">Inactive</span>';
        }
    }

    public function getCities()
    {
        return $this->hasMany(ProductCity::class, ['product_id' => 'id']);
    }


    public function getStyles()
    {
        return $this->hasMany(ProductStyleData::class, ['product_id' => 'id']);
    }

    public function isTour()
    {
        return $this->type == self::TOUR ? true : false;
    }
    public function isActivity()
    {
        return $this->type == self::ACTIVITY ? true : false;
    }
}
