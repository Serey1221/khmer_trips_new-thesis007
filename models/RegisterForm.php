<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property string|null $name
 * @property string|null $email
 */
class RegisterForm extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'customer';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['name'], 'string', 'max' => 50],
      [['email'], 'email'],
    ];
  }
}
