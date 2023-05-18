<!-- Team Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <div class="text-center mb-3 pb-3">
            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Guides</h6>
            <h1>Our Travel Guides</h1>
        </div>
        <div class="row">
            <?php if (!empty($guide)) {
                foreach ($guide as $key => $value) { ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                        <div class="team-item bg-white mb-4">
                            <div class="team-img position-relative overflow-hidden">
                                <img class="img-fluid" onerror="this.onerror=null;this.src='<?= Yii::getAlias('@web/app/img/no-img.png') ?>';" src="<?= $value->getUploadUrl('img_url') ?>" alt="">
                            </div>
                            <div class="text-center py-4">
                                <h5 class="text-truncate"><?= $value['name'] ?></h5>
                                <p class="m-0">Guide <?= $value->language ?></p>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
            <!-- <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="../app/img/Guides-2.png" alt="">
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Sok Bunheng</h5>
                        <p class="m-0">Guide chinese</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="../app/img/Guides-3.png" alt="">
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Chea Vannak</h5>
                        <p class="m-0">Guide chinese</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="../app/img/Guides-4.png" alt="">
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Leak Chilean</h5>
                        <p class="m-0">Guide Spain</p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
<!-- Team End -->