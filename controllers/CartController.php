<?php

namespace app\controllers;

use app\models\BookingItem;
use app\models\BookingPassenger;
use app\models\Cart;
use app\models\Product;
use app\models\Booking;
use app\models\BookingActivity;
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
    if (Yii::$app->user->isGuest) {
      $model = [];
      $cartTotalPrice = 0;
    } else {
      $model = Cart::find()->where(['created_by' => Yii::$app->user->identity->id])->all();
      $cartTotalPrice = array_sum(array_column($model, 'total_price'));
    }
    return $this->render('index', [
      'model' => $model,
      'cartTotalPrice' => $cartTotalPrice
    ]);
  }

  public function actionCheckOut()
  {
    $cart = Cart::find()->where(['created_by' => Yii::$app->user->identity->id])->all();
    $cartTotalPrice = array_sum(array_column($cart, 'total_price'));
    $modelPassenger = new BookingPassenger();
    if (
      $this->request->isPost &&
      $modelPassenger->load($this->request->post())
    ) {
      $transaction_exception = Yii::$app->db->beginTransaction();
      try {
        $model = new Booking();

        $model->customer_id = Yii::$app->user->identity->id;
        $model->total_amount = $cartTotalPrice;
        $model->paid = 0;
        $model->total_item = count($cart);
        if (!$model->save()) throw new Exception(print_r($model->getErrors()));

        $modelPassenger->booking_id = $model->id;
        $modelPassenger->is_lead = 1;
        if (!$modelPassenger->save()) throw new Exception(print_r($modelPassenger->getErrors()));

        foreach ($cart as $key => $value) {
          $duration_day = intval($value->product->tourday);
          $return_date = $value->product->isActivity() ? '' : date('Y-m-d', strtotime($value->select_date . " + {$duration_day} days"));
          $item = new BookingItem();
          $item->booking_id = $model->id;
          $item->product_id = $value->product_id;
          $item->departure_date = $value->select_date;
          $item->return_date = $return_date;
          $item->total_guest = $value->total_guest;
          $item->price = $value->price;
          $item->total_price = $value->total_price;
          if (!$item->save()) throw new Exception(print_r($item->getErrors()));
        }

        Cart::deleteAll(['created_by' => Yii::$app->user->identity->id]);
        BookingActivity::addActivity(['type' => BookingActivity::TYPE_CREATE, 'booking_id' => $model->id]);

        $transaction_exception->commit();
        return $this->redirect(['site/success-pay']);
      } catch (Exception $ex) {
        echo "<pre>";
        print_r($ex->getMessage());
        exit;
        Yii::$app->session->setFlash('warning', $ex->getMessage());
        $transaction_exception->rollBack();
      }
    }

    return $this->render('checkout', [
      'modelPassenger' => $modelPassenger,
      'cart' => $cart,
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
        $cart = Cart::find()->where(['created_by' => $user_id])->all();
        return json_encode(['status' => $status, 'total' => count($cart)]);
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
