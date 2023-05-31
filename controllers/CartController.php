<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CartController extends \yii\web\Controller
{
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
    ];
  }
  public function actionIndex()
  {
    $model = Cart::find()->where(['created_by' => Yii::$app->user->identity->id])->all();
    $cartTotalPrice = array_sum(array_column($model, 'total_price'));
    return $this->render('index', [
      'model' => $model,
      'cartTotalPrice' => $cartTotalPrice
    ]);
  }

  public function actionCheckOut()
  {
    $model = Cart::find()->where(['created_by' => Yii::$app->user->identity->id])->all();
    $cartTotalPrice = array_sum(array_column($model, 'total_price'));
    return $this->render('checkout', [
      'model' => $model,
      'cartTotalPrice' => $cartTotalPrice
    ]);
  }

  public function actionDependent()
  {
    /** @var \app\components\Rate $tate */
    $rate = Yii::$app->rate;
    if ($this->request->isAjax && $this->request->isPost) {
      if ($this->request->post('action') == 'add-to-cart') {
        $departure_date = $this->request->post('departure_date');
        $number_of_guest = $this->request->post('number_of_guest');
        $productCode = $this->request->post('productCode');
        $user_id = Yii::$app->user->identity->id;

        $price = 0;
        $product = Product::findOne(['code' => $productCode]);
        if (!empty($product)) {
          $price = $rate->getPrice($product->id, $departure_date);
        }

        $status = 'error';
        $cart = new Cart();
        $cart->product_id = $product->id;
        $cart->total_guest = $number_of_guest;
        $cart->select_date = $departure_date;
        $cart->price = $price;
        $cart->total_price = $cart->total_guest * $price;
        $cart->created_at = date("Y-m-d H:i:s");
        $cart->created_by = $user_id;
        if ($cart->save()) {
          $status = 'success';
        }
        return json_encode(['status' => $status]);
      }
      if ($this->request->post('action') == 'update-cart') {
        $cartId = $this->request->post('cartId');
        $current = $this->request->post('current');
        $user_id = Yii::$app->user->identity->id;
        $cart = Cart::findOne($cartId);
        $status = 'error';
        if (!empty($cart)) {
          if ($current == 0) {
            if ($cart->delete()) {
              $status = 'removed';
            }
          } else {
            $cart->total_guest = $current;
            $cart->total_price = $current * $cart->price;
            if ($cart->save()) {
              $status = 'updated';
            }
          }
        }
        $cart = Cart::find()->where(['created_by' => $user_id])->all();
        $cartTotalPrice = array_sum(array_column($cart, 'total_price'));
        return json_encode(['status' => $status, 'total' => count($cart), 'cartTotalPrice' => floatval($cartTotalPrice)]);
      }
    }
  }
}
