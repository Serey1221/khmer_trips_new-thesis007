<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "frequently_asked_question".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $subject
 * @property string|null $description
 * @property int|null $status
 * @property string|null $created_date
 * @property int|null $created_by
 * @property string|null $updated_date
 * @property int|null $updated_by
 */
class Faqs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'frequently_asked_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['name', 'email', 'subject', 'description'], 'string', 'max' => 255],
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
            'email' => 'Email',
            'subject' => 'Subject',
            'description' => 'Description',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
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
