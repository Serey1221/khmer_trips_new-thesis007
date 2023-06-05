<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use app\models\User;
use app\models\Booking;
use app\models\BookingActivity;
use app\models\BookingPayment;
use app\modules\admin\models\ProductGallery;
use app\modules\admin\models\ProductItinerary;
use Yii;
use yii\base\Exception;
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

  public function actionViewBookingItem($code)
  {
    $model = $this->findModel($code);
    $modelGallery = ProductGallery::find()->where(['product_id' => $model->id])->all();
    $relatedProducts = Product::find()
      ->where(['product_id' => $model->id])
      ->all();

    $modelItinerary = ProductItinerary::find()
      ->where(['product_id' => $model->id])
      ->all();

    return $this->render('view-booking-item', [
      'model' => $model,
      'relatedProducts' => $relatedProducts,
      'modelGallery' => $modelGallery,
      'modelItinerary' => $modelItinerary
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

  protected function findModel($id)
  {
    if (($model = Booking::findOne(['code' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
