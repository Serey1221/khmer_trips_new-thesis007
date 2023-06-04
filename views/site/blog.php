<?php

use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
$formater = Yii::$app->formater;

?>
<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <div class="text-center mb-3 pb-3">
            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Our Blog</h6>
            <h1>Latest From Our Blog</h1>
        </div>
        <div class="row pb-3">
            <?php if (!empty($threeblog)) {
                foreach ($threeblog as $key => $value) {
                    $url = Url::toRoute(['site/detail', 'slug' => $value->slug]); ?>
                    <div class="col-lg-4 col-md-6 mb-4 pb-2">
                        <div class="blog-item">
                            <div class="position-relative">
                                <img class="img-fluid" onerror="this.onerror=null;this.src='<?= Yii::getAlias('@web/app/img/no-img.png') ?>';" src="<?= $value->getUploadUrl('img_url') ?>" alt="">
                                <!-- <div class="h_container" style="position: absolute;top: 8px;right: 10px;">
                                    <i id="heart" class="far fa-heart"></i>
                                </div> -->
                                <div class="blog-date">
                                    <h6 class="font-weight-bold text-white mb-n1"><?= date('d', strtotime($value->created_date)); ?></h6>
                                    <small class="text-white text-uppercase"><?= date('M', strtotime($value->created_date)); ?></small>
                                </div>
                            </div>
                            <div class="bg-white p-4">
                                <div class="d-flex mb-2">
                                    <a class="text-primary text-uppercase text-decoration-none" href="<?= $url ?>"><?= $value['title'] ?></a>
                                </div>
                                <a class="h5 m-0 text-decoration-none d-inline-block text-truncate" href="<?= $url ?>" style="max-width: 320px;"><?= $value->short_description ?></a>
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