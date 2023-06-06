<?php

/* @var $this yii\web\View */

use app\models\Booking;
use yii\helpers\Url;

$this->title = 'Admin';
$this->params['breadcrumbs'][] = 'Dashboard';

$countBooking = Booking::find()->where(['status' => Booking::BOOKED])->count();
$acceptBooking = Booking::find()->where(['status' => Booking::CONFIRMED])->count();
$rejectedBooking = Booking::find()->where(['status' => Booking::DECLINED])->count();
?>

<?php
$base_url = Yii::getAlias('@web');

$script = <<<JS
    var base_url = "$base_url";
JS;
$this->registerJs($script);
?>
<style>
  .content {
    padding-top: 20px
  }
</style>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $countBooking ?></h3>

            <p>New Booking</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $acceptBooking ?><sup style="font-size: 20px"></sup></h3>

            <p>Accept Booking</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?= $rejectedBooking ?></h3>

            <p>Rejected Booking</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>
  </div>
</section>