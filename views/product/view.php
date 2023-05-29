<?php

use yii\bootstrap4\Breadcrumbs;
use app\assets\DatePickerAsset;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

DatePickerAsset::register($this);
$this->title = 'Booking Detail';
$this->params['breadcrumbs'][] = $this->title;

/** @var \app\components\Formater $formater */
$formater = Yii::$app->formater;

/** @var \app\components\Rate $tate */
$rate = Yii::$app->rate;

?>
<style>
  .page-title {
    background-color: #7ab730;
    margin-top: 45px;
    height: 62px;
  }

  .image-thumbnail {
    height: 220px;
    width: 100%;
    object-fit: cover;
  }

  .table-booking-summary th {
    font-size: .8rem;
    font-weight: 500;
  }

  .table-booking-summary td {
    font-size: .8rem;
  }
</style>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <h4 class="text-justify py-3" style="color:white"> <?= $model->name ?></h4>
      </div>
      <div class="col-lg-4">
        <div class="text-justify py-2">
          <?php
          echo Breadcrumbs::widget([
            'class' => 'py-4',
            'homeLink' => [
              'label' => Yii::t('yii', 'Back to package'),
              'url' => Yii::getAlias('@web/site/package'),
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
          ]);
          ?>
        </div>

      </div>
    </div>

  </div>
</div>
<!-- Blog Start -->
<div class="container-fluid">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-8">
        <!-- Blog Detail Start -->
        <div class="pb-3">
          <div class="blog-item">
            <div class="position-relative">

              <img class="img-fluid w-100" src="<?= $model->getUploadUrl('img_url') ?>" alt="">
              <div class="blog-date">
                <h6 class="font-weight-bold text-white mb-n1"><?= date('d', strtotime($selectedDate)); ?></h6>
                <small class="text-white text-uppercase"><?= date('M', strtotime($selectedDate)); ?></small>
              </div>
            </div>
          </div>
          <div class="bg-white mb-3" style="padding: 30px;">
            <div class="d-flex mb-3">
              <a class="text-primary text-uppercase text-decoration-none" href="#"><?= $model->getLocation() ?></a>
            </div>
          </div>
        </div>
        <section id="checkavaibility">
          <div class=" bg-primary shadow" style="padding: 30px;">
            <h2 class="text-white">Select participants and date</h2>
            <?php $form = ActiveForm::begin([
              'action' => ['product/invidex'],
              'options' => ['data-pjax' => false, 'id' => 'formProductsearch'],
              'method' => 'get',
            ]); ?>
            <div class="row align-items-center" style="min-height: 60px;">

              <div class="col-md">
                <h4 class="title text-white">Date</h4>
                <?= Html::textInput('departure_date', $selectedDate, ['class' => 'form-control bg-white', 'value' => date("Y-m-d")]) ?>
              </div>

              <div class="col-md">
                <h4 class="title text-white">Guest</h4>
                <?= Html::dropDownList('number_of_guest', $totalGuest, Yii::$app->rate->guest(), ['class' => 'custom-select']) ?>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-md-8"></div>
              <div class="col-md-4">
                <button class="btn btn-warning btn-block" type="button" id="btnCheckAvailability">Check availability</button>
              </div>
            </div>
            <?php ActiveForm::end(); ?>
          </div>
        </section>
      </div>

      <div class="col-lg-4 mt-5 mt-lg-0">
        <!-- Category List -->
        <div class="mb-5">
          <h4 class="text-uppercase mb-4" style="letter-spacing: 2px;">Why book with us?</h4>
          <div class="bg-white" style="padding: 30px;">
            <ul class="list-inline m-0">
              <li class="mb-3 d-flex justify-content-between align-items-center">
                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>រៀបចំដំណើរកំសាន្តដោយសម្រិតសម្រាង</a>
              </li>
              <li class="mb-3 d-flex justify-content-between align-items-center">
                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>ធានាលើតម្លៃ និង គុណភាពសេវាកម្ម</a>
              </li>
              <li class="mb-3 d-flex justify-content-between align-items-center">
                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>ការបង់ប្រាក់ប្រកបដោយសុវត្ថិភាព</a>
              </li>
              <li class="mb-3 d-flex justify-content-between align-items-center">
                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>បុគ្គលិកប្រកបដោយបទពិសោធន៍ខ្ពស់</a>
              </li>
              <li class="d-flex justify-content-between align-items-center">
                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>កក់បានភ្លាមៗ ២៤/៧</a>
              </li>
            </ul>
          </div>
        </div>

        <!-- Recent Post -->
        <div class="mb-5">
          <h4 class="text-uppercase mb-4" style="letter-spacing: 3px;">Recent Post</h4>
          <?php if (!empty($threeproduct)) {
            foreach ($threeproduct as $key => $value) { ?>
              <a class="d-flex align-items-center text-decoration-none bg-white mb-3" href="">
                <img class="img-fluid" onerror="this.onerror=null;this.src='<?= Yii::getAlias('@web/app/img/no-img.png') ?>';" src="<?= $value->getUploadUrl('img_url') ?>" alt="" style="max-width:40%;">
                <div class="pl-3">
                  <h6 class="ml-1"><?= $value['name'] ?></h6>
                  <small class=""><?= $formater->date($value->created_at) ?></small>
                </div>
              </a>
          <?php
            }
          } ?>
        </div>

        <div class="bg-white" style="padding: 30px;">
          <h6>Need Assist from Khmer Travel?</h6>
          <p>យើងរីករាយនឹងផ្តល់ប្រឹក្សា(24/7) ដល់អ្នកដើម្បីបំពេញតម្រូវការដំណើរកំសាន្តរបស់អ្នក។ khmertravel នឹងជូនអ្នកនៅកន្លែងដែលអ្នកប្រាថ្នា</p>
          <p><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
          <p><i class="fa fa-envelope mr-2"></i>khmertravel@gmail.com</p>
        </div>

        <div class="bg-white mt-4" style="padding: 30px;">
          <div class="mb-2">
            <div class="row">
              <div class="col-md">
                <h5>Total Price</h5>
              </div>
              <div class="col-md text-right">
                <h5 id="rateTotalPrice"><?= $formater->DollarFormat($totalGuest * $rate->getPrice($model->id, $selectedDate)) ?></h5>
              </div>
            </div>
          </div>
          <hr>
          <h6>Booking Summary</h6>
          <table class="table table-booking-summary">
            <thead>
              <tr>
                <th>Description</th>
                <th class="text-right">Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Guest(s)</td>
                <td class="text-right" id="totalGuestPrice"><?= $totalGuest . "x " . number_format($rate->getPrice($model->id, $selectedDate), 2) ?></td>
              </tr>
            </tbody>
          </table>
          <div class="mb-2">
            <a href="#checkavaibility" class="btn btn-primary btn-lg btn-block m-0"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
          </div>
          <div class="mb-2">
            <a href="#checkavaibility" class="btn btn-warning btn-lg btn-block m-0"></i> Book Now</a>
          </div>
        </div>
      </div>
    </div>
    <!-- The Original experience-->
    <div class="row mt-5 mb-4">
      <div class="col-lg-8">
        <h3>The Original experience</h3>
        <div class="row mt-3">
          <div class="col-md-4">
            <h5>Highlights</h5>
          </div>
          <div class="col-md-8">
            <p><?= nl2br($model->highlight) ?></p>
          </div>
        </div>
        <hr>
        <div class="row mt-3">
          <div class="col-md-4">
            <h5>Overview</h5>
          </div>
          <div class="col-md-8">
            <p><?= nl2br($model->overview) ?></p>
          </div>
        </div>
        <hr>
        <div class="row mt-3">
          <div class="col-md-4">
            <h5>Includes</h5>
          </div>
          <div class="col-md-8">
            <p><?= nl2br($model->price_include) ?></p>
          </div>
        </div>
        <hr>
        <div class="row mt-3">
          <div class="col-md-4">
            <h5>Excludes</h5>
          </div>
          <div class="col-md-8">
            <p><?= nl2br($model->price_exclude) ?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- You might also like-->
    <div class="row mt-5">
      <div class="col-lg-12">
        <h4>You might also like...</h4>

      </div>
    </div>

    <div class="row">
      <?php if (!empty($relatedProducts)) {
        foreach ($relatedProducts as $key => $value) { ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="package-item bg-white mb-2">
              <img class="image-thumbnail img-fluid" onerror="this.onerror=null;this.src='<?= Yii::getAlias('@web/app/img/no-img.png') ?>';" src="<?= $value->getUploadUrl('img_url') ?>" alt="">
              <div class="h_container" style="position: absolute;top: 8px;right: 24px;">
                <i id="heart" class="far fa-heart"></i>
              </div>
              <div class="p-4">
                <div class="d-flex justify-content-between mb-3">
                  <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>Koh Ker</small>
                  <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i>3 days</small>
                  <small class="m-0"><i class="fa fa-user text-primary mr-2"></i>2 Person</small>
                </div>
                <a class="h5 text-decoration-none d-inline-block text-truncate" href="<?= Yii::getAlias('@web/site/booking-detail') ?>" style="max-width: 320px;"><?= $value['name'] ?></a>
                <div class="border-top mt-4 pt-4">
                  <div class="d-flex justify-content-between">
                    <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small>(250)</small></h6>
                    <h5 class="m-0">$350</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php
        }
      } ?>
    </div>
  </div>
</div>
<!-- Blog End -->
<?php
$baseUrl = Yii::getAlias("@web");
$script = <<<JS
    
  flatpickr('input[name="departure_date"]', {
      minDate: "today",
      altInput: true,
      altFormat: "F j, Y",
      dateFormat: "Y-m-d",
  });
  var baseUrl = "$baseUrl";

  $("#btnCheckAvailability").click(function(){
    var url = new URL(window.location.href);
    var search_params = url.searchParams;

    var departure_date = $('input[name="departure_date"]').val();
    var number_of_guest = $('select[name="number_of_guest"]').val();
    var productCode = "$model->code";

    search_params.set('selectedDate', departure_date);
    search_params.set('totalGuest', number_of_guest);

    url.search = search_params.toString();
    var new_url = url.toString();

    window.history.pushState({}, null, new_url);

    $.ajax({
      url: baseUrl + "/product/dependent",
      method: 'post',
      data: {
        productCode: productCode,
        departure_date: departure_date,
        action: 'search-availability',
      },
      success: function(res){
        var data = JSON.parse(res);
        
        if(parseFloat(data) > 0){
          $("#totalGuestPrice").text(`\${number_of_guest}x \${parseFloat(data).toFixed(2)}`)
          var totalPrice = parseInt(number_of_guest) * parseFloat(data);
          totalPrice = `$ \${parseFloat(totalPrice).toFixed(2)}`;
          $("#rateTotalPrice").text(totalPrice);
        }else{
          
        }
      },
      error: function(err){
        console.log(err);
      }
    });

  });

JS;
$this->registerJs($script);
?>