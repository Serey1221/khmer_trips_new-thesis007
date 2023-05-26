<?php

/** @var yii\web\View $this */

$this->title = 'Khmer Travel';


?>


<?= $this->render('carousel-search') ?>

<?= $this->render('_section_search') ?>


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

<?= $this->render("destination_section", ['city' => $city]) ?>

<?= $this->render('_sub_service'); ?>


<?= $this->render('_sub_package', ['product' => $product]); ?>

<?= $this->render('registration'); ?>

<?= $this->render('team', ['guide' => $guide]); ?>


<?= $this->render('testimonial'); ?>

<?= $this->render('blog', ['threeblog' => $threeblog]); ?>

<?php
$script = <<<JS
    

JS;
$this->registerJs($script);
?>