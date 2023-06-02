<?php

use yii\bootstrap4\Breadcrumbs;
use app\assets\DatePickerAsset;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

DatePickerAsset::register($this);
$this->title = 'Product Detail';
$this->params['breadcrumbs'][] = $this->title;

/** @var \app\components\Formater $formater */
$formater = Yii::$app->formater;

/** @var \app\components\Rate $tate */
$rate = Yii::$app->rate;

?>
<style>
  .page-title {
    background-color: #7ab730;
    margin-top: 84px;
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

  .product-rating {
    font-size: .9rem;
    color: gainsboro;
  }

  .shadow {
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  }
</style>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <h4 class="text-justify d-inline-block text-truncate py-3" style="color:white;max-width: 720px;"> <?= $model->name ?></h4>
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
          <div class="bg-white  mb-3" style="padding: 30px;">
            <div class="d-flex justify-content-around mb-3">
              <div class="d-block">
                <h6 class="text-primary text-uppercase text-decoration-none"><i class="fa fa-map-marker-alt mr-2"></i> <?= $model->getLocation() ?></h6>
              </div>
              <div class="d-block">
                <h6 class="text-primary text-uppercase text-decoration-none"><i class="fa fa-calendar-alt mr-2"></i> <?= $model->getDuration() ?></h6>
              </div>
              <!-- <div class="col-md">
                <h6 class="text-warning text-uppercase text-decoration-none"><i class="fas fa-ticket-alt mr-2"></i> Code: <?= $model->code ?></h6>
              </div> -->
            </div>
            <div class="bg-secondary d-flex justify-content-around shadow" style="padding: 20px;border-radius: 10px;">
              <div class="d-block">
                <h6 class="text-muted">Code: </h6>
                <h5 class="text-warning text-uppercase text-decoration-none"><i class="fas fa-ticket-alt mr-2"></i> <?= $model->code ?></h5>
              </div>
              <div class="product-rating my-1">
                <h6 class="text-muted">Overall rating</h6> <?= $formater->starRatingReview($model->rating) ?>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-md-12">
                <h5>Overview</h5>
                <p><?= nl2br($model->overview) ?></p>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <h5>Highlights</h5>
                <p><?= nl2br($model->highlight) ?></p>
              </div>
            </div>
            <hr>

          </div>
        </div>
        <section id="checkavaibility">
          <div class=" bg-primary shadow" style="padding: 30px;">
            <h2 class="text-white">Select participants and date</h2>
            <?php $form = ActiveForm::begin([
              'action' => ['product/index'],
              'options' => ['data-pjax' => false, 'id' => 'formProductsearch'],
              'method' => 'get',
            ]); ?>
            <div class="row align-items-center" style="min-height: 60px;">

              <div class="col-md">
                <h4 class="title text-white">Date</h4>
                <?= Html::textInput('departure_date', $selectedDate, ['class' => 'form-control search-availability-form bg-white', 'value' => date("Y-m-d")]) ?>
              </div>

              <div class="col-md">
                <h4 class="title text-white">Guest</h4>
                <?= Html::dropDownList('number_of_guest', $totalGuest, Yii::$app->rate->guest(), ['class' => 'custom-select search-availability-form']) ?>
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
          <?php

          if (Yii::$app->user->isGuest) {
          ?>
            <div class="mb-2">
              <button class="btn btn-primary btn-lg btn-block m-0 modalButton" value="<?= Url::toRoute(['site/login']) ?>" data-title="Please login to continue" type="button"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
            <div class="mb-2">
              <a class="btn btn-warning btn-lg btn-block m-0 modalButton" value="<?= Url::toRoute(['site/login']) ?>" data-title="Please login to continue"> Book Now</a>
            </div>
          <?php
          } else {
          ?>
            <div class="mb-2">
              <button class="btn btn-primary btn-lg btn-block m-0" id="btnAddToCart" type="button"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
            <div class="mb-2">
              <a class="btn btn-warning btn-lg btn-block m-0" href="<?= Url::toRoute(['cart/check-out']) ?>"> Book Now</a>
            </div>
          <?php
          }

          ?>

        </div>
      </div>
    </div>
    <!-- The Original experience-->
    <div class="row mt-5 mb-4">
      <div class="col-lg-8">
        <h3>The Original experience</h3>
        <hr>
        <div class="row mt-3">
          <div class="col-md-12">
            <h5>Includes</h5>
            <p><?= nl2br($model->price_include) ?></p>
          </div>
        </div>
        <hr>
        <div class="row mt-3">
          <div class="col-md-12">
            <h5>Excludes</h5>
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
                <div class="d-flex mb-2">
                  <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i><?= $value->getLocation() ?></small>
                </div>
                <div class="d-flex mb-2">
                  <a class="h5 text-decoration-none d-inline-block text-truncate" href="<?= Yii::getAlias('product/view') ?>" style="max-width: 320px;"><?= $value['name'] ?></a>
                </div>
                <div class="d-flex">
                  <small class="m-0 ml-1"><i class="fa fa-calendar-alt text-primary mr-2"></i><?= $value->getDuration() ?></small>
                </div>
                <div class="border-top mt-4 pt-4">
                  <div class="d-flex justify-content-between">
                    <h6 class="m-0" style="color:gainsboro"><?= $formater->starRatingReview($value->rating) ?></h6>
                    <h5 class="m-0"><?= $formater->DollarFormat($rate->getPrice($value->id, $selectedDate)) ?> <small class="text-muted">Per Pax</small></h5>
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
        }
        $("#btnAddToCart").prop('disabled', false);
      },
      error: function(err){
        console.log(err);
      }
    });

  });

  $('.search-availability-form').change(function(){
    $("#btnAddToCart").prop('disabled', true);
  });

  $("#btnAddToCart").click(function(){
    var departure_date = $('input[name="departure_date"]').val();
    var number_of_guest = $('select[name="number_of_guest"]').val();
    var productCode = "$model->code";

    $.ajax({
      url: baseUrl + "/cart/dependent",
      method: 'post',
      data: {
        number_of_guest: number_of_guest,
        productCode: productCode,
        departure_date: departure_date,
        action: 'add-to-cart',
      },
      success: function(res){
        var data = JSON.parse(res);
        var Toast = Swal.mixin({
          toast: true,
          position: "bottom-end",
          showConfirmButton: false,
          timer: 5000,
          iconColor: "#fff",
          background: "#7ab730",
          customClass: {
            container: "colored-toast",
          }
        });
        if(data.status == 'success'){
          Swal.fire({
            title: "Item Added to Cart Sucessful!",
            text: "Do you want to check-out now?",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonText:'Not Now',
            confirmButtonText: 'Yes, Go to check-out'
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = baseUrl+'/cart/index';
            }
          });          
          $(".cart-badge").text(data.total);
        }else if(data.status == 'error'){
          Toast.fire({
            icon: 'error',
            title: 'Something went wrong!'
          });
          console.log(data.status);
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