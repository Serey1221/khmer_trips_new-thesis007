<?php

use yii\helpers\Url;

$selectedCity = !empty(Yii::$app->request->get("ProductSearch")) ? Yii::$app->request->get("ProductSearch")['selectedCity'] : 1;
$selectedDate = !empty(Yii::$app->request->get("ProductSearch")) ? Yii::$app->request->get("ProductSearch")['selectedDate'] : date("Y-m-d");
$totalGuest = !empty(Yii::$app->request->get("ProductSearch")) ? Yii::$app->request->get("ProductSearch")['totalGuest'] : 1;

/** @var \app\components\Formater $formater */
$formater = Yii::$app->formater;

/** @var \app\components\Rate $tate */
$rate = Yii::$app->rate;
?>
<!-- Packages Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <div class="text-center mb-3 pb-3">
            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Packages</h6>
            <h1>Pefect Tour Packages</h1>
        </div>
        <div class="row">
            <?php if (!empty($product)) {
                foreach ($product as $key => $value) { ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="package-item bg-white mb-2">
                            <img class="img-fluid" onerror="this.onerror=null;this.src='<?= Yii::getAlias('@web/app/img/no-img.png') ?>';" src="<?= $value->getUploadUrl('img_url') ?>" alt="">
                            <?= $value->getWishlist() ?>
                            <div class="h_container" style="position: absolute;top: 8px;right: 22px;">
                                <i id="heart" class="far fa-heart"></i>
                            </div>
                            <div class="p-4">
                                <div class="d-flex mb-2">
                                    <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i><?= $value->getLocation() ?></small>
                                </div>
                                <div class="d-flex mb-2">
                                    <a class="h5 text-decoration-none d-inline-block text-truncate" href="<?= Url::to([
                                                                                                                '//product/view',
                                                                                                                'id' => $value->code,
                                                                                                                'selectedCity' => $selectedCity,
                                                                                                                'selectedDate' => $selectedDate,
                                                                                                                'totalGuest' => $totalGuest,
                                                                                                            ]); ?>" style="max-width: 320px;"><?= $value['name'] ?></a>
                                </div>
                                <div class="d-flax">
                                    <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i><?= $value->getDuration() ?></small>
                                </div>
                                <div class="border-top mt-4 pt-4">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="m-0" style="color:gainsboro"><?= $formater->starRatingReview($value->rating) ?></h6>
                                        <h5 class="m-0"><?= Yii::$app->formater->DollarFormat(Yii::$app->rate->getPrice($value->id, date("Y-m-d"))) ?> <small class="text-muted">Per Pax</small></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</div>
<!-- Packages End -->