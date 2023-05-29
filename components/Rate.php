<?php

namespace app\components;

use app\models\City;
use app\modules\admin\models\Product;
use app\modules\admin\models\ProductRateModify;
use DateTime;
use Yii;

class Rate extends \yii\web\Request
{
  public function getPrice($productId, $date)
  {
    if (empty($productId)) return 0;
    $date = $this->validateDate($date) ? $date : date("Y-m-d");

    $product = Product::findOne($productId);
    if (empty($product)) return 0;

    $defaultRate = floatval($product->rate);
    $modifyRate = ProductRateModify::find()
      ->where(['product_id' => $productId])
      ->andWhere(['BETWEEN', 'from_date', 'to_date', $date])
      ->one();
    if (empty($modifyRate)) return $defaultRate;

    if ($modifyRate->amount_type == ProductRateModify::FIXED_AMOUNT) {
      $modifyAmount = $modifyRate->amount;
    } else {
      $modifyAmount = ($defaultRate * $modifyRate->amount) / 100;
    }
    return floatval($modifyAmount);
  }

  public function city()
  {
    return Yii::$app->db->createCommand("SELECT city.id, city.`name`, city.name_kh
        FROM city
        INNER JOIN product_city ON city.id = product_city.city_id
        GROUP BY city.id
    ")
      ->queryAll();
  }

  public function guest()
  {
    return [1 => "1 Guest", 2 => "2 Guests", 3 => "3 Guests", 4 => "4 Guests", 5 => "5 Guests"];
  }

  public function validateDate($date, $format = 'Y-m-d')
  {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
  }
}
