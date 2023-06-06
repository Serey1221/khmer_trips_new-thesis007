<?php

/* @var $this yii\web\View */

use app\models\Booking;
use app\models\Product;
use yii\bootstrap4\Html;
use yii\helpers\Url;

/** @var \app\components\Formater $formater */
$formater = Yii::$app->formater;

$this->title = 'Admin';
$this->params['breadcrumbs'][] = 'Dashboard';

$countBooking = Booking::find()->where(['status' => Booking::BOOKED])->count();
$acceptBooking = Booking::find()->where(['status' => Booking::CONFIRMED])->count();
$rejectedBooking = Booking::find()->where(['status' => Booking::DECLINED])->count();
$totalProduct = Product::find()->count();

$this->registerJsFile(
  "https://cdn.jsdelivr.net/npm/chart.js",
  ['depends' => [\yii\web\JqueryAsset::class]]
);

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
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $countBooking ?></h3>

            <p>New Booking</p>
          </div>
          <div class="icon">
            <i class="far fa-calendar"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $acceptBooking ?><sup style="font-size: 20px"></sup></h3>

            <p>Accept Booking</p>
          </div>
          <div class="icon">
            <i class="far fa-calendar-check"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?= $rejectedBooking ?></h3>

            <p>Rejected Booking</p>
          </div>
          <div class="icon">
            <i class="far fa-calendar-times"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $totalProduct ?></h3>

            <p>Total Products</p>
          </div>
          <div class="icon">
            <i class="fas fa-map-marker-alt"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Sales Charts</h3>
          </div>
          <div class="card-body">
            <div class="chart">
              <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                  <div class=""></div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                  <div class=""></div>
                </div>
              </div>
              <canvas id="barChart"></canvas>
            </div>
          </div>

        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h6>Recent activity</h6>
            <hr>
            <?php
            if (!empty($recentActivity)) {
              foreach ($recentActivity as $key => $value) {
            ?>
                <li class="list-group-item ">
                  <div class="text-muted">
                    <i class="fas fa-user"></i> <?= $value->getUserAction() ?> | <?= $formater->dateTime($value->created_at) ?>
                  </div>
                  <div><?= $value->getTypeAsText() ?> - File <?= Html::a("#" . $value->booking->code, ['booking/view', 'id' => $value->booking->code]) ?></div>
                </li>

            <?php
              }
            }
            ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<?php
$script = <<<JS

    const ctx = document.getElementById('barChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: $chartLabel,
        datasets: [
          {
              label: ' Net Revenue',
              data: $chartTotalAmount,
              backgroundColor: 'rgb(18 119 188 / 50%)',
              borderWidth: 1,
          },
          {
              label: ' Payment',
              data: $chartPaidAmount,
            
              borderWidth: 1,
              fill: false,
              // tension: 0.1,
          }
        ]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

JS;
$this->registerJs($script);
?>