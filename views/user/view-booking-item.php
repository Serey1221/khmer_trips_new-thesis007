<?php

use yii\bootstrap4\Breadcrumbs;
use app\assets\DatePickerAsset;
use yii\helpers\Url;

DatePickerAsset::register($this);
$this->title = 'Booking Detail';
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
        margin-top: 83px;
        height: 62px;
    }
</style>
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h4 class="text-justify py-3" style="color:white">Bayon or Angkor Thom temple</h4>
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
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <!-- Category List -->
                <div class="card">
                    <div class="card-body">
                        <h5>Activity</h5>
                        <hr>
                        <ul class="list-group">
                            <?php
                            if (!empty($modelActivity)) {
                                foreach ($modelActivity as $key => $value) {
                            ?>
                                    <li class="list-group-item ">
                                        <div class="text-muted">
                                            <i class="fas fa-user"></i> <?= $value->getUserAction() ?> | <?= $formater->dateTime($value->created_at) ?>
                                        </div>
                                        <div><?= $value->getTypeAsText() ?></div>
                                    </li>

                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
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
$script = <<<JS
    
   
JS;
$this->registerJs($script);
?>