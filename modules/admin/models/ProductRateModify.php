<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product_rate_modify".
 *
 * @property int $id
 * @property int|null $product_id
 * @property float|null $amount
 * @property int|null $amount_type
 * @property string|null $from_date
 * @property string|null $to_date
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 *
 * @property Product $product
 */
class ProductRateModify extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_rate_modify';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'amount_type'], 'integer'],
            [['amount'], 'number'],
            [['from_date', 'to_date', 'created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'string'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'amount' => 'Amount',
            'amount_type' => 'Amont Type',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
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

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
