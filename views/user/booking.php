<?php

use yii\bootstrap4\Html;

/** @var app\components\Formater $formater */
$formater = Yii::$app->formater;

$this->title = 'My Booking';
?>
<style>
    .blog-date {
        left: 10px;
        top: 10px;
    }


    .product-image {
        height: 110px !important;
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
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">My Booking</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row ">
        <?= $this->render('_left_menu') ?>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header p-3">
                    <h3 class="mb-0 ml-2"> My Booking </h3>
                </div>
                <div class="card-body">

                    <?php
                    if (!empty($model)) {
                        foreach ($model as $key => $value) {
                    ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="card-title">
                                        <div class="d-flex">
                                            <div>
                                                <div> Order ID: #<?= $value->code ?> </div>
                                                <?= $value->getBookingStatus() ?>
                                            </div>
                                            <div class="ml-auto">
                                                <?= Html::a('View order', ['user/view-booking', 'code' => $value->code], ['class' => 'btn btn-link']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row product-item">
                                        <?php
                                        $bookingItems = $value->items;
                                        if (!empty($bookingItems)) {
                                            $notFound = Yii::getAlias('@web/app/img/no-img.png');
                                            $onerror = "this.onerror=null;this.src=\"{$notFound}\"";
                                            foreach ($bookingItems as $keyItem => $item) {
                                                $product = $item->product;
                                        ?>
                                                <div class="col-lg-4">
                                                    <div class="">
                                                        <?= Html::img($product->getUploadUrl('img_url'), ['onerror' => $onerror, 'class' => 'product-image']) ?>
                                                        <div class="blog-date">
                                                            <h6 class="font-weight-bold text-white mb-n1"><?= date('d', strtotime($item->departure_date)); ?></h6>
                                                            <small class="text-white text-uppercase"><?= date('M', strtotime($item->departure_date)); ?></small>
                                                        </div>
                                                        <hr class="border-0">
                                                        <?= Html::a($product->name, ['user/view-booking-item', 'item' => $item->id], ['class' => 'product-title', 'target' => '_blank']) ?>
                                                        <div class="product-description">
                                                            <div class="product-location my-1">
                                                                <i class="fas fa-map-marker-alt"></i> <?= $product->getLocation() ?>
                                                            </div>
                                                            <div class="product-duration my-2"><i class="far fa-calendar"></i> <?= $product->getDuration() ?></div>
                                                        </div>

                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<h5>There are no booking yet.</h5>";
                    }
                    ?>

                </div>
            </div>

        </div>
    </div>
</div>