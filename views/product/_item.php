<?php

use yii\helpers\Html;

$selectedCity = !empty(Yii::$app->request->get("ProductSearch")) ? Yii::$app->request->get("ProductSearch")['selectedCity'] : 1;
$selectedDate = !empty(Yii::$app->request->get("ProductSearch")) ? Yii::$app->request->get("ProductSearch")['selectedDate'] : date("Y-m-d");
$totalGuest = !empty(Yii::$app->request->get("ProductSearch")) ? Yii::$app->request->get("ProductSearch")['totalGuest'] : 1;
?>

<div class="row product-item ">
  <div class="col-lg-4">
    <img src="<?= $model->getUploadUrl('img_url') ?>" class="product-image" />
  </div>
  <div class="col-lg-6 align-self-center">
    <div class="product-title"><?= $model->name ?></div>
    <div class="product-location my-1"><i class="fas fa-map-marker-alt"></i> <?= $model->getLocation() ?></div>
    <div class="product-rating my-1"><?= $formater->starRatingReview($model->rating) ?></div>

    <div class="product-duration my-2">Duration: <?= $model->getDuration() ?></div>
    <div class="product-code my-2">Code: <?= $model->code ?></div>
  </div>
  <div class="col-lg-2 align-self-center">
    <div class="d-flex">
      <div class="ml-auto">
        <div class="text-right">
          <small class="d-block">price start from</small>
          <span class="product-price"><?= $formater->DollarFormat($rate->getPrice($model->id, $selectedDate)) ?></span> <small class="d-block">per pax</small>
          <div class="d-block mt-3">
            <?= Html::a('View Now', [
              'product/view',
              'id' => $model->code,
              'selectedCity' => $selectedCity,
              'selectedDate' => $selectedDate,
              'totalGuest' => $totalGuest
            ], ['class' => 'btn btn-lg btn-primary']) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<hr class="my-5">