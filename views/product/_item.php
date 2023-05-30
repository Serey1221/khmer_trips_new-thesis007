<?php

use yii\helpers\Html;

$selectedCity = !empty(Yii::$app->request->get("ProductSearch")) ? Yii::$app->request->get("ProductSearch")['selectedCity'] : 1;
$selectedDate = !empty(Yii::$app->request->get("ProductSearch")) ? Yii::$app->request->get("ProductSearch")['selectedDate'] : date("Y-m-d");
$totalGuest = !empty(Yii::$app->request->get("ProductSearch")) ? Yii::$app->request->get("ProductSearch")['totalGuest'] : 1;
?>
<?= $model->getListItemTemplate([
  'selectedCity' => $selectedCity,
  'selectedDate' => $selectedDate,
  'totalGuest' => $totalGuest,
]) ?>