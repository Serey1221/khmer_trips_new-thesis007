<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\DatetimepickerAsset;
use kartik\date\DatePicker;


/** @var yii\web\View $this */

$this->title = 'Khmer Travel';
DatetimepickerAsset::register($this);
?>

<!-- Carousel Start -->
<div class="container-fluid p-0">
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="../app/img/Khmer-Travel-Logo-12.png" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                        <h1 class="display-3 text-white mb-md-4">We are serving from our heart.</h1>
                        <!-- <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Book Now</a> -->
                        <div class="input-group rounded py-md-3 px-md-5 mt-2">
                            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="../app/img/Khmer-Travel-Logo-13.png" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                        <h1 class="display-3 text-white mb-md-4">Discover Amazing Places With Us.</h1>
                        <!-- <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Book Now</a> -->
                        <div class="input-group rounded py-md-3 px-md-5 mt-2">
                            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="../app/img/Khmer-Travel-Logo-11.png" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                        <h1 class="display-3 text-white mb-md-4">Travel is an investment in yourself.</h1>
                        <!-- <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Book Now</a> -->
                        <div class="input-group rounded py-md-3 px-md-5 mt-2">
                            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="../app/img/Khmer-Travel-Logo-14.png" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                        <h1 class="display-3 text-white mb-md-4">Travel is an investment in yourself.</h1>
                        <!-- <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Book Now</a> -->
                        <div class="input-group rounded py-md-3 px-md-5 mt-2">
                            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
</div>
<!-- Carousel End -->

<?php if (!empty($numberCity)) {
    foreach ($numberCity as $key => $value) { ?>
        <div class="container-fluid booking mt-5 pb-5">
            <div class="container pb-5">
                <div class="bg-light shadow" style="padding: 30px;">
                    <div class="row align-items-center" style="min-height: 60px;">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4 class="title">Location</h4>
                                    <label>Your destination</label>
                                    <div class="mb-3 mb-md-0">
                                        <select class="custom-select px-4" style="height: 47px;">
                                            <option selected>All</option>
                                            <option value=""><?= $value->name ?></option>


                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h4 class="title">Date</h4>
                                    <label>Departure</label>
                                    <!-- <div class="mb-3 mb-md-0">
                                        <div class="date" id="date1" data-target-input="nearest">
                                            <input type="text" class="form-control p-4 datetimepicker-input" placeholder="D/M/Y" data-target="#date1" data-toggle="datetimepicker" />

                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <!-- <label for="id_start_datetime"></label> -->
                                        <div class="input-group date" id='datetimepicker1'>
                                            <input type="text" name="birthday" value="05/16/2018 11:31:00" class="form-control p-4 datetimepicker-input" required />
                                            <div class="input-group-addon input-group-append">
                                                <div class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                    <!-- <i class="glyphicon glyphicon-calendar fa fa-calendar"></i> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <h4 class="title">Day</h4>
                                    <label>Duration</label>
                                    <div class="mb-3 mb-md-0">
                                        <!-- <div class="date" id="date2" data-target-input="nearest">
                                            <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Number of days" data-target="#date2" data-toggle="datetimepicker" />
                                        </div> -->
                                        <select class="custom-select px-4" style="height: 47px;">
                                            <option selected>Number of days</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                    <!-- <div class="input-group date" id="datetimepicker">
                                    <input type="text" class="form-control" style="height: 47px;">
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-white">Number of people
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                </div> -->
                                </div>
                                <div class="col-md-3">
                                    <h4 class="title">Number</h4>
                                    <label>People</label>
                                    <div class="mb-3 mb-md-0">
                                        <select class="custom-select px-4" style="height: 47px;">
                                            <option selected>Guests</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block" type="submit" style="height: 47px; margin-top: 52px;">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php }
} ?>

<?= $this->render('_sub_about'); ?>


<!-- Feature Start -->
<div class="container-fluid pb-5">
    <div class="container pb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex mb-4 mb-lg-0">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                        <i class="fa fa-2x fa-money-check-alt text-white"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="">Competitive Pricing</h5>
                        <p class="m-0">Khmer Travel provide best price to customers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex mb-4 mb-lg-0">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                        <i class="fa fa-2x fa-award text-white"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="">Best Services</h5>
                        <p class="m-0">Khmer Travel brings you the best service and confidence.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex mb-4 mb-lg-0">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                        <i class="fa fa-2x fa-globe text-white"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="">Nationwide Coverage</h5>
                        <p class="m-0">Khmer Travel brings you new destinations closest to you.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature End -->


<?= $this->render('destination') ?>


<?= $this->render('_sub_service'); ?>


<?= $this->render('_sub_package'); ?>

<?= $this->render('registration'); ?>

<?= $this->render('team'); ?>


<?= $this->render('testimonial'); ?>

<?= $this->render('blog'); ?>

<?php
$script = <<<JS
    $(function() {
  $('input[name="birthday"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10)
  }, function(start, end, label) {
    var years = moment().diff(start, 'years');
    alert("You are " + years + " years old!");
  });
});
JS;
$this->registerJs($script);
?>