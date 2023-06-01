<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Admin';
$this->params['breadcrumbs'][] = 'Dashboard';
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
            <h3>150</h3>

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
            <h3>53<sup style="font-size: 20px"></sup></h3>

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
            <h3>65</h3>

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