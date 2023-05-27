<?php
$this->title = 'Your wishlist';
?>
<style>
    .text-justify {
        text-align: center;
    }
</style>
<section class="h-100 h-custom mt-5">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Your wishlist</h1>
                                        <h6 class="mb-0 text-muted"> <i class="fas fa-heart"></i> 5 activities</h6>
                                    </div>
                                    <hr class="my-4">
                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="../app/img/photo-4.png" class="img-fluid rounded-3" style="max-width:160%;margin-top:-5px" alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4 ml-5">
                                            <h6 class="m-1">Yeak loam crater lake</h6>
                                            <div class="d-flexmb-3">
                                                <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>Ratanakiri</small>
                                            </div>
                                            <div class="d-flexmb-3">
                                                <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i>3 days</small>
                                            </div>
                                            <div class="d-flexmb-3">
                                                <small class="m-0"><i class="fa fa-user text-primary mr-2"></i>2 </small>
                                            </div>
                                            <div class="d-flexmb-3">
                                                <small class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small>(250)</small></small>
                                            </div>
                                            <div class="d-flexm-3">
                                                <small><i class="fa fa-clock text-primary mr-2"></i> July 01, 2023</small>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
                                            <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control form-control-lg" />

                                            <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2 offset-lg-1" style="margin-top: -50px;">
                                            <div class="d-flexm-3 text-right mb-4">
                                                <a href="#!" class="text-muted"><i class="fas fa-trash"></i></a>
                                            </div>
                                            <h6 class="mb-0 text-right">$ 84.00</h6>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="../app/img/photo-5.png" class="img-fluid rounded-3" style="max-width:160%;margin-top:-5px" alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4 ml-5">
                                            <h6 class="m-1">kbal spean cambodia</h6>
                                            <div class="d-flexmb-3">
                                                <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>SR</small>
                                            </div>
                                            <div class="d-flexmb-3">
                                                <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i>2 days</small>
                                            </div>
                                            <div class="d-flexmb-3">
                                                <small class="m-0"><i class="fa fa-user text-primary mr-2"></i>6 </small>
                                            </div>
                                            <div class="d-flexmb-3">
                                                <small class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small>(250)</small></small>
                                            </div>
                                            <div class="d-flexm-3">
                                                <small><i class="fa fa-clock text-primary mr-2"></i> July 01, 2023</small>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
                                            <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control form-control-lg" />

                                            <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2 offset-lg-1" style="margin-top: -50px;">
                                            <div class="d-flexm-3 text-right mb-4">
                                                <a href="#!" class="text-muted"><i class="fas fa-trash"></i></a>
                                            </div>
                                            <h6 class="mb-0 text-right">$ 95.00</h6>
                                        </div>
                                    </div>


                                    <hr class="my-4">

                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="../app/img/photo-6.png" class="img-fluid rounded-3" style="max-width:160%;margin-top:-5px" alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4 ml-5">
                                            <h6 class="m-1">Royal Palace</h6>
                                            <div class="d-flexmb-3">
                                                <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>PP</small>
                                            </div>
                                            <div class="d-flexmb-3">
                                                <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i>2 days</small>
                                            </div>
                                            <div class="d-flexmb-3">
                                                <small class="m-0"><i class="fa fa-user text-primary mr-2"></i>5 </small>
                                            </div>
                                            <div class="d-flexmb-3">
                                                <small class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5 <small>(250)</small></small>
                                            </div>
                                            <div class="d-flexm-3">
                                                <small><i class="fa fa-clock text-primary mr-2"></i> July 01, 2023</small>
                                            </div>
                                        </div>



                                        <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
                                            <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control form-control-lg mw-100" />

                                            <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2 offset-lg-1" style="margin-top: -50px;">
                                            <div class="d-flexm-3 text-right mb-4">
                                                <a href="#!" class="text-muted"><i class="fas fa-trash"></i></a>
                                            </div>
                                            <h6 class="mb-0 text-right">$ 134.00</h6>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <div class="pt-5">
                                        <h6 class="mb-0"><a href="<?= Yii::getAlias('@web/site/package') ?>" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i> Back to shop</a></h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>