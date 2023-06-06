<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

/** @var \app\components\Formater $formater */
$formater = Yii::$app->formater;

$this->title = 'View Booking :' . $model->code;
?>
<style>
  .product-image {
    height: 80px !important;
  }

  .product-title {
    font-size: .77rem !important;
    line-height: 1.3rem !important;
  }

  .product-description div {
    font-size: .6rem !important;
  }

  .product-price {
    font-size: 1rem !important;
    line-height: 1.1rem !important;
  }

  .price {
    color: red;
  }

  .departure-date {
    font-size: .8rem !important;
  }

  .departure-icon {
    font-size: .7rem !important;
  }
</style>
<div class="container py-5 mt-5">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= Url::toRoute(['user/booking']) ?>">My Booking</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?= $model->code ?></li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-7">
      <div class="card">
        <div class="card-body">
          <div class="d-flex">
            <h5 class="card-title">Order code: <u class="text-info">#<?= $model->code ?></u></h5>
            <div class="ml-auto">
              <?= $model->getBookingStatus(); ?>
            </div>
          </div>
          <hr>
          <h5 class="mb-3 text-primary">Passenger detail</h5>
          <div class="row">
            <div class="col-lg-4">
              <h6><?= $model->passenger->first_name . ' ' . $model->passenger->last_name ?></h6>
              <div class="font-size-sm">Booked by</div>
            </div>
            <div class="col-lg-4">
              <h6><?= $model->passenger->phone_number ?></h6>
              <div class="font-size-sm">Phone number</div>
            </div>
            <div class="col-lg-4">
              <h6><?= $model->passenger->email ?></h6>
              <div class="font-size-sm">Email address</div>
            </div>
          </div>
          <hr class="my-4">
          <h5 class="mb-3 text-primary">Items detail</h5>
          <?php
          $bookingItems = $model->items;
          if (!empty($bookingItems)) {
            $notFound = Yii::getAlias('@web/app/img/no-img.png');
            $onerror = "this.onerror=null;this.src=\"{$notFound}\"";
            foreach ($bookingItems as $key => $value) {
              $product = $value->product;
              $imageUrl = $product->getUploadUrl('img_url');
          ?>
              <div class="row product-item cart-item-row" data-key="<?= $key ?>">
                <div class="col-lg-3">
                  <?= Html::img($imageUrl, ['onerror' => $onerror, 'class' => 'product-image']) ?>
                </div>
                <div class='col-lg-9 align-self-center'>
                  <p class="product-title mb-0"><?= $product->name ?></p>
                  <div class="departure-date my-1">
                    <span class="departure-icon"><i class='far fa-calendar-check'></i> Departure:</span> <mark><?= $formater->date($value->departure_date) ?></mark>
                  </div>
                  <div class="d-flex">
                    <div class="product-description">
                      <div class='product-location'>
                        <i class='fas fa-map-marker-alt'></i> <?= $product->getLocation() ?>
                      </div>
                      <div class='product-rating'><?= $formater->starRatingReview($product->rating) ?></div>
                      <div class="mb-1">Duration: <?= $product->getDuration() ?></div>
                      <div class="mb-1">Code: <?= $product->code ?></div>
                    </div>
                    <div class="ml-auto">
                      <span class="product-price"><?= $formater->DollarFormat($value->price) ?></span>
                      <small class="d-block">x <?= $value->total_guest ?> pax</small>
                    </div>
                  </div>
                </div>
                <div class="w-100 my-2 border-bottom"></div>
              </div>
          <?php
            }
          }
          ?>
          <div class="d-flex my-3 justify-content-between">
            <h6>Total:</h6>
            <h6><?= $formater->DollarFormat($model->total_amount) ?></h6>
          </div>
          <div class="d-flex my-3 justify-content-between">
            <h6>Grand Total:</h6>
            <h5 class="price"><?= $formater->DollarFormat($model->total_amount) ?></h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="d-flex mb-3">
        <?= Html::a('View Invoice', ['user/invoice', 'code' => $model->code], ['target' => '_blank', 'class' => 'btn btn-primary mr-3']) ?>
        <?php // Html::a('View Voucher', ['user/vouher', 'code' => $model->code], ['target' => '_blank', 'class' => 'btn btn-warning']) 
        ?>
      </div>
      <div class="card mb-3">
        <div class="card-body">
          <h5>Payment</h5>
          <?php
          if (!empty($modelPayment)) {
            $paymentStr = "<table class='table table-hover'>";
            $paymentStr .= "<thead class=''>
                            <tr>
                              <th>Date</th>
                              <th>Method</th>
                              <th class='text-right'>Amount</th>
                            </tr>
                            </thead>";
            $paymentStr .= '<tbody>';
            foreach ($modelPayment as $key => $value) {
              $paymentStr .= "<tr>
                            <td>{$formater->date($value->date)}</td>
                            <td>{$value->method->name}</td>
                            <td class='text-right'>{$formater->DollarFormat($value->amount)}</td>
                          </tr>";
            }
            $paymentStr .= "</tbody>";
            $paymentStr .= "<tfoot>
                        <tr>
                        <th class='text-right' colspan='2'>Total:</th>
                        <th class='text-right'>{$formater->DollarFormat($model->paid)}</th>
                        </tr>
                        <tr>
                        <th class='text-right text-danger' colspan='2'>Balance:</th>
                        <th class='text-right text-danger'>{$formater->DollarFormat($model->balance_amount)}</th>
                        </tr>
                    </tfoot>";
            $paymentStr .= "</table>";
            echo $paymentStr;
          }
          ?>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h5>Activity</h5>
          <hr>
          <ul class="list-group">
            <?php
            if (!empty($modelActivity)) {
              foreach ($modelActivity as $key => $value) {
            ?>
                <li class="list-group-item ">
                  <div class="text-muted">
                    <i class="fas fa-user"></i> <?= $value->getUserAction() ?> | <?= $formater->dateTime($value->created_at) ?>
                  </div>
                  <div><?= $value->getTypeAsText() ?></div>
                </li>

            <?php
              }
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>