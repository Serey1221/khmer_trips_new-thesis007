<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\BookingActivity;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class DashboardController extends Controller
{
  public function actions()
  {
    return [
      'access' => [
        'class' => AccessControl::class,
        'rules' => [
          [
            'actions' => ['index', 'error'],
            'allow' => true,
          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter::class,
        'actions' => [
          'logout' => ['post'],
        ],
      ],
      'error' => [
        'class' => 'yii\web\ErrorAction',
        'layout' => 'error',
      ],
    ];
  }
  public function actionIndex()
  {
    $recentActivity = BookingActivity::find()
      ->orderBy(['created_at' => SORT_DESC])
      ->limit(5)
      ->all();

    $revenueData = Yii::$app->db->createCommand("SELECT 
            SUM(booking.total_amount) total_amount,
            SUM(booking.paid) paid_amount,
            DATE_FORMAT(booking.created_at, '%b %y') `month`
        FROM booking
        WHERE booking.`status` NOT IN(0, 10)
        AND DATE(booking.`created_at`) BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') - INTERVAL 11 MONTH AND CURDATE()
        GROUP BY MONTH(booking.created_at)
        ORDER BY DATE(booking.created_at)
        ")->queryAll();
    $chartLabel = json_encode(ArrayHelper::getColumn($revenueData, 'month'));
    $chartTotalAmount = json_encode(ArrayHelper::getColumn($revenueData, function ($data) {
      return floatval($data['total_amount']);
    }));
    $chartPaidAmount = json_encode(ArrayHelper::getColumn($revenueData, 'paid_amount'));

    return $this->render('index', [
      'recentActivity' => $recentActivity,
      'chartLabel' => $chartLabel,
      'chartTotalAmount' => $chartTotalAmount,
      'chartPaidAmount' => $chartPaidAmount,
    ]);
  }

  public function actionTest()
  {
    echo "Test";
    exit;
    return $this->render('index');
  }
  public function beforeAction($action)
  {
    if ($action->id == 'error') {
      $this->layout = 'error';
    }

    return parent::beforeAction($action);
  }
}
