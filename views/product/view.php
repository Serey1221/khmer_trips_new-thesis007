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



$selectedCity = !empty(Yii::$app->request->get("ProductSearch")) ? Yii::$app->request->get("ProductSearch")['selectedCity'] : 1;
$selectedDate = !empty(Yii::$app->request->get("ProductSearch")) ? Yii::$app->request->get("ProductSearch")['selectedDate'] : date("Y-m-d");
$totalGuest = !empty(Yii::$app->request->get("ProductSearch")) ? Yii::$app->request->get("ProductSearch")['totalGuest'] : 1;

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

  .timeline {
    border-left: 1px solid hsl(0, 0%, 90%);
    position: relative;
    list-style: none;
  }


  .timeline .timeline-item {
    position: relative;
  }

  .timeline .timeline-item:after {
    position: absolute;
    display: block;
    top: 0;
  }

  .timeline .timeline-item:after {
    background-color: hsl(87, 58%, 45%, 1);
    left: -38px;
    border-radius: 50%;
    height: 11px;
    width: 11px;
    content: "";
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
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <?php
                  if (!empty($modelGallery)) {
                    foreach ($modelGallery as $key => $value) {
                  ?>
                      <li data-target="#carouselExampleIndicators" data-slide-to="<?= $key ?>" class="<?= $key == 0 ? 'active' : '' ?>"></li>
                  <?php
                    }
                  }
                  ?>
                </ol>
                <div class="carousel-inner">
                  <?php
                  if (!empty($modelGallery)) {
                    foreach ($modelGallery as $key => $value) {
                  ?>
                      <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
                        <img class="img-fluid  w-100" src="<?= $value->getUploadUrl('img_url') ?>" alt="<?= $key ?>">
                      </div>
                  <?php
                    }
                  }
                  ?>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
              <!-- <img class="img-fluid w-100" src="<?php // $model->getUploadUrl('img_url') 
                                                      ?>" alt=""> -->
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
          <div class="bg-white" style="padding: 27px;">
            <ul class="list-inline m-0">
              <li class="mb-3 d-flex justify-content-between align-items-center">
                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Carefully organize travel packages</a>
              </li>
              <li class="mb-3 d-flex justify-content-between align-items-center">
                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Guaranteed price and service</a>
              </li>
              <li class="mb-3 d-flex justify-content-between align-items-center">
                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Secure payment</a>
              </li>
              <li class="mb-3 d-flex justify-content-between align-items-center">
                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Highly experienced staff</a>
              </li>
              <li class="d-flex justify-content-between align-items-center">
                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Booking now and get now 24/7</a>
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
          <p>We are happy to provide 24/7 hours consultation to meet your travel needs.</p>
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
              <button class="btn btn-warning btn-lg btn-block m-0" id="btnCheckOut" type="button">Book Now</button>
              <!-- <a class="btn btn-warning btn-lg btn-block m-0" href="<?= Url::toRoute(['cart/check-out']) ?>"> Book Now</a> -->
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
        <h3 class="mb-4">Detailed program</h3>
        <ul class="timeline">
          <?php
          if (!empty($modelItinerary)) {
            foreach ($modelItinerary as $key => $value) {
              $key = $key++;
          ?>
              <li class="timeline-item mb-5">
                <h5 class="fw-bold"><?= "Day {$key} - {$value->title}" ?></h5>
                <p class="text-primary mb-2 fw-bold"><?= !empty($value->city) ? "<i class='fas fa-map-marker-alt'></i> {$value->city->name}" : '' ?></p>
                <p class="text-muted">
                  <?= nl2br($value->description) ?>
                </p>
                <?= $value->is_stay == 1 ? "<span class='text-success mr-3'><i class='fas fa-bed'></i> Overnight</span>" : "" ?>
                <?= $value->is_breakfast == 1 ? "<span class='text-info mr-2'><i class='fas fa-utensils'></i> Breakfast</span>" : "" ?>
                <?= $value->is_lunch == 1 ? "<span class='text-info mr-2'><i class='fas fa-utensils'></i> Lunch</span>" : "" ?>
                <?= $value->is_dinner == 1 ? "<span class='text-info mr-2'><i class='fas fa-utensils'></i> Dinner</span>" : "" ?>
              </li>
          <?php
            }
          }
          ?>



        </ul>
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
        <hr>
        <div class="row mb-4">
          <div class="col-md">
            <h5>Conditions</h5>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-md">
            <h6 class="text-primary">Conditions for children:</h6>
            <p>For children under 5 years old: Free of charge</p>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-md">
            <h6 class="text-primary">Reservation Terms:</h6 class="text-primary">
            <p>- The company reserves the right to modify the program or cancel the trip if necessary: late arrival of guests, weather, traffic, insufficient customers ឫ Case of the President!</p>
            <p>- Hotel accommodation (1 room for 2 people) In case the customer registers alone, need to stay with other guests</p>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-md">
            <h6 class="text-primary">Deletion terms:</h6 class="text-primary">
            <p>- If you want to cancel the tour 7 days before departure and will be fined 50%.</p>
            <p>- If you want to cancel the trip 3 days before departure and require 75% loss.</p>
            <p>- If you want to cancel the trip one day before departure and will be fined 100%.</p>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-md">
            <h6 class="text-primary">Terms of payment:</h6>
            <p>- If your booking is confirmed, the customer is required to pay 50% of the total amount in advance and the remaining amount must be paid 3 days before departure.</p>
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

    <div class="row product-item">
      <?php if (!empty($relatedProducts)) {
        foreach ($relatedProducts as $key => $value) { ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="package-item bg-white mb-2">
              <img class="image-thumbnail img-fluid" onerror="this.onerror=null;this.src='<?= Yii::getAlias('@web/app/img/no-img.png') ?>';" src="<?= $value->getUploadUrl('img_url') ?>" alt="">
              <?= $value->getWishlistButton() ?>
              <div class="p-4">
                <div class="d-flex mb-2">
                  <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i><?= $value->getLocation() ?></small>
                </div>
                <div class="d-flex mb-2">
                  <a class="h5 text-decoration-none d-inline-block text-truncate" href="<?= Url::to([
                                                                                          'product/view',
                                                                                          'id' => $value->code,
                                                                                          'selectedCity' => $selectedCity,
                                                                                          'selectedDate' => $selectedDate,
                                                                                          'totalGuest' => $totalGuest,
                                                                                        ]); ?>" style="max-width: 320px;"><?= $value['name'] ?></a>
                </div>
                <div class="d-flex">
                  <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i><?= $value->getDuration() ?></small>
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
        $("#btnCheckOut").prop('disabled', false);
      },
      error: function(err){
        console.log(err);
      }
    });

  });

  $('.search-availability-form').change(function(){
    $("#btnAddToCart").prop('disabled', true);
    $("#btnCheckOut").prop('disabled', true);
  });

  $("#btnCheckOut").click(function(){
    var totalCart = $totalCart;
    totalCart = parseInt(totalCart);
    if(totalCart > 0){
      location.href = baseUrl+'/cart/check-out';
    }else{
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
            location.href = baseUrl+'/cart/index';     
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
    }
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
<?= $this->render('//site/_wishlist_script') ?>