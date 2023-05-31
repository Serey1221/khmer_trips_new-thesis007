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
                                        <h6 class="mb-0 text-muted"> <i class="fas fa-heart"></i> <?= count($model) ?> service(s)</h6>
                                    </div>
                                    <?php
                                    if (!empty($model)) {
                                        foreach ($model as $key => $value) {
                                            echo $value->getListItemTemplate([]);
                                        }
                                    } else {
                                        echo "<h5>There are no wishlist.</h5>";
                                    }
                                    ?>

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