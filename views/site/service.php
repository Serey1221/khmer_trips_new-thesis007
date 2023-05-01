<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

$this->title = 'Service';

?>
<?= $this->render('booking'); ?>
<?= $this->render('_sub_service'); ?>
<div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="service-item bg-white text-center mb-2 py-5 px-4">
            <i class="fa fa-2x fa-archive mx-auto mb-4"></i>
            <h5 class="mb-2">Packages</h5>
            <p class="m-0">Meet guides with years of experience in guiding tourists</p>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="service-item bg-white text-center mb-2 py-5 px-4">
            <i class="fa fa-2x fa-refresh mx-auto mb-4"></i>
            <h5 class="mb-2">Recent Post</h5>
            <p class="m-0">Get the latest tour information and weekly specials.</p>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="service-item bg-white text-center mb-2 py-5 px-4">
            <i class="fa fa-2x fa-home mx-auto mb-4"></i>
            <h5 class="mb-2">Domistic tours</h5>
            <p class="m-0">Khmer Travel brings you a new experience of booking a private tour</p>
        </div>
    </div>
</div>
<?= $this->render('testimonial'); ?>