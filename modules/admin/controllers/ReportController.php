<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\base\Exception;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii2tech\csvgrid\CsvGrid;

class ReportController extends Controller
{
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
    ];
  }

  public function actionSale()
  {
    $fromDate = date("Y-m-d");
    $toDate = date("Y-m-d");

    if (!empty($this->request->get('dateRange'))) {
      $dateRange = explode(' - ', $this->request->get('dateRange'));
      if (count($dateRange) >= 2) {
        $fromDate = $dateRange[0];
        $toDate = $dateRange[1];
      }
    }
    $customerId = $this->request->get('customerId') ? $this->request->get('customerId') : 'all';

    $data = Yii::$app->db->createCommand("SELECT 
        booking.created_at,
        CONCAT(customer.first_name,' ',customer.last_name) customer_name,
        booking.`code`,
        product.`name`,
        product.id product_id,
        booking_item.price,
        booking_item.total_guest,
        booking_item.total_price
      FROM booking_item
      INNER JOIN booking ON booking.id = booking_item.booking_id
      INNER JOIN customer ON customer.id = booking.customer_id
      INNER JOIN product ON product.id = booking_item.product_id
      WHERE DATE(booking.created_at) BETWEEN :fromDate AND :toDate
      AND booking.status NOT IN (0,10)
      AND IF(:customerId = 'all', true, booking.customer_id = :customerId)
      ORDER BY booking.created_at DESC
    ", [
      ':fromDate' => $fromDate,
      ':toDate' => $toDate,
      ':customerId' => $customerId
    ])->queryAll();

    return $this->render('sale', [
      'data' => $data,
      'fromDate' => $fromDate,
      'toDate' => $toDate,
      'customerId' => $customerId,
    ]);
  }

  public function actionExportSale($fromDate, $toDate, $customerId)
  {
    $data = Yii::$app->db->createCommand("SELECT 
        booking.created_at,
        CONCAT(customer.first_name,' ',customer.last_name) customer_name,
        booking.`code`,
        product.`name`,
        product.id product_id,
        booking_item.price,
        booking_item.total_guest,
        booking_item.total_price
      FROM booking_item
      INNER JOIN booking ON booking.id = booking_item.booking_id
      INNER JOIN customer ON customer.id = booking.customer_id
      INNER JOIN product ON product.id = booking_item.product_id
      WHERE DATE(booking.created_at) BETWEEN :fromDate AND :toDate
      AND booking.status NOT IN (0,10)
      AND IF(:customerId = 'all', true, booking.customer_id = :customerId)
      ORDER BY booking.created_at DESC
    ", [
      ':fromDate' => $fromDate,
      ':toDate' => $toDate,
      ':customerId' => $customerId
    ])->queryAll();

    $exporter = new CsvGrid([
      'dataProvider' => new ArrayDataProvider([
        'allModels' => $data
      ]),
      'columns' => [
        [
          'attribute' => 'created_at',
          'label' => 'Sale Date',
        ],
        [
          'attribute' => 'customer_name',
          'label' => 'Customer',
        ],
        [
          'attribute' => 'code',
          'label' => 'Code',
        ],
        [
          'attribute' => 'name',
          'label' => 'Product',
        ],
        [
          'attribute' => 'price',
          'label' => 'Price',
          'format' => 'decimal',
        ],
        [
          'attribute' => 'total_guest',
          'label' => 'Qty',
        ],
        [
          'attribute' => 'total_price',
          'label' => 'Amount',
          'format' => 'decimal',
        ],
      ],
    ]);


    $file_name = "report-sale-export.csv";
    return $exporter->export()->send($file_name);
  }
}
