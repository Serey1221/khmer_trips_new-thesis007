 <?php

    /** @var yii\web\View $this */

    use yii\helpers\Html;

    $this->title = 'Package';
    // $this->params['breadcrumbs'][] = $this->title;
    ?>
 <?= $this->render('_section_search') ?>
 <div class="container mt-5">
     <div class="row">
         <div class="col-lg-5">
             <img class="img-fluid" onerror="this.onerror=null;this.src='<?= Yii::getAlias('@web/app/img/no-img.png') ?>';" src="<?= $newproduct->getUploadUrl('img_url') ?>" alt="">
         </div>
         <div class="col-lg-7 py-0">
             <h2 class="text-primary text-uppercase">What`s New</h2>
             <div class="d-flex mb-3">
                 <small class="m-0 mr-2"><i class="fa fa-map-marker-alt text-primary mr-2"></i>Angkor Thom</small>
                 <small class="m-0 mr-2"><i class="fa fa-calendar-alt text-primary mr-2"></i>2 days</small>
                 <small class="m-0"><i class="fa fa-user text-primary mr-2"></i>5 Person</small>
             </div>
             <a class="h3 text-decoration-none" href="<?= Yii::getAlias('@web/site/booking-detail') ?>"><?= $newproduct['name'] ?></a>
             <!-- <p class="text-muted">The Bayon was the last state temple to be built at Angkor and the only Angkorian</p> -->
             <div class="border-top mt-4 pt-4">
                 <div class="d-flex">
                     <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small>(250)</small></h6>
                     <h5 class="m-0 px-4">$235</h5>

                 </div>
                 <a href="<?= Yii::getAlias('@web/site/booking-detail') ?>" class="btn btn-primary mt-4">Book Now</a>
             </div>
         </div>
     </div>
 </div>
 <?= $this->render('_sub_package', ['product' => $product]); ?>
 <?= $this->render("destination_section", ['city' => $city]) ?>