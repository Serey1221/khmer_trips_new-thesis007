<?php
$this->title = 'Your cart';
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
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Select participants and date</h1>

                                    </div>
                                    <hr class="my-4">
                                    <div class="pt-5">
                                        <h6 class="mb-0"><a href="<?= Yii::getAlias('@web/site/package') ?>" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="">Items 3</h5>
                                        <h5>$ 132.00</h5>
                                    </div>

                                    <!-- <h5 class="text-uppercase mb-3">Shipping</h5>

                                    <div class="mb-4 pb-2">
                                        <select class="select">
                                            <option value="1">Standard-Delivery- €5.00</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                            <option value="4">Four</option>
                                        </select>
                                    </div> -->

                                    <!-- <h5 class="text-uppercase mb-3">Give code</h5> -->

                                    <!-- <div class="mb-5">
                                        <div class="form-outline">
                                            <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Examplea2">Enter your code</label>
                                        </div>
                                    </div> -->

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="">Total price
                                            <small>
                                                <p class="mb-0">(including VAT)</p>
                                            </small>
                                        </h5>

                                        <h5>$ 137.00</h5>
                                    </div>

                                    <a href="<?= Yii::getAlias('@web/site/checkout') ?>" class="btn btn-primary btn-lg btn-block m-0"></i> Go to checkout</a>
                                    <!-- <button type="button" class="btn btn-primary btn-lg btn-block">
                                        Go to checkout
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>