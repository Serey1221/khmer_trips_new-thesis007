<?php

namespace app\models;

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

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['status', 'created_by', 'updated_by'], 'integer'],
      [['created_at', 'updated_at'], 'safe'],
      [['name'], 'string', 'max' => 50],
      [['language'], 'string', 'max' => 20],
      [['img_url'], 'string', 'max' => 255],
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
      'img_url' => 'Img Url',
      'status' => 'Status',
      'created_at' => 'Created At',
      'created_by' => 'Created By',
      'updated_at' => 'Updated At',
      'updated_by' => 'Updated By',
    ];
  }
}
