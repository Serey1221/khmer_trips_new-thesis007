<?php

namespace app\models;

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
    public function rules()
    {
        return [
            [['tourhour', 'tourmin'], 'required', 'on' => self::ACTIVITY],
            [['tourday', 'tournight'], 'required', 'on' => self::TOUR],
            [['tourday', 'tournight'], 'integer', 'min' => 1],
            [['name', 'namekh'], 'required'],

            ['img_url', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['admin']],
            [['tourhour', 'tourmin', 'status', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['overview', 'overviewkh', 'highlight', 'highlight_kh'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['rating'], 'number'],
            [['type', 'code'], 'string', 'max' => 20],
            [['name', 'namekh', 'pick_up', 'pick_up_kh', 'drop_off', 'drop_off_kh', 'price_include_kh', 'price_exclude_kh', 'price_include', 'price_exclude'], 'string', 'max' => 255],
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
            'namekh' => 'Name khmer',
            'tourday' => 'Day(s)',
            'tournight' => 'Night(s)',
            'tourhour' => 'Hour(s)',
            'tourmin' => 'Minute(s)',
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

    public function isWishlist()
    {
        $user_id = Yii::$app->user->isGuest ? 0 : Yii::$app->user->identity->id;
        $wishlist = UserWishlist::findOne(['product_id' => $this->id, 'user_id' => $user_id]);
        return !empty($wishlist) ? true : false;
    }

    public function getListItemTemplate($data)
    {
        /** @var \app\components\Formater $formater */
        $formater = Yii::$app->formater;

        /** @var \app\components\Rate $tate */
        $rate = Yii::$app->rate;

        $selectedCity = !empty($data['selectedCity']) ? $data['selectedCity'] : '';
        $selectedDate = !empty($data['selectedDate']) ? $data['selectedDate'] : date("Y-m-d");
        $totalGuest = !empty($data['totalGuest']) ? $data['totalGuest'] : 1;
        $button = !empty($data['button']) ? boolval($data['button']) : true;

        $imageUrl = $this->getUploadUrl('img_url');
        $wishlist = $this->isWishlist() ? "active" : "";
        $wishlistIcon = $this->isWishlist() ? "fas fa-heart" : "far fa-heart";
        $bookButton = \yii\helpers\Html::a('View Now', [
            'product/view',
            'id' => $this->code,
            'selectedCity' => $selectedCity,
            'selectedDate' => $selectedDate,
            'totalGuest' => $totalGuest
        ], ['class' => 'btn btn-lg btn-primary']);
        $notFound = Yii::getAlias('@web/app/img/no-img.png');
        $onerror = "this.onerror=null;this.src=\"{$notFound}\"";
        $buttonTemp = '';
        if ($button) {
            $buttonTemp = "<div class='col-lg-2 align-self-center'>
                                <div class='d-flex'>
                                    <div class='ml-auto'>
                                        <div class='text-right'>
                                            <small class='d-block'>price start from</small>
                                            <span class='product-price'>{$formater->DollarFormat($rate->getPrice($this->id,$selectedDate))}</span>
                                            <small class='d-block'>per pax</small>
                                            <div class='d-block mt-3'> {$bookButton} </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";
        }
        return "<div class='row product-item '>
                    <div class='col-lg-4'>
                        <img onerror='{$onerror}' src='{$imageUrl}' class='product-image' />
                        <div class='h_container product-fav-button {$wishlist}' data-id='{$this->code}'>
                            <i class='{$wishlistIcon}'></i>
                        </div>
                    </div>
                    <div class='col-lg align-self-center'>
                        <div class='product-title'>{$this->name}</div>
                        <div class='product-location my-1'>
                            <i class='fas fa-map-marker-alt'></i> {$this->getLocation()}
                        </div>
                        <div class='product-rating my-1'>{$formater->starRatingReview($this->rating)}</div>
                        <div class='product-duration my-2'>Duration: {$this->getDuration()}</div>
                        <div class='product-code my-2'>Code: {$this->code}</div>
                    </div>
                    {$buttonTemp}
                </div>
                <hr class='my-5'>";
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

    public function getCities()
    {
        return $this->hasMany(ProductCity::class, ['product_id' => 'id']);
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
