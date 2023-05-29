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
                            <div class="h_container" style="position: absolute;top: 8px;right: 22px;">
                                <i id="heart" class="far fa-heart"></i>
                            </div>
                            <div class="p-4">
                                <div class="d-flex mb-3">
                                    <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>Angkor Thom</small>
                                    <small class="m-0 ml-3"><i class="fa fa-calendar-alt text-primary mr-2"></i>2 days</small>
                                    <!-- <small class="m-0"><i class="fa fa-user text-primary mr-2"></i>5 Person</small> -->
                                </div>
                                <a class="h5 text-decoration-none d-inline-block text-truncate" href="<?= Yii::getAlias('@web/site/booking-detail') ?>" style="max-width: 320px;"><?= $value['name'] ?></a>
                                <div class="border-top mt-4 pt-4">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small>(250)</small></h6>
                                        <h5 class="m-0">$235</h5>
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