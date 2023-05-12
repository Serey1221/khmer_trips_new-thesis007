<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $img_url
 * @property string|null $slug
 * @property string|null $title
 * @property string|null $short_description
 * @property string|null $description
 * @property int|null $category_id
 * @property int|null $status
 * @property int|null $created_by
 * @property string|null $created_date
 * @property int|null $updated_by
 * @property string|null $updated_date
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['img_url', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['admin']],
            [['description'], 'string'],
            [['category_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['slug', 'title', 'short_description', 'meta_description', 'meta_keyword'], 'string', 'max' => 255],

            [['slug', 'title', 'short_description'], 'required', 'on' => ['admin']],
            [['slug'], 'unique'],
            [['slug'], 'match', 'pattern' => '/^[A-Za-z0-9 -_.]+$/', 'message' => 'Invalid characters'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \mohorev\file\UploadImageBehavior::class,
                'attribute' => 'img_url',
                'scenarios' => ['admin'],
                'placeholder' => '@webroot/img/placeholder.png',
                'path' => '@webroot/upload/article/{id}',
                'url' => '@web/upload/article/{id}',
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
            'img_url' => 'Img Url',
            'slug' => 'Slug',
            'title' => 'Title',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'category_id' => 'Category ID',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->slug = Yii::$app->formater->slugify($this->slug);
            if ($this->isNewRecord) {
                $this->created_date = date('Y-m-d H:i:s');
                $this->created_by = Yii::$app->user->identity->id;
            } else {
                $this->updated_date = date('Y-m-d H:i:s');
                $this->updated_by = Yii::$app->user->identity->id;
            }
            return true;
        } else {
            return false;
        }
    }

    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::class, ['id' => 'category_id']);
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
