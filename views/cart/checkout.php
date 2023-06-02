<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Cart Checkout';
/** @var \app\components\Formater $formater */
$formater = Yii::$app->formater;

/** @var \app\components\Rate $tate */
$rate = Yii::$app->rate;

$customer = Yii::$app->user->identity->customer;
?>
<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }

  .container {
    margin-top: 140px;
  }

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
<div class="container">
  <div class="row">
    <div class="col-md-5 order-md-2 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h6 class="text-uppercase">Cart summary</h6>
            <?= count($cart) ?> item(s)
          </div>
          <hr>
          <?php
          if (!empty($cart)) {
            foreach ($cart as $key => $value) {
              $product = $value->product;
              $imageUrl = $product->getUploadUrl('img_url');
              $notFound = Yii::getAlias('@web/app/img/no-img.png');
              $onerror = "this.onerror=null;this.src=\"{$notFound}\"";
          ?>
              <div class="row product-item cart-item-row" data-key="<?= $key ?>">
                <div class="col-lg-3">
                  <?= Html::img($imageUrl, ['onerror' => $onerror, 'class' => 'product-image']) ?>
                </div>
                <div class='col-lg-9 align-self-center'>
                  <p class="product-title mb-0"><?= $product->name ?></p>
                  <div class="departure-date my-1">
                    <span class="departure-icon"><i class='far fa-calendar-check'></i> Departure:</span> <mark><?= $formater->date($value->select_date) ?></mark>
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
            <h6><?= $formater->DollarFormat($cartTotalPrice) ?></h6>
          </div>
          <div class="d-flex my-3 justify-content-between">
            <h6>Grand Total:</h6>
            <h5 class="price"><?= $formater->DollarFormat($cartTotalPrice) ?></h5>
          </div>
        </div>
      </div>

    </div>
    <div class="col-md-7 order-md-1">
      <?php
      $form = ActiveForm::begin([
        'options' => ['id' => 'checkoutForm'],
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
      ]);
      ?>

      <div class="card">
        <div class="card-body">
          <h3 class="mb-3">Lead traveller/Tour Leader information</h3>
          <div class="row">
            <div class="col-lg-6">
              <?= $form->field($modelPassenger, 'first_name')->textInput(['value' => $customer->first_name])->label('First name <abbr title="Required">*</abbr>') ?>
            </div>
            <div class="col-lg-6">
              <?= $form->field($modelPassenger, 'last_name')->textInput(['value' => $customer->last_name])->label('Last name <abbr title="Required">*</abbr>') ?>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <?= $form->field($modelPassenger, 'phone_number')->textInput(['value' => $customer->phone_number])->label('Phone number <abbr title="Required">*</abbr>') ?>
            </div>
            <div class="col-lg-6">
              <?= $form->field($modelPassenger, 'email')->textInput(['value' => $customer->email])->label('Email <abbr title="Required">*</abbr>') ?>
            </div>
          </div>
          <hr>
          <h3 class="mb-2">Payment Method</h3>
          <p class="text-muted mb-4"><i class="fas fa-info-circle mr-1"></i>Select the payment method you want to pay for your booking.</p>
          <div class="card">
            <div class="card-body">
              <div class="custom-control custom-radio mb-1">
                <input type="radio" class="custom-control-input" checked name="payment_method" id="payment_method_1">
                <label class="custom-control-label font-weight-bold text-dark" for="payment_method_1">Book online, Pay offline</label>
                <div class="text-muted font-size-sm">You can make the payment at a later date, either in bank transfer or online <br>(Payment terms and conditions will be applied).</div>
              </div>
            </div>
          </div>
          <hr>

          <?= Html::submitButton('Checkout', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
        </div>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>