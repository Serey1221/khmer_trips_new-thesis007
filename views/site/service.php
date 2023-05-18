<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

$this->title = 'Service';

?>
<?= $this->render('_section_search') ?>
<?= $this->render('_sub_service'); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-item bg-white text-center mb-2 py-5 px-4">
                <i class="fa fa-2x fa-archive mx-auto mb-4"></i>
                <h5 class="mb-2">Packages</h5>
                <p class="m-0">Khmer Travel prepares the best package for you</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-item bg-white text-center mb-2 py-5 px-4">
                <i class="fa fa-2x fa-retweet mx-auto mb-4"></i>
                <h5 class="mb-2">Recent Post</h5>
                <p class="m-0">You will receive a new tour from our company Khmer Travel.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-item bg-white text-center mb-2 py-5 px-4">
                <i class="fa fa-2x fa-home mx-auto mb-4"></i>
                <h5 class="mb-2">Domistic tours</h5>
                <p class="m-0">Khmer Travel would like to take you to visit the provinces in Cambodia.</p>
            </div>
        </div>
    </div>
</div>

<?= $this->render('testimonial'); ?>