<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use app\models\User;
use app\modules\admin\models\Booking;
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

    return $this->render('index', [
      'model' => $model,
    ]);
  }

  public function actionBooking()
  {
    $model = Booking::find()->where(['created_by' => Yii::$app->user->identity->id])->all();
    return $this->render('booking', [
      'model' => $model,
    ]);
  }
}
