<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "guide_profile".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $language
 * @property string|null $img_url
 * @property int|null $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 */
class GuideProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guide_profile';
    }

    public function behaviors()
    {
        return [
            [
                'class' => \mohorev\file\UploadImageBehavior::class,
                'attribute' => 'img_url',
                'scenarios' => ['form'],
                'placeholder' => '@webroot/img/placeholder-3.png',
                'path' => '@webroot/upload/guide-profile/{id}',
                'url' => '@web/upload/guide-profile/{id}',
                // 'thumbs' => [
                //     'thumb' => ['width' => 300, 'height' => 300],
                // ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'language'], 'required'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['language'], 'string', 'max' => 20],
            ['img_url', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['form']],
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
            'language' => 'Language',
            'img_url' => 'Image',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getStatusTemp()
    {
        if ($this->status == 1) {
            return '<span class="badge badge-pill badge-info">Active</span>';
        } else {
            return '<span class="badge badge-pill badge-danger">Inactive</span>';
        }
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
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
}
