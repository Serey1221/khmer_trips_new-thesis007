<?php

$this->title = 'Blog';
$formater = Yii::$app->formater;
?>
<?= $this->render('_section_search') ?>
<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="row pb-3">
                    <?php if (!empty($blog)) {
                        foreach ($blog as $key => $value) { ?>
                            <div class="col-md-6 mb-4 pb-2">
                                <div class="blog-item">
                                    <div class="position-relative">
                                        <img class="img-fluid" onerror="this.onerror=null;this.src='<?= Yii::getAlias('@web/app/img/no-img.png') ?>';" src="<?= $value->getUploadUrl('img_url') ?>" alt="">
                                        <div class="blog-date">
                                            <!-- <h6 class="font-weight-bold mb-n1">01</h6> -->
                                            <small class="font-weight-bold text-white text-uppercase ml-2"><?= $formater->date($value->created_date) ?></small>
                                        </div>
                                    </div>
                                    <div class="bg-white p-4">
                                        <div class="d-flex mb-2">
                                            <a class="text-primary text-uppercase text-decoration-none" href=""><?= $value['title'] ?></a>
                                        </div>
                                        <a class="h5 m-0 text-decoration-none" href="<?= Yii::getAlias('@web/site/detail') ?>"><?= $value->short_description ?></a>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } ?>
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-lg justify-content-center bg-white mb-0" style="padding: 30px;">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <!-- Search Form -->
                <div class="mb-5">
                    <div class="bg-white" style="padding: 30px;">
                        <div class="input-group">
                            <input type="text" class="form-control p-4" placeholder="Keyword">
                            <div class="input-group-append">
                                <span class="input-group-text bg-primary border-primary text-white"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category List -->
                <div class="mb-5">
                    <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Categories</h4>
                    <div class="bg-white" style="padding: 30px;">
                        <ul class="list-inline m-0">
                            <li class="mb-3 d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Camping Trip</a>
                                <span class="badge badge-primary badge-pill">150</span>
                            </li>
                            <li class="mb-3 d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Solo Travel</a>
                                <span class="badge badge-primary badge-pill">131</span>
                            </li>
                            <li class="mb-3 d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Calture</a>
                                <span class="badge badge-primary badge-pill">78</span>
                            </li>
                            <li class="mb-3 d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Adventure</a>
                                <span class="badge badge-primary badge-pill">56</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#"><i class="fa fa-angle-right text-primary mr-2"></i>Group Travel</a>
                                <span class="badge badge-primary badge-pill">98</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Recent Post -->
                <div class="mb-5">
                    <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Recent Post</h4>
                    <?php if (!empty($threeblog)) {
                        foreach ($threeblog as $key => $value) { ?>
                            <a class="d-flex align-items-center text-decoration-none bg-white mb-3" href="">
                                <img class="img-fluid" onerror="this.onerror=null;this.src='<?= Yii::getAlias('@web/app/img/no-img.png') ?>';" src="<?= $value->getUploadUrl('img_url') ?>" alt="" style="max-width:40%;">
                                <div class="pl-3">
                                    <h6 class="ml-1"><?= $value['title'] ?></h6>
                                    <small class=""><?= $formater->date($value->created_date) ?></small>
                                </div>
                            </a>
                    <?php
                        }
                    } ?>
                </div>

                <!-- Tag Cloud -->
                <div class="mb-5">
                    <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Tag Cloud</h4>
                    <div class="d-flex flex-wrap m-n1">
                        <a href="" class="btn btn-light m-1">Camping</a>
                        <a href="" class="btn btn-light m-1">Calture</a>
                        <a href="" class="btn btn-light m-1">Adventure</a>
                        <a href="" class="btn btn-light m-1">Mountain</a>
                        <a href="" class="btn btn-light m-1">Nature</a>
                        <a href="" class="btn btn-light m-1">Food</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->