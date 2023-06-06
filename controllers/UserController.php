<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use app\models\User;
use app\models\Booking;
use app\models\BookingActivity;
use app\models\BookingItem;
use app\models\BookingPayment;
use app\modules\admin\models\ProductGallery;
use app\modules\admin\models\ProductItinerary;
use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UserController extends \yii\web\Controller
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
    $model = User::findOne(Yii::$app->user->identity->id);
    $customer = $model->customer;
    if ($this->request->isPost && $customer->load($this->request->post())) {
      $transaction_exception = Yii::$app->db->beginTransaction();
      try {

        if (!$customer->save()) throw new Exception(print_r($customer->getErrors()));

        $transaction_exception->commit();
        Yii::$app->session->setFlash('success', "Profile has been updated successfully");
        return $this->redirect(Yii::$app->request->referrer);
      } catch (Exception $ex) {
        echo "<pre>";
        print_r($ex->getMessage());
        exit;
        Yii::$app->session->setFlash('warning', $ex->getMessage());
        $transaction_exception->rollBack();
      }
    }

    return $this->render('index', [
      'model' => $model,
      'customer' => $customer
    ]);
  }

  public function actionViewBookingItem($item)
  {
    $modelBookingItem = BookingItem::findOne($item);
    $model = Product::find()
      ->where(['id' => $modelBookingItem->product_id])
      ->one();
    $modelGallery = ProductGallery::find()->where(['product_id' => $model->id])->all();
    $modelItinerary = ProductItinerary::find()
      ->where(['product_id' => $model->id])
      ->all();
    $cityArr = ArrayHelper::getColumn($model->cities, 'city_id');
    $relatedProducts = Product::find()
      ->innerJoin('product_city', 'product.id = product_city.product_id')
      ->where(['IN', 'product_city.city_id', $cityArr])
      ->groupBy(['product.id'])
      ->all();

    $modelActivity = BookingActivity::find()
      ->where(['booking_id' => $model->id])
      ->orderBy(['created_at' => SORT_DESC])
      ->one();

    return $this->render('view-booking-item', [
      'model' => $model,
      'relatedProducts' => $relatedProducts,
      'modelGallery' => $modelGallery,
      'modelItinerary' => $modelItinerary,
      'modelActivity' => $modelActivity
    ]);
  }

  public function actionBooking()
  {
    $model = Booking::find()
      ->where(['created_by' => Yii::$app->user->identity->id])
      ->orderBy(['created_at' => SORT_DESC])
      ->all();
    return $this->render('booking', [
      'model' => $model,
    ]);
  }

  public function actionViewBooking($code)
  {
    $model = $this->findModel($code);
    $modelPayment = BookingPayment::find()
      ->where(['booking_id' => $model->id])
      ->orderBy(['created_at' => SORT_DESC])
      ->all();
    $modelActivity = BookingActivity::find()
      ->where(['booking_id' => $model->id])
      ->orderBy(['created_at' => SORT_DESC])
      ->all();
    return $this->render('view_booking', [
      'model' => $model,
      'modelPayment' => $modelPayment,
      'modelActivity' => $modelActivity,
    ]);
  }

  public function actionInvoice($code)
  {
    $this->layout = 'file';
    $model = $this->findModel($code);
    $customer = $model->customer;
    $invoiceDate = BookingActivity::findOne(['booking_id' => $model->id, 'type' => BookingActivity::TYPE_CONFIRM]);
    $invoiceDate = !empty($invoiceDate) ? $invoiceDate->created_at : $model->created_at;
    $invoiceItem = $model->items;
    return $this->render('_invoice', [
      'model' => $model,
      'customer' => $customer,
      'invoiceDate' => $invoiceDate,
      'invoiceItem' => $invoiceItem
    ]);
  }

  protected function findModel($id)
  {
    if (($model = Booking::findOne(['code' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
